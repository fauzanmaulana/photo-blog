<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
{
    protected $fillable = ['judul', 'user_id', 'tema_id', 'gambar_depan', 'deskripsi'];

    public function tema()
    {
        return $this->belongsTo('App\tema');
    }

    public function user()
    {
        return $this->belongsTo('App\user');
    }

    public function pesanan()
    {
        return $this->hasMany('App\pesanan');
    }
}
