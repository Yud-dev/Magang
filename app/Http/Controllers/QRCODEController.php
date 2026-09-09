<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Client\Events\RequestSending;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\QRCODE;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QRGenerator;
use Illuminate\Support\Facades\Storage;



class QRCODEController extends Controller
{

public function index()
{

    return view('Scanner.CreateQrcode',);
}

public function Codeqr(Request $request)
{
    $request->validate([
        'Nama_rak' => 'required|string',
        'posisi_rak' => 'required|string',

    ]);
    // simpan data ke database
    QRCODE::create([
        'Nama_rak' => $request->input('Nama_rak'),
        'posisi_rak' => $request->input('posisi_rak'),

    ]);

    $text = $request->input('Nama_rak') . "|" . $request->input('posisi_rak');



    $qrcode = QRGenerator::format('png')->size(400)->generate($text);

       $filename = \Illuminate\Support\Str::slug($request->Nama_rak . '-' . $request->posisi_rak) . '.png';
    // $filePath = 'public/qrcodes/' . $filename
    Storage::disk('public')->put('qrcodes/' . $filename, $qrcode);
$filePath = 'qrcodes/' . $filename;


    return view('Scanner.CreateQrcode', compact('filename', 'text'))
        ->with('success', 'QR Code berhasil dibuat');
}


public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
        ]);

        $scannedData = $request->input('kode');

        // Uraikan string untuk mengekstrak 'namabarang' dan 'letak'
        // Contoh: "Nama Barang: Monitor, Letak: Ruang 101"
 $parts = explode('|', $scannedData);
    $Nama_rak = $parts[0] ?? '';
    $posisi_rak = $parts[1] ?? '';

        try {
            // Periksa apakah data sudah ada
            $existingQR = QRCODE::where('Nama_rak', $Nama_rak)
                               ->where('posisi_rak', $posisi_rak)
                               ->first();

            if ($existingQR) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data ini sudah ada.'
                ], 409);
            }



            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan.',
                'data' => $qrcode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500);
        }

    }
// public function DataTabel()
// {
//     $data = QRCODE::latest()->get();
//     return view('Scanner.index', compact('data'));
//



public function delete($id) {
   $barang  = QRCODE::findOrFail($id);
   $barang -> delete();
return redirect()->route('barang.Tabel')->with(['success' => 'Data Berhasil Dihapus!']);
}

// public function Tabel()
//     {
//  $barang = QRCODE::paginate(5);

//         return view('Scanner.index', compact('barang'))

//     }

public function download(String $filename)
{

   $filePath = 'qrcodes/' . $filename;

if (Storage::disk('public')->exists($filePath)) {
    return Storage::disk('public')->download($filePath, $filename);
} else {
    abort(404, 'File tidak ditemukan');
}





}

public function edit(string $id)
{
    $barang = QRCODE::findOrFail($id);
    return view('Scanner.Edittabel', compact('barang'));
}

// public function update($request,$id)
// {
//       $request->validate([
//             'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
//              'jenis'       => 'required|string|min:1',
//           'nama_rak'    => 'required|string|min:1',
//         'posisi_rak'  => 'required|string|min:1',
//         'tanggalscan' => 'required|date',
//          'outner'      => 'required|string|min:1',
//         'pic'         => 'required|string|min:1',
//         ]);
//          $barang = QRCODE::findOrFail($id);
//          if($request->$request->hasFile('image')){
//             Storage::delete('public/qrcodes/' . $barang->image);
//             $image = $request->file('image');
//             $image->storeAs('barang', $image->hashName());

//             $barang->update([
//                 'image' => $image->hashName(),
//                 'jenis' => $request->jenis,
//                   'nama_rak' => $request->nama_rak,
//                     'posisi_rak' => $request->posisi_rak,
//                       'tanggalscan' => $request->tanggalscan,
//                         'outner' => $request->outner,
//                           'pic' => $request->pic,
//             ]);
//          } else {
//             $barang->update([
// 'jenis' => $request->jenis,
//                   'nama_rak' => $request->nama_rak,
//                     'posisi_rak' => $request->posisi_rak,
//                       'tanggalscan' => $request->tanggalscan,
//                         'outner' => $request->outner,
//                           'pic' => $request->pic,
//             ]);
//          }
//          return redirect()->route('barang.Tabel')->with(['success' => 'Data Berhasil Diubah!']);
// }
}



