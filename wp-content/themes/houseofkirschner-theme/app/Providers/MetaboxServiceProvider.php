<?php 

namespace App\Providers;

class MetaboxServiceProvider
{
    protected $metaboxes = [
        \App\Metaboxes\Cltvo_SocialNet::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach($this->metaboxes as $metabox){
            $object = new $metabox;
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