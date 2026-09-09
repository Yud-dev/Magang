<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Kuota Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
 {{-- yearpicker --}}
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

{{-- <!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}


<!-- Bootstrap Datepicker -->

<!-- jQuery UI (untuk autocomplete) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style>

         header {
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 10px;
      height: 60px;
      background-color: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    header ul {
      list-style-type: none;
      display: flex;
      align-items: center;
      gap: 20px;
      margin: 0;
      padding: 0;
    }

        .sidebar-admin {
      position: fixed;
      top: 60px;
      left: 0;
      width: 220px;
      height: calc(100vh - 60px);
      background-color: #228B22;
      padding: 20px 15px;
      border-top-right-radius: 15px;
      display: flex;
      flex-direction: column;
      gap: 10px;
      box-shadow: 2px 0 5px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      z-index: 900;
    }

    .sidebar-admin .nav-link {
      color: white !important;
      font-weight: 500;
      border-radius: 10px;
      padding: 10px;
      transition: background-color 0.3s;
      white-space: nowrap;
    }

    .sidebar-admin .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }
.container{
      margin-left: 240px;
      padding: 30px;
     width: 70%;
      min-height: 100vh;
      transition: margin-left 0.3s ease;
      position: absolute;
}
.toggle-btn {
        position: fixed;
        top: 70px;
        left: 15px;
        z-index: 950;
        background-color: #228B22;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 10px;
      }
    @media (max-width: 992px) {
    .sidebar-admin {
      left: -240px;
      width: 200px;
    }

    .sidebar-admin.active {
      left: 0;
    }

    .container {
      margin-left: 14%;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
     width:80%;
     height: 50%;
     margin-top: 90;


    }

    .toggle-btn {
      display: block;
    }
  }

    </style>
</head>
<body style="background: lightgray">
    {{-- @if($errors->any)
    <div class="alert alert-danger">

            {{-- @foreach ($errors->all() as $error)

            @endforeach --}}
{{--
    </div>

    @endif --}}

 {{-- Header --}}
    <header class="header shadow bg-body-tertiary rounded">

 {{-- @error('UnitKerja')
    <script>
        alert("{{ $message }}");
    </script>
@enderror --}}



  <ul>
    <li><img src="{{ asset('magang/logopetro.png') }}" alt="petro-logo" width="180"></li>
    <li><img src="{{ asset('magang/pupukindonesia.png') }}" alt="pupukindonesia-logo" width="120"></li>
  </ul>
</header>
{{-- Sidebar  --}}
 <button class="toggle-btn d-lg-none" onclick="toggleSidebar()">
  <i class="bi bi-list fs-4"></i>
</button>


<div class="sidebar-admin" id="sidebar">
  <div class="nav flex-column">
    <a href="{{ route('kuotamagang.indexkuotamagang') }}" class="nav-link d-flex align-items-center gap-2">
      <i class="bi bi-pie-chart-fill fs-4"></i> <span>Kuota</span>
    </a>
    <a href="{{ route('jurusan.Jurusan') }}" class="nav-link d-flex align-items-center gap-2">
      <i class="bi bi-mortarboard-fill fs-4"></i> <span>Jurusan</span>
    </a>
    <a href="{{ route('unitkerja.indexunitkerja') }}" class="nav-link d-flex align-items-center gap-2">
      <i class="bi bi-building fs-4"></i> <span>Unit Kerja</span>
    </a>
 <form action="{{ route('logout') }}" method="POST" class="mt-auto">
    @csrf
    <button type="submit" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>

  </div>
</div>


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-body">
<form action="{{ route('kuotamagang.storekuotamagang') }}" method="POST" enctype="multipart/form-data">

                        @csrf

                        {{-- <div class="form-group mb-3"> --}}


                            <label class="font-weight-bold">Unit Kerja</label><br>



 <input type="text" id="inputunitkerja" class="form-control" placeholder="inputkan Nama unitkerja" name="UnitKerja">

           {{-- dropdown
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="unitkerja">
    Unit Kerja
  </button>
  <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="menu-unitkerja">
    <li><a class="dropdown-item" href="#">Dep Administrasi Bisnis</a></li>
    <li><a class="dropdown-item" href="#">Dep Akuntansi Biaya</a></li>
    <li><a class="dropdown-item" href="#">Dep Anggaran</a></li>
        <li><a class="dropdown-item" href="#">Dep Audit Keuangan & Umun</a></li>
    <li><a class="dropdown-item" href="#">Dep Audit Operasi & Produksi</a></li>
    <li><a class="dropdown-item" href="#">Dep Fabrikasi & Alat Berat</a></li>
        <li><a class="dropdown-item" href="#">Dep Hukum</a></li>
    <li><a class="dropdown-item" href="#">Dep Inovasi & Sistem Manajemen</a></li>
    <li><a class="dropdown-item" href="#">Dep Inspeksi Teknik Rotating</a></li>
        <li><a class="dropdown-item" href="#">Dep Teknik Statik</a></li>
    <li><a class="dropdown-item" href="#">Dep Investasi Rutin & EPC</a></li>
    <li><a class="dropdown-item" href="#">Dep Keamanan</a></li>
        <li><a class="dropdown-item" href="#">Dep Keselamatan & Kesehatan Kerja</a></li>
    <li><a class="dropdown-item" href="#">Dep Akuntansi Biaya</a></li>
    <li><a class="dropdown-item" href="#">Dep Keuangan</a></li>
        <li><a class="dropdown-item" href="#">Dep Komunikasi Korporat</a></li>
    <li><a class="dropdown-item" href="#">Dep Laboratorium</a></li>
    <li><a class="dropdown-item" href="#">Dep Lingkungan</a></li>
        <li><a class="dropdown-item" href="#">Dep Manajemen & Pengembangan SDM</a></li>
    <li><a class="dropdown-item" href="#">Dep Manajemen Aset</a></li>
    <li><a class="dropdown-item" href="#">Dep Mitra Bisnis Pemasaran Korporasi </a></li>
        <li><a class="dropdown-item" href="#">Dep Mitra Bisnis Pemasaran Ritel</a></li>
    <li><a class="dropdown-item" href="#">Dep Operasional SDM</a></li>
    <li><a class="dropdown-item" href="#">Dep Pelaporan Keuangan & Manajemen</a></li>
        <li><a class="dropdown-item" href="#">Dep Pelayanan Umun</a></li>
    <li><a class="dropdown-item" href="#">Dep Pemelihara 1</a></li>
    <li><a class="dropdown-item" href="#">Dep Pemelihara 2</a></li>
        <li><a class="dropdown-item" href="#">Dep Pemelihara 3</a></li>
    <li><a class="dropdown-item" href="#">Dep Pengadaan Barang</a></li>
    <li><a class="dropdown-item" href="#">Dep Pengadaan Jasa</a></li>
        <li><a class="dropdown-item" href="#">Dep Pengelolaan Pelabuhan</a></li>
    <li><a class="dropdown-item" href="#">Dep Pengelolaan Persediaan Suku Cadang & BB</a></li>
    <li><a class="dropdown-item" href="#">Dep Pengelolaan Transformasi Bisnis </a></li>
        <li><a class="dropdown-item" href="#">Dep Pengembangan Korporat</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan & Pengendalian Produksi</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan & Pengendalian TA</a></li>
        <li><a class="dropdown-item" href="#">Dep Perencanaan Pemeliharaan</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan Pemeliharaan</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan Pengadaan Barang/Jasa</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan & Pengendalian Produksi</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan & Pengendalian TA</a></li>
        <li><a class="dropdown-item" href="#">Dep Perencanaan Pemeliharaan</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan Pemeliharaan</a></li>
    <li><a class="dropdown-item" href="#">Dep Perencanaan Pengadaan Barang/Jasa</a></li>
    <li><a class="dropdown-item" href="#">Dep Pergudangan & Pengantongan</a></li>
    <li><a class="dropdown-item" href="#">Dep Portofolio Bisnis</a></li>
        <li><a class="dropdown-item" href="#">Dep Produksi 1 A</a></li>
    <li><a class="dropdown-item" href="#">Dep Produksi 1 B</a></li>
    <li><a class="dropdown-item" href="#">Dep produksi 2 B</a></li>
    <li><a class="dropdown-item" href="#">Dep produksi 3 A</a></li>
    <li><a class="dropdown-item" href="#">Dep Produksi 3 B</a></li>
        <li><a class="dropdown-item" href="#">Dep Proses & Pengelolaan Energo</a></li>
    <li><a class="dropdown-item" href="#">Dep Rancang Bangun</a></li>
    <li><a class="dropdown-item" href="#">Dep Reliability</a></li>
    <li><a class="dropdown-item" href="#">Dep Riset</a></li>
    <li><a class="dropdown-item" href="#">Dep Tanggung Jawab Sosial & Lingkungan</a></li>
        <li><a class="dropdown-item" href="#">Dep Teknik & Bisnis</a></li>
    <li><a class="dropdown-item" href="#">Dep TKP & Manajemen Risiko</a></li>
    <li><a class="dropdown-item" href="#">Persiapan Pryek Dermaga A</a></li>
     <li><a class="dropdown-item" href="#">Persiapan Proyek Soda Ash</a></li>
    <li><a class="dropdown-item" href="#">Projek Agrosolution</a></li>
        <li><a class="dropdown-item" href="#">Proyek Barang Reject</a></li>
    <li><a class="dropdown-item" href="#">Proyek Manajemen Produk Baru</a></li>
    <li><a class="dropdown-item" href="#">Proyek Manajemen Pengelolaan Tagihan Bersama</a></li>
     <li><a class="dropdown-item" href="#">Komp Administrasi Keuangan</a></li>
    <li><a class="dropdown-item" href="#">Komp Mitra Bisnis</a></li>
        <li><a class="dropdown-item" href="#">Komp Mitra Bisnis</a></li>
    <li><a class="dropdown-item" href="#">Komp Pabrik 1</a></li>
    <li><a class="dropdown-item" href="#">Komp Pabrik 2</a></li>
     <li><a class="dropdown-item" href="#">Komp Pabrik 3</a></li>
    <li><a class="dropdown-item" href="#">Komp Pengelolaan Pergudangan & Pelabuhan</a></li>
        <li><a class="dropdown-item" href="#">Komp Pengembangan & Portofolio Bisnis</a></li>
    <li><a class="dropdown-item" href="#">Komp Perencanaan & Pengendalian Pemeliharaan</a></li>
    <li><a class="dropdown-item" href="#">Komp Satuan Pengawasan Intern</a></li>\ <li><a class="dropdown-item" href="#">Dep Riset</a></li>
    <li><a class="dropdown-item" href="#">Komp Sekretaris Perusahaan</a></li>
        <li><a class="dropdown-item" href="#">Komp Sumber Daya Perusahaan</a></li>
    <li><a class="dropdown-item" href="#">Komp Teknik</a></li>
    <li><a class="dropdown-item" href="#">Komp Umum</a></li>
  </ul>
    <input type="hidden" name="UnitKerja" id="UnitKerja" >
</div>
                            {{-- <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror" name="unit_kerja" value="{{ old('unit_kerja') }}" placeholder="Masukkan Unit Kerja">
                             --}}
                             @error('UnitKerja')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Tahun</label>
  <input  class="year-picker form-control" type="number" placeholder="Masukkan Tahun Magang"  id="tahunmagang" name="tahun" >
                            @error('tahun')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            {{-- dropdown --}}
                            <label class="font-weight-bold">Batch</label><br>
                            <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="batch">
    Batch
  </button>
  <ul class="dropdown-menu" aria-labelledby="batch">
    <li><a class="dropdown-item" href="#">Batch 1</a></li>
    <li><a class="dropdown-item" href="#">Batch 2</a></li>
  </ul>
                              <input type="hidden" class="form-control @error('batch') is-invalid @enderror" name="batch" value="{{ old('batch', ) }}" id="jenisbatch" >
</div>

                            @error('batch')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Kuota</label>
                            <input type="text" class="form-control @error('kuota') is-invalid @enderror" name="kuota"  placeholder="Masukkan Kuota">
                            @error('kuota')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
<div class="d-grid gap-2 d-md-block">
   <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
</div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- <script>
  const dropdownButtonUnit = document.getElementById('unitkerja'); // Variabel diubah namanya
const dropdownItemsUnit = document.querySelectorAll('#unitkerja + .dropdown-menu .dropdown-item'); // Selektor diperbaiki
dropdownItemsUnit.forEach(item => {
    item.addEventListener('click', function() {
        const selectedCategory = item.textContent;
        dropdownButtonUnit.textContent = selectedCategory;
        document.getElementById('unit_kerja').value = selectedCategory;
    });
});
</script> --}}

 {{-- <script>
    const dropdownButtonUnitBatch = document.getElementById('batch');
const dropdownItemsUnitBatch = document.querySelectorAll('#batch + .dropdown-menu .dropdown-item');

dropdownItemsUnitBatch.forEach(item => {
    item.addEventListener('click', function() {
        const selectedCategory = item.textContent;
        dropdownButtonUnitBatch.textContent = selectedCategory;
        document.getElementById('jenisbatch').value = selectedCategory;
    });
});

    </script> --}}

<script>
const dropdownButtonUnitBatch = document.getElementById('batch');
const dropdownItemsUnitBatch = document.querySelectorAll('[aria-labelledby="batch"] .dropdown-item');

dropdownItemsUnitBatch.forEach(item => {
    item.addEventListener('click', function() {
        const selectedCategory = this.textContent.trim();
        dropdownButtonUnitBatch.textContent = selectedCategory;
        document.getElementById('jenisbatch').value = selectedCategory;
    });
});
</script>


<script>
    const routeunitkerja = "{{ route('autocompleteUnitkerja') }}";

    $(function () {
        $("#inputunitkerja").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: routeunitkerja,
                    type: 'GET',
                    dataType: 'json',
                    data: { search: request.term },
                    success: function (dataUnitkerja) {
                        response(dataUnitkerja);
                    }
                });
            },
            select: function (event, ui) {
                $('#inputunitkerja').val(ui.item.label);
                console.log(ui.item);
                return false;
            },
            minLength: 1
        });
    });

</script>


<script>
     $(document).ready(function () {

                $('#tahunmagang').datepicker({
                    minViewMode: 'years',
                    autoclose: true,
                     format: 'yyyy'
                });

            });

</script>

<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");
    }
</script>
</body>
</html>
