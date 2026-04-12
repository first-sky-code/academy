@extends('backend.admintemplate')
@section('title', 'Halaman Admin')
@section('content')
    @include('navbars.admin_navbar')
    Selamat datang di halaman admin, {{ auth()->user()->name }}!
@endsection
