@extends('layouts.app')

@section('title','Kelola Pesanan')

@section('content')
<div class="card-soft p-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0" style="font-weight:900;">Kelola Pesanan</h2>

    <button class="btn btn-brand px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="bi bi-plus-lg me-2"></i>Tambah pesanan
    </button>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="fw-bold mb-1">Form belum benar:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th style="width:70px;">No</th>
          <th>Nama Paket</th>
          <th>Nama Pelanggan</th>
          <th>Tanggal Acara</th>
          <th>Total Harga</th>
          <th>Status</th>
          <th style="width:140px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pesanan as $i => $row)
          @php
            $statusClass = match($row->status_pesanan){
              'Berhasil' => 'status-berhasil',
              'Menunggu' => 'status-menunggu',
              'Dibatalkan' => 'status-dibatalkan',
              default => 'status-menunggu',
            };
            $modalId = 'modalEdit_' . $row->id;
          @endphp

          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $row->paket?->nama_paket ?? '-' }}</td>
            <td>{{ $row->pelanggan?->nama_pelanggan ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($row->tanggal_pesanan)->format('d M Y') }}</td>
            <td>Rp{{ number_format($row->total_harga, 0, ',', '.') }}</td>
            <td><span class="status-pill {{ $statusClass }}">{{ $row->status_pesanan }}</span></td>
            <td class="d-flex gap-2">
              <button type="button" class="icon-btn" title="Edit" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                <i class="bi bi-pencil text-warning"></i>
              </button>

              <form action="{{ route('pesanan.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pesanan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="icon-btn" title="Hapus">
                  <i class="bi bi-trash text-danger"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-4">Data kosong</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:18px;">
      <div class="modal-body p-4">
        <h4 style="font-weight:900;">Tambah Pesanan</h4>

        <form action="{{ route('pesanan.store') }}" method="POST" class="mt-3">
          @csrf
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Paket *</label>
              <select name="id_paket" class="form-select" required>
                <option value="">-- pilih paket --</option>
                @foreach($paket as $p)
                  <option value="{{ $p->id }}">{{ $p->nama_paket }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Tanggal Acara *</label>
              <input type="date" name="tanggal_pesanan" class="form-control" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Pelanggan *</label>
              <select name="id_pelanggan" class="form-select" required>
                <option value="">-- pilih pelanggan --</option>
                @foreach($pelanggan as $pl)
                  <option value="{{ $pl->id }}">{{ $pl->nama_pelanggan }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Total harga *</label>
              <input type="number" name="total_harga" class="form-control" min="0" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Status *</label>
              <select name="status_pesanan" class="form-select" required>
                <option value="Berhasil">Berhasil</option>
                <option value="Menunggu">Menunggu</option>
                <option value="Dibatalkan">Dibatalkan</option>
              </select>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-warning px-4 rounded-pill" style="font-weight:800;">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@foreach($pesanan as $row)
  @php $modalId = 'modalEdit_' . $row->id; @endphp
  <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content" style="border-radius:18px;">
        <div class="modal-body p-4">
          <h4 style="font-weight:900;">Edit Pesanan</h4>

          <form action="{{ route('pesanan.update', $row->id) }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-bold">Nama Paket *</label>
                <select name="id_paket" class="form-select" required>
                  @foreach($paket as $p)
                    <option value="{{ $p->id }}" {{ (int)$row->id_paket === (int)$p->id ? 'selected' : '' }}>
                      {{ $p->nama_paket }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold">Tanggal Acara *</label>
                <input type="date" name="tanggal_pesanan" class="form-control" value="{{ $row->tanggal_pesanan }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold">Nama Pelanggan *</label>
                <select name="id_pelanggan" class="form-select" required>
                  @foreach($pelanggan as $pl)
                    <option value="{{ $pl->id }}" {{ (int)$row->id_pelanggan === (int)$pl->id ? 'selected' : '' }}>
                      {{ $pl->nama_pelanggan }}
                    </option>
                  @endforeach
                </select>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold">Total harga *</label>
                <input type="number" name="total_harga" class="form-control" min="0" value="{{ $row->total_harga }}" required>
              </div>

              <div class="col-md-6">
                <label class="form-label fw-bold">Status *</label>
                <select name="status_pesanan" class="form-select" required>
                  <option value="Berhasil" {{ $row->status_pesanan === 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                  <option value="Menunggu" {{ $row->status_pesanan === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                  <option value="Dibatalkan" {{ $row->status_pesanan === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
              <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-warning px-4 rounded-pill" style="font-weight:800;">Simpan</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
@endforeach
@endsection
