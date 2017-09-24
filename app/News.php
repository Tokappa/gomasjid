<?php

namespace App;


use Jenssegers\Optimus\Optimus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{

    use SoftDeletes;

    protected $fillable     = ['masjid_id', 'title', 'content'];
    protected $hidden       = ['id', 'created_at', 'updated_at'];
    protected $appends      = ['hashed_id'];


    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }


    public function masjid()
    {
        return $this->belongsTo('App\Masjid');
    }

}
