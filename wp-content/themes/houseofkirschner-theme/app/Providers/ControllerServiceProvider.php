<?php 

namespace App\Providers;

class ControllerServiceProvider
{
    protected $controllers = [
        \App\Http\Controllers\MakeOrderController::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach($this->controllers as $controller){
            $controller = new $controller;
            $controller->registerController();
        }
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