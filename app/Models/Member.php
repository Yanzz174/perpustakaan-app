<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['nisn', 'name', 'class', 'phone', 'address'];

    // Relasi: 1 Anggota bisa melakukan banyak Peminjaman
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
