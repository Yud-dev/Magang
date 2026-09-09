<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sudahdiambil; //memanggil models
use Illuminate\Pagination\Paginator; //untuk pagination
class SudahdiambilController extends Controller
{
    //
    public function search1(Request $request)
    {
        $search = $request->input('cari');
        $barang = Sudahdiambil::query()
        ->when($search, function ($query, $search) {
            $query->where('nama_barang', 'like', '%' . $search . '%')
            ->orWhere('PIC', 'like', '%' . $search . '%');

        })
        ->paginate(10);
        return view('Sudahdiambil', compact('barang'));
    }
}
