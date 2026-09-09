<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
use App\Models\QRCODE;
use Illuminate\Http\RedirectResponse;

class IndexScannerController extends Controller
{
    public function generate()
    {
        return view('Scanner.ScannerCam'); // tidak perlu compact('barang') kalau tidak dipakai
    }

    public function index()
    {
        $barang = QRCODE::table('qrcode')
        ->orderBy('id', 'asc')
            ->orderBy('namabarang', 'desc')
            ->get();
        return view('Scanner.index', compact('barang'));
    }


//     public function form(Request $request){
// Post::create($request->all());
// Alert::success('Data disimpan');

//         return view('Scanner.Form')


//     }
}
