<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Pengajuan Magang</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
/* ... (Style CSS tidak diubah) ... */
body {
    background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e9 100%);
    font-family: 'Poppins', sans-serif;
}

.form-container {
    max-width: 720px;
    margin: 60px auto;
    padding: 35px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 28px rgba(0,0,0,0.12);
}

.btn-modern {
    padding: 10px 25px;
    border-radius: 12px;
    font-weight: 500;
    transition: 0.2s ease;
}
.btn-modern:hover { transform: translateY(-2px); }
.btn-modern.active { /* Style tambahan untuk tombol yang aktif */
    box-shadow: 0 0 0 0.25rem rgba(25,135,84,0.5);
    border: 3px solid #198754;
}

.btn-success-gradient {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none; color: white;
}

.btn-danger-gradient {
    background: linear-gradient(135deg, #dc3545, #ff4d6d);
    border: none; color: white;
}
.btn-danger-gradient.active {
    box-shadow: 0 0 0 0.25rem rgba(220,53,69,0.5);
    border: 3px solid #dc3545;
}

.btn-submit {
    background: linear-gradient(135deg, #198754, #28a745);
    border: none;
    padding: 14px;
    font-size: 16px;
    border-radius: 14px;
    font-weight: 600;
    width: 100%;
    color: white;
}
.btn-submit:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}
</style>
</head>
<body>

<div class="form-container">

    <div class="form-header bg-success text-white text-center p-3 rounded mb-4">
        <h3><i class="bi bi-pencil-square me-2"></i>Form Permintaan data Magang</h3>
    </div>

    <form action="{{ route('storedatapermintaan') }}" method="POST">
        @csrf

        <h5 class="mb-3 fw-bold">Pilih Status Pengajuan:</h5>

        <input type="hidden" name="status" id="statusValue" required>
        <input type="hidden" name="alasan_penolakan" id="alasanPenolakanValue">

        <div class="d-flex justify-content-between mb-4">

            <button type="button" id="btnDiterima" class="btn btn-success-gradient btn-modern w-50 me-2">
                <i class="bi bi-check-circle me-1"></i> Diterima
            </button>

            <button type="button" id="btnDitolak" class="btn btn-danger-gradient btn-modern w-50 ms-2"
                    data-bs-toggle="modal" data-bs-target="#modalTolak">
                <i class="bi bi-x-circle me-1"></i> Ditolak
            </button>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mahasiswa</label>
            <input type="text" class="form-control" name="nama_mahasiswa" >
        </div>

        <div class="mb-3">
            <label class="form-label">Universitas</label>
            <input type="text" class="form-control" name="universitas" >
        </div>

        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" >
        </div>

        <div class="mb-3">
            <label class="form-label">NIK SAP</label>
            <input type="number" class="form-control" name="nik_sap" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Mentor</label>
            <input type="text" class="form-control" name="nama_mentor" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Unit Kerja</label>
            <input type="text" class="form-control" name="unit_kerja" required>
        </div>

        <button id="btnSubmit" type="submit" class="btn-submit" disabled>
            <i class="bi bi-send me-1"></i> Kirim
        </button>

    </form>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Alasan Penolakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <textarea id="inputAlasan" class="form-control"
                    placeholder="Masukkan alasan penolakan..." rows="4"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="btnConfirmTolak" class="btn btn-danger-gradient">Tolak & Pilih Status</button>
            </div>

        </div>
    </div>
</div>

<script>
// === LOGIKA JAVASCRIPT YANG DIPERBAIKI ===

// Mendapatkan elemen-elemen penting
const btnDiterima = document.getElementById("btnDiterima");
const btnDitolak = document.getElementById("btnDitolak");
const btnConfirmTolak = document.getElementById("btnConfirmTolak");
const statusValue = document.getElementById("statusValue");
const alasanPenolakanValue = document.getElementById("alasanPenolakanValue");
const inputAlasan = document.getElementById("inputAlasan");
const btnSubmit = document.getElementById("btnSubmit");

// Fungsi untuk mengaktifkan tombol submit
function checkStatusSelected() {
    // Tombol submit diaktifkan jika statusValue sudah terisi
    btnSubmit.disabled = statusValue.value === "";
}

// === TOMBOL DITERIMA ===
btnDiterima.addEventListener("click", function() {
    statusValue.value = "diterima";
    alasanPenolakanValue.value = ""; // Kosongkan alasan penolakan saat status diterima

    // Perbarui visual
    btnDiterima.classList.add('active');
    btnDitolak.classList.remove('active');

    checkStatusSelected();
    alert("Status dipilih: DITERIMA");
});

// === KONFIRMASI TOLAK ===
btnConfirmTolak.addEventListener("click", function() {
    let alasan = inputAlasan.value.trim();

    if (alasan === "") {
        alert("Alasan penolakan wajib diisi!");
        return;
    }

    statusValue.value = "ditolak";
    alasanPenolakanValue.value = alasan; // Isi nilai alasan penolakan

    // Perbarui visual
    btnDitolak.classList.add('active');
    btnDiterima.classList.remove('active');

    checkStatusSelected();

    // Tutup modal
    let modalTolak = bootstrap.Modal.getInstance(document.getElementById('modalTolak'));
    if (modalTolak) {
        modalTolak.hide();
    }

    alert("Status dipilih: DITOLAK");
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
