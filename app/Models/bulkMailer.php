<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\category;

class bulkMailer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'emails';

    protected $guarded = ['id'];

    // public function cateName(){
    //    return $this->belongsTo(category::class,'category_id','id');
    // }
}