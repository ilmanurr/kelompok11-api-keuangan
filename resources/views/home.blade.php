@extends('layouts.main')

@section('container')
<h1>Selamat Datang di Budget-Qu</h1>
<p>Budget-Qu adalah sebuah platform yang dirancang untuk membantu pengguna dalam mencatat dan mengelola pemasukan dan
    pengeluaran mereka dengan lebih efektif </p>

<div class="container mt-4">
    <h1 class="mb-4">Saldo Terkini</h1>

    @auth
    <!-- Periksa apakah pengguna sudah login -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Saldo milik <span style="color: blue;">{{ auth()->user()->name }}</span></h5>
            <p class="card-text">
                Total Pendapatan: Rp.
                {{ number_format(auth()->user()->incomes()->sum('amount'), 0, ',', '.') }}
            </p>
            <p class="card-text">
                Total Pengeluaran: Rp.{{ number_format(auth()->user()->expenses()->sum('amount'), 0, ',', '.') }}
            </p>
            <p class="card-text">
                Saldo Saat Ini: Rp.
                {{ number_format(auth()->user()->incomes()->sum('amount') - auth()->user()->expenses()->sum('amount'), 0, ',', '.') }}
            </p>
        </div>
    </div>
    @endauth
    <!-- Akhir dari pengecekan login -->

    @guest
    <!-- Jika pengguna belum login -->
    <div class="alert alert-info" role="alert">
        Silakan login untuk melihat saldo terkini.
    </div>
    @endguest
    <!-- Akhir dari pengecekan pengguna belum login -->
</div>
@endsection