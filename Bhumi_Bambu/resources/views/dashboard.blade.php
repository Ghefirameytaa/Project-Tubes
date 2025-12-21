@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-4">
    <!-- Search Bar -->
    <div class="row mb-4 mt-4">
        <div class="col-md-6">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" placeholder="Cari" id="searchInput">
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <!-- Acara Berlangsung -->
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #2d5f3f 0%, #3a7750 100%); border-radius: 12px;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-subtitle mb-2" style="opacity: 0.85; font-size: 14px;">Acara<br>Berlangsung</h6>
                            <h1 class="card-title fw-bold mb-0" style="font-size: 48px;">{{ $acaraBerlangsung }}</h1>
                        </div>
                        <div class="stat-icon bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-calendar-check" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menunggu Konfirmasi -->
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #2d5f3f 0%, #3a7750 100%); border-radius: 12px;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-subtitle mb-2" style="opacity: 0.85; font-size: 14px;">Menunggu<br>Konfirmasi</h6>
                            <h1 class="card-title fw-bold mb-0" style="font-size: 48px;">{{ $menungguKonfirmasi }}</h1>
                        </div>
                        <div class="stat-icon bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-user-clock" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acara Selesai -->
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #2d5f3f 0%, #3a7750 100%); border-radius: 12px;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-subtitle mb-2" style="opacity: 0.85; font-size: 14px;">Acara<br>Selesai</h6>
                            <h1 class="card-title fw-bold mb-0" style="font-size: 48px;">{{ $acaraSelesai }}</h1>
                        </div>
                        <div class="stat-icon bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-check-circle" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Venue Terpakai -->
        <div class="col-md-3">
            <div class="card stat-card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #2d5f3f 0%, #3a7750 100%); border-radius: 12px;">
                <div class="card-body text-white p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-subtitle mb-2" style="opacity: 0.85; font-size: 14px;">Venue<br>Terpakai</h6>
                            <h1 class="card-title fw-bold mb-0" style="font-size: 48px;">{{ $venueTerpakai }}</h1>
                        </div>
                        <div class="stat-icon bg-white bg-opacity-25 p-3 rounded-circle">
                            <i class="fas fa-campground" style="font-size: 28px;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Pelanggan -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom py-3" style="border-radius: 12px 12px 0 0;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">Detail Pelanggan</h5>
                <div class="dropdown">
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dateDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ \Carbon\Carbon::parse($tanggal)->format('d F Y') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dateDropdown">
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['tanggal' => now()->format('Y-m-d')]) }}">Hari Ini</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.dashboard', ['tanggal' => now()->addDay()->format('Y-m-d')]) }}">Besok</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="px-3">
                            <form action="{{ route('admin.dashboard') }}" method="GET">
                                <label class="form-label small">Pilih Tanggal</label>
                                <input type="date" name="tanggal" class="form-control form-control-sm" value="{{ $tanggal }}" onchange="this.form.submit()">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="px-4 py-3 fw-semibold text-secondary" style="font-size: 13px;">Nama Paket</th>
                            <th class="py-3 fw-semibold text-secondary" style="font-size: 13px;">Nama Pelanggan</th>
                            <th class="py-3 fw-semibold text-secondary" style="font-size: 13px;">Tanggal Acara</th>
                            <th class="py-3 fw-semibold text-secondary" style="font-size: 13px;">Total Harga</th>
                            <th class="py-3 fw-semibold text-secondary" style="font-size: 13px;">Venue</th>
                            <th class="py-3 fw-semibold text-secondary" style="font-size: 13px;">Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($detailPelanggan as $item)
                        <tr>
                            <td class="px-4 py-3">{{ $item['nama_paket'] }}</td>
                            <td class="py-3">{{ $item['nama_pelanggan'] }}</td>
                            <td class="py-3">
                                <div>{{ $item['tanggal_acara'] }}</div>
                                <small class="text-muted">{{ $item['waktu_mulai'] }}</small>
                            </td>
                            <td class="py-3 fw-semibold">{{ $item['total_harga'] }}</td>
                            <td class="py-3">{{ $item['venue'] }}</td>
                            <td class="py-3">
                                @if($item['status'] === 'berhasil')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #10b981; font-size: 12px;">{{ $item['status_label'] }}</span>
                                @elseif($item['status'] === 'menunggu')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #f59e0b; font-size: 12px;">{{ $item['status_label'] }}</span>
                                @elseif($item['status'] === 'dibatalkan')
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #ef4444; font-size: 12px;">{{ $item['status_label'] }}</span>
                                @else
                                    <span class="badge rounded-pill px-3 py-2" style="background-color: #3b82f6; font-size: 12px;">{{ $item['status_label'] }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-calendar-times fa-3x mb-3 d-block opacity-25"></i>
                                    <p class="mb-0">Tidak ada acara pada tanggal ini</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    .stat-icon i {
        opacity: 0.8;
    }
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody tr');
        
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection