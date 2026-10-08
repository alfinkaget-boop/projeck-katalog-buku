@extends('Layout.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku</h1>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf
         @include('books._form')
        {{-- Judul Buku --}}
        <div>
            <label for="title">Judul Buku *</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title') }}" 
                required
            >
            @error('title')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Penulis --}}
        <div>
            <label for="author">Penulis *</label>
            <input 
                type="text" 
                id="author" 
                name="author" 
                value="{{ old('author') }}" 
                required
            >
            @error('author')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Harga --}}
        <div>
            <label for="price">Harga *</label>
            <input 
                type="number" 
                step="0.01" 
                id="price" 
                name="price" 
                value="{{ old('price') }}" 
                min="0" 
                required
            >
            @error('price')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        {{-- Stok --}}
        <div>
            <label for="stock">Stok *</label>
            <input 
                type="number" 
                id="stock" 
                name="stock" 
                value="{{ old('stock') }}" 
                min="0" 
                required
            >
            @error('stock')
                <small style="color: red;">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit">Simpan</button>
    </form>
@endsection