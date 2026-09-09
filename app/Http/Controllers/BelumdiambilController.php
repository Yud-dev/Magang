<?php

namespace App\Http\Controllers;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Belumdiambil;

use Illuminate\Pagination\Paginator;
use Illuminate\View\View;

class BelumdiambilController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('cari');

        $barang = Belumdiambil::query()
             ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('nama_barang', 'like', '%' . $searchTerm . '%')
                      ->orWhere('tanggal_ditemukan', 'like', '%' . $searchTerm . '%');

            })
             ->latest()
            ->paginate(10); //  batas paginasi yang Anda inginkan

        return view('Belumdiambil', compact('barang')); //
    }


public function create (){
    return view('crud.create'); //mengarahkan ke view crud/create
}


public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|min:2',
        'nama_penemu_barang' => 'required|min:2',
        'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        'deskripsi' => 'required|min:2',
        'tanggal_ditemukan' => 'required|date',
    ]);

    $foto = $request->file('foto');
        $foto->storeAs('Belumdiambil', $foto->hashName(), 'public');

    Belumdiambil::create([
        'nama_barang'       => $request->nama_barang,
        'foto'              => $foto->hashName(),
        'nama_penemu_barang'=> $request->nama_penemu_barang,
        'deskripsi'         => $request->deskripsi,
        'tanggal_ditemukan' => $request->tanggal_ditemukan,
    ]);

    return redirect()->route('belumdiambil.index')
        ->with(['success' => 'Data Berhasil Ditambahkan']);
}


//    public function store(Request $request): RedirectResponse
// {
//     $request->validate([
//         'nama_barang' => 'required|min:2',
//         'nama_penemu_barang' => 'required|min:2',
//         'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
//         'deskripsi' => 'required|min:2',
//         'tanggal_ditemukan' => 'required|date',
//     ]);

//     $foto = $request->file('foto');
//      $foto->storeAs('public/Belumdiambil', $foto->hashName())

//     Belumdiambil::create([
//         'nama_barang'       => $request->nama_barang,
//         'foto'            => $foto->hashName(),
//         'nama_penemu_barang' => $request->nama_penemu_barang,
//         'deskripsi'         => $request->deskripsi,
//         'tanggal_ditemukan' => $request->tanggal_ditemukan,
//     ])

//     return redirect()
//         ->route('belumdiambil.index')
//         ->with(['success' => 'Data Berhasil Ditambahkan'])
// }

public function index()
{
    $barang = Belumdiambil::paginate(10);
    return view('Belumdiambil', compact('barang')); // ganti dengan view sesuai nama file
    //return view mengarahkan ke view / halaman blade
}

public function edit(string $id){
    $barang = Belumdiambil::findOrFail($id);
    return view('crud.edit', compact('barang'));
}
public function update(Request $request, $id): RedirectResponse
{
    $request->validate([
        'nama_barang'       => 'required|min:2',
        'foto'              => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'deskripsi'         => 'required|min:2',
        'tanggal_ditemukan' => 'required|date',
    ]);

    $barang = Belumdiambil::findOrFail($id);

    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $nama_file = $foto->hashName();
        $foto->move(public_path('img'), $nama_file);

        $barang->update([
            'nama_barang'       => $request->nama_barang,
            'foto'              => 'img/' . $nama_file,
            'deskripsi'         => $request->deskripsi,
            'tanggal_ditemukan' => $request->tanggal_ditemukan,
        ]);
    } else {
        $barang->update([
            'nama_barang'       => $request->nama_barang,
            'deskripsi'         => $request->deskripsi,
            'tanggal_ditemukan' => $request->tanggal_ditemukan,
        ]);
    }

    return redirect()->route('belumdiambil.index')->with(['success' => 'Data Berhasil Diubah!']);
    //return redirect mengarahkan ke route
}

public function delete($id): RedirectResponse
{
    $barang = Belumdiambil::findOrFail($id);

    // Hapus file gambar dari public/img jika ada
    if ($barang->foto && file_exists(public_path($barang->foto))) {
        unlink(public_path($barang->foto));
    }

    $barang->delete();

    return redirect()->route('belumdiambil.index')
        ->with(['success' => 'Data Berhasil Dihapus!']);
}

}
