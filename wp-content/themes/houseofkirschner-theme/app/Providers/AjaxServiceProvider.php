<?php 

namespace App\Providers;

class AjaxServiceProvider
{
    protected $files = [
        \App\Ajax\Cltvo_Contact_Form::class,
        \App\Ajax\LoadPosts::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach($this->files as $file){
            $file::registerAjax();
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