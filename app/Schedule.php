<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{

    protected $appends  = ['hashed_id'];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
