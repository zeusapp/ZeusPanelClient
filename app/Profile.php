<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profiles";
    public $primaryKey = "id";
    public $timestamps = true;

    public function user() {
        $this->belongsTo('App\User');
    }

    //TODO: FINISH PROFILES!!!!!

}
