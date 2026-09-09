<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
      position: fixed;
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
     width: 70%;
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


    <div class="container mt-5 mb-5" >
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('unitkerja.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            {{-- <div class="form-group mb-3">
                                <label class="font-weight-bold">IMAGE</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                <!-- error message untuk image -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> --}}

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">ID UNIT KERJA</label>
                                <input type="text" class="form-control @error('ID_UnitKerja') is-invalid @enderror" name="ID_UnitKerja" value="{{ old('ID_UnitKerja') }}" placeholder="Masukkan ID Unit Kerja">

                                <!-- error message untuk title -->
                                {{-- @error('ID_UnitKerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror --}}
                            </div>

                           <div class="form-group mb-3">
                                <label class="font-weight-bold"> UNIT KERJA</label>
                                <input type="text" class="form-control" name="UnitKerja" value="{{ old('UnitKerja') }}" placeholder="Masukkan Nama Unit Kerja">

                                <!-- error message untuk title -->
                                 @error('UnitKerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold"> Nama Mentor</label>
                                <input type="text" class="form-control" name="Nama_Mentor" value="{{ old('Nama_Mentor') }}" placeholder="Masukkan Nama Mentor">

                                <!-- error message untuk title -->
                                 @error('Nama_Mentor')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            {{-- type reset untuk mengembalikan ke kondisi awal --}}
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
      <script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
  }
</script>
</body>
</html>
