<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gallery extends Model
{

    use SoftDeletes;

    protected $fillable = ['masjid_id', 'image_url', 'title'];
    protected $hidden = [
        'id',
        'masjid_id',
        'created_at',
        // 'updated_at',
        'deleted_at',
    ];

    protected $appends  = ['hashed_id'];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }


    public function masjid()
    {
        return $this->belongsTo('App\Masjid');
    }


    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}
