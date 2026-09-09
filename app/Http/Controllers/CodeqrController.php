<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class CodeqrController extends Controller
{
    //
    public function index(){
        return view('Scanner.Qrcode');
    }

    // public function QR(Request $request)
    // {
    //     $this->validate($request, [
    //         'link' => 'required|url',
    //     ]);
    //     $code = time();

    //     $qr = QrCode::format('png')->generate($request->link);
    //     $qrImageName = $code . '.png';

    //     Storage::put('public/qr/' . $qrImageName, $qr);

    //     return view()
    // }
    
}
