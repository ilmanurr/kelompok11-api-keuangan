@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Pengeluaran</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Pengeluaran</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $expense->type }}" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pengeluaran</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $expense->amount }}"
                    step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required>{{ $expense->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="expense_date" class="form-label">Tanggal Pengeluaran</label>
                <input type="date" class="form-control" id="expense_date" name="expense_date"
                    value="{{ $expense->expense_date }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection