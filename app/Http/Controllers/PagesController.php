<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
	protected $data = [
    		[
    			'name' => 'Mustapha',
    			'lastname' => 'Chakir'
    		],
    		[
    			'name' => 'Hidran',
    			'lastname' => 'Arias'
    		],
    		[
    			'name' => 'Hidran',
    			'lastname' => 'Arias'
    		]
    	];
    public function about() 
    {
    	
        return view('about', 
        [

        'title' => 'Our team',
        'about' => $this->data,
    	]);
    }

    public function pagamento()
    {
        return view('payment');
    }
}
