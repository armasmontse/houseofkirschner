<?php 

namespace App\Http\Controllers;

use App\PageContacto;
use App\Mail\NewOrder;
use Illuminate\Mail\Mail;
use Illuminate\Controller;

class MakeOrderController extends Controller
{
    public function store($input)
    {
        $this->validate($input, [
            'type'          => 'required',
            'product'       => 'required',
            'name'          => 'required',
            'email'         => 'required',
            'whatsapp'      => 'required',
            'street1'       => 'required',
            'street2'       => 'required',
            'interior'      => 'required',
            'street3'       => 'required',
            'municipality'  => 'required',
            'receiver'      => 'required',
        ]);

        Mail::to($input['email'])->send(new NewOrder($input));

        $this->success( specialPagePermalink('gracias') );
    }
}