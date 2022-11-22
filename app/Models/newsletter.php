<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class newsletter extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'newsletter';

    protected $guarded = ['id'];

    public function getCompleteTime($id){
        $updateTime = self::select('updated_at')->where('id',$id)->where('status', 'completed')->first();
        return $updateTime != null ?$updateTime->updated_at :" ";
    }

}
