@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Promo</h2>

    <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">
        + Tambah Promo
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Promo</th>
                <th>Diskon</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($promos as $promo)
            <tr>
                <td>{{ $promo->nama_promo }}</td>
                <td>{{ $promo->diskon }}%</td>
                <td>
                    {{ $promo->tanggal_mulai }} <br>
                    {{ $promo->tanggal_selesai }}
                </td>
                <td>
                    @if(now()->between($promo->tanggal_mulai, $promo->tanggal_selesai))
                        <span class="badge bg-success">Aktif</span>
                    @else
                        <span class="badge bg-secondary">Nonaktif</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('promo.edit', $promo->id) }}"
                       class="btn btn-sm btn-warning">
                        ✏️ Edit
                    </a>

                    <form action="{{ route('promo.destroy', $promo->id) }}"
                          method="POST"
                          style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah promo ini akan dihapus?')">
                            🗑 Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL SUCCESS EDIT --}}
@if(session('success'))
<div class="promo-modal-overlay" id="promoModal">
    <div class="promo-modal">
        <div class="check-icon">✔</div>
        <h4>Edit promo berhasil</h4>
        <p>{{ session('success') }}</p>
        <button onclick="closePromoModal()">OK</button>
    </div>
</div>
@endif

{{-- JAVASCRIPT --}}
<script>
function closePromoModal() {
    document.getElementById('promoModal').style.display = 'none';
}
</script>
@endsection
