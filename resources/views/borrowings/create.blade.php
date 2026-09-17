<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Transaksi Peminjaman Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Anggota (Siswa)</label>
                        <select name="member_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}">{{ $member->nisn }} - {{ $member->name }} ({{ $member->class }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Pilih Buku yang Dipinjam</label>
                        <select name="book_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih Buku --</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}">{{ $book->title }} (Stok Tersedia: {{ $book->available_stock }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                            <input type="date" name="borrow_date" value="{{ date('Y-m-d') }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Harus Kembali</label>
                            <input type="date" name="return_date" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('borrowings.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">Simpan Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
