<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ratna Cake</title>

    <!-- Fonts and Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Styles -->
   
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="{{ asset('images/logo.png.png') }}" alt="Logo Ratna Cake" width="200">
            <span class="brand-name">Ratna Cake</span>
        </div>
        <nav class="nav">
            <a href="#">Beranda</a>
            <a href="{{ url('tentangkami') }}">Tentang Kami</a>
            <a href="{{ route('login') }}">Belanja</a> 
            <a href="{{ url('lokasi') }}">Lokasi</a>
            <a href="{{ route('login') }}">Pesanan Saya</a>
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
            
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Section 1 -->
        <section class="section">
            <div>
                <h2>The Best Cakes</h2>
                <p>"Selamat datang di dunia kelezatan Ratna Cake! Nikmati beragam pilihan kue dan roti berkualitas tinggi yang dibuat dengan bahan-bahan segar pilihan. Dari kue ulang tahun yang cantik hingga roti lembut sehari-hari, kami hadir untuk memenuhi setiap momen spesial Anda."</p>
                <a href="{{ route('login') }}" class="btn-belanja">Belanja</a>
            </div>
            <img alt="Cake Image" class="image" src="{{ asset('images/rainbow-cake-pana.png') }}">
        </section>

        <!-- Section 2 -->
        <section class="section">
            <img alt="Welcome to website! RATNA CAKE" class="image" src="{{ asset('images/Banner.png') }}">
            <div>
                <h2>Tentang Kami</h2>
                <p>Ingin kue yang unik dan personal? Kami siap mewujudkan impian Anda! Dengan layanan custom cake, Anda dapat mendesain kue sesuai dengan tema dan selera Anda.</p>
                <a href="{{ url('tentangkami') }}" class="btn-belanja">Tentang Kami</a>
            </div>
        </section>

        <!-- Produk Populer -->
        <header>
            <h1>Produk Populer</h1>
        </header>

        <section class="produk">
            <div class="produk-item">
                <img src="{{ asset('images/brownies.jpg') }}" alt="Brownies Kukus">
                <div class="produk-info">
                    <h2>Brownies Kukus</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="{{ route('login') }}" class="btn-belanja">Belanja</a>
                </div>
            </div>

            <div class="produk-item">
                <img src="{{ asset('images/bolu_ultah.jpg') }}" alt="Bolu Ulang Tahun">
                <div class="produk-info">
                    <h2>Bolu Ulang Tahun</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="{{ route('login') }}" class="btn-belanja">Belanja</a>
                </div>
            </div>
        </section>

        <!-- Promo Bulanan -->
        <section class="promosi">
            <div class="promosi-content">
                <h2>Promo Bulanan</h2>
                <p>Jangan lewatkan promo spesial setiap bulan dari Ratna Cake!</p>
            </div>
            <div class="promosi-images">
                <img src="{{ asset('images/promo.png') }}" alt="Promo Image 1">
                <img src="{{ asset('images/promo1.png') }}" alt="Promo Image 2">
                <img src="{{ asset('images/promo2.png') }}" alt="Promo Image 3">
                <img src="{{ asset('images/promo3.png') }}" alt="Promo Image 4">
            </div>
        </section>

        <section class="testimoni-section">
    <h2 class="testimoni-title">
        Testimoni
    </h2>
    <div class="testimoni-content">
    <button id="prevTestimoni" class="testimoni-nav-btn">
    <i class="fas fa-chevron-left"></i>
        </button>
        <p id="testimoniText" class="testimoni-text">
            <!-- Testimoni akan berubah di sini -->
        </p>
        <button id="nextTestimoni" class="testimoni-nav-btn">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</section>

<script>
        // Array berisi testimoni
        const testimoniArray = [
            `"Kue dari Ratna Cake benar-benar lezat! Teksturnya lembut dan rasanya tidak terlalu manis, pas banget untuk selera keluarga kami." - Rina, Jatibarang`,
            `"Saya pesan bolu untuk acara ulang tahun, hasilnya sangat memuaskan! Dekorasi kue sangat cantik dan rasanya luar biasa." - Dwi, Indramayu`,
            `"Pelayanan dari Ratna Cake sangat cepat, dan kualitas kuenya tetap terjaga. Bolu pisangnya benar-benar favorit saya!" - Budi, Lobener`,
            `"Ratna Cake selalu jadi pilihan keluarga kami untuk setiap acara. Kuenya bervariasi, fresh, dan rasanya selalu konsisten enak." - Lina, Indramayu`,
            `"Pengalaman belanja di Ratna Cake sangat menyenangkan! Adminnya ramah dan kue ulang tahunnya sesuai dengan ekspektasi saya." - Andi, Pawidean`
        ];

        let currentTestimoni = 0;

        // Fungsi untuk menampilkan testimoni berdasarkan index
        function showTestimoni(index) {
            const testimoniText = document.getElementById('testimoniText');
            testimoniText.innerText = testimoniArray[index];
        }

        // Event listener untuk tombol navigasi
        document.getElementById('prevTestimoni').addEventListener('click', function() {
            currentTestimoni = (currentTestimoni === 0) ? testimoniArray.length - 1 : currentTestimoni - 1;
            showTestimoni(currentTestimoni);
        });

        document.getElementById('nextTestimoni').addEventListener('click', function() {
            currentTestimoni = (currentTestimoni === testimoniArray.length - 1) ? 0 : currentTestimoni + 1;
            showTestimoni(currentTestimoni);
        });

        // Tampilkan testimoni pertama saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            showTestimoni(currentTestimoni);
        });
    </script>

    </main>

    <!-- Footer -->
    <div class="footer-container">
        <div class="footer-left">
            <h3>Layanan Pelanggan</h3>
            <p>Email: support@ratnacake.com</p>
            <p>Telepon: +62 812 3456 7890</p>
        </div>
        
        <div class="footer-right">
            <h3>Ikuti kami</h3>
            <a href="#"><img src="{{ asset('images/icons8-facebook-30 (1).png') }}" alt="Facebook"></a><br>
            <a href="#"><img src="{{ asset('images/icons8-whatsapp-30.png') }}" alt="whatsaAp"></a>
            
        </div>
    </div>

    <div class="footer-copyright">
        <p>Copyright 2024</p>
    </div>
</footer>
</body>
</html>
