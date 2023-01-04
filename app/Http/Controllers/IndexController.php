<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\bulkMailer;
use App\Models\newsletter;
use App\Models\newsletterMeta;
use App\Models\SendingMail;
use Illuminate\Support\Facades\Artisan;
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

     public function previous_campaigns_details(SendingMail $mails,newsletter $newsletter,$id){
          $newsletter::findOrFail($id);
         $details = $newsletter->select('newsletter.id as id','newsletter.Subject as Subject','newsletter.from_name as from_name', 'newsletter.status', 'newsletter.newsletter','newsletter.created_at', 'newsletter_metas.categories_id', 'newsletter_metas.send_emails', 'newsletter_metas.total_emails')
                     ->join('newsletter_metas', 'newsletter_metas.campaign_id','newsletter.id')
                     ->where('newsletter.id', $id)
                     ->first();
         $emails = $mails->where('campaign_id',$id)->get();
         return view('campaignDetail',compact('details','emails'));
     }

     public function get_data(Request $request){
         if($request->input('id') == 'all'){
            $data = bulkMailer::select('email','status')->where('status','!=','-')->get();
         }else{
             $data = bulkMailer::select('email','status')
             -> whereIn('category_id',json_decode($request->input('id')))
             ->where('status','!=','-')
             ->get();
         }
         $data;
        return view('partials.showData',compact('data'));
     }

     public function single_row(Request $request){
        $i = category::select('id')->where('title','LIKE','%'.$request->post('input').'%')->first();
        $id = $i ? $i->id : '';
         $emails = bulkMailer::where('email','LIKE','%'.$request->post('input').'%')->orWhere('type','LIKE','%'.$request->post('input').'%')->orWhere('category_id',$id)->get();

         return view('partials.mailList',compact(['emails']));
     }

     public function stop_campaign(newsletter $newsletter){
        Artisan::call('queue:clear');
        return 'success';
     }

}
