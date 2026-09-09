<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Http\Request;
use \App\Models\QRCODE;
use \App\Models\DatatabelQR;
use \App\Models\FormQR;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class TabelController extends Controller
{
    //

public function index(Request $request)
{
    $data = DatatabelQR::orderBy('id', 'asc')
                ->orderBy('Nama_Barang', 'desc')
              ->orderBy('Nama_rak', 'desc')
              ->orderBy('posisi_rak', 'desc')
              ->orderBy('outner', 'desc')
              ->orderBy('PIC', 'desc')
                  ->paginate(5);

    return view('Scanner.index', compact('data'));
}




public function search(Request $request)
{
    $keyword = $request->input('search');
    $data = DatatabelQR::when($keyword, function ($query, $keyword) {
        $query->where('Nama_Barang', 'like', '%' . $keyword . '%')
          ->orWhere('Nama_rak', 'like', '%' . $keyword . '%')
          ->orWhere('posisi_rak', 'like', '%' . $keyword . '%');


    //   ->get()
    })
    ->orderBy('id', 'desc')

            ->orderBy('Nama_Barang', 'desc')
              ->orderBy('Nama_rak', 'desc')
              ->orderBy('posisi_rak', 'desc')
              ->orderBy('outner', 'desc')
              ->orderBy('PIC', 'desc')
            ->paginate(5);





    return view('Scanner.index', compact('data', 'keyword'))
           ->with('i', ($request->input('page', 1) - 1) * 5);
}



public function edit(string $id){
    $barang = FormQR::findOrFail($id);

    return view('Scanner.Edittabel', compact('barang'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'foto'       => 'image|mimes:jpeg,jpg,png|max:2048',
        'Nama_Barang'        => 'required|string|min:1',
        'Jenis'       => 'required|string|min:1',
        'Nama_rak'    => 'required|string|min:1',
        'posisi_rak'  => 'required|string|min:1',
        'tanggalscan' => 'required|date',
        'outner'      => 'required|string|min:1',
        'PIC'         => 'required|string|min:1',
    ]);

    $barang = DatatabelQR::findOrFail($id);

    if ($request->hasFile('foto')) {
        // hapus file lama
        Storage::delete('public/data/' . $barang->image);

        // simpan file baru
        $foto = $request->file('foto');
        $foto->storeAs('public/data', $foto->hashName());

        $barang->update([
            'foto'       => $foto->hashName(),
            'Nama_Barang'       => $request->Nama_Barang,
            'Jenis'       => $request->Jenis,
            'Nama_rak'    => $request->Nama_rak,
            'posisi_rak'  => $request->posisi_rak,
            'tanggalscan' => $request->tanggalscan,
            'outner'      => $request->outner,
            'PIC'         => $request->PIC,
        ]);
    } else {
        $barang->update([
            'Jenis'       => $request->Jenis,
            'Nama_rak'    => $request->Nama_rak,
            'posisi_rak'  => $request->posisi_rak,
            'tanggalscan' => $request->tanggalscan,
            'outner'      => $request->outner,
            'PIC'         => $request->PIC,
        ]);
    }
return redirect()->route('data.index')->with('success', 'Data Berhasil Diubah');

}

public function hapus($id)
{
    $barang = DatatabelQR::findOrFail($id);
    $barang->delete();
   toast('Data Berhasil Di Hapus','success');
    return redirect()->route('data.search')
                     ->with(['success' => 'Data Berhasil Dihapus!']);
}
public function Form()
{

    return view('Scanner.Form',);
}
public function Upload(Request $request)
{
// FORM BARANG
    $request->validate([
        'Nama_Barang'        => 'required|string|min:1',
        'Jenis'       => 'required|string|min:1',
        'Nama_rak'    => 'required|string|min:1',
        'posisi_rak'  => 'required|string|min:1',
        'tanggalscan' => 'required|date',
        'outner'      => 'required|string|min:1',
        'PIC'         => 'required|string|min:1',
        'foto'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // upload image
    $foto = $request->file('foto');
    $filename = $foto->hashName();
    $foto->storeAs('data', $filename, 'public');


    DatatabelQR::create([
        'Nama_Barang'        => $request->Nama_Barang,
        'Jenis'       => $request->Jenis,
        'Nama_rak'    => $request->Nama_rak,
        'posisi_rak'  => $request->posisi_rak,
        'tanggalscan' => $request->tanggalscan,
        'outner'      => $request->outner,
        'PIC'         => $request->PIC,
        'foto'       => $foto->hashName(),
    ]);
 toast('Data Berhasil Di Tambahkan','success');
    return redirect()->route('data.search')
                     ->with(['success' => 'Data Berhasil Disimpan']);
}
public function Detail($id)
{
 $barang = DatatabelQR::findOrFail($id);
 return view('Scanner.Detailtabel', compact('barang'));
}
public function EditDetail(string $id)
{
    $barang = DatatabelQR::findOrFail($id);
    return view('Scanner.Edittabel', compact('barang'));
}

public function UpdateDetail(Request $request, $id)
{
    $request->validate([
        'Nama_Barang'  => 'required|string|min:1',
        'foto'       => 'image|mimes:jpeg,jpg,png|max:2048',
        'Jenis'       => 'required|string|min:1',
        'Nama_rak'    => 'required|string|min:1',
        'posisi_rak'  => 'required|string|min:1',
        'tanggalscan' => 'required|date',
        'outner'      => 'required|string|min:1',
        'PIC'         => 'required|string|min:1',
    ]);

    $barang = DatatabelQR::findOrFail($id);

    if ($request->hasFile('foto')) {

        Storage::disk('public')->delete('data/' . $barang->image);


        $foto = $request->file('foto');
        $foto->storeAs('data', $foto->hashName(), 'public');

        $barang->update([
            'Nama_Barang'  => $request->Nama_Barang,
            'foto'       => $foto->hashName(),
            'Jenis'       => $request->Jenis,
            'Nama_rak'    => $request->Nama_rak,
            'posisi_rak'  => $request->posisi_rak,
            'tanggalscan' => $request->tanggalscan,
            'outner'      => $request->outner,
            'PIC'         => $request->PIC,
        ]);
    } else {
        $barang->update([
            'Nama_Barang'  => $request->Nama_Barang,
            'Jenis'       => $request->Jenis,
            'Nama_rak'    => $request->Nama_rak,
            'posisi_rak'  => $request->posisi_rak,
            'tanggalscan' => $request->tanggalscan,
            'outner'      => $request->outner,
            'PIC'         => $request->PIC,
        ]);
    }
 toast('Data Berhasil Di Ubah','success');
    return redirect()->route('data.search')->with('success', 'Data Berhasil Diubah');
}

}
