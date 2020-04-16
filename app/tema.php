<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tema extends Model
{
    protected $fillable = ['nama_tema', 'harga_tema'];

    public function portfolio(){
        return $this->hasMany('App\portfolio');
    }
}
