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
      <tbody id="pesananTbody">
        <tr>
          <td colspan="7" class="text-center text-muted py-4">Data kosong</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:18px;">
      <div class="modal-body p-4">
        <h4 style="font-weight:900;">Tambah Pesanan</h4>

        <form id="formTambah" class="mt-3">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Paket *</label>
              <input type="text" class="form-control" id="tambahNamaPaket" placeholder="Ketik nama paket..." required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Tanggal Acara *</label>
              <input type="date" class="form-control" id="tambahTanggal" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Pelanggan *</label>
              <input type="text" class="form-control" id="tambahNamaPelanggan" placeholder="Ketik nama pelanggan..." required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Total harga *</label>
              <input type="number" class="form-control" id="tambahTotal" min="0" placeholder="Contoh: 300000" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Status *</label>
              <select class="form-select" id="tambahStatus" required>
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

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border-radius:18px;">
      <div class="modal-body p-4">
        <h4 style="font-weight:900;">Edit Pesanan</h4>

        <form id="formEdit" class="mt-3">
          <input type="hidden" id="editId">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Paket *</label>
              <input type="text" class="form-control" id="editNamaPaket" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Tanggal Acara *</label>
              <input type="date" class="form-control" id="editTanggal" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Nama Pelanggan *</label>
              <input type="text" class="form-control" id="editNamaPelanggan" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Total harga *</label>
              <input type="number" class="form-control" id="editTotal" min="0" required>
            </div>

            <div class="col-md-6">
              <label class="form-label fw-bold">Status *</label>
              <select class="form-select" id="editStatus" required>
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
@endsection

@push('scripts')
<script>
  const KEY = 'pesanan_manual_v1';

  function rupiah(n){
    const num = Number(n || 0);
    return 'Rp' + num.toLocaleString('id-ID');
  }

  function statusClass(status){
    if(status === 'Berhasil') return 'status-berhasil';
    if(status === 'Menunggu') return 'status-menunggu';
    return 'status-dibatalkan';
  }

  function loadData(){
    try { return JSON.parse(localStorage.getItem(KEY)) || []; }
    catch(e){ return []; }
  }

  function saveData(data){
    localStorage.setItem(KEY, JSON.stringify(data));
  }

  function render(){
    const tbody = document.getElementById('pesananTbody');
    const data = loadData();

    if(data.length === 0){
      tbody.innerHTML = `<tr><td colspan="7" class="text-center text-muted py-4">Data kosong</td></tr>`;
      return;
    }

    tbody.innerHTML = data.map((row, idx) => `
      <tr>
        <td>${idx+1}</td>
        <td>${row.nama_paket}</td>
        <td>${row.nama_pelanggan}</td>
        <td>${new Date(row.tanggal).toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' })}</td>
        <td>${rupiah(row.total)}</td>
        <td><span class="status-pill ${statusClass(row.status)}">${row.status}</span></td>
        <td class="d-flex gap-2">
          <button class="icon-btn" title="Edit" onclick="openEdit('${row.id}')">
            <i class="bi bi-pencil text-warning"></i>
          </button>
          <button class="icon-btn" title="Hapus" onclick="hapus('${row.id}')">
            <i class="bi bi-trash text-danger"></i>
          </button>
        </td>
      </tr>
    `).join('');
  }

  document.getElementById('formTambah').addEventListener('submit', function(e){
    e.preventDefault();

    const data = loadData();
    data.unshift({
      id: crypto.randomUUID(),
      nama_paket: document.getElementById('tambahNamaPaket').value.trim(),
      nama_pelanggan: document.getElementById('tambahNamaPelanggan').value.trim(),
      tanggal: document.getElementById('tambahTanggal').value,
      total: document.getElementById('tambahTotal').value,
      status: document.getElementById('tambahStatus').value
    });

    saveData(data);
    render();

    this.reset();
    bootstrap.Modal.getInstance(document.getElementById('modalTambah')).hide();
  });

  window.openEdit = function(id){
    const data = loadData();
    const row = data.find(x => x.id === id);
    if(!row) return;

    document.getElementById('editId').value = row.id;
    document.getElementById('editNamaPaket').value = row.nama_paket;
    document.getElementById('editNamaPelanggan').value = row.nama_pelanggan;
    document.getElementById('editTanggal').value = row.tanggal;
    document.getElementById('editTotal').value = row.total;
    document.getElementById('editStatus').value = row.status;

    new bootstrap.Modal(document.getElementById('modalEdit')).show();
  }

  document.getElementById('formEdit').addEventListener('submit', function(e){
    e.preventDefault();

    const id = document.getElementById('editId').value;
    const data = loadData();
    const idx = data.findIndex(x => x.id === id);
    if(idx === -1) return;

    data[idx] = {
      id,
      nama_paket: document.getElementById('editNamaPaket').value.trim(),
      nama_pelanggan: document.getElementById('editNamaPelanggan').value.trim(),
      tanggal: document.getElementById('editTanggal').value,
      total: document.getElementById('editTotal').value,
      status: document.getElementById('editStatus').value
    };

    saveData(data);
    render();

    bootstrap.Modal.getInstance(document.getElementById('modalEdit')).hide();
  });

  window.hapus = function(id){
    if(!confirm('Yakin hapus pesanan ini?')) return;
    const data = loadData().filter(x => x.id !== id);
    saveData(data);
    render();
  }

  render();
</script>
@endpush
