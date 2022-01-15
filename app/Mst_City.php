<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mst_City extends Model
{
    //ブラックリスト方式
    protected $guarded = ['city_cd'];
}
