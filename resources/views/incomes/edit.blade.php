@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Edit Pemasukan</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('incomes.update', $income->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Pemasukan</label>
                <input type="text" class="form-control" id="type" name="type" value="{{ $income->type }}" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pemasukan</label>
                <input type="number" class="form-control" id="amount" name="amount" value="{{ $income->amount }}"
                    step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3"
                    required>{{ $income->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="income_date" class="form-label">Tanggal Pemasukan</label>
                <input type="date" class="form-control" id="income_date" name="income_date"
                    value="{{ $income->income_date }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection