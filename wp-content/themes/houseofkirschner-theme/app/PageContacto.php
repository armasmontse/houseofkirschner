<?php 

namespace App;

use Illuminate\Page;
use App\Metaboxes\Cltvo_SocialNet;

class PageContacto extends Page
{
    public $social_net;

    function __construct()
    {
        parent::__construct( specialPage('contacto', true) );
    }

    public function setMetas()
    {
        $this->social_net = $this->getSocialNets();
    }

    protected function getSocialNets()
    {
        return Cltvo_SocialNet::getMetaValue($this->post);
    }
}
