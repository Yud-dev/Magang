<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Schema::hasTable('unitkerjas')) {
            View::composer(['crudwebmagang.kuotamagangcreate', 'magang.index','crudwebmagang.editkuotamagang'], function ($view) {
                $data_unitkerja = UnitKerja::latest()->get();
                $view->with('data_unitkerja', $data_unitkerja);
            });
        }
    }
}
