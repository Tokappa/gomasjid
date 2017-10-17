<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Album extends Model
{

    use SoftDeletes;

    protected $fillable = ['masjid_id', 'title'];
    protected $hidden = [
        'id',
        'masjid_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends  = ['hashed_id'];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }


    public function images()
    {
        return $this->hasMany('App\AlbumImage');
    }

    public function schedules()
    {
        return $this->hasMany('App\AlbumSchedule');
    }

}
