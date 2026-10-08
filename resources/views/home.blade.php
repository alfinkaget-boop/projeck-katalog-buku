@extends('layout.app')

@section('title', 'Beranda')

@section('content')
    <h1>Selamat Datang di Katalog Buku</h1>
    <p>Kelola dan jelajahi koleksi buku Anda dengan mudah.</p>
    <p>
        <a href="{{ url('books') }}">Lihat Data Buku</a>
    </p>
@endsection
