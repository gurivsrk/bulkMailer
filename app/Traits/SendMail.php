<?php

namespace App\Traits;

use App\Jobs\SendNewsletter;
use Illuminate\Http\Request;
use App\Models\category;
trait SendMail {

    protected function Email($request)
    {
        $job = SendNewsletter::dispatch($request);
        // echo "Mail send successfully !!";
    }

    protected $success = true;
    protected $errorFile = [];
    protected $isExist = false;

    public function uploadFormBulk(Request $request=Null){
        $cateName = category::find($request->post('category_name'));
        foreach($request->file('files') as $file){
            if($file->getClientOriginalExtension() == 'pdf'){

                $img_name = $file->getClientOriginalName();
                $file->storePubliclyAs( date('Y').'/'.date('M'), $img_name,'public');
            }
            else{
                $this->errorFile[] = $file->getClientOriginalName() . ' is not PDF';
                $this->success = false;
                continue;
            }

        }
        return ['errors' => $this->errorFile, 'success' => $this->success, 'isExist' => $this->isExist];

    }

}
