@extends('layout.app')

@section('title', 'Detail Buku')

@section('content')
    <h1>Detail Buku</h1>
    <p>ID yang diminta: {{ $id }}</p>
    <a href="{{ route('books.index') }}">Kembali</a>
@endsection
