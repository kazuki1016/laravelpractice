<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MstShop extends Model
{
    //ブラックリスト方式
    protected $guarded = ['shop_cd'];
}
