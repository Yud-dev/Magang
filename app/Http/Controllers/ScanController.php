<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ScanController extends Controller
{
    public function submit(Request $request)
    {
        $this->validate($request, [
            'string' => 'required|string',
        ]);

        $code = time();
        $qr = QrCode::format('png')->size(100)->generate($request->string);
        $qrImageName = $code . '.png';
        Storage::put('public/qr/' . $qrImageName, $qr);

        return view('Scanner.Scan', compact('qrImageName'));
    }
}
