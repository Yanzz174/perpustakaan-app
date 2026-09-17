<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrow_code', 'member_id', 'user_id',
        'borrow_date', 'return_date', 'actual_return_date',
        'status', 'total_fine'
    ];

    // Relasi: Peminjaman dilakukan oleh 1 Anggota
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Relasi: Peminjaman dilayani oleh 1 User (Petugas)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Peminjaman memiliki banyak item buku (Detail)
    public function details()
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}
