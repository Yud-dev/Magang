<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Queue\Connectors\RedisConnector;
use Illuminate\Support\Facades\DB;
use Closure;

class ValidationKuota implements ValidationRule
{
    protected $unitKerja;
    protected $tahun;
    protected $batch;
    protected $tahunmagang;


   public function __construct($unitKerja, $tahunmagang, $batch, )
    {
        $this->unitKerja = $unitKerja;
        $this->tahun = now()->year;
        $this->batch = $batch;
        $this->tahunmagang = $tahunmagang;

    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $kuota = DB::table('kuota_magangs')
            ->where('UnitKerja', $this->unitKerja)
            ->where('tahun', $this->tahun)
            ->where('batch', $this->batch)
            ->value('kuota');


         if ($kuota === null) {

             $fail("Kuota untuk {$this->unitKerja}  {$this->tahun}  {$this->batch} belum ditetapkan oleh admin. Silakan hubungi admin Diklat di ext. 2423 / 2424. ");
            return;
        }


        $totalTerpakai = DB::table('tabel_permintaans')
            ->where('UnitKerja', $this->unitKerja)
            ->where('Batch', $this->batch)
->where('tahunmagang', $this->tahunmagang)

            ->count();


        if ($totalTerpakai >= $kuota) {
         

$fail("Kuota magang untuk {$this->unitKerja}  {$this->tahunmagang}  {$this->batch} sudah penuh (maksimal {$kuota}). Silakan hubungi admin Diklat di ext. 2423 / 2424.");
        }

//    $jurusan = DB::table('jurusans')
//     ->where('ID_Jurusan', $this->id_jurusan)
//     ->where('Jurusan', $this->jurusan)
//     ->exists();

// if ( $jurusan == null) {
//     $fail("Data jurusan {$this->jurusan} belum tersedia. Silakan hubungi admin Diklat di ext. 2423 / 2424.");
// }


    }
}
