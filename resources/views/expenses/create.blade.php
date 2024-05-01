<!-- resources/views/expenses/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Pengeluaran Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('expenses.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Pengeluaran</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="expense_date" class="form-label">Tanggal Pengeluaran</label>
                <input type="date" class="form-control" id="expense_date" name="expense_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('expenseForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        fetch('/api/expenses', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                // Redirect pengguna ke halaman pengeluaran
                window.location.href = '/show-expenses';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
</script>
@endpush