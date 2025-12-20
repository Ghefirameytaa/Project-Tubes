<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pembayaran</title>


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</a>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f4f6f8;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 240px;
            background: #ffffff;
            height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
        }

        .logo {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .menu a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin-bottom: 8px;
            text-decoration: none;
            color: #333;
            border-radius: 10px;
            font-size: 14px;
        }

        .menu a i {
            margin-right: 12px;
            width: 20px;
        }

        .menu a.active,
        .menu a:hover {
            background: #2f6f3e;
            color: #fff;
        }

        /* ================= MAIN ================= */
        .main {
            margin-left: 240px;
            min-height: 100vh;
        }

        /* ================= NAVBAR ================= */
        .topbar {
            height: 70px;
            background: #2f6f3e;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-box {
            background: #fff;
            border-radius: 25px;
            padding: 8px 15px;
            width: 350px;
            display: flex;
            align-items: center;
        }

        .search-box i {
            color: #aaa;
            margin-right: 10px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 14px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            color: #fff;
        }

        .topbar-right i {
            margin-right: 25px;
            font-size: 18px;
            cursor: pointer;
        }

        .profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .profile img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .profile-text {
            margin-right: 8px;
            line-height: 1.2;
        }

        .profile-text .name {
            font-size: 14px;
            font-weight: 500;
        }

        .profile-text .role {
            font-size: 12px;
            opacity: 0.8;
        }

        /* ================= CONTENT ================= */
        .content {
            padding: 30px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .content-header h2 {
            font-size: 22px;
            font-weight: 600;
        }

        .btn-add {
            background: #4f7f5f;
            color: #fff;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 14px;
            text-decoration: none;
        }

        /* ================= TABLE ================= */
        .card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f1f4f8;
        }

        th, td {
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        tr:not(:last-child) {
            border-bottom: 1px solid #eee;
        }

        /* ================= STATUS ================= */
        .status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            color: #fff;
            display: inline-block;
        }

        .success {
            background: #17b890;
        }

        .pending {
            background: #f4b400;
        }

        .cancel {
            background: #ff5c5c;
        }

        /* ================= ACTION ================= */
        .action i {
            cursor: pointer;
            margin-right: 12px;
            font-size: 15px;
        }

        .edit {
            color: #f4b400;
        }

        .delete {
            color: #ff5c5c;
        }
    </style>
</head>
<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <div class="logo">Bhumi Bambu</div>

    <div class="menu">
        <a href="#"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="#"><i class="fa-solid fa-list"></i> List Pesanan</a>
        <a href="#" class="active"><i class="fa-solid fa-wallet"></i> Pembayaran</a>
        <a href="#"><i class="fa-solid fa-box"></i> Paket</a>
        <a href="#"><i class="fa-solid fa-tag"></i> Promo</a>
        <a href="#"><i class="fa-solid fa-gear"></i> Peraturan</a>
        <a href="#"><i class="fa-solid fa-right-from-bracket"></i> Keluar</a>
    </div>
</div>

<!-- ================= MAIN ================= -->
<div class="main">

    <!-- NAVBAR -->
    <div class="topbar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari">
        </div>

        <div class="topbar-right">
            <i class="fa-regular fa-bell"></i>

            <div class="profile">
                <img src="https://i.pravatar.cc/40" alt="Admin">
                <div class="profile-text">
                    <div class="name">Ghefira Meyta</div>
                    <div class="role">Admin</div>
                </div>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="content-header">
            <h2>Detail Pembayaran</h2>
            <a href="#" class="btn-add">+ Tambah</a>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Nama Paket</th>
                        <th>Nama Pelanggan</th>
                        <th>Tanggal Acara</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Paket Bambu Area</td>
                        <td>Farah Rizki</td>
                        <td>Bambu Area</td>
                        <td>Rp300.000</td>
                        <td><span class="status success">Berhasil</span></td>
                        <td class="action">
                            <i class="fa-solid fa-pen edit"></i>
                            <i class="fa-solid fa-trash delete"></i>
                        </td>
                    </tr>

                    <tr>
                        <td>Paket Bhumi Area</td>
                        <td>Abimanyu</td>
                        <td>Bhumi Area</td>
                        <td>Rp400.000</td>
                        <td><span class="status pending">Menunggu</span></td>
                        <td class="action">
                            <i class="fa-solid fa-pen edit"></i>
                            <i class="fa-solid fa-trash delete"></i>
                        </td>
                    </tr>

                    <tr>
                        <td>Paket Edukasi</td>
                        <td>Jaehyun Jung</td>
                        <td>Outdoor</td>
                        <td>Rp500.000</td>
                        <td><span class="status cancel">Dibatalkan</span></td>
                        <td class="action">
                            <i class="fa-solid fa-pen edit"></i>
                            <i class="fa-solid fa-trash delete"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>