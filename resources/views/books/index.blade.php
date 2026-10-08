@extends('Layout.app')

@section('title', 'Data Buku')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Daftar Buku</h1>
        <a href="{{ route('books.create') }}" style="padding: 8px 16px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">
            + Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div style="padding:10px; background:#d4edda; color:#155724; margin-bottom:15px; border-radius:4px;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; text-align: left; margin-bottom: 20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $books->firstItem() + $loop->index }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                    <td>
                        @if($book->stock == 0)
                            <span style="color: red; font-weight: bold;">Stok Habis</span>
                        @else
                            {{ $book->stock }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book) }}">Detail</a> |
                        <a href="{{ route('books.preview', $book) }}">Preview</a> |
                        <a href="{{ route('books.edit', $book) }}">Edit</a> |
                        <form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Hapus data buku ini?')" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer; text-decoration:underline; padding:0;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Data belum tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($books->hasPages())
        <nav style="margin-top: 15px;">
            @if ($books->onFirstPage())
                <span>Sebelumnya</span>
            @else
                <a href="{{ $books->previousPageUrl() }}">Sebelumnya</a>
            @endif
            <span style="margin: 0 10px;">Halaman {{ $books->currentPage() }} dari {{ $books->lastPage() }}</span>
            @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}">Berikutnya</a>
            @endif
        </nav>
    @endif
@endsection