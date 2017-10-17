<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;


class AlbumSchedule extends Model
{

    protected $appends  = ['hashed_id'];
    protected $hidden = [
        'id',
        'masjid_id',
        'album_id',
        // 'start',
        // 'end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }

    public function album()
    {
        return $this->belongsTo('App\Album');
    }
}
