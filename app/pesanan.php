<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $fillable = ['user_id', 'portfolio_id', 'author_id', 'pesan', 'bukti', 'status'];

    public function portfolio()
    {
        return $this->belongsTo('App\portfolio');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
