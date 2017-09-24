<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Jumat extends Model
{

    use SoftDeletes;

    protected $fillable     = ['masjid_id', 'muadzin', 'khatib', 'imam'];
    protected $hidden       = ['created_at', 'updated_at'];
    protected $table        = 'jumat';

    public function masjid()
    {
        return $this->belongsTo('App\Masjid');
    }
}
