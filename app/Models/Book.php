<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'isbn', 'title', 'author',
        'publisher', 'publication_year', 'total_stock',
        'available_stock', 'rack_location', 'cover_image'
    ];

    // Relasi: Buku dimiliki oleh 1 Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Buku bisa ada di banyak Detail Peminjaman
    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class);
    }
}
