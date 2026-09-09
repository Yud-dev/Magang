<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Unit Kerja</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
    margin-left: 12%;
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

<header class="shadow-sm bg-white">
    <ul>
      <li><img src="{{ asset('magang/logopetro.png') }}" alt="Petrokimia Logo" height="100"></li>
      <li><img src="{{ asset('magang/pupukindonesia.png') }}" alt="Pupuk Indonesia Logo" height="40"
        ></li>
    </ul>
  </header>
{{-- ICON HUMBERGER MENU RESPONSIVE --}}
<button class="toggle-btn d-lg-none" onclick="toggleSidebar()">
  <i class="bi bi-list fs-4"></i>
</button>

  <!-- SIDEBAR -->
<div class="sidebar-admin" id="sidebar">
  <div class="nav flex-column">
    <a href="{{ route('kuotamagang.indexkuotamagang') }}" class="nav-link d-flex align-items-center gap-2">
      <i class="bi bi-pie-chart-fill fs-4"></i> <span>Kuota</span>
    </a>
    <a href="{{ route('jurusan.Jurusan') }}" class="nav-link d-flex align-items-center gap-2">
      <i class="bi bi-mortarboard-fill fs-4"></i> <span>Jurusan</span>
    </a>
    <a href="{{ route('unitkerja.indexunitkerja') }}" class="nav-link d-flex align-items-center gap-2" style="background-color: #EEE8AA; " >
      <i class="bi bi-building fs-4" style="color: black
      "></i> <span style="color: black" >Unit Kerja</span>
    </a>
<br>
    <form action="{{ route('logout') }}" method="POST" class="mt-auto">
    @csrf
    <button type="submit" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>
  </div>
</div>

<div class="content">
  <div class="top-actions d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <a class="btn btn-success btn-sm" href="{{ route('unitkerja.create') }}">
      <i class="fa fa-plus"></i> Tambah Data
    </a>

    <form action="{{ route('unitkerja.indexunitkerja') }}" method="GET" class="input-group" style="max-width: 300px;">
      <input class="form-control" type="text" placeholder="Search" name="search" value="{{ $search ?? '' }}">
      <button type="submit" class="btn btn-primary">Search</button>
    </form>
  </div>

  <div class="table-container">
    <table class="table table-striped table-bordered text-center align-middle">
      <thead class="table-primary">
        <tr>
          <th style="background-color:#EEE8AA;">No</th>
          <th style="background-color:#EEE8AA;">ID Unit Kerja</th>
          <th style="background-color:#EEE8AA;">Unit Kerja</th>
           <th style="background-color:#EEE8AA;">Nama Mentor</th>
          <th style="background-color:#EEE8AA;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($Unitkerja as $unitkerja)
        <tr>
          <td>{{ $loop->iteration + $Unitkerja->firstItem() - 1 }}</td>
          <td>{{ $unitkerja->ID_UnitKerja }}</td>
          <td>{{ $unitkerja->UnitKerja }}</td>
            <td>{{ $unitkerja->Nama_Mentor }}</td>
          <td>
            <div class="d-flex justify-content-center gap-2">
              <a href="{{ route('unitkerja.editunitkerja', $unitkerja->id) }}" class="btn btn-sm btn-primary">Edit</a>
              <form action="{{ route('unitkerja.destroyunitkerja', $unitkerja->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $Unitkerja->links() }}
  </div>
</div>
<script>
    function toggleSidebar() {
        document.getElementById("sidebar").classList.toggle("active");


            }


  </script>


</body>
</html>
