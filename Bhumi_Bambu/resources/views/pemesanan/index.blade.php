@extends('layouts.app')
@section('title','Kelola Pesanan')

@section('content')
<div class="card-soft p-4">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h3 class="mb-0" style="font-weight:900;">Kelola Pesanan</h3>

    <button class="btn btn-brand rounded-pill px-4 py-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
      <i class="bi bi-plus-lg me-1"></i> Tambah pesanan
    </button>
  </div>

  <div class="table-responsive">
    <table class="table align-middle" id="pesananTable">
      <thead>
        <tr>
          <th style="width:65px;">No</th>
          <th>Nama Paket</th>
          <th>Nama Pelanggan</th>
          <th>Tanggal Acara</th>
          <th>Total Harga</th>
          <th>Status</th>
          <th style="width:120px;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pesanans as $i => $p)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $p->paket->nama_paket ?? $p->paket->nama ?? ('ID Paket: '.$p->id_paket) }}</td>
          <td>{{ $p->pelanggan->nama_pelanggan ?? $p->pelanggan->nama ?? ('ID Pelanggan: '.$p->id_pelanggan) }}</td>
          <td>{{ $p->tanggal_pesanan }}</td>
          <td>Rp {{ number_format($p->total_harga,0,',','.') }}</td>

          <td>
            @php
              $cls = $p->status_pesanan == 'Berhasil' ? 'status-pill status-berhasil'
                    : ($p->status_pesanan == 'Dibatalkan' ? 'status-pill status-dibatalkan'
                    : 'status-pill status-menunggu');
            @endphp
            <div class="dropdown">
              <button class="{{ $cls }}" data-bs-toggle="dropdown">{{ $p->status_pesanan }} <i class="bi bi-caret-down-fill ms-1"></i></button>
              <ul class="dropdown-menu">
                @foreach(['Menunggu','Berhasil','Dibatalkan'] as $st)
                <li>
                  <form action="{{ route('pesanan.update', $p->id) }}" method="POST" class="px-2 py-1">
                    @csrf @method('PUT')
                    <input type="hidden" name="id_paket" value="{{ $p->id_paket }}">
                    <input type="hidden" name="id_pelanggan" value="{{ $p->id_pelanggan }}">
                    <input type="hidden" name="id_promo" value="{{ $p->id_promo }}">
                    <input type="hidden" name="tanggal_pesanan" value="{{ $p->tanggal_pesanan }}">
                    <input type="hidden" name="total_harga" value="{{ $p->total_harga }}">
                    <input type="hidden" name="status_pesanan" value="{{ $st }}">
                    <button class="btn btn-sm w-100 text-start">{{ $st }}</button>
                  </form>
                </li>
                @endforeach
              </ul>
            </div>
          </td>

          <td>
            <button class="icon-btn me-1"
              title="Edit"
              data-bs-toggle="modal" data-bs-target="#modalEdit"
              data-id="{{ $p->id }}"
              data-id_paket="{{ $p->id_paket }}"
              data-id_pelanggan="{{ $p->id_pelanggan }}"
              data-id_promo="{{ $p->id_promo }}"
              data-tanggal="{{ $p->tanggal_pesanan }}"
              data-total="{{ $p->total_harga }}"
              data-status="{{ $p->status_pesanan }}"
            >
              <i class="bi bi-pencil-square"></i>
            </button>

            <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
              @csrf @method('DELETE')
              <button class="icon-btn" title="Hapus">
                <i class="bi bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted py-4">Data kosong</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content card-soft">
      <div class="modal-body p-4">
        <h5 class="mb-3" style="font-weight:900;">Tambah Pesanan</h5>

        <form action="{{ route('pesanan.store') }}" method="POST">
          @csrf

          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">ID Paket</label>
              <select class="form-select" name="id_paket">
                <option value="">-- pilih --</option>
                @foreach($pakets as $pk)
                  <option value="{{ $pk->id }}">{{ $pk->id }}</option>
                @endforeach
              </select>
            </div>

           <div class="col-6">
              <label class="form-label">Nama Pemesan *</label>
              <input type="string" class="form-control" name="nama_pemesan" required>
            </div>

            <div class="col-6">
              <label class="form-label">Tanggal Acara *</label>
              <input type="date" class="form-control" name="tanggal_pesanan" required>
            </div>

            <div class="col-6">
              <label class="form-label">ID Pelanggan</label>
              <select class="form-select" name="id_pelanggan">
                <option value="">-- pilih --</option>
                @foreach($pelanggans as $pl)
                  <option value="{{ $pl->id }}">{{ $pl->id }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-6">
              <label class="form-label">Total Harga *</label>
              <input type="number" class="form-control" name="total_harga" min="0" required>
            </div>

            <div class="col-12">
              <label class="form-label">ID Promo (opsional)</label>
              <select class="form-select" name="id_promo">
                <option value="">-- tanpa promo --</option>
                @foreach($promos as $pr)
                  <option value="{{ $pr->id }}">{{ $pr->id }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Status</label>
              <select class="form-select" name="status_pesanan">
                <option>Menunggu</option>
                <option>Berhasil</option>
                <option>Dibatalkan</option>
              </select>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-brand rounded-pill px-4">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- MODAL EDIT --}}
<div class="modal fade" id="modalEdit" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content card-soft">
      <div class="modal-body p-4">
        <h5 class="mb-3" style="font-weight:900;">Edit Pesanan</h5>

        <form id="formEdit" method="POST">
          @csrf @method('PUT')

          <div class="row g-3">
            <div class="col-6">
              <label class="form-label">ID Paket</label>
              <select class="form-select" name="id_paket" id="edit_id_paket">
                <option value="">-- pilih --</option>
                @foreach($pakets as $pk)
                  <option value="{{ $pk->id }}">{{ $pk->id }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-6">
              <label class="form-label">Tanggal Acara *</label>
              <input type="date" class="form-control" name="tanggal_pesanan" id="edit_tanggal" required>
            </div>

            <div class="col-6">
              <label class="form-label">ID Pelanggan</label>
              <select class="form-select" name="id_pelanggan" id="edit_id_pelanggan">
                <option value="">-- pilih --</option>
                @foreach($pelanggans as $pl)
                  <option value="{{ $pl->id }}">{{ $pl->id }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-6">
              <label class="form-label">Total Harga *</label>
              <input type="number" class="form-control" name="total_harga" id="edit_total" min="0" required>
            </div>

            <div class="col-12">
              <label class="form-label">ID Promo (opsional)</label>
              <select class="form-select" name="id_promo" id="edit_id_promo">
                <option value="">-- tanpa promo --</option>
                @foreach($promos as $pr)
                  <option value="{{ $pr->id }}">{{ $pr->id }}</option>
                @endforeach
              </select>
            </div>

            <div class="col-12">
              <label class="form-label">Status</label>
              <select class="form-select" name="status_pesanan" id="edit_status">
                <option>Menunggu</option>
                <option>Berhasil</option>
                <option>Dibatalkan</option>
              </select>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2 mt-4">
            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
            <button class="btn btn-brand rounded-pill px-4">Simpan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

{{-- MODAL SUKSES --}}
<div class="modal fade" id="modalSukses" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content card-soft">
      <div class="modal-body text-center p-5">
        <div style="font-size:64px;">✅</div>
        <div class="fw-bold mt-2">Berhasil</div>
        <button class="btn btn-light mt-3 px-4 rounded-pill" data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // search
  const searchInput = document.getElementById('searchInput');
  const table = document.getElementById('pesananTable');
  if (searchInput && table) {
    searchInput.addEventListener('input', function() {
      const q = this.value.toLowerCase();
      table.querySelectorAll('tbody tr').forEach(tr => {
        tr.style.display = tr.innerText.toLowerCase().includes(q) ? '' : 'none';
      });
    });
  }

  // modal edit
  const modalEdit = document.getElementById('modalEdit');
  modalEdit?.addEventListener('show.bs.modal', function (event) {
    const btn = event.relatedTarget;
    const id = btn.getAttribute('data-id');

    document.getElementById('formEdit').action = `{{ url('pesanan') }}/${id}`;
    document.getElementById('edit_id_paket').value = btn.getAttribute('data-id_paket') ?? '';
    document.getElementById('edit_id_pelanggan').value = btn.getAttribute('data-id_pelanggan') ?? '';
    document.getElementById('edit_id_promo').value = btn.getAttribute('data-id_promo') ?? '';
    document.getElementById('edit_tanggal').value = btn.getAttribute('data-tanggal') ?? '';
    document.getElementById('edit_total').value = btn.getAttribute('data-total') ?? '';
    document.getElementById('edit_status').value = btn.getAttribute('data-status') ?? 'Menunggu';
  });

  // popup sukses
  @if(session('success'))
    new bootstrap.Modal(document.getElementById('modalSukses')).show();
  @endif
</script>
@endpush