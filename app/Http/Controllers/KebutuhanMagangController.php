<?php

namespace App\Http\Controllers;


use App\Models\TabelPermintaan;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Support\Facades\Auth;
use App\Models\Unitkerja;
use Illuminate\Http\Request;
use App\Models\KuotaMagang;
use App\Models\Jurusan;
use App\Models\DatatabelQR;
use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use App\Rules\Validationkuota;
use App\Rules\ValidationJurusan;
use App\Rules\ValidationNamaMentor;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Unique;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Login;
use Psy\Command\ListCommand\FunctionEnumerator;
use Session;
use App\Requests\KuotaPostRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Ramsey\Collection\AbstractCollection;
use Illuminate\Support\Facades\Response;
use App\Models\DataStatusPermintaan;
use Illuminate\Support\Str;
class KebutuhanMagangController extends Controller
{
    //
    public function indexMagang(){


        return view('magang.index', );
    }
    public function storeAdminKebutuhanMagang(Request $request)
{
    $validatedData = $request->validate([
        'NIK_SAP' => 'required|numeric|min:1',
        'Nama_Mentor' => 'required|string|min:1',
        'NO_WA_Mentor' => 'required|string|min:1',
        'Batch' => 'required|string|min:1',
        'UnitKerja' => 'required|string|min:1',
        'Bagian' => 'required|string|min:1',
        'JudulPA' => 'required|string|min:1',
        'FileExcel' => 'required|string|min:1',
    ]);

    $hasExpenseSAVEDForUser = Expense::query()
        ->where('UnitKerja', $validatedData['UnitKerja'])
        ->where('Nama_Mentor', $validatedData['Nama_Mentor'])
        ->exists();

    if ($hasExpenseSAVEDForUser) {
        return back()->withErrors([
            'UnitKerja' => 'Data untuk Unit Kerja dan Nama Mentor ini sudah pernah diinputkan.',
        ]);
    }

    Expense::create($validatedData);

    return view('magang.index')->with('success', 'Data berhasil disimpan.');
}


    public function indexunitkerja(Request $request)
    {
        $search = $request->input('search');
        $Unitkerja = Unitkerja::when($search, function ($query, $search) {
            $query->where('ID_Unitkerja', 'like', '%' . $search . '%')
            ->orWhere('UnitKerja', 'like', '%' . $search . '%');
        })
       ->orderBy('ID_UnitKerja', 'desc')
       ->orderBy('created_at', 'desc')

        ->paginate(6);
        return view('magang.unitkerja', compact('Unitkerja', 'search'));

    }
    public function indexlogin(Request $request)
    {


        return view('magang.Login');
    }
//     public function storelogin(Request $request)
//     {
// $request->validate([
//     'username' => 'required|string|max:255',
//     'password' => 'required',
// ]);

// if (Auth::attempt([
//     'username' => $request->username,
//     'password' => $request->password,
// ])) {
//     return redirect()->intended('/Admin');
// }
// return back()->withErrors([
//     'username' => 'Username Atau Password Salah. Silahkan Coba Lagi'
// ])
public function storeLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ])) {
            $request->session()->regenerate();
            return redirect()->intended('/Admin');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.'
        ]);
    }


public function logout(Request $request)
{
 Auth::logout();

 $request->session()->invalidate();
 $request->session()->regenerateToken();

 return redirect('/')->with('status', 'Kamu telah Berhasil Logout');

}



public function Createunitkerja(){


    return view('crudwebmagang.UnitkerjaCreate',);
}
public function storeunitkerja(Request $request){
    $request->validate([
        'ID_UnitKerja' => 'required|min:1',
        'UnitKerja' => [
            'required',
            Rule::unique('unitkerjas')->where(function ($query) use ($request) {
                return $query->where('UnitKerja', $request->UnitKerja);
            }),
        ],
        'Nama_Mentor' => 'required|min:1',

    ],
        [
          'UnitKerja.unique' => 'Data UnitKerja Sudah Ada',


    ]);

Unitkerja::create([
    'ID_UnitKerja' => $request->ID_UnitKerja,
    'UnitKerja' => $request->UnitKerja,
    'Nama_Mentor' => $request->Nama_Mentor,
]);
    return redirect()->route('unitkerja.indexunitkerja')->with('success', 'Data Berhasil Ditambahkan');
}

public function editunitkerja($id){
    $unitkerja = Unitkerja::findOrFail($id);
    return view('crudwebmagang.editunitkerja', compact('unitkerja'));
}
public function updateunitkerja(Request $request, $id)
{
    $request->validate([
        'ID_UnitKerja' => 'required|min:1',
        'UnitKerja' => 'required|min:1',
        'Nama_Mentor' => 'required|min:1',
    ]);
    $unitkerja = Unitkerja::findOrFail($id);
    $unitkerja->update([
'ID_UnitKerja' => $request->ID_UnitKerja,
'UnitKerja' => $request->UnitKerja,
'Nama_Mentor' => $request->Nama_Mentor,
    ]);
    return redirect()->route('unitkerja.indexunitkerja')->with(['success' => 'Data Berhasil Diubah!']);
}
public function destroyunitkerja($id)
{
    $unitkerja = Unitkerja::findorfail($id);
    $unitkerja->delete();
    return redirect()->route('unitkerja.indexunitkerja')->with('success', 'Data Berhasil Dihapus');
}

public function indexkuotamagang(Request $request)
{
    $search = $request->input('search');

    $kuotamagang = KuotaMagang::with('unitkerja')
        ->when($search, function ($query, $search) {
            // Bungkus semua kondisi OR dalam satu where closure
            return $query->where(function ($q) use ($search) {
                $q->whereHas('unitkerja', function ($qUnit) use ($search) {
                    $qUnit->where('UnitKerja', 'like', '%' . $search . '%');
                })
                ->orWhere('tahun', 'like', '%' . $search . '%')
                ->orWhere('batch', 'like', '%' . $search . '%')
                ->orWhere('kuota', 'like', '%' . $search . '%');
            });
        })
 ->orderBy('id', 'desc')
        ->paginate(6);

     $unitkerjas = Unitkerja::first();

    return view('magang.kuotamagang', compact('kuotamagang',  'search', 'unitkerjas'));
}

public function Createkuotamagang(Request $request)
{
    return view('crudwebmagang.kuotamagangcreate');
}
public function editkuota($id){
    $kuota = KuotaMagang::findOrFail($id);
    return view('crudwebmagang.editkuotamagang', compact('kuota'));
}



// public function storekuotamaganglama(Request $request)
// {
//     $request->validate([
//         'UnitKerja' => [
//             'required',
//             Rule::unique('kuota_magangs')->where(function ($query) use ($request) {
//                 return $query->where('UnitKerja', $request->UnitKerja)
//                              ->where('tahun', $request->tahun)
//                              ->where('batch', $request->batch);
//             }),


//         ],

//          'tahun' => [
// 'required',
// Rule::unique('kuota_magangs')->where(function ($query) use ($request) {
//     return $query->where('tahun', $request->tahun);
// }),
//          ],

//         'batch' => [
//             'required',
// Rule::unique('kuota_magangs')->where(function ($query) use ($request) {
//     return $query->where('batch', $request->batch);
// })
//         ],
//         'kuota' => 'required|min:1',
//     ], [
//         'UnitKerja.unique' => 'Data Unit Kerja Sudah Ada',
//          'tahun.unique' => 'Data Tahun Sudah Ada',
//          'batch.unique' => 'Data Batch Sudah Ada',
//     ]);

//     KuotaMagang::create([
//         'UnitKerja' => $request->UnitKerja,
//         'tahun' => $request->tahun,
//         'batch' => $request->batch,
//         'kuota' => $request->kuota,
//     ]);

//     return redirect()->route('kuotamagang.indexkuotamagang')
//         ->with('success', 'Data Berhasil Ditambahkan');
// }
// KuotaMagangController.php (Potongan Kode)

// KuotaMagangController.php

public function storekuotamagang(Request $request)
{
    $request->validate([
        'UnitKerja' => [
            'required',

            Rule::unique('kuota_magangs')->where(function ($query) use ($request) {
                return $query->where('UnitKerja', $request->UnitKerja)
                             ->where('tahun', $request->tahun)
                             ->where('batch', $request->batch);
            }),
        ],

         'tahun' => 'required|numeric',
         'batch' => 'required|string',
         'kuota' => 'required|min:1|numeric',
    ], [

        'UnitKerja.unique' => 'Kuota untuk Unit Kerja ini pada Tahun dan Batch tersebut sudah ada.',
        'kuota.min' => 'Kuota harus minimal 1.',

    ]);

    KuotaMagang::create([
        'UnitKerja' => $request->UnitKerja,
        'tahun' => $request->tahun,
        'batch' => $request->batch,
        'kuota' => $request->kuota,
    ]);

    return redirect()->route('kuotamagang.indexkuotamagang')
        ->with('success', 'Data Berhasil Ditambahkan');
}
public function updatekuota(Request $request, $id)
{
    $request->validate([
        'UnitKerja' => 'required|min:1',
        'tahun' => 'required|min:1',
         'batch' => 'required|min:1',
        'kuota' => 'required|min:1',
    ]);
    $kuota = KuotaMagang::findOrFail($id);
    $kuota->update([
        'UnitKerja' => $request->UnitKerja,
        'tahun' => $request->tahun,
        'batch' => $request->batch,
        'kuota' => $request->kuota,
    ]);
    // KuotaMagang::create($request->all());
    // return redirect()->route('kuotamagang.indexkuotamagang')->with(['success' => 'Data Berhasil Diubah!'])
  return redirect()->route('kuotamagang.indexkuotamagang')->with('Success Data Berhasil Diubah');//berfungsi mengarahkan kehalaman sebelumnya ketika berhasil
}
public function destroykuota($id)
{
    $kuota = KuotaMagang::findorfail($id);
    $kuota->delete();
    return redirect()->route('kuotamagang.indexkuotamagang')->with('success', 'Data Berhasil Dihapus');
}

// public function Jurusan(Request $request)
//     {
//          $search = $request->input('search');
//         $jurusan = Jurusan::when($search, function ($query, $search) {
//         $query->where('ID_Jurusan', 'like', '%' . $search . '%')
//               ->orWhere('Jurusan', 'like', '%' . $search . '%');
// })
// }
   public function Jurusan(Request $request)
{
    $search = $request->input('search');

    $jurusan = Jurusan::when($search, function ($query, $search) {
            $query->where('ID_Jurusan', 'like', '%' . $search . '%')
                  ->orWhere('Jurusan', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')   // data baru di atas sesuai created at
        ->orderBy('ID_Jurusan', 'desc')   // kalau created_at sama, urutkan berdasarkan ID_Jurusan
        ->paginate(10);


    return view('magang.jurusan', compact('jurusan', 'search'));
}




public function CreateJurusan(Request $request)
{


    return view('crudwebmagang.jurusanmagangcreate');
}
public function storejurusan(Request $request)
{
    $request->validate([
        'ID_Jurusan' => 'required',
        'Jurusan' => [
            'required',
            Rule::unique('jurusans')->where(function ($query) use ($request) {
                return $query->where('Jurusan', $request->Jurusan);
            }),
        ],
    ], [
        'Jurusan.unique' => 'Data Jurusan Sudah Ada',
    ]);

    Jurusan::create([
        'ID_Jurusan' => $request->ID_Jurusan,
        'Jurusan' => $request->Jurusan,
    ]);

    return redirect()->route('jurusan.Jurusan')->with('success', 'Data Berhasil Ditambahkan');
}

public function editjurusan($id){
    $jurusan = Jurusan::findOrFail($id);
    return view('crudwebmagang.editjurusan', compact('jurusan'));
}
public function updatejurusan(Request $request, $id)
{
    $request->validate([
        'ID_Jurusan' => 'required|min:1',
        'Jurusan' => 'required|min:1',
    ]);
    $jurusan = Jurusan::findOrFail($id);
    $jurusan->update([
        'ID_Jurusan' => $request->ID_Jurusan,
        'Jurusan' => $request->Jurusan,
    ]);
    return redirect()->route('jurusan.Jurusan')->with('Success Data Berhasil Diubah');
}
public function destroyjurusan($id)
{
    $jurusan = Jurusan::findOrFail($id);
    $jurusan->delete();
    return redirect()->route('jurusan.Jurusan')->with('success', 'Data Berhasil Dihapus');
}

public function IndexAdmin(Request $request)
{
    // 1. Ambil semua nilai input dari request
    $search = $request->input('search');
    $tahunmagang = $request->input('tahunmagang');

    // MENGAMBIL INPUT DENGAN 'Batch' (Huruf B kapital)
    $batch = $request->input('Batch');

    $status = $request->input('status');

    // 2. Mulai Query
    $query = TabelPermintaan::query();

    // 3. Terapkan Filter Search
    $query->when($search, function ($q) use ($search) {
        $q->where('NIK_SAP', 'like', '%' . $search . '%')
          ->orWhere('Nama_Mentor', 'like', '%' . $search . '%')
          ->orWhere('UnitKerja', 'like', '%' . $search . '%')
          ->orWhere('Bagian', 'like', '%' . $search . '%')
          ->orWhere('Jurusan', 'like', '%' . $search . '%')
          ->orWhere('JudulPA', 'like', '%' . $search . '%');
    });

    // 4. Terapkan Filter Tahun
    $query->when($tahunmagang, function ($q) use ($tahunmagang) {
        $q->where('tahunmagang', $tahunmagang);
    });

    // 5. Terapkan Filter Batch (Kolom database: 'Batch')
    $query->when($batch, function ($q) use ($batch) {
        $q->where('Batch', $batch); // Menggunakan 'Batch' (kapital) untuk kolom DB
    });

    // 6. Terapkan Filter Status
    $query->when($status, function ($q) use ($status) {
        $q->where('status', $status);
    });

    // 7. Ambil data dengan pagination
    $tabelpermintaan = $query->latest()
                             ->paginate(6)
                             ->withQueryString();

    // 8. Kirim data dan variabel filter ke view
    // Variabel $batch dikirimkan untuk mengisi ulang dropdown
    return view('magang.dasboardadmin', compact('tabelpermintaan', 'search', 'tahunmagang', 'batch', 'status'));
}





// public function storeTabelPermintaanlama(Request $request)
// {
//     // VALIDASI
//     $request->validate([
//         'NIK_SAP' => 'required|numeric|digits:7',

//         'Nama_Mentor' => [
//             'required',
//             'string',
//             'min:3',
//             new ValidationNamaMentor($request->UnitKerja, $request->Nama_Mentor)
//         ],

//         'NO_WA_Mentor' => 'required|string|min:10|max:15',

//         'Batch' => 'required|string|in:Batch 1,Batch 2',

//         'tahunmagang' => 'required|numeric|digits:4',

//         'UnitKerja' => [
//             'required',
//             'string',
//             new ValidationKuota($request->UnitKerja, $request->tahunmagang, $request->Batch)
//         ],

//         'Bagian' => 'required|string|min:3',

//         'Jurusan' => [
//             'required',
//             'string',
//             new ValidationJurusan($request->Jurusan)
//         ],

//         'JudulPA' => 'required|string|min:10',

//         'file_excel' => 'required|file|mimes:xlsx,xls|max:2048',

//         'flexRadioDefault' => 'required|in:on',
//     ]);

//     // UPLOAD FILE
//     $namaFile = null;

//     if ($request->hasFile('file_excel')) {

//         $file = $request->file('file_excel');

//         $namaFile = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

//         $file->move(public_path('fileexcel'), $namaFile);
//     }

//     // SIMPAN KE DB
//     try {

//         $data = TabelPermintaan::create([
//             'NIK_SAP' => $request->NIK_SAP,
//             'Nama_Mentor' => $request->Nama_Mentor,
//             'NO_WA_Mentor' => $request->NO_WA_Mentor,
//             'Batch' => $request->Batch,
//             'tahunmagang' => $request->tahunmagang,
//             'UnitKerja' => $request->UnitKerja,
//             'Bagian' => $request->Bagian,
//             'Jurusan' => $request->Jurusan,
//             'JudulPA' => $request->JudulPA,
//             'file_excel' => $namaFile,
//             'status' => 'pending'
//         ]);

//         return redirect()
//             ->back()
//             ->with('success', "Permintaan magang berhasil dikirim! ");

//     } catch (\Exception $e) {

//         if ($namaFile && file_exists(public_path('fileexcel/'.$namaFile))) {
//             unlink(public_path('fileexcel/'.$namaFile));
//         }

//         return redirect()
//             ->back()
//             ->withErrors(['error' => "Gagal menyimpan data: " . $e->getMessage()])
//             ->withInput();
//     }
// }

public function storeTabelPermintaan(Request $request)
{
    // VALIDASI
    $request->validate([
        'NIK_SAP' => 'required|numeric|digits:7',

        'Nama_Mentor' => [
            'required',
            'string',
            'min:3',
            new ValidationNamaMentor($request->UnitKerja, $request->Nama_Mentor)
        ],

        'NO_WA_Mentor' => 'required|string|min:10|max:15',
        'Batch' => 'required|string|in:Batch 1,Batch 2',
        'tahunmagang' => 'required|numeric|digits:4',

        'UnitKerja' => [
            'required',
            'string',
            new ValidationKuota($request->UnitKerja, $request->tahunmagang, $request->Batch)
        ],

        'Bagian' => 'required|string|min:3',

        'Jurusan' => [
            'required',
            'string',
            new ValidationJurusan($request->Jurusan)
        ],

        'JudulPA' => 'required|string|min:10',
        'file_excel' => 'required|file|mimes:xlsx,xls|max:2048',
        'flexRadioDefault' => 'required|in:on',
    ]);


    $namaFile = null;

    if ($request->hasFile('file_excel')) {
        $file = $request->file('file_excel');


        $namaFile = uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());


        $file->move(public_path('fileexcel'), $namaFile);
    }


    try {
        $data = TabelPermintaan::create([
            'NIK_SAP' => $request->NIK_SAP,
            'Nama_Mentor' => $request->Nama_Mentor,
            'NO_WA_Mentor' => $request->NO_WA_Mentor,
            'Batch' => $request->Batch,
            'tahunmagang' => $request->tahunmagang,
            'UnitKerja' => $request->UnitKerja,
            'Bagian' => $request->Bagian,
            'Jurusan' => $request->Jurusan,
            'JudulPA' => $request->JudulPA,
            'file_excel' => $namaFile,
            'status' => 'pending'
        ]);

        return redirect()
            ->back()
            ->with('success', "Permintaan magang berhasil dikirim!");

    } catch (\Exception $e) {


        if ($namaFile && file_exists(public_path('fileexcel/'.$namaFile))) {
            unlink(public_path('fileexcel/'.$namaFile));
        }

        return redirect()
            ->back()
            ->withErrors(['error' => "Gagal menyimpan data: " . $e->getMessage()])
            ->withInput();
    }
}


public function downloadExcel($filename)
{

$file = public_path('fileexcel/'. $filename);
if(file_exists($file)){
return response()->download($file);
}else {
         return redirect()->back()->with('error', 'File tidak ditemukan.');
}



}

// public function autocompleteJurusan(Request $request): JsonResponse
// //
// {
//     $search = $request->get('search');

//     $dataJurusan = Jurusan::where('Jurusan', 'LIKE', '%' . $search . '%')
//         ->select('id', 'Jurusan as label', 'Jurusan as value')
//         ->take(5)
//         ->get()

//     return response()->json($dataJurusan)
// }

public function autocompleteJurusan(Request $request): JsonResponse
//
{
    $search = $request->get('search');

    $dataJurusan = Jurusan::select("Jurusan as value", "id")
        ->where('Jurusan', 'LIKE', '%' . $request->get('search') . '%')
         ->take(3)
        ->get();

         if ($dataJurusan->isEmpty()) {
        return response()->json([
            [
                'label' => "Jurusan '$search' tidak ada",
                'value' => "",
                'id' => null
            ]
        ]);
    }
    return response()->json($dataJurusan);
}

public function autocompleteUnitkerja(Request $request): JsonResponse
{
      $inputunitkerja = $request->get('inputunitkerja');
    $unitkerja = Unitkerja::select("UnitKerja as value", "id")
        ->where('UnitKerja', 'LIKE', '%' . $request->get('inputunitkerja') . '%')
         ->take(3)
        ->get();


         if ($unitkerja->isEmpty()) {
        return response()->json([
            [
                'label' => "UnitKerja '$inputunitkerja' tidak ada",
                'value' => "",
                'id' => null
            ]
        ]);
    }
    return response()->json($unitkerja);
}


public function templateworkplan(){
$file = public_path('download/Template_Workplan.xlsx');

return response()->download($file);
}

public function cekdata($id)
{
    $data = TabelPermintaan::findOrFail($id);
    $excelData = [];
    $errorMessage = null;

    // Ambil nama file dari kolom file_excel (BUKAN CekData)
    $fileName = $data->file_excel;
    $filePath = public_path('fileexcel/' . $fileName);

    // Cek apakah file ada
    if ($fileName && file_exists($filePath)) {
        try {
            // Dengan Maatwebsite Excel
            $excel = Excel::toArray([], $filePath);

            if (!empty($excel)) {
                $excelData = $excel;
            } else {
                $errorMessage = "File Excel kosong atau tidak dapat dibaca.";
            }

        } catch (\Exception $e) {
            $errorMessage = "Error membaca file Excel: " . $e->getMessage();
        }

    } else {
        $errorMessage = "File Excel tidak ditemukan di folder fileexcel.";
    }

    return view('magang.cekdata', compact('data', 'excelData', 'errorMessage'));
}


public function updateStatus(Request $request, $id)
    {
        // 1. Validasi input
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        try {
            // 2. Cari data pengajuan berdasarkan ID
            $data = TabelPermintaan::findOrFail($id); // Ganti "Permintaan" jika nama model berbeda

            // 3. Ambil nilai status baru dari request
            $newStatus = $request->input('status');

            // 4. Update kolom status dan set kolom 'sudah_dicek' menjadi 1 (Sudah Dicek)
            $data->status = $newStatus;

            // Karena data ini sedang di-update oleh admin, diasumsikan sudah dicek.
            // Sesuai dengan logika di HTML: <span class="badge bg-success">Sudah Dicek</span>
            // Kolom `sudah_dicek` di-set ke 1
            $data->sudah_dicek = 1;

            // 5. Simpan perubahan ke database
            $data->save();

            // Opsional: Log aktivitas
            Log::info("Status pengajuan ID {$id} berhasil diperbarui menjadi: {$newStatus} oleh Admin.");

            // 6. Redirect kembali ke halaman index dengan pesan sukses
            return redirect()
                ->route('tabelpermintaan.IndexAdmin')
                ->with('success', 'Status pengajuan berhasil diperbarui menjadi ' . $newStatus . '!');

        } catch (\Exception $e) {
            // Tangani error jika data tidak ditemukan atau terjadi masalah lain
            Log::error("Gagal memperbarui status pengajuan ID {$id}: " . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Gagal memperbarui status pengajuan. Silakan coba lagi.');
        }
    }

    public function detailform($id)
{
    $data = TabelPermintaan::findOrFail($id);

    return view('magang.cekdata', compact('data'));
}
// public function setujuiPermintaanlama($id)
// {
//     try {
//         $permintaan = TabelPermintaan::findOrFail($id);

//         // 1. Ubah status menjadi 'disetujui'
//         $permintaan->update(['status' => 'disetujui']);

//         // 2. Arahkan ke halaman utama tabel admin (dashboard)
//         return redirect()->route('tabelpermintaan.IndexAdmin')
//                          ->with('success', 'Permintaan magang BERHASIL DISETUJUI.');

//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Gagal menyetujui permintaan.');
//     }
// }

// //

// // ...

// // Contoh di Controller, misal fungsi statuspermintaan()

// public function tolakPermintaanlama(Request $request, $id)
// {
//     // Validasi input alasan yang dikirim dari form (Wajib ada)
//     $request->validate(['alasan' => 'required|string|max:500']);

//     try {
//         $permintaan = TabelPermintaan::findOrFail(id: $id);

//         // 1. Ubah status menjadi 'ditolak' DAN simpan alasan penolakan
//         // Catatan: Kolom 'alasan_penolakan' harus ada di database dan di $fillable Model.
//         $permintaan->update([
//             'status' => 'ditolak',
//             'alasan_penolakan' => $request->alasan,
//         ]);

//         // 2. Arahkan ke halaman utama tabel admin (dashboard)
//         return redirect()->route('tabelpermintaan.IndexAdmin')
//                          ->with('success', 'Permintaan magang BERHASIL DITOLAK. Alasan telah disimpan.');

//     } catch (\Exception $e) {
//         // Jika gagal, kembali ke halaman sebelumnya dengan pesan error
//         return redirect()->back()->with('error', 'Gagal menolak permintaan: ' . $e->getMessage());
//     }
// }

// public function tolakPermintaan(Request $request, $id)
// {
//     $request->validate(['alasan' => 'required|string|max:500']);

//     try {
//         $permintaan = TabelPermintaan::findOrFail($id);

//         // Ubah status menjadi 'ditolak' DAN simpan alasan penolakan
//         $permintaan->update([
//             'status' => 'ditolak',
//             'alasan_penolakan' => $request->alasan,
//         ]);

//         // Ambil NIK_SAP untuk redirect ke halaman status user
//         $nikSap = $permintaan->NIK_SAP;

//         // Arahkan ke halaman status permintaan user
//         return redirect()->route('datapermintaan.statuspermintaan', [
//                             'nik_sap' => $nikSap
//                         ])
//                         ->with('success', 'Permintaan magang BERHASIL DITOLAK. Silakan cek status Anda.');

//     } catch (\Exception $e) {
//         // Jika gagal, arahkan kembali ke halaman sebelumnya (cekdata)
//         return redirect()->back()->with('error', 'Gagal menolak permintaan: ' . $e->getMessage());
//     }
// }
// ...

// public function tolakPermintaan(Request $request, $id)
// {
//     // 1. Validasi alasan wajib diisi
//     $request->validate(['alasan' => 'required|string|max:500']);

//     try {
//         // 2. Ambil data permintaan berdasarkan ID
//         $permintaan = TabelPermintaan::findOrFail($id);
//         $nikSap = $permintaan->NIK_SAP;

//         // 3. Ubah status menjadi 'ditolak' dan simpan alasan
//         $permintaan->update([
//             'status' => 'ditolak',
//             'alasan_penolakan' => $request->alasan,
//             'sudah_dicek' => 1 // Opsional: Set kolom sudah_dicek menjadi 1
//         ]);

//         // 4. Sinkronisasi status ke DataStatusPermintaan (Tabel User)
//         DataStatusPermintaan::where('nik_sap', $nikSap)
//                             ->update(['status' => 'ditolak']);

//         // 5. Arahkan ke halaman status permintaan user
//         return redirect()->route('datapermintaan.statuspermintaan', ['nik_sap' => $nikSap])
//                          ->with('success', 'Permintaan magang BERHASIL DITOLAK. Status dan alasan telah dikirim.');

//     } catch (\Exception $e) {
//         return redirect()->back()->with('error', 'Gagal menolak permintaan: ' . $e->getMessage());
//     }
public function LoginStatus()
    {
        return view('magang.logincekstatus');
    }

    /**
     * Memproses login status berdasarkan NIK SAP.
     */
//



 public function processStatusLogin(Request $request)
{
    $request->validate([
        'nik_sap' => 'required|min:1',
    ]);

    $nikSap = $request->input('nik_sap');

    // Cek apakah NIK SAP ada
    $permintaan = DataStatusPermintaan::where('nik_sap', $nikSap)->first();

    if ($permintaan) {
        // Simpan ke session
        $request->session()->put('nik_sap_status', $nikSap);

        // Redirect cukup bawa nik_sap saja
        return redirect()->route('datapermintaan.statuspermintaan', [
            'nik_sap' => $nikSap
        ]);
    }

    return back()->withErrors([
        'nik_sap' => 'NIK SAP tidak ditemukan!'
    ]);
}

   /**
     * Menampilkan Dashboard Status Permintaan Magang berdasarkan NIK SAP.
     */
    // 3. Mengganti parameter fungsi menjadi $NIK_SAP
    //  public function statusDashboard(Request $request)
    // {
    //     // Guard clause: Middleware CheckStatusLogin akan menangani redirect jika session hilang
    //     if (!$request->session()->has('nik_sap_status')) {
    //          return redirect()->route('status.login');
    //     }

    //     $nikSap = $request->session()->get('nik_sap_status')

    //     // Ambil SEMUA data permintaan magang berdasarkan NIK SAP yang ada di session
    //     $dataPermintaan = TabelPermintaan::where('NIK_SAP', $nikSap)->get();

    //     return view('magang.permintaanuser', compact('dataPermintaan', 'nikSap'))
    // }
// public function statuspermintaan($nik_sap)
// {
//     $datapermintaan = DataStatusPermintaan::where('nik_sap', $nik_sap)->get();

//     return view('magang.statuspermintaanuser', [
//         'datapermintaan' => $datapermintaan,
//         'nikSap' => $nik_sap
//     ])
// }
public function statuspermintaan(Request $request)
{
    $nik_sap = $request->nik_sap;

    $datapermintaan = DataStatusPermintaan::where('nik_sap', $nik_sap)->get();

    return view('magang.statuspermintaanuser', [
        'datapermintaan' => $datapermintaan,
        'nik_sap' => $nik_sap
    ]);
}


    // method storedatapermintaan untuk menyimpan data permintaan magang dari user
// public function storedatapermintaanlama(Request $request)
// {
//     // 1. Validasi diperkuat (misalnya, NIK SAP harus 7 digit)
//     $request->validate([
//         'nama_mahasiswa' => 'required|string|max:255',
//         'universitas'    => 'required|string|max:255',
//         'jurusan'        => 'required|string|max:255',
//         // Jika NIK SAP harus 7 digit:
//         'nik_sap'        => 'required|numeric|digits:7',
//         'nama_mentor'    => 'required|string|max:255',
//         'unit_kerja'     => 'required|string|max:255',
//     ]);

//     // 2. Simpan data
//     $datapermintaan = DataStatusPermintaan::create([
//         'nama_mahasiswa' => $request->nama_mahasiswa,
//         'universitas'    => $request->universitas,
//         'jurusan'        => $request->jurusan,
//         'nik_sap'        => $request->nik_sap,
//         'nama_mentor'    => $request->nama_mentor,
//         'unit_kerja'     => $request->unit_kerja,
//         'status'         => 'pending', // Default
//     ]);

//     // 3. Redirect ke halaman status menggunakan NIK SAP yang baru saja disimpan
//     return redirect()->route('datapermintaan.statuspermintaan', [
//         'nik_sap' => $datapermintaan->nik_sap // Lebih baik menggunakan data dari model yang sudah disimpan
//     ])
//     ->with('success', 'Data magang berhasil dikirim. Tunggu persetujuan admin.');
// }
// public function storedatapermintaanbenar(Request $request)
// {
//     // 1. Validasi input
//     $request->validate([
//         'nama_mahasiswa' => 'required|string|max:255',
//         'universitas'    => 'required|string|max:255',
//         'jurusan'        => 'required|string|max:255',
//         'nik_sap'        => 'required|numeric|digits:7',
//         'nama_mentor'    => 'required|string|max:255',
//         'unit_kerja'     => 'required|string|max:255',

//         // Status diubah agar sesuai dengan ENUM database: 'diterima' atau 'ditolak'
//         'status'         => 'required|in:diterima,ditolak',

//         'alasan_penolakan' => 'nullable|string|max:255',
//     ]);

//     // 2. Tentukan status dan alasan penolakan
//     $status = $request->status;
//     $alasan_penolakan = $request->alasan_penolakan;

//     // Perbaikan: Ganti 'disetujui' menjadi 'diterima'
//     // Pastikan alasan penolakan null jika statusnya DITERIMA
//     if ($status == 'diterima') {
//         $alasan_penolakan = null;
//     }

//     // 3. Simpan data
//     $datapermintaan = DataStatusPermintaan::create([
//         'nama_mahasiswa' => $request->nama_mahasiswa,
//         'universitas'    => $request->universitas,
//         'jurusan'        => $request->jurusan,
//         'nik_sap'        => $request->nik_sap,
//         'nama_mentor'    => $request->nama_mentor,
//         'unit_kerja'     => $request->unit_kerja,
//         'status'         => $status, // Nilai yang tersimpan: 'diterima' atau 'ditolak'
//         'alasan_penolakan' => $alasan_penolakan,
//     ]);

//     // 4. Tentukan pesan feedback
//     $message = 'Data magang berhasil dikirim. Status: ';
//     $type = 'success';

//     // Perbaikan: Ganti 'disetujui' menjadi 'diterima' untuk pengecekan
//     if ($status == 'diterima') {
//         // Pesan yang dilihat user tetap "Disetujui" agar lebih jelas
//         $message .= 'Disetujui.';
//         $type = 'success';
//     } elseif ($status == 'ditolak') {
//         $message .= 'Ditolak.';
//         $type = 'error';
//     }

//     // 5. Redirect ke halaman status berdasarkan nik sap
//     return redirect()->route('datapermintaan.statuspermintaan', [
//         'nik_sap' => $datapermintaan->nik_sap
//     ])->with($type, $message);
// }
public function storedatapermintaan(Request $request)
{
    // 1. Validasi input
    $request->validate([
      'nama_mahasiswa' => 'nullable|string|max:255', // <-- SUDAH BENAR
        'universitas'    => 'nullable|string|max:255',  // <-- SUDAH BENAR
        'jurusan'        => 'nullable|string|max:255',
        'nik_sap'        => 'required|numeric|digits:7',
        'nama_mentor'    => 'required|string|max:255',
        'unit_kerja'     => 'required|string|max:255',

        // Status diubah agar sesuai dengan ENUM database: 'diterima' atau 'ditolak'
        'status'         => 'required|in:diterima,ditolak',

        'alasan_penolakan' => 'nullable|string|max:255',
    ]);

    // 2. Tentukan status dan alasan penolakan
    $status = $request->status;
    $alasan_penolakan = $request->alasan_penolakan;

    // Pastikan alasan penolakan null jika statusnya DITERIMA
    if ($status == 'diterima') {
        $alasan_penolakan = null;
    }

    // 3. Simpan data
    $datapermintaan = DataStatusPermintaan::create([
        'nama_mahasiswa' => $request->nama_mahasiswa,
        'universitas'    => $request->universitas,
        'jurusan'        => $request->jurusan,
        'nik_sap'        => $request->nik_sap,
        'nama_mentor'    => $request->nama_mentor,
        'unit_kerja'     => $request->unit_kerja,
        'status'         => $status,
        'alasan_penolakan' => $alasan_penolakan,
    ]);

    // 4. Tentukan pesan feedback
    $message = 'Data magang berhasil dikirim. Status: ';
    $type = 'success'; // Default type

    if ($status == 'diterima') {
        $message .= 'Disetujui.';
        $type = 'success';
    } elseif ($status == 'ditolak') {
        $message .= 'Ditolak.';
        $type = 'error'; // Menggunakan 'error' atau 'warning' untuk notifikasi penolakan
    }

    // 5. Redirect ke halaman sebelumnya (kembali ke formulir)
    // --------------------------------------------------------
    return redirect()->back()->with($type, $message);
    // --------------------------------------------------------
}
// Fungsi setujuiPermintaan dan tolakPermintaan tidak perlu diubah.
public function setujuiPermintaan($id)
{
    $permintaan = DataStatusPermintaan::findOrFail($id);

    $permintaan->update([
        'status' => 'disetujui',
        'alasan_penolakan' => null,
    ]);

    // Redirect ke halaman status permintaan
    return redirect()->route('datapermintaan.statuspermintaan', [
        'nik_sap' => $permintaan->nik_sap
    ])->with('success', 'Permintaan magang telah disetujui.');
}

public function tolakPermintaan(Request $request, $id)
{
    $request->validate([
        'alasan_penolakan' => 'required|string|max:255',
    ]);

    $permintaan = DataStatusPermintaan::findOrFail($id);

    $permintaan->update([
        'status' => 'ditolak',
        'alasan_penolakan' => $request->alasan_penolakan,
    ]);

    // Redirect ke halaman status permintaan
    return redirect()->route('datapermintaan.statuspermintaan', [
        'nik_sap' => $permintaan->nik_sap
    ])->with('error', 'Permintaan magang ditolak dengan alasan.');
}

public function autocompleteNamamentor(Request $request): JsonResponse
{
    $input = $request->get('inputnamamentor'); // sesuai dengan JS

    $datamentor = Unitkerja::select(
        'Nama_Mentor as label',
        'Nama_Mentor as value',
        'id'
    )
    ->where('Nama_Mentor', 'LIKE', "%{$input}%")
    ->take(5)
    ->get();

    if ($datamentor->isEmpty()) {
        return response()->json([
            [
                'label' => "Nama mentor '$input' tidak ditemukan",
                'value' => "",
                'id' => null
            ]
        ]);
    }

    return response()->json($datamentor);
}


}

