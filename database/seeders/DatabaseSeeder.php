<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin / Petugas Perpustakaan
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.com',
            'password' => bcrypt('password123'),
        ]);

        // 2. Buat Kategori Contoh
        $kategoriPemrograman = Category::create([
            'name' => 'Pemrograman & Teknologi',
            'slug' => 'pemrograman-dan-teknologi',
        ]);

        $kategoriSains = Category::create([
            'name' => 'Sains & Matematika',
            'slug' => 'sains-dan-matematika',
        ]);

        $kategoriSastra = Category::create([
            'name' => 'Sastra & Novel',
            'slug' => 'sastra-dan-novel',
        ]);

        // 3. Buat Buku Contoh
        Book::create([
            'category_id' => $kategoriPemrograman->id,
            'isbn' => '978-602-04-1234-1',
            'title' => 'Belajar Web Development dengan Laravel 11',
            'author' => 'Ahmad Code',
            'publisher' => 'Informatika Press',
            'publication_year' => 2024,
            'total_stock' => 5,
            'available_stock' => 5,
            'rack_location' => 'Rak A-01',
        ]);

        Book::create([
            'category_id' => $kategoriPemrograman->id,
            'isbn' => '978-602-04-5678-9',
            'title' => 'Clean Code & Master Object Oriented Programming',
            'author' => 'Robert C.',
            'publisher' => 'Tech Publishing',
            'publication_year' => 2023,
            'total_stock' => 3,
            'available_stock' => 3,
            'rack_location' => 'Rak A-02',
        ]);

        Book::create([
            'category_id' => $kategoriSastra->id,
            'isbn' => '978-979-3062-92-0',
            'title' => 'Laskar Pelangi',
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'publication_year' => 2008,
            'total_stock' => 10,
            'available_stock' => 10,
            'rack_location' => 'Rak B-05',
        ]);

        // 4. Buat Anggota Contoh
        Member::create([
            'nisn' => '0051234567',
            'name' => 'Budi Santoso',
            'class' => 'XI RPL 1',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 10',
        ]);

        Member::create([
            'nisn' => '0057654321',
            'name' => 'Siti Aminah',
            'class' => 'X TKJ 2',
            'phone' => '089876543210',
            'address' => 'Jl. Mawar No. 4',
        ]);
    }
}
