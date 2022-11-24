<?php

namespace App\Http\Controllers;

use App\Models\newsletter;

use Illuminate\Http\Request;

class OpenRateController extends Controller
{
    public function showImage($id){
        newsletter::where('id',$id)->update(['open' => 2]);

        return asset('imgs/vsrk circle.png');
    }
}
