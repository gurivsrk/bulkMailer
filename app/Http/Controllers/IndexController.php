<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\bulkMailer;
use App\Models\newsletter;

class IndexController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth');
     }

     public function add_emails(){

        $categories = category::select('title','id')->orderBy('id','desc')->get();

        return view('addMailList', compact('categories'));
     }

     public function mail_list(category $category,bulkMailer $bulkMailer){

        $emails = bulkMailer::select('emails.email','emails.id','emails.type','emails.status','emails.category_id','category.title as catname')
                    ->join('category','category.id','emails.category_id')
                    ->orderBy('id','desc')->paginate(100);

        return view('mailList', compact('emails'));

     }

     public function previous_campaigns()
     {
        $allCampaign = newsletter::paginate(10);
        return view('previousCampaigns',compact('allCampaign'));
     }


}
