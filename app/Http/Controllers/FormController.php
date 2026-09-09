<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use App\Models\Belumdiambil;
use App\Models\FormPengambilan;
use Illuminate\Support\Facades\File;
class FormController extends Controller
{
    public function index()
    {
        $riwayat = Riwayat::latest()->paginate(6);
        return view('Riwayat', compact('riwayat'));
    }

   public function input(Request $request, $id)
{
    $barang = Belumdiambil::findOrFail($id);


    $foto = $barang->foto;
     $nama_barang = $barang->nama_barang;


    $riwayat = Riwayat::where('id', $id)->first();

    return view('Form', compact('foto', 'nama_barang', 'barang','riwayat' ));
}




  public function store(Request $request, $id)
{

    $request->validate([
        'nama_pengambil' => 'required|string|min:1',
        'no_whatsapp'    => 'required|string|min:1',
        'tanggal'        => 'required|date',
        'jam'            => 'required|date_format:H:i',
    ]);

    $barang = Belumdiambil::findOrFail($id);

    Riwayat::create([
        'nama_pengambil' => $request->nama_pengambil,
        'no_whatsapp'    => $request->no_whatsapp,
        'nama_barang'    => $barang->nama_barang,
        'tanggal'        => $request->tanggal,
        'jam'            => $request->jam,
        'foto'           => $barang->foto,
    ]);



    return redirect()->route('riwayat.index')->with('success', 'Data berhasil disimpan!');
}

}
