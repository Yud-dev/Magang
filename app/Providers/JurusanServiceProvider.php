<?php

namespace App\Providers;
use App\Models\Jurusan;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;


class JurusanServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        if (Schema::hasTable('jurusans')) {
            View::composer(['magang.index'], function ($view) {
                $data_jurusan = Jurusan::latest()->get();
                $view->with('data_jurusan', $data_jurusan);
            });
        }
    }
}
