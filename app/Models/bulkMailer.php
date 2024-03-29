<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\category;

use Illuminate\Database\Eloquent\Casts\Attribute;

class bulkMailer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'emails';


    protected $guarded = ['id'];

    public function getEmailAttribute($value){
        return strtolower($value);
    }

    public function scopeNotSend($query){
        return $query->where('status','!=','success');
    }
    public function scopeSubscribed($query){
       return $query->where('type','subscribed');
    }
}
