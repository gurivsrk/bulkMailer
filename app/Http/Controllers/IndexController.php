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
        $allCampaign = newsletter::select('newsletter.id as id','newsletter.Subject as Subject','newsletter.from_name as from_name', 'newsletter.status','newsletter.created_at', 'newsletter_metas.categories_id', 'newsletter_metas.send_emails', 'newsletter_metas.total_emails')
                        ->leftJoin('newsletter_metas', 'newsletter_metas.campaign_id','newsletter.id')
                        ->orderBy('id','asc')->paginate(100);
        return view('previousCampaigns',compact('allCampaign'));
     }

     public function get_data(Request $request){
        $data = bulkMailer::select('email','status')
                -> whereIn('category_id',$request->input('id'))
                ->where('status','!=','-')
                ->get();
        return view('partials.showData',compact('data'));
     }

}
