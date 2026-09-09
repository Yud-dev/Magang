<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Closure;

class ValidationNamaMentor implements ValidationRule
{
    protected $unitKerja;
    protected $namaMentor;

    public function __construct($unitKerja, $namaMentor)
    {
        $this->unitKerja  = $unitKerja;
        $this->namaMentor = $namaMentor;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mentor = DB::table('unitkerjas')
            ->whereRaw('LOWER(UnitKerja) = ?', [strtolower($this->unitKerja)])
            ->whereRaw('LOWER(Nama_Mentor) = ?', [strtolower($this->namaMentor)])
            ->exists();

        if (!$mentor) {
            $fail("Nama mentor '{$this->namaMentor}' tidak terdaftar pada Unit Kerja '{$this->unitKerja}'.
Hubungi admin Diklat ext. 2423 / 2424.");
        }
    }
}

