<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Cek Status Permintaan Magang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --petro-green: #198754;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-image: url('magang/Petrokimia.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: -1;
        }

        /* CARD GLASS BLUR */
        .login-box {
            max-width: 450px;
            margin: 80px auto;
            padding: 35px;
            background: rgba(255, 255, 255, 0.55);
            border-radius: 15px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-top: 5px solid var(--petro-green);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .btn-success {
            background-color: var(--petro-green) !important;
            border-color: var(--petro-green) !important;
        }

        .btn-success:hover {
            background-color: #157347 !important;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-box">

        <div class="text-center mb-3">
            <i class="bi bi-shield-lock-fill text-success" style="font-size: 3rem;"></i>
            <h4 class="fw-bold mt-2" style="color: var(--petro-green);">Verifikasi Status Permintaan</h4>
            <p class="text-muted mb-0" style="font-size: 0.9rem;">
                Masukkan NIK SAP Anda untuk melihat status pengajuan magang.
            </p>
        </div>

        <form action="{{ route('status.permintaan') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-3">
                <label class="fw-semibold">NIK SAP</label>
                <input type="text"
                       name="nik_sap"
                       class="form-control form-control-lg @error('nik_sap') is-invalid @enderror"
                       placeholder="Masukkan NIK SAP Anda"
                       required
                       maxlength="7"
                       pattern="\d*"
                       title="NIK SAP harus berupa angka 7 digit">
            </div>

            <button type="submit" class="btn btn-success w-100 fw-bold py-2 mt-2">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Cek Status Permintaan
            </button>

            <div class="text-center mt-3">
                <a href="{{ url('/landingpage') }}" class="text-decoration-none text-secondary small">
                    ← Kembali ke Halaman Utama
                </a>
            </div>
        </form>

    </div>
</div>

</body>
</html>
