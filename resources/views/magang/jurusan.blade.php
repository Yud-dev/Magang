<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Jurusan</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Icons -->
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
      gap: 25px;
      margin: 0;
      padding: 0;
    }

    /* SIDEBAR */
    .sidebar-admin {
      position: fixed;
      top: 60px;
      left: 0;
      width: 230px;
      height: calc(100vh - 60px);
      background-color: #228B22;
      padding: 20px 15px;
      border-top-right-radius: 15px;
      display: flex;
      flex-direction: column;
      gap: 15px;
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

    /* CONTENT */
    .content {
      margin-left: 250px;
      padding: 30px;
      min-height: 100vh;
      background-color: #f2f2f2;
      transition: margin-left 0.3s ease;
    }

    .top-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 20px;
    }

    .table-container {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      overflow-x: auto;
    }

    .table th, .table td {
      white-space: nowrap;
      vertical-align: middle;
    }

    /* TOGGLE BUTTON (HP/TABLET) */
    .toggle-btn {
      display: none;
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

    /* RESPONSIVE */
    @media (max-width: 992px) {
      .sidebar-admin {
        left: -240px;
        width: 200px;
      }

      .sidebar-admin.active {
        left: 0;
      }

      .content {
        margin-left: 12%;
        padding: 20px;
      }

      .toggle-btn {
        display: block;
      }
    }

    @media (max-width: 576px) {
      header ul {
        gap: 10px;
      }

      header ul img {
        height: 30px;
      }

      .table-container {
        padding: 10px;
      }

      .table {
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body>

  <!-- HEADER -->
  <header>
    <ul>
      <li><img src="{{ asset('magang/logopetro.png') }}" alt="petro-logo" height="100"></li>
      <li><img src="{{ asset('magang/pupukindonesia.png') }}" alt="pupukindonesia-logo" height="40"></li>
    </ul>
  </header>

  <!-- TOGGLE BUTTON (UNTUK HP) -->
  <button class="toggle-btn d-lg-none" onclick="toggleSidebar()">
    <i class="bi bi-list fs-4"></i>
  </button>

  <!-- SIDEBAR -->
  <div class="sidebar-admin" id="sidebar">
    <div class="nav flex-column">
      <a href="{{ route('kuotamagang.indexkuotamagang') }}" class="nav-link d-flex align-items-center gap-2">
        <i class="bi bi-pie-chart-fill fs-4"></i> <span>Kuota</span>
      </a>
      <a href="{{ route('jurusan.Jurusan') }}" class="nav-link d-flex align-items-center gap-2" style="background-color: #EEE8AA; ">
        <i class="bi bi-mortarboard-fill fs-4" style="color: black"></i> <span style="color: black">Jurusan</span>
      </a>
      <a href="{{ route('unitkerja.indexunitkerja') }}" class="nav-link {{ request()->is('unitkerja*') ? 'active' : '' }}">
      <i class="bi bi-building fs-5"></i> <span>Unit Kerja</span>
    </a>
   <form action="{{ route('logout') }}" method="POST" class="mt-auto">
    @csrf
    <button type="submit" class="btn btn-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
    </button>
</form>

      {{-- <form action="{{ route('logout') }}" method="post" class="mt-auto">
        @csrf
        <button type="submit" class="btn btn-danger w-100">
          <i class="bi bi-box-arrow-right"></i> Logout
        </button>
      </form> --}}
    </div>
  </div>

  <!-- CONTENT -->
  <div class="content">
    <div class="top-actions">
      <a class="btn btn-success btn-sm" href="{{ url('/tambahjurusan') }}">
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
            <th style="background-color:#EEE8AA">No</th>
            <th style="background-color:#EEE8AA">ID Jurusan</th>
            <th style="background-color:#EEE8AA">Jurusan</th>
            <th style="background-color:#EEE8AA">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($jurusan as $Jurusan)
          <tr>
            <td>{{ $loop->iteration + $jurusan->firstItem() - 1 }}</td>
            <td>{{ $Jurusan->ID_Jurusan }}</td>
            <td>{{ $Jurusan->Jurusan }}</td>
            <td>
              <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('jurusan.editjurusan', $Jurusan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                <form action="{{ route('jurusan.destroyjurusan', $Jurusan->id) }}" method="POST">
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
      <div class="d-flex justify-content-center mt-3">
        {{ $jurusan->links() }}
      </div>
    </div>
  </div>

  <!-- SCRIPT -->
  <script>
    function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("active");
    }
  </script>

<script>
    function logout() {
    if (confirm("Apakah Anda yakin ingin logout?")) {
      window.location.href = "http://127.0.0.1:8000/Webmagang";
    }
  }
  </script>
</body>
</html>
