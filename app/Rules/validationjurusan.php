<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Closure;

class ValidationJurusan implements ValidationRule
{
    protected $jurusan;

    public function __construct($jurusan)
    {
        $this->jurusan = $jurusan;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = DB::table('jurusans')
            ->whereRaw('LOWER(Jurusan) = ?', [strtolower($this->jurusan)])
            ->exists();

        if (!$exists) {
            $fail("Data jurusan '{$this->jurusan}' belum tersedia.
Silakan hubungi admin Diklat di ext. 2423 / 2424.");
        }
    }
}
