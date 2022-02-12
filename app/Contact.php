<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //ブラックリスト方式
    protected $guarded = ['id'];
}
