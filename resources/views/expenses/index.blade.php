@extends('layouts.main')

@section('container')
<div class="d-flex justify-content-between align-items-center">
    <h1>Daftar Pengeluaran
        @auth
        <span style="color: blue;">{{ auth()->user()->name }}</span>
        @endauth
    </h1>
    @auth
    <a href="{{ route('expenses.create') }}" class="btn btn-success">Tambah Pengeluaran Baru</a>
    @endauth
</div>

<br><br>

@if (Session::has('message'))
<div class="alert alert-success" role="alert">
    {{ Session::get('message') }}
</div>
@endif

<form action="{{ route('expenses.filter-and-display') }}" method="GET">
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
                <th>Tanggal Pengeluaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
            <tr class="text-center">
                <td>{{ $expense->type }}</td>
                <td>Rp. {{number_format($expense->amount, 0, ',', '.') }}</td>
                <td>{{ $expense->description }}</td>
                <td>{{ $expense->expense_date }}</td>
                <td>
                    <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" style="display: inline;"
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
    Silakan login untuk melihat dan membuat daftar pengeluaran.
</div>
@endauth

<script>
function confirmDelete() {
    return confirm('Apakah Anda yakin ingin menghapus pengeluaran ini?');
}
</script>
@endsection