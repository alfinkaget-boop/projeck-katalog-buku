@extends('layout.app')

@section('content')
    <h1>Edit Buku: {{ $book->title }}</h1>

    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom:12px;">
            <label for="title">Judul</label><br>
            <input id="title" name="title" value="{{ old('title', $book->title ?? '') }}" style="width:100%; padding:8px;">
            @error('title') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label for="author">Penulis</label><br>
            <input id="author" name="author" value="{{ old('author', $book->author ?? '') }}" style="width:100%; padding:8px;">
        </div>

        <div style="margin-bottom:12px;">
            <label for="stock">Stok</label><br>
            <input id="stock" type="number" name="stock" value="{{ old('stock', $book->stock ?? 0) }}" style="width:100%; padding:8px;">
            @error('stock') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label for="price">Harga</label><br>
            <input id="price" type="number" name="price" value="{{ old('price', $book->price ?? 0) }}" style="width:100%; padding:8px;">
            @error('price') <small style="color:red">{{ $message }}</small> @enderror
        </div>

        <div style="margin-bottom:12px;">
            <label for="description">Deskripsi</label><br>
            <textarea id="description" name="description" style="width:100%; padding:8px;">{{ old('description', $book->description ?? '') }}</textarea>
        </div>

        <button type="submit" style="padding:10px 20px; background:#28a745; color:white; border:none; border-radius:4px;">Simpan Perubahan</button>
        <a href="{{ route('books.index') }}" style="margin-left:10px;">Batal</a>
    </form>
@endsection