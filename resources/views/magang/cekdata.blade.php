<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permintaan Magang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: #f4f4f4;
        }
        .container-box {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 7px rgba(0,0,0,.1);
            margin-top: 30px;
        }
        /* Style untuk menyembunyikan kotak alasan secara default */
        #alasanBox {
            display: none;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="container-box">

        <h3 class="mb-4">Detail Permintaan Magang</h3>

        <a href="#" class="btn btn-secondary mb-3">← Kembali</a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-bordered">
            {{-- Bagian Detail Data --}}
            <tr><th>NIK SAP</th><td>{{ $data->NIK_SAP }}</td></tr>
            <tr><th>Nama Mentor</th><td>{{ $data->Nama_Mentor }}</td></tr>
            <tr><th>No WA Mentor</th><td>{{ $data->NO_WA_Mentor }}</td></tr>
            <tr><th>Batch</th><td>{{ $data->Batch }}</td></tr>
            <tr><th>Unit Kerja</th><td>{{ $data->UnitKerja }}</td></tr>
            <tr><th>Bagian</th><td>{{ $data->Bagian }}</td></tr>
            <tr><th>Jurusan</th><td>{{ $data->Jurusan }}</td></tr>
            <tr><th>Judul PA</th><td>{{ $data->JudulPA }}</td></tr>
            <tr><th>Tahun Magang</th><td>{{ $data->tahunmagang }}</td></tr>

            {{-- Kolom Status dengan Badge --}}
            {{-- <tr>
                <th>Status</th>
                <td>
                    @if ($data->status == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif ($data->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @else
                        <span class="badge bg-warning text-dark">Pending</span>
                    @endif
                </td>
            </tr> --}}

            {{-- Kolom File Excel (Preview Iframe dihilangkan) --}}
            <tr>
                <th>File Excel</th>
                <td>
                    @if ($data->file_excel)
                        <p><strong>{{ $data->file_excel }}</strong></p>

                        <a href="{{ asset('fileexcel/' . $data->file_excel) }}"
                            download
                            class="btn btn-success btn-sm">
                            <i class="fas fa-download"></i> Download File Excel
                        </a>
                        {{-- Iframe Preview Dihilangkan di sini --}}

                    @else
                        <span class="text-danger">Tidak ada file.</span>
                    @endif
                </td>
            </tr>
        </table>

        <hr>

        <div class="mt-4">
            <h4>Aksi Permintaan</h4>

            {{-- Tampilkan tombol aksi hanya jika status masih 'pending' --}}
            {{-- @if ($data->status == 'pending') --}}

                {{-- Tombol Setujui --}}
                 {{-- <form action="{{ route('tabelpermintaan.setujui', $data->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Anda yakin ingin MENYETUJUI permintaan ini?');">
                        ✅ Setujui
                    </button>
                </form> --}}

                {{-- Tombol Tolak (Memanggil JavaScript) --}}
                {{-- <button class="btn btn-danger" onclick="showAlasan()">
                    ✖ Tolak
                </button> --}}
                <a href="{{ url('/status') }}" class="btn btn-primary btn-sm">
    <i class="bi bi-file-earmark-text me-2 "></i>  Form Penerimaan
</a>
{{--
            @else
                <p class="alert alert-info">Permintaan ini sudah diproses. Status: **{{ strtoupper($data->status) }}**.</p>
            @endif --}}
        </div>

        <div id="alasanBox" class="mt-3">
            <form action="{{ route('tabelpermintaan.tolak', $data->id) }}" method="POST">
                @csrf
                <label for="alasanTextarea" class="form-label fw-bold">Alasan Penolakan :</label>
                <textarea name="alasan" id="alasanTextarea" class="form-control" rows="3" required placeholder="Masukkan alasan penolakan..."></textarea>

                <button type="submit" class="btn btn-danger mt-2">
                    Kirim Penolakan
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    // Fungsi untuk menampilkan/menyembunyikan kotak alasan
    function showAlasan() {
        const alasanBox = document.getElementById('alasanBox');
        // Toggle display block/none
        alasanBox.style.display = (alasanBox.style.display === 'none' || alasanBox.style.display === '') ? 'block' : 'none';
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
