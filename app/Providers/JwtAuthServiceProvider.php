<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JwtAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // aca estoy cargando mi helper dentro del servicio para seguirlo utilizando
        // la funciíon app_path() nos da la ruta hasta la carpeta app
        require_once app_path() .'\Helpers\JwtAuth.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
