<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- Bootstrap & W3.CSS -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
   body {
  background-color: #f2f2f2;
}

/* HEADER */
header {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 10px;
  height: 70px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

header ul {
  list-style: none;
  display: flex;
  align-items: center;
  justify-content: center; /* pastikan di tengah */
  gap: 25px;
  margin: 0;
  padding: 0;
  text-align: center;
}

.logopetro {
  width: 130px;
  height: auto;
}

.pupuk {
  width: 130px;
  height: auto;
}

/* SIDEBAR */
.sidebar-admin {
  position: fixed;
  top: 70px;
  left: 0;
  width: 220px;
  height: calc(100vh - 70px);
  background-color: #228B22;
  padding: 20px 15px;
  border-top-right-radius: 15px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  z-index: 900;
}

.sidebar-admin .nav-link {
  color: white ;
  font-weight: 500;
  border-radius: 10px;
  padding: 10px;
  transition: background-color 0.3s;
  white-space: nowrap;
}

.sidebar-admin .nav-link:hover {
  background-color: rgba(255, 255, 255, 0.2);
}

/* CONTENT */
.content {
  margin-left: 240px;
  padding: 30px;
  background-color: #f2f2f2;
  min-height: 100vh;
  transition: margin-left 0.3s ease;
}

.table-container {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  overflow-x: auto;
}

.table th,
.table td {
  white-space: nowrap;
  vertical-align: middle;
}

/* RESPONSIVE DESIGN */
@media (max-width: 992px) {
  header ul {
    flex-direction: column;
    gap: 10px;
  }

  .sidebar-admin {
    position: fixed;
    top: 70px;
    left: -240px;
    width: 200px;
    height: calc(100vh - 70px);
    border-radius: 0;
  }

  .sidebar-admin.active {
    left: 0;
  }

  .content {
    margin-left: 0;
    padding: 20px;
  }

  .toggle-btn {
    position: fixed;
    top: 80px;
    left: 15px;
    z-index: 950;
    background-color: #228B22;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 10px;
  }
}

@media (max-width: 576px) {
  .logopetro,
  .pupuk {
    width: 80px;
    height: auto;
  }

  .table-container {
    padding: 10px;
  }

  .table {
    font-size: 0.85rem;
  }
  header ul { flex-direction: row;
    gap: 10px;
}
}

  </style>
</head>

<body>

<!-- Header -->
<header class="header shadow bg-body-tertiary rounded">
  <ul>
    <li><img src="{{ asset('magang/logopetro.png') }}" alt="petro-logo"  class="logopetro"></li>
    <li><img src="{{ asset('magang/pupukindonesia.png') }}" alt="pupukindonesia-logo" class="pupuk"></li>
  </ul>
</header>

<!-- Sidebar -->
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
    {{-- <a href="#" class="nav-link d-flex align-items-center gap-2">
      <i class="bi-bar-chart-line fs-4"></i> <span>Data Statistik</span>
    </a> --}}
<form action="{{ route('logout') }}" method="POST" class="mt-auto">
    @csrf
    <button type="submit" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>

  </div>
</div>

<!-- Main Content -->
<div class="content">
  <div class="top-actions">
    {{-- filter data --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">

        <form action="{{ route('tabelpermintaan.IndexAdmin') }}" method="GET" class="d-flex gap-2 flex-grow-1 flex-md-grow-0">
            {{-- <select name="tahunmagang" class="form-select" style="max-width: 150px;">
                <option value="">Tahun</option>
                {{-- Membuat pilihan tahun dari 2020 hingga tahun sekarang + 1 --}}
                {{-- @for ($y = date('Y') + 1; $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ (request('tahunmagang') == $y) ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select> --}}

            {{-- <select name="Batch" class="form-select" style="max-width: 150px;">
                <option value="">Batch</option>
                <option value="Batch 1" {{ (request('Batch') == 'Batch 1') ? 'selected' : '' }}>Batch 1</option>
                <option value="Batch 2" {{ (request('Batch') == 'Batch 2') ? 'selected' : '' }}>Batch 2</option>
            </select> --}}

            {{-- <select name="status" class="form-select" style="max-width: 150px;">
                <option value="">Status</option>
                <option value="pending" {{ (request('status') == 'pending') ? 'selected' : '' }}>Belum di cek</option>
                <option value="disetujui" {{ (request('status') == 'disetujui') ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ (request('status') == 'ditolak') ? 'selected' : '' }}>Ditolak</option>
            </select> --}}

            <input type="hidden" name="search" value="{{ request('search') }}">

            {{-- <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('tabelpermintaan.IndexAdmin') }}" class="btn btn-secondary">Reset</a> --}}
        </form>
    <!-- Search -->
    <div class="d-flex justify-content-end mb-3">
      <form action="{{ route('tabelpermintaan.IndexAdmin') }}" method="GET" class="input-group" style="max-width: 300px;">
        <input class="form-control" type="text" placeholder="Search" name="search" value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">Search</button>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="table-container">
    <table class="table table-striped table-bordered text-center">
      <thead class="table-primary">
        <tr>
          <th style="background-color: #EEE8AA">NO</th>
          <th style="background-color: #EEE8AA">NIK SAP</th>
          <th style="background-color: #EEE8AA">Nama Mentor</th>
          <th style="background-color: #EEE8AA">No WA Mentor</th>
          <th style="background-color: #EEE8AA">Batch</th>
          <th style="background-color: #EEE8AA">Unit Kerja</th>
          <th style="background-color: #EEE8AA">Tahun</th>
          <th style="background-color: #EEE8AA">Bagian</th>
          <th style="background-color: #EEE8AA">Jurusan</th>
          <th style="background-color: #EEE8AA">Judul PA</th>
           {{-- <th style="background-color: #EEE8AA">File Excel</th> --}}
           <th style="background-color: #EEE8AA">Cek Data</th>
              {{-- <th style="background-color: #EEE8AA">Status</th> --}}

        </tr>
      </thead>
      <tbody>
        @foreach($tabelpermintaan as $datatabel)
        <tr>
          <td>{{ $loop->iteration + $tabelpermintaan->firstItem() - 1 }}</td>
          <td>{{ $datatabel->NIK_SAP }}</td>
          <td>{{ $datatabel->Nama_Mentor }}</td>
          <td>{{ $datatabel->NO_WA_Mentor }}</td>
          <td>{{ $datatabel->Batch }}</td>
          <td>{{ $datatabel->UnitKerja }}</td>
          <td>{{ $datatabel->tahunmagang }}</td>
          <td>{{ $datatabel->Bagian }}</td>
          <td>{{ $datatabel->Jurusan }}</td>
          <td>{{ $datatabel->JudulPA }}</td>
          <td>

              <a href="{{ route('detailform', ['id' => $datatabel->id]) }}" class="btn btn-sm btn-success">
                Cek Data
              </a>

          </td>
          {{-- <td>
    @if ($datatabel->status == 'disetujui')
        <span class="badge bg-success">Disetujui</span>
    @elseif ($datatabel->status == 'ditolak')
        <span class="badge bg-danger">Ditolak</span>
    @else
        <span class="badge bg-warning text-dark">Belum di cek</span>
    @endif
</td> --}}
        </tr>
     @endforeach
      </tbody>
    </table>
  </div>

  <div class="d-flex justify-content-center mt-3">
    {{ $tabelpermintaan->links() }}
  </div>
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
  }
</script>
 {{-- <script>
    function logout() {
    if (confirm("Apakah Anda yakin ingin logout?")) {
      window.location.href = "http://127.0.0.1:8000/Webmagang";
    }
  }
  </script> --}}
</body>
</html>
