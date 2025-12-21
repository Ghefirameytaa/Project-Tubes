@extends('layouts.app')

@section('content')

<style>
/* Wrapper */
.promo-wrapper {
    background: #e6e6e6;
    min-height: 100vh;
    padding: 40px;
}

/* Card */
.promo-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 32px;
    max-width: 900px;
    margin: auto;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

/* Title */
.promo-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 24px;
}

/* Grid */
.promo-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 32px;
}

/* Form */
.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
}

.form-group label span {
    color: red;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

.form-group textarea {
    resize: none;
    height: 80px;
}

/* Actions */
.promo-actions {
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    margin-top: 24px;
}

/* Buttons */
.btn-cancel {
    background: #d1d1d1;
    color: #333;
    padding: 10px 22px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 500;
}

.btn-save {
    background: #f58220;
    color: white;
    padding: 10px 26px;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
}

.btn-save:hover {
    background: #e06f10;
}
</style>

<div class="promo-wrapper">
    <div class="promo-card">

        <h2 class="promo-title">Tambah Promo</h2>

        <form action="{{ route('promo.store') }}" method="POST">
            @csrf

            <div class="promo-grid">
                <!-- KIRI -->
                <div>
                    <div class="form-group">
                        <label>Nama Promo <span>*</span></label>
                        <input type="text" name="nama_promo" required>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi <span>*</span></label>
                        <textarea name="deskripsi" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Diskon (%) <span>*</span></label>
                        <input type="number" name="diskon" required>
                    </div>
                </div>

                <!-- KANAN -->
                <div>
                    <div class="form-group">
                        <label>Tanggal Mulai <span>*</span></label>
                        <input type="date" name="tanggal_mulai" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Selesai <span>*</span></label>
                        <input type="date" name="tanggal_selesai" required>
                    </div>
                </div>
            </div>

            <div class="promo-actions">
                <a href="{{ route('promo.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save">Simpan</button>
            </div>

        </form>
    </div>
</div>

@endsection
