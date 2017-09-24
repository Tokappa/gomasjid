<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{

    protected $appends  = ['hashed_id'];
    protected $hidden = [
        'id',
        'masjid_id',
        'gallery_id',
        'start',
        'end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }

    public function gallery()
    {
        return $this->belongsTo('App\Gallery');
    }
}
