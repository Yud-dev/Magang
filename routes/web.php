<?php
use App\Http\Controllers\AboutController;
use App\Http\Controllers\IndexScannerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelumdiambilController;
use App\Http\Controllers\SudahdiambilController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\QRCODEController;
use App\Http\Controllers\TabelController;
use App\Http\Controllers\KebutuhanMagangController;

use Illuminate\Support\Facades\Auth;
Route::get('/Welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('magang.landingpage');
});
Route::get('/status', function () {
    return view('magang.status');
});
// Route::get('/', function () {
//     return view('index');
// })

// Route navbar atau halaman statis
// Route::get('/sudahdiambilnavbar', function () {
//     return view('Sudahdiambil');
// });

Route::get('/modal', function () {
    return view('Modal');
});

// Route Belum Diambil
// Route::get('/belumdiambilnavbar', function () {
//     return view('Belumdiambil');
// });

// Resource controller untuk Sudahdiambil
Route::resource('/sudahdiambil', SudahdiambilController::class);

// FormRoute
Route::get('/Form/input/{id}', [FormController::class, 'input'])->name('form.input');

// route halaman riwayat
Route::get('/riwayatbarang', [FormController::class, 'index'])->name('riwayat.index');

// Menyimpan data dari form
Route::get('/search', [BelumdiambilController::class, 'search'])->name('barang.search');
Route::get('/search1', [SudahdiambilController::class, 'search1'])->name('barang.search1');
Route::post('/create', [BelumdiambilController::class, 'store'])->name('store'); //route create dengan method post
Route::get('/create', [BelumdiambilController::class, 'create'])->name('barang.create');
Route::get('/belumdiambil', [BelumdiambilController::class, 'index'])->name('belumdiambil.index');
Route::post('/belumdiambil/{id}', [BelumdiambilController::class, 'update'])->name('belumdiambil.update');
// Route delete untuk Belumdiambil
Route::delete('/belumdiambil/delete/{id}', [BelumdiambilController::class, 'delete'])->name('barang.delete');

// Route delete untuk Tabel
Route::delete('/tabel/delete/{id}', [TabelController::class, 'hapus'])->name('barang.hapus');
// Route::post('/riwayat/{id}', [RiwayatController::class, 'form'])->name('riwayat.form');
// Route::put('/riwayat/{id}', [RiwayatController::class, 'update'])->name('riwayat.update')
// Route::delete(uri:'/deleteriwayat/{id}', action: [RiwayatController::class,'deleteriwayat' ])->name('riwayat.delete');
// Route::get('/riwayat/{id}/edit', [RiwayatController::class, 'editriwayat'])->name('editriwayat');
Route::get('/belumdiambil/update/{id}', [BelumdiambilController::class, 'edit'])->name('barang.update');
Route::get(uri: '/editbelumdiambil/{id}', action: [BelumdiambilController::class, 'edit'])->name('barang.edit');
// Route::post('/riwayat/update-foto/{id}', [RiwayatController::class, 'updateFoto'])->name('riwayat.updateFoto')
Route::put('/belumdiambil/update/{id}', [BelumdiambilController::class, 'update'])->name('barang.update');
Route::get('/about1', function () {
    return view('About');
});
Route::get('/scannercam', function () {
    return view('Scanner.ScannerCam');
});



// Route::get('/tabel1', function () {
//     return view('Scanner.TableScanner');
// })

Route::get('/qrcode1/{id}', function () {
    return view('Scanner.Qrcode');
});

Route::post('/store', [QRCODEController::class, 'store'])->name('qrcode.store');
Route::get('/qrcode/{id}', [QRCODEController::class, 'show'])->name('Scanner.Qrcode');

Route::get('/scannernew', function () {
    return view('Scanner.Scannernew');
});
Route::get('/Codeqr', function () {
    return view('Scanner.CodeQR');
});
Route::post('/loginstore', [KebutuhanMagangController::class,'storelogin'])->name('storelogin');
Route::get('/scancode', function () {
    return view('Scanner.Scan');
});
// Route::get('/updatebarang/{id}', [QRCODEController::class, 'edit'])->name('barang.edit')
Route::get('/generate-qrcode', [QRCODEController::class, 'index'])->name('qrcode.index');
Route::post('/generate-qrcode',  [QRCODEController::class, 'Codeqr'])->name('qrcode.Codeqr');
Route::get('/tabel1', [TabelController::class, 'index'])->name('data.index');
Route::get('/searchtabel', [TabelController::class, 'search'])->name('Scanner.search');
Route::post('/data/store', [QRCODEController::class, 'store'])->name('data.store');
Route::get('/indexScanner', [IndexScannerController::class, 'index'])->name('barang.index');
Route::get('/indexScanner', [TabelController::class, 'search'])->name('data.search');
Route::get('/seken', function () {
    return view('Scanner.Scan');
});
Route::get('/updatebarang/{id}', [QRCODEController::class, 'edit'])->name('barang.edit');
// Route::get('/formscan', function () {
//     return view('Scanner.Form');
// })

Route::get('/download/{filename}', [QRCODEController::class, 'download'])->name('filepath.download');
Route::get('/pemindai', function () {
    return view('Pemindai');
});
Route::delete('/delete/{id}', [TabelController::class, 'hapus'])->name('barang.hapus');
Route::get('/Form', [TabelController::class, 'Form'])->name('barang.Form');
// Route::resource('/form', TabelController::class)
Route::post('/Upload', [TabelController::class, 'Upload'])->name('tabel.Upload');
Route::get('/Detail/{id}', [TabelController::class, 'Detail'])->name('barang.Detail');
Route::post('/upload', [TabelController::class, 'Upload'])->name('tabel.Upload');
// Route::get('/edit', function () {
//     return view('Scanner.Edit');
// })
Route::get('/edit/{id}', [TabelController::class, 'EditDetail'])->name('barang.EditDetail');
Route::put('/editdetail/{id}', [TabelController::class, 'UpdateDetail'])->name('barang.UpdateDetail');
Route::get('/editdetail/{id}', [TabelController::class, 'UpdateDetail'])->name('barang.UpdateDetail');
// Route::put('/edit/{id}', [TabelController::class, 'UpdateDetail'])

Route::post('/riwayatpost/{id}', [FormController::class, 'store'])->name('riwayat.store');

Route::post('/adminkebutuhanmagang', [KebutuhanMagangController::class, 'storeAdminKebutuhanMagang'])->name('storeAdminKebutuhanMagang');
// Route::get('/', [KebutuhanMagangController::class, 'indexMagang'])->name('indexMagang')
Route::post('/logout', [KebutuhanMagangController::class, 'logout'])->name('logout');
// Route::get('/Webmagang', function () {
//     return view('magang.index');
// });
// Route::get('/loginmagang', function () {
//     return view('magang.login');

// Route::get('/unitkerja', [KebutuhanMagangController::class, 'indexunitkerja'])->name('unitkerja.indexunitkerja');
// Route::get('/kuota', [KebutuhanMagangController::class, 'indexkuotamagang'])->name('kuotamagang.indexkuotamagang')
Route::post('/logout', [KebutuhanMagangController::class, 'logout'])->name('logout');
// unitkerja
// UNIT KERJA
// Route::get('/unitkerja', [KebutuhanMagangController::class, 'indexunitkerja'])->name('unitkerja.indexunitkerja');
// Route::get('/create-unitkerja', [KebutuhanMagangController::class, 'createUnitKerja'])->name('unitkerja.create');
Route::post('/store-unitkerja', [KebutuhanMagangController::class, 'storeUnitKerja'])->name('unitkerja.store');
// Route::get('/editunitkerja/{id}', [KebutuhanMagangController::class, 'editunitkerja'])->name('unitkerja.editunitkerja')
Route::put('/updateunitkerja/{id}', [KebutuhanMagangController::class, 'updateunitkerja'])->name('unitkerja.updateunitkerja');
Route::delete('/deleteunitkerja/{id}', [KebutuhanMagangController::class, 'destroyunitkerja'])->name('unitkerja.destroyunitkerja');
Route::get('/deleteunitkerja/{id}', [KebutuhanMagangController::class, 'destroyunitkerja'])->name('unitkerja.destroyunitkerja');
// kuota
// Route::get('/updateunitkerja/{id}', [KebutuhanMagangController::class, 'updateunitkerja'])->name('unitkerja.updateunitkerja');
// Route::get('/tambahkuota', [KebutuhanMagangController::class, 'Createkuotamagang'])->name('kuotamagang.Createkuotamagang');
Route::post('/storekuota', [KebutuhanMagangController::class, 'storekuotamagang'])->name('kuotamagang.storekuotamagang');
// Route::get('/editkuota/{id}', [KebutuhanMagangController::class, 'editkuota'])->name('kuota.editkuota')
Route::put('/updatekuota/{id}',[KebutuhanMagangController::class, 'updatekuota'])->name('kuota.updatekuota');
// Route::get('/deletekuota/{id}', [KebutuhanMagangController::class, 'destroykuota'])->name('kuota.destroykuota')
Route::delete('/deletekuota/{id}', [KebutuhanMagangController::class, 'destroykuota'])->name('kuota.destroykuota');
 Route::get('/statuspermintaan', [KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan');
Route::get('/cekdata', function () {
    return view('magang.cekdata');
});
Route::post('/status/login', [KebutuhanMagangController::class, 'processStatusLogin'])->name('status.login.process');
Route::get('/status/login', [KebutuhanMagangController::class, 'processStatusLogin'])->name('status.login.process');

// Jurusan
// Route::get('/Jurusan', [KebutuhanMagangController::class, 'Jurusan'])->name('jurusan.Jurusan');

// Route::get('/tambahjurusan', [KebutuhanMagangController::class, 'CreateJurusan'])->name('CreateJurusan')
Route::post('/storejurusan', [KebutuhanMagangController::class, 'storejurusan'])->name('jurusan.storejurusan');
// Route::get('/editjurusan/{id}', [KebutuhanMagangController::class, 'editjurusan'])->name('jurusan.editjurusan')
Route::put('/editjurusan/{id}', [KebutuhanMagangController::class, 'updatejurusan'])->name('jurusan.updatejurusan');
Route::delete('/deletejurusan/{id}', [KebutuhanMagangController::class, 'destroyjurusan'])->name('jurusan.destroyjurusan');
// search
// Route::get('/searchjurusan', [KebutuhanMagangController::class, 'searchjurusan'])->name('jurusan.searchjurusan');
// // TabelPermintaan
// Route::get('/TabelPermintaan', [KebutuhanMagangController::class,'TabelPermintaanIndex'])->name('tabelpermintaan.TabelPermintaanIndex');
Route::post('/datatabel', [KebutuhanMagangController::class,'storeTabelPermintaan'])->name('storeTabelPermintaan');
// Route::get('/download/excel/{filename}', [KebutuhanMagangController::class, 'downloadExcel'])->name('download.downloadExcel');
// login
Route::get('/statusrequestuser/{nik_sap}',
    [KebutuhanMagangController::class, 'statuspermintaan']
)->name('datapermintaan.statuspermintaan');

// Ganti 'indexlogin' menjadi 'login'
Route::get('/Login', [KebutuhanMagangController::class,'indexlogin'])->name('login');
Route::post('/storeLogin', [KebutuhanMagangController::class,'storeLogin'])->name('storelogin');

//  Route::get('/Admin', function () {
//      return view('magang.dasboardadmin');
// })
Route::get('/uploadbarang', function () {
    return view('Upload');
});

Route::get('/templateworkplan', [KebutuhanMagangController::class,'templateworkplan'])->name('download.templateworkplan');
// autocomplete
Route::get('/autocompletejurusan', [KebutuhanMagangController::class, 'autocompleteJurusan'])->name('autocompleteJurusan');
Route::get('/autocompleteunitkerja', [KebutuhanMagangController::class, 'autocompleteUnitkerja'])->name('autocompleteUnitkerja');
Route::get('/autocompletenamamentor', [KebutuhanMagangController::class, 'autocompleteNamamentor'])->name('autocompleteNamamentor');
  Route::post('/statuspermintaan',[KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan');
  Route::get('/statuspermintaan',[KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan');
//   Route::get('/statuspermintaan',[KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan');
// middleware
Route::get('/loginstatus', [KebutuhanMagangController::class, 'LoginStatus'])->name('status.login');
Route::middleware(['auth'])->group(function () {

Route::get('/statusrequestuser/{nik_sap}',
    [KebutuhanMagangController::class, 'statuspermintaan']
)->name('datapermintaan.statuspermintaan');

Route::post('/permintaan/{id}/setujui', [KebutuhanMagangController::class, 'setujuiPermintaan'])
    ->name('permintaan.setujui');

Route::post('/permintaan/{id}/tolak', [KebutuhanMagangController::class, 'tolakPermintaan'])
    ->name('permintaan.tolak');
    Route::post('/statumagang', [KebutuhanMagangController::class, 'processStatusLogin'])->name('processStatusLogin');
   Route::get('/status', function () {
      return view('magang.statuspermintaanmagang');
  });
    Route::get('/storedatapermintaan', [KebutuhanMagangController::class, 'storedatapermintaan'])->name('storedatapermintaan');
  Route::post('/storedatapermintaan', [KebutuhanMagangController::class, 'storedatapermintaan'])->name('storedatapermintaan');
//   Route::post('/statuspermintaan',[KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan')
//   Route::get('/statuspermintaan',[KebutuhanMagangController::class, 'statuspermintaan'])->name('status.permintaan')
  Route::post('/status', [KebutuhanMagangController::class, 'storedatapermintaan'])->name('storedatapermintaan');
Route::post('/tabelpermintaan/setujui/{id}', [KebutuhanMagangController::class, 'setujuiPermintaan'])->name('tabelpermintaan.setujui');
Route::post('/tabelpermintaan/tolak/{id}', [KebutuhanMagangController::class, 'tolakPermintaan'])->name('tabelpermintaan.tolak');
Route::get('/cekdataform/{id}', [KebutuhanMagangController::class,'detailform'])->name('detailform');
Route::post('/cekdataform/{id}', [KebutuhanMagangController::class,'detailform'])->name('detailform');

// ✅ Solusi: Gunakan Route::get() untuk menampilkan halaman detail
Route::get('/cekdata/{id}', [KebutuhanMagangcontroller::class, 'cekData'])->name('tabelpermintaan.cekData');
// Route::post('/tabelpemintaan', [KebutuhanMagangController::class, 'storeTabelPermintaan'])->name('storeTabelPermintaan')
Route::post('/datapermintaan/{id}', [KebutuhanMagangController::class, 'updateStatus'])->name('updateStatus');
Route::post('/cekdata/{id}', [KebutuhanMagangController::class,'cekdata'])->name('cekdata');
Route::get('/Admin', [KebutuhanMagangController::class, 'IndexAdmin'])->name('tabelpermintaan.IndexAdmin');
Route::get('/unitkerja', [KebutuhanMagangController::class, 'indexunitkerja'])->name('unitkerja.indexunitkerja');
Route::get('/kuota', [KebutuhanMagangController::class, 'indexkuotamagang'])->name('kuotamagang.indexkuotamagang');
Route::get('/Jurusan', [KebutuhanMagangController::class, 'Jurusan'])->name('jurusan.Jurusan');
Route::get('/tambahjurusan', [KebutuhanMagangController::class, 'CreateJurusan'])->name('CreateJurusan');
Route::get('/unitkerja', [KebutuhanMagangController::class, 'indexunitkerja'])->name('unitkerja.indexunitkerja');
Route::get('/kuota', [KebutuhanMagangController::class, 'indexkuotamagang'])->name('kuotamagang.indexkuotamagang');
Route::get('/create-unitkerja', [KebutuhanMagangController::class, 'createUnitKerja'])->name('unitkerja.create');
Route::get('/editunitkerja/{id}', [KebutuhanMagangController::class, 'editunitkerja'])->name('unitkerja.editunitkerja');
Route::get('/updateunitkerja/{id}', [KebutuhanMagangController::class, 'updateunitkerja'])->name('unitkerja.updateunitkerja');
Route::get('/tambahkuota', [KebutuhanMagangController::class, 'Createkuotamagang'])->name('kuotamagang.Createkuotamagang');
Route::get('/editkuota/{id}', [KebutuhanMagangController::class, 'editkuota'])->name('kuota.editkuota');
Route::get('/editjurusan/{id}', [KebutuhanMagangController::class, 'editjurusan'])->name('jurusan.editjurusan');
Route::get('/searchjurusan', [KebutuhanMagangController::class, 'searchjurusan'])->name('jurusan.searchjurusan');
// TabelPermintaan
// Route::get('/TabelPermintaan', [KebutuhanMagangController::class,'TabelPermintaanIndex'])->name('tabelpermintaan.TabelPermintaanIndex');
Route::get('/download/excel/{filename}', [KebutuhanMagangController::class, 'downloadExcel'])->name('download.downloadExcel');
    // Tambahkan route lainnya di sini
});

// Form login cek status
// Route::get('/status/login', [KebutuhanMagangcontroller::class, 'showLogin'])->name('status.login');
// Route::post('/status/login', [KebutuhanMagangcontroller::class, 'processLogin'])->name('status.login.process');
// / Dashboard Status
// Route::get('/status-permintaan', [KebutuhanMagangcontroller::class, 'statusPage'])->name('status.page');


