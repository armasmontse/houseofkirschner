<?php 

namespace App\Providers;

class FiltersServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Elimina la barra de herramientas del sitio en el front
        add_filter('show_admin_bar', [$this, 'showAdminBar']);
    }

    public function showAdminBar()
    {
        return false;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}