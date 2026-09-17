<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\PublicCatalogController;
use App\Http\Controllers\SettingController;

// Route Akses Publik
Route::get('/', [PublicCatalogController::class, 'index'])->name('catalog.index');
Route::get('/cek-pinjaman', [PublicCatalogController::class, 'checkBorrowing'])->name('catalog.check');
Route::post('/ajukan-pinjam', [PublicCatalogController::class, 'requestBorrow'])->name('catalog.request');

// Route Dashboard
Route::get('/dashboard', function () {
    $totalBooks = \App\Models\Book::sum('total_stock');
    $totalMembers = \App\Models\Member::count();
    $activeBorrowings = \App\Models\Borrowing::where('status', 'dipinjam')->count();
    $totalFines = \App\Models\Borrowing::sum('total_fine');
    $recentBorrowings = \App\Models\Borrowing::with(['member', 'details.book'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalBooks',
        'totalMembers',
        'activeBorrowings',
        'totalFines',
        'recentBorrowings'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Admin (Memerlukan Login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route Custom Member (Harus di ATAS Route::resource('members'))
    Route::get('/members/template', [MemberController::class, 'downloadTemplate'])->name('members.template');
    Route::post('/members/import', [MemberController::class, 'import'])->name('members.import');

    // Master Data
    Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('members', MemberController::class);

    // Transaksi Peminjaman & Approval
    Route::resource('borrowings', BorrowingController::class)->only(['index', 'create', 'store']);
    Route::patch('borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
    Route::patch('borrowings/{borrowing}/approve', [BorrowingController::class, 'approve'])->name('borrowings.approve');
    Route::patch('borrowings/{borrowing}/reject', [BorrowingController::class, 'reject'])->name('borrowings.reject');

    // Pengaturan Web Dinamis
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
