<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cetegory;
use App\Models\User;


class blog extends Model
{
    use HasFactory;
    protected $guarded=[''];

    public function onecategory(){
        return $this->hasOne(Cetegory::class,'id','category_id');
    }
    public function oneuser(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
