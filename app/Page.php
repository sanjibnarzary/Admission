<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = ["title","body","admin_user_id"];

    public function admin(){
        return $this->belongsTo('App\AdminUser','admin_user_id');
    }
}
