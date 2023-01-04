<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SendingMail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function Smtp(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value!= 'fail' ? json_encode(unserialize($value)): 'fail'
        );
    }


}
