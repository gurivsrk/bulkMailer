<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\bulkMailer;
use App\Models\category;

use App\Http\Requests\StorebulkMailerRequest;
use App\Http\Requests\UpdatebulkMailerRequest;
use App\Http\Requests\StoreCategoryRequest;

use App\Traits\SendMail;

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
           $msg = 'SuccessFully Updated';
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
        $this->Email($request->all());
        //return redirect()->back()->with('msg','Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function show(bulkMailer $bulkMailer)
    {
        //
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
    public function update(UpdatebulkMailerRequest $request, bulkMailer $bulkMailer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bulkMailer  $bulkMailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(bulkMailer $bulkMailer)
    {
        //
    }
}
