<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Bhumi Bambu Baturraden</title>

    <style>
        .logo {
            display: flex; 
            align-items: center; 
            margin-left: 20px; 
            gap: 10px;
        }
        
        .logo img {
            width: 110px; 
            height: 40px; 
            object-fit: cover;
        }
        
        .logo span {
            font-size: 20px; 
            font-weight: bold;
        }

        body { 
            margin: 0; 
            font-family: 'Poppins'; 
            background: #f5f5f5; 
        }

        header { 
            background: #2C5F2D; 
            padding: 20px 80px; 
            color: white; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }

        .menu {
            flex: 1;
            display: flex; 
            justify-content: center;
            gap: 10px;
            margin-left: 100px;
        }

        .menu a{
            color: white;
            text-decoration: none;
        }

        .auth {
            display: flex; 
            gap: 20px;
        }

        .btn-login {
            background: white;  
            padding: 5px 10px; 
            border-radius: 10px; 
            color: #2C5F2D; 
            text-decoration: none;
            outline: none;
        }

        .btn-daftar {
            background: white; 
            padding: 5px 10px; 
            border-radius: 10px; 
            color: #2C5F2D;
            margin-right: 40px;
            text-decoration: none;
            outline: none ;
        }

        .hero { 
            position: relative; 
        }

        .hero img { 
            width: 100%; 
            height: 550px; 
            object-fit: cover; 
            filter: brightness(60%); 
        }

        .hero-text {
            position: absolute;
            top: 40%; 
            left: 50%; 
            transform: translate(-50%, -50%);
            color: white; 
            text-align: center;
        }

        .btn {
            background: #39a86b; 
            padding: 10px 20px; 
            color: white; 
            border-radius: 10px;
            text-decoration: none; 
            font-weight: bold;
        }

        .section { 
            padding: 30px 10px; 
        }

        .flex { 
            display: flex; 
            gap: 30px; 
            justify-content: center; 
            flex-wrap: wrap; 
        }

        .isi{
            padding: 20px 80px;
            /* background: white; */
            margin-left: 40px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 10px; 
        }

        .testimonial-wrapper {
            display: flex;
            gap: 20px;
            justify-content: center;
            padding:60px 0px;
            background: #f5f5f5;
            flex-wrap: wrap;
            margin-top: -20px;
        }
        
        .testimonial-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 5px;
            width: 330px;
            height: 125px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .rating {
            color: #ff8c32;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .name {
            font-weight: 50px;
            margin-top: 5px;
        }

        .quote {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .section-paragraf {
            max-width: 500px;        
            margin-left: 110px;   
            text-align: left;       
            line-height: 1.6;       
            font-size: 14px;
            color: #555;
            margin-top: 50px;
        }

        .promos-wrapper {
            display: flex;
            gap: 20px;
            justify-content: center;
            padding:25px 0px;
            background: #f5f5f5;
            flex-wrap: wrap;
            margin-top: -30px;
        }

        .promos-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 5px;
            width: 330px;
            height: 125px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            /* margin-bottom: 20px; */
        }

        .promos-tittle {
            font-size: 14px;
            margin-bottom: 10px;    
        }

        .promos-content {
            background: #E67E22;
            border-radius: 10px;
            padding: 5px;
            width: 250px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 15px;
            margin-left: 35px;
        }

        .promos-code {
            font-size: 12px;
        }

        footer {
            background: #1f2c2d;
            color: white;
            padding: 50px 80px;
            margin-top: 50px;
        }

        footer a { 
            color: #ffce83; 
            display: block; 
            text-decoration: none; 
            margin: 5px 0; }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header>
        <div class="logo">
            <img src="aset/logo.png" alt="Logo Bhumi Bambu">
            <span>Bhumi Bambu Baturraden</span>
        </div>

        <nav class="menu">
            <a href="#">Beranda</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Bantuan</a>
        </nav>

        <div class="auth">
            <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            <a href="#" class="btn-daftar">Daftar</a>
        </div>
    </header>

    <!-- HERO -->
    <div class="hero">
        <img src="aset/bg.jpeg" alt="Hero Image">
        <div class="hero-text">
            <h1>Rasakan Harmoni Alam di Bhumi Bambu</h1>
            <p>Wisata edukasi dan alam terbaik di Baturraden</p>
            <a href="#" class="btn">Pesan Sekarang →</a>
        </div>
    </div>

    <!-- PENGALAMAN -->
    <div class="sectionGambar">
        <div class="flex" style="margin-top: 30px;">
            <img src="aset/gambar1.jpeg" width="250" style="border-radius:10px;">
            <img src="aset/gambar2.jpeg" width="250" style="border-radius:10px;">
            <img src="aset/gambar3.jpeg" width="250" style="border-radius:10px;">
        </div>
    </div>

    <!-- FITUR -->
    <div class="isi">
        <h3>Pengalaman yang Bisa Kamu Nikmati</h3>
        <ul>
            <li>Berkemah</li>
            <li>Edukasi Bambu</li>
            <li>Outbound & Gathering</li>
            <li>Wisata Air</li>
            <li>Silver Roof Café</li>
            <li>Pondok Kayu</li>
        </ul>
    </div>

    <!-- PROMO -->
    <p class="section-paragraf"> 
        Ada penawaran seru buat kamu yang berencana liburan ke Bhumi Bambu.
        Temukan promo terbaik yang bisa bikin perjalananmu semakin berkesan </p>

    <div class="promos-wrapper">
        <div class="promos-card">
            <p class="promos-tittle">"Diskon Khusus Pengguna Baru! Hemat Hingga 10%!"</p>
                <div  class="promos-content">
                    <div class="promos-code">
                        <i class="fas fa-copy"></i>
                        <span>BAMBUBM</span>
                    </div>
                </div>
        </div>

        <div class="promos-card">
            <p class="promos-tittle">"Flash Sale! Harga Spesial Untuk Libur NATARU"</p>
                <div class="promos-content">
                    <div class="promos-code">
                        <i class="fas fa-copy"></i>
                        <span>NATARU25</span>
                    </div>
                </div>
        </div>

        <div class="promos-card">
            <p class="promos-tittle">"Promo Akhir Tahun"</p>
                <div class="promos-content">
                    <div class="promos-code">
                        <i class="fas fa-copy"></i>
                        <span>AKHIRTHN</span>
                    </div>
                </div>
        </div>
    </div>

    <!-- ULASAN -->
    <h2 class="section-title">💬 Apa Kata Mereka Tentang Kami</h2>
    <div class="testimonial-wrapper">
        <div class="testimonial-card">
            <p class="quote">"Tempatnya asri banget, hutan bambunya adem dan nyaman buat healing"</p>
            <div class="rating">
                ⭐ ⭐ ⭐ ⭐ ☆
            </div>
            <p class="name">Rania</p>
        </div>

        <div class="testimonial-card">
            <p class="quote">"Camping di sini menyenangkan, suasananya tenang dan fasilitasnya cukup lengkap</p>
            <div class="rating">
                ⭐ ⭐ ⭐ ⭐ ☆
            </div>
            <p class="name">Dimas</p>
        </div>

        <div class="testimonial-card">
            <p class="quote">"Outboundnya seru banget, banyak tantangan yang bikin kita makin kompak sebagai tim"</p>
            <div class="rating">
                ⭐ ⭐ ⭐ ⭐ ☆
            </div>
            <p class="name">Nayla</p>
        </div>
    </div>
  
    <!-- FOOTER -->
    <footer>
        <div style="display:flex; justify-content:space-between; flex-wrap: wrap;">
            
            <div>
                <h3>Layanan Kami</h3>
                <a href="#">Berkemah</a>
                <a href="#">Outbound</a>
                <a href="#">Edukasi Bambu</a>
                <a href="#">Wisata Alam</a>
                <a href="#">Pondok Kayu</a>
            </div>

            <div>
                <h3>Kontak</h3>
                <a href="https://www.instagram.com/bhumi_bambu?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">Instagram</a>
                <a href="https://www.tiktok.com/@bhumi_bambubaturaden?is_from_webapp=1&sender_device=pc">TikTok</a>
                <a href="#">Whatsapp</a>
                <a href="#">bambubumi@gmail.com</a>
            </div>

            <div>
                <h3>Jam Operasional</h3>
                <p>Minggu – Senin</p>
                <p>08.00 – 17.00 WIB</p>
            </div>

            <div>
                <h3>Lokasi</h3>
                <iframe 
                    src="https://maps.google.com/maps?q=Bhumi%20Bambu%20Baturraden&z=15&output=embed"
                    width="300" height="200" style="border:0;">
                </iframe>
            </div>
        </div>

        <p style="text-align:center; margin-top:30px;">© 2025 Bhumi Bambu</p>
    </footer>

</body>
</html>