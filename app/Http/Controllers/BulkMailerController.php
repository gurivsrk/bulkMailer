<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Models\bulkMailer;
use App\Models\category;

use App\Http\Requests\StorebulkMailerRequest;
use App\Http\Requests\UpdatebulkMailerRequest;
use App\Http\Requests\StoreCategoryRequest;

use App\Traits\SendMail;
use App\Mail\Newsletter;

use Exception;
class BulkMailerController extends Controller
{

    use SendMail;

    private $emails,$id, $notice = false ,$error=[],$sameEmails=[];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(category $category)
    {

        $categories = $category->select('title','id')->orderBy('id','desc')->get();
        return view('newsletter',compact(['categories']));
    }

    public function singleEmail(Request $request, bulkMailer $bulkMailer, $id=null){
        if($request->isMethod('post')){
            try{
                foreach($request->post('category_name') as $email){
                    mail::mailer('singleMailer')->to($email)->send(new Newsletter($request->post('from_name'), $request->post('title'), $request->post('newsletter'), $request->post('category_name')[0]));
                }
                $msg = 'Successfully Send Emails';
                echo $msg;
            }
            catch(Exception $err){
                print_r($err);
            }

            return redirect()->back()->with('success',$msg);
        }
        $isSingle = true;
        $categories = $bulkMailer->where('id',$id)->limit(1)->get();
        return view('newsletter',compact(['categories','isSingle']));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreCategoryRequest $catRequest)
    {
        $catValue = $catRequest->post('category_name');

        if(!is_numeric($catValue)){
           $cate=  category::create(['title' => $catValue]);
           $catValue = $cate->id;
        }
        $this->id =  $catValue;
        $this->emails = (explode('\r\n',json_encode($catRequest->post('emails'))));

        DB::transaction(function (){

            foreach($this->emails as $email){

                $email = str_replace('"','',$email);

                if (filter_var($email, FILTER_VALIDATE_EMAIL)){

                    $count = bulkMailer::where('email',$email)->count();

                    if($count < 1){
                        $email = bulkMailer::create([
                            'email' =>  $email,
                            'category_id' => $this->id
                        ]);
                    }
                    else{
                        array_push($this->sameEmails, $email);
                    }

                }
                else{
                    array_push($this->error, $email.' !! Is not a valid email');
                }
            }
         });

         if(count($this->sameEmails) == count($this->emails)){

            array_push($this->error,'No Updations! Duplicate Emails');

         }elseif(count($this->sameEmails) <= count($this->emails) && count($this->sameEmails) != 0){

            $this->notice = 'updated! but some emails are Duplicate';

         }

         if(count($this->error) == 0 && $this->notice == false){
           $type = 'success';
           $msg = 'Successfully Updated';
         }
         elseif($this->notice != false){
            $type = 'noitce';
            $msg = json_encode($this->notice);
         }
         else{
            $type = 'fail';
            $msg = json_encode($this->error);
         }
         return redirect()->back()->with($type,$msg);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorebulkMailerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorebulkMailerRequest $request)
    {
        if(count($request->post('category_name')) <= 1){
            $id =  $request->post('category_name')[0];
            if(bulkMailer::where('category_id',$id)->count() <1 ) return redirect()->back()->with('fail','No Email is assign to this category') ;
        }
        $this->Email($request->all());
        return redirect()->back()->with('success','Successfully Send Emails');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function showDeleted(bulkMailer $bulkMailer)
    {
        $emails = $bulkMailer->onlyTrashed()->get();
        $trash = true;
        return view('mailList', compact('emails','trash'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function edit(bulkMailer $bulkMailer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatebulkMailerRequest  $request
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function update(bulkMailer $bulkMailer, Request $request)
    {
        if($request->post('type') == 'type'){
            $bulkMailer->where('id',$request->post('id'))->update(['type' => $request->post('input')]);
        }elseif($request->post('type') == 'email'){
            $bulkMailer->where('id',$request->post('id'))->update(['email' => $request->post('input')]);
        }
       return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(bulkMailer $bulkMailer,$id)
    {
        $bulkMailer->destroy($id);
        return redirect()->back()->with('success','Deleted Successfully');
    }

    public function restore(bulkMailer $bulkMailer,$id)
    {
        $bulkMailer->where('id',$id)->restore();
        return redirect()->back()->with('success','Restore Successfully');
    }
}
