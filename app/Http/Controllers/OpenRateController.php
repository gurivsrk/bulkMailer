<?php

namespace App\Http\Controllers;

use App\Models\newsletter;
use App\Models\bulkMailer;

use Illuminate\Http\Request;
class OpenRateController extends Controller
{

    public function unsubscribe(Request $request, $email=null)
    {
        $this->middleware('web');
        if($request->isMethod('post')){
            $e = html_entity_decode(base64_decode($request->post('email')));
            $result = bulkMailer::where('email',$e)->count();
            if($result == 1){
                bulkMailer::where('email',$e)->update(['type'=>'unsubscribed']);
                return 'success';
            }
            else{
                return 'no_result';
            }

        }

        return view('unsubscribe',compact(['email']));
    }

    public function showImage($id){
        newsletter::where('id',$id)->update(['open' => 2]);

        return asset('imgs/vsrk circle.png');
    }
}
