@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Daftar Pemasukan
        @auth
        <span style="color: blue;">{{ auth()->user()->name }}</span>
        @endauth
    </h1>
    @auth
    <a href="{{ route('incomes.create') }}" class="btn btn-success">Tambah Pemasukan Baru</a>
    @endauth
</div>

<br><br>

@if (Session::has('message'))
<div class="alert alert-success" role="alert">
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ route('incomes.filter-and-display') }}" method="GET">
    <div class="row align-items-end justify-content-center">
        <div class="col-md-4 text-center">
            <label for="start_date" class="form-label">Mulai tanggal</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>
        <div class="col-md-4 text-center">
            <label for="end_date" class="form-label">Selesai tanggal</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>
        <div class="col-md-2 text-center">
            <button type="submit" class="btn btn-primary">Cari</button>
        </div>
    </div>
</form>

<br><br>

@auth
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr class="text-center">
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Deskripsi</th>
                <th>Tanggal Pemasukan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($incomes as $income)
            <tr class="text-center">
                <td>{{ $income->type }}</td>
                <td>Rp. {{ number_format($income->amount, 0, ',', '.') }}</td>
                <td>{{ $income->description }}</td>
                <td>{{ $income->income_date }}</td>
                <td>
                    <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('incomes.destroy', $income->id) }}" method="POST" style="display: inline;"
                        onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="alert alert-info" role="alert">
    Silakan login untuk melihat dan membuat daftar pemasukan.
</div>
@endauth

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus pemasukan ini?');
}
</script>
@endsection