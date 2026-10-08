@extends('layout.app')

@section('title', 'Detail Buku')

@section('content')
    @if (session('status'))
        <p role="status">{{ session('status') }}</p>
    @endif

    <h1>{{ $book->title }}</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>ISBN</th>
            <td>{{ $book->isbn ?: '-' }}</td>
        </tr>
        <tr>
            <th>Penulis</th>
            <td>{{ $book->author }}</td>
        </tr>
        <tr>
            <th>Penerbit</th>
            <td>{{ $book->publisher ?: '-' }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $book->published_year ?? '-' }}</td>
        </tr>
        <tr>
            <th>Ditambahkan</th>
            <td>{{ $book->created_at->locale('id')->translatedFormat('j F Y, H:i') }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp {{ number_format((float) $book->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>
                @if ($book->stock === 0)
                    <strong>Stok Habis</strong>
                @else
                    {{ $book->stock }}
                @endif
            </td>
        </tr>
        <tr>
            <th>Deskripsi</th>
            <td>{{ $book->description ?: '-' }}</td>
        </tr>
    </table>

    <p>
        <a href="{{ route('books.edit', $book) }}">Edit</a>
        |
        <a href="{{ route('books.index') }}">Kembali</a>
    </p>

    <form method="POST" action="{{ route('books.destroy', $book) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Hapus Buku</button>
    </form>
@endsection