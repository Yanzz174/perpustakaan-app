<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])->latest()->get();
        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::where('available_stock', '>', 0)->get();
        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
        ]);

        DB::transaction(function () use ($request) {
            $book = Book::findOrFail($request->book_id);
            $borrowCode = 'TRX-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

            $borrowing = Borrowing::create([
                'borrow_code' => $borrowCode,
                'member_id' => $request->member_id,
                'user_id' => auth()->id(),
                'borrow_date' => $request->borrow_date,
                'return_date' => $request->return_date,
                'status' => 'dipinjam',
            ]);

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book->id,
                'qty' => 1,
            ]);

            $book->decrement('available_stock');
        });

        return redirect()->route('borrowings.index')->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    public function approve(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return redirect()->back()->with('error', 'Transaksi ini tidak dalam status pending.');
        }

        DB::transaction(function () use ($borrowing) {
            $borrowing->update(['status' => 'dipinjam']);

            foreach ($borrowing->details as $detail) {
                $detail->book->decrement('available_stock');
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Pengajuan peminjaman berhasil disetujui!');
    }

    public function reject(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return redirect()->back()->with('error', 'Transaksi ini tidak dalam status pending.');
        }

        $borrowing->update(['status' => 'ditolak']);

        return redirect()->route('borrowings.index')->with('success', 'Pengajuan peminjaman telah ditolak.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'dipinjam') {
            return redirect()->back()->with('error', 'Transaksi ini sudah selesai.');
        }

        DB::transaction(function () use ($borrowing) {
            $today = Carbon::today();
            $dueDate = Carbon::parse($borrowing->return_date);
            $fine = 0;
            $status = 'dikembalikan';

            $setting = Setting::first();
            $finePerDay = $setting ? $setting->fine_per_day : 1000;

            if ($today->gt($dueDate)) {
                $lateDays = $today->diffInDays($dueDate);
                $fine = $lateDays * $finePerDay;
                $status = 'terlambat';
            }

            $borrowing->update([
                'actual_return_date' => $today->toDateString(),
                'status' => $status,
                'total_fine' => $fine,
            ]);

            foreach ($borrowing->details as $detail) {
                $detail->book->increment('available_stock');
            }
        });

        return redirect()->route('borrowings.index')->with('success', 'Buku berhasil dikembalikan!');
    }
}
