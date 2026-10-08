@extends('layout.app')

@section('title', 'Preview Buku')

@section('content')
    <h1>Preview Buku</h1>
    <p>ID yang diminta: {{ $book->id }}</p>
    <p>Judul: {{ $book->title ?? 'Tidak tersedia' }}</p>
    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
