<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingMail extends Model
{
    use HasFactory;

    protected $fillable = ['email','campaign_id'];

}
