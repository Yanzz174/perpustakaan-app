<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class PublicCatalogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $books = Book::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('author', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(8);

        return view('welcome', compact('books', 'search'));
    }

    public function checkBorrowing(Request $request)
    {
        $nisn = $request->query('nisn');
        $member = null;

        if ($nisn) {
            $member = Member::with(['borrowings.details.book'])
                ->where('nisn', $nisn)
                ->first();
        }

        return view('check-borrowing', compact('member', 'nisn'));
    }

    public function requestBorrow(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|exists:members,nisn',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
        ]);

        $member = Member::where('nisn', $request->nisn)->first();
        $book = Book::findOrFail($request->book_id);

        if ($book->available_stock < 1) {
            return redirect()->back()->with('error', 'Stok buku sedang habis.');
        }

        $activeCount = Borrowing::where('member_id', $member->id)
            ->whereIn('status', ['pending', 'dipinjam'])
            ->count();

        if ($activeCount >= 2) {
            return redirect()->back()->with('error', 'Gagal! Siswa masih memiliki 2 pinjaman aktif/pending.');
        }

        $borrowCode = 'REQ-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        $setting = Setting::first();
        $maxDays = $setting ? $setting->max_borrow_days : 7;
        $returnDate = date('Y-m-d', strtotime($request->borrow_date . " +{$maxDays} days"));

        $borrowing = Borrowing::create([
            'borrow_code' => $borrowCode,
            'member_id' => $member->id,
            'user_id' => 1,
            'borrow_date' => $request->borrow_date,
            'return_date' => $returnDate,
            'status' => 'pending',
        ]);

        BorrowingDetail::create([
            'borrowing_id' => $borrowing->id,
            'book_id' => $book->id,
            'qty' => 1,
        ]);

        return redirect()->route('catalog.check', ['nisn' => $member->nisn])
            ->with('success', 'Pengajuan berhasil dikirim! Silakan tunggu konfirmasi petugas.');
    }
}
