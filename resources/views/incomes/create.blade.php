@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Tambah Pemasukan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('incomes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="type" class="form-label">Tipe Pemasukan</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">Jumlah Pemasukan</label>
                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>



            <div class="mb-3">
                <label for="income_date" class="form-label">Tanggal Pemasukan</label>
                <input type="date" class="form-control" id="income_date" name="income_date" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        fetch('{{ route("incomes.store") }}', {
                method: 'POST',
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                // Redirect pengguna ke halaman pemasukan
                window.location.href = '{{ route("incomes.index") }}';
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
</script>
@endpush