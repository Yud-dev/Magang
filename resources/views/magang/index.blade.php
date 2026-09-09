<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Kebutuhan Magang</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI Autocomplete -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        header {
            background: #fff;
            padding: 10px 20px;
            width: 95%;
            margin: 20px auto;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .logo-petro {
            height: 55px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .icon-header {
            height: 45px;
            cursor: pointer;
            transition: 0.2s;
        }

        .icon-header:hover {
            transform: scale(1.1);
        }

        .form-card {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #005fcc;
        }
    </style>
</head>

<body>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- HEADER -->
    <header>
        <img src="{{ asset('magang/logopetro.png') }}" class="logo-petro">

        <div class="header-right">
            <a href="#form"><img src="{{ asset('magang/dokumen.png') }}" class="icon-header" title="Form"></a>

            <a href="{{ route('download.templateworkplan') }}">
                <img src="{{ asset('magang/downloaddokumen.png') }}" class="icon-header" title="Download Template">
            </a>
        </div>
    </header>


    <div class="container">
        <h2 class="mt-3 mb-3">Form Kebutuhan Magang</h2>

        <form action="{{ route('storeTabelPermintaan') }}" method="POST" enctype="multipart/form-data"
            class="form-card" id="form" onsubmit="return validateForm()">

            @csrf

            <div class="mb-3">
                <label>NIK SAP</label>
                <input type="text" name="NIK_SAP" class="form-control" maxlength="7" pattern="[0-9]{7}"
                    placeholder="Masukkan NIK SAP">
            </div>

            <div class="mb-3">
                <label>Nama Mentor</label>
                <input type="text" name="Nama_Mentor" class="form-control" placeholder="Masukkan Nama Mentor" id="inputnamamentor">
                @error('Nama_Mentor')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label>No WA Mentor</label>
                <input type="number" name="NO_WA_Mentor" class="form-control" placeholder="Masukkan No WA">
            </div>

            <!-- Batch -->
            <div class="mb-3">
                <label>Batch</label>
                <select name="Batch" class="form-control">
                    <option value="">Pilih Batch</option>
                    <option value="Batch 1">Batch 1</option>
                    <option value="Batch 2">Batch 2</option>
                </select>
            </div>

            <!-- Unit Kerja Autocomplete -->
            <label>Unit Kerja</label>
            <input type="text" id="inputunitkerja" name="UnitKerja" class="form-control"
                placeholder="Masukkan Unit Kerja">
            @error('UnitKerja')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <div class="mb-3 mt-3">
                <label>Bagian</label>
                <input type="text" name="Bagian" class="form-control" placeholder="Masukkan Bagian">
            </div>

            <!-- Jurusan -->
            <label>Jurusan</label>
            <i class="fa-solid fa-circle-info"
                onclick="alert('Jika jurusan tidak ada di list, isi manual sesuai kebutuhan.')"></i>
            <input type="text" id="search" name="Jurusan" class="form-control" placeholder="Masukkan Jurusan">

            @error('Jurusan')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            <!-- Tahun Magang -->
            <div class="mb-3 mt-3">
                <label>Tahun Magang</label>
                <input type="text" id="tahunmagang" name="tahunmagang" class="form-control"
                    placeholder="Masukkan Tahun Magang">
            </div>

            <!-- Judul PA -->
            <div class="mb-3">
                <label>Judul Projek Akhir</label>
                <i class="fa-solid fa-circle-info"
                    onclick="alert('Contoh: Sistem Pendukung Keputusan menggunakan AHP dan Fuzzy Tsukamoto')"></i>
                <input type="text" name="JudulPA" class="form-control" placeholder="Masukkan Judul PA">
            </div>

            <!-- Upload Workplan -->
            <div class="mb-3">
                <label>Upload Workplan</label>
                <input type="file" name="file_excel" class="form-control"
                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
            </div>

            <!-- Radio Persetujuan -->
            <label>Persetujuan Mentor</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="tidakpilihradio">
                <label class="form-check-label">Tidak setuju</label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault">
                <label class="form-check-label">
                    Dengan ini saya bersedia menjadi Mentor dan membimbing mahasiswa selama program magang
                </label>
            </div>

            <button class="btn btn-primary">Submit</button>

        </form>
    </div>


    <!-- JS AUTOCOMPLETE -->
    <script>
        const route = "{{ route('autocompleteJurusan') }}";

        $("#search").autocomplete({
            source: function(request, response) {
                $.get(route, {
                    search: request.term
                }, function(data) {
                    response(data);
                });
            },
            minLength: 1
        });

        const routeunitkerja = "{{ route('autocompleteUnitkerja') }}";

        $("#inputunitkerja").autocomplete({
            source: function(request, response) {
                $.get(routeunitkerja, {
                    inputunitkerja: request.term
                }, function(data) {
                    response(data);
                });
            },
            minLength: 1
        });

         const routenamamentor = "{{ route('autocompleteNamamentor') }}";

        $("#inputnamamentor").autocomplete({
            source: function(request, response) {
                $.get(routenamamentor, {
                    inputnamamentor: request.term
                }, function(data) {
                    response(data);
                });
            },
            minLength: 1
        });


    </script>

    <!-- Datepicker Tahun -->
    <script>
        $('#tahunmagang').datepicker({
            format: "yyyy",
            minViewMode: 2,
            autoclose: true
        });
    </script>

    <!-- Validation -->
    <script>
        function validateForm() {
            const radio1 = document.getElementById('tidakpilihradio');
            const radio2 = document.getElementById('flexRadioDefault');

            if (!radio1.checked && !radio2.checked) {
                alert("Harap pilih persetujuan mentor.");
                return false;
            }

            if (radio1.checked) {
                alert("Anda harus menyetujui persyaratan menjadi mentor.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
