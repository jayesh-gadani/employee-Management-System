
<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ajaxController extends BaseController
{
    
    public function ajaxLoad()
    {
    	echo "hi";
    	//return view("loadAjax");
    	return Response::json(array(view('loadAjax')));
    }
}
