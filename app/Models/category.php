<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\bulkMailer;

class category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category';

    protected $fillable = ['title'];

    public function getEmailsCount($id){
       return bulkMailer::where('category_id',$id)->where('type','subscribed')->count();
    }
}
