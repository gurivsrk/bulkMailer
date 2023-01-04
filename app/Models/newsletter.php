<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\category;

class newsletter extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'newsletter';

    protected $guarded = ['id'];

    public function getCompleteTime($id){
        $updateTime = $this->select('updated_at')->where('id',$id)->where('status','<>' ,'sending')->first();
        return $updateTime != null ? $updateTime->updated_at :" ";
    }

    public function getPercentage($val,$total){
        $per = $val != 0 ? (round(($val/$total)*100)) : 0;
        return $per.'%';
    }

    public function getCategoryName($ids){
        $titles = [];
        if($ids == 'all'){
            $titles = $ids;
        }
        else{
            $j = json_decode($ids);
            foreach($j as $id){
                $title = category::select('title')->where('id',$id)->first();
                $titles[] = $title ? $title->title: json_decode($ids);
            }
        }
        return json_encode($titles);
    }

}
