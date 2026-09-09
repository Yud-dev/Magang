<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Magang – PT Petrokimia Gresik</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        .navbar {
            background: #0c6b3a !important;
            background: linear-gradient(90deg, #0c6b3a, #17894c) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
        }
        .logo-petro {
          height: 100px !important; /* Tambahkan !important */
    width: auto !important;
        }
        .nav-link {
            color: #ffffff !important;
            font-weight: 600;
        }
        .nav-link:hover {
            color: #dfffea !important;
        }

        .hero {
            background: url('{{ asset('magang/Petrokimia.jpeg') }}') center/cover no-repeat;
            height: 90vh;
            display: flex;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 10px rgba(0,0,0,.8);
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 40px;
            position: relative;
        }
        .section-title::after {
            content: "";
            width: 70px;
            height: 4px;
            background: #198754;
            display: block;
            margin: 10px auto 0;
            border-radius: 4px;
        }

        .info-card {
            transition: .3s;
            border: 1px solid #eee;
            border-radius: 12px;
        }
        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 30px rgba(0,0,0,.15);
        }

        footer {
            margin-top: 50px;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <img src="{{ asset('magang/logopetro.png') }}" alt="logo" class="logo-petro" >

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link fw-semibold" href="#program">Program Magang</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#alur">Alur Permintaan</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#cekstatus">Cek Status</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#kontak">Kontak</a></li>
            </ul>
            <a href="{{ url('/') }}" class="btn btn-light btn-sm ms-3 fw-bold">Ajukan Permintaan</a>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<section class="hero">
    <div class="container text-center">
        <h1 class="fw-bold display-4">Program Magang<br>PT Petrokimia Gresik</h1>
        <p class="lead mt-3">
            Ajukan kebutuhan magang dengan mudah, dengan sistem kami.
        </p>
        {{-- <a href="{{ url('form-permintaan') }}" class="btn btn-warning btn-lg mt-3 fw-bold px-4 py-2">
            Ajukan Permintaan Magang
        </a> --}}
    </div>
</section>

<!-- PROGRAM SECTION -->
<section id="program" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Tentang Program Magang</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 bg-white info-card text-center">
                    <i class="bi bi-journal-text display-5 text-success"></i>
                    <h5 class="mt-3 fw-bold">Permintaan Magang</h5>
                    <p>Unit kerja dapat mengajukan kebutuhan peserta magang melalui sistem secara online.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white info-card text-center">
                    <i class="bi bi-check2-circle display-5 text-success"></i>
                    <h5 class="mt-3 fw-bold">Validasi Sistem</h5>
                    <p>Admin akan melakukan verifikasi sebelum diteruskan ke mentor/unit kerja.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white info-card text-center">
                    <i class="bi bi-person-workspace display-5 text-success"></i>
                    <h5 class="mt-3 fw-bold">Penempatan Magang</h5>
                    <p>penempatan peserta ke unitkerja yang sesuai kriteria user</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ALUR PENDAFTARAN -->
<section id="alur" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center">Alur Permintaan Magang</h2>

        <div class="row g-4 text-center">

            <div class="col-md-3">
                <div class="p-4 bg-white info-card">
                    <div class="display-4 text-success fw-bold">1</div>
                    <p class="mt-2 fw-bold">Isi Form Permintaan Magang</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white info-card">
                    <div class="display-4 text-success fw-bold">2</div>
                    <p class="mt-2 fw-bold">Validasi Admin</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white info-card">
                    <div class="display-4 text-success fw-bold">3</div>
                    <p class="mt-2 fw-bold">Verifikasi admin</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-4 bg-white info-card">
                    <div class="display-4 text-success fw-bold">4</div>
                    <p class="mt-2 fw-bold">Pengumuman Hasil</p>
                </div>
            </div>

        </div>
{{--
        <div class="text-center mt-4">
            <a href="{{ url('form-permintaan') }}" class="btn btn-success btn-lg px-4">
                Ajukan Permintaan
            </a>
        </div> --}}
    </div>
</section>

<!-- CEK STATUS -->
<section id="cekstatus" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Cek Status Permintaan</h2>

        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow text-center">
                <p>Masukkan NIK SAP atau Kode Permintaan Anda untuk melihat status.</p>

                <a href="{{ url('/loginstatus') }}" class="btn btn-outline-success fw-bold mt-2">
                    Cek Status Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- KONTAK -->
<section id="kontak" class="py-5">
    <div class="container">
        <h2 class="section-title text-center">Kontak Kami</h2>

        <div class="row justify-content-center">
            <div class="col-md-6 bg-white p-4 rounded shadow text-center">

                <p><i class="bi bi-geo-alt-fill text-success"></i>
                   Gedung Diklat - Dep. Manajemen & Pengembangan SDM</p>

                <p><i class="bi bi-envelope-fill text-success"></i>
                  diklat@petrokimia-gresik.com</p>

                <p><i class="bi bi-telephone-fill text-success"></i>
                  Ext. 2423 / 2424</p>

            </div>
        </div>
    </div>
</section>

{{-- <footer class="text-center py-3 bg-success text-white">
    © {{ date('Y') }} PT Petrokimia Gresik — Program Magang
</footer> --}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
