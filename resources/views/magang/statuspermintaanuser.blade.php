<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Permintaan Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ... (Style CSS tidak diubah) ... */
        body {
            background: #eef2f7;
            min-height: 100vh;
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .status-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(6px);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.15);
        }

        .title-text {
            font-weight: 700;
            color: #0d3b66;
        }

        .filter-text {
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        table thead tr {
            background: #0d6efd;
            color: white;
        }

        table tbody tr:hover {
            background: rgba(13,110,253,0.09);
            transition: all 0.2s ease;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="status-container mx-auto col-lg-10 col-md-12">
<div class="mb-3">
            <a href="{{ url('/loginstatus') }}" class="btn btn-secondary">
                ← Kembali
            </a>
        </div>
        <h3 class="text-center mb-4 title-text">Status Permintaan Magang Anda</h3>

        <p class="text-center filter-text">
             NIK SAP:
            <b>{{ $nik_sap ?? 'Tidak Ditemukan' }}</b>
        </p>

        @if($datapermintaan->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                Tidak ada data permintaan magang yang ditemukan untuk NIK SAP ini.
            </div>
        @else

            <div class="table-responsive">
                <table class="table table-striped table-hover text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Mahasiswa</th>
                            <th>Universitas</th>
                            <th>Jurusan</th>
                            <th>Unit Kerja</th>
                            <th>Nama Mentor</th>
                            <th>NIK SAP</th>
                            <th>Status</th>
                            <th>Alasan Penolakan</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach ($datapermintaan as $data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->nama_mahasiswa }}</td>
        <td>{{ $data->universitas }}</td>
        <td>{{ $data->jurusan }}</td>
        <td>{{ $data->unit_kerja }}</td>
        <td>{{ $data->nama_mentor }}</td>
        <td>{{ $data->nik_sap }}</td>

       <td>
    @if($data->status == 'pending')
        <span class="badge bg-warning text-dark">Menunggu Persetujuan</span>
    @elseif($data->status == 'diterima')
        <span class="badge bg-success">Diterima</span>
    @elseif($data->status == 'ditolak')
        <span class="badge bg-danger">Ditolak</span>
    @endif
</td>

<td>
    @if($data->status == 'ditolak')
        {{ $data->alasan_penolakan ?? '-' }}
    @else
        -
    @endif
</td>

    </tr>
@endforeach
</tbody>

                </table>
            </div>

        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
