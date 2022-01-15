<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstCity extends Model
{
    //ブラックリスト方式
    protected $guarded = ['city_cd'];
}
