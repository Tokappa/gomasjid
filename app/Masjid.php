<?php

namespace App;


use Jenssegers\Optimus\Optimus;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Masjid extends Model
{

    use SoftDeletes;

    // protected $table = 'masjid';
    protected $fillable = ['user_id', 'address'];
    protected $appends  = ['hashed_id'];
    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        // 'updated_at',
        'deleted_at',
    ];

    public function getHashedIdAttribute()
    {
        return app(Optimus::class)->encode($this->id);
    }


    // Define relationship with user model
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }


    public function albums()
    {
        return $this->hasMany('App\Album');
    }


    // Define relationship with Schedule model
    public function gallery_schedules()
    {
        return $this->hasMany('App\GallerySchedule');
    }


    public function album_schedules()
    {
        return $this->hasMany('App\AlbumSchedule');
    }


    public function active_galleries($start, $end, $single_day = false)
    {
        // $current_time = \Carbon\Carbon::now();
        // echo $current_time->toDateTimeString();
        // return $this->events()->where('start', '<=', $current_time->toDateTimeString())->where('end', '>=', $current_time->toDateTimeString());
        // return $this->events()->where('start', '<=', $start)->where('end', '>=', $end);
        $params = array($start, $end);
        if ($single_day)
        {
            return $this->gallery_schedules()->where('start', '<=', $start)->where('end', '>=', $end);
        }
        else
        {
            return $this->gallery_schedules()->where(function($query) use ($params)
			{
				$query->whereBetween('start', $params)->orWhere(function($query2) use ($params)
				{
					$query2->whereBetween('end', $params);
				});
            });
        }
    }


    public function active_albums($start, $end, $single_day = false)
    {

        $params = array($start, $end);
        if ($single_day)
        {
            return $this->album_schedules()->where('start', '<=', $start)->where('end', '>=', $end);
        }
        else
        {
            return $this->album_schedules()->where(function($query) use ($params)
			{
				$query->whereBetween('start', $params)->orWhere(function($query2) use ($params)
				{
					$query2->whereBetween('end', $params);
				});
            });
        }
    }


    // Define relationship with finance model
    public function finance()
    {
        return $this->hasOne('App\Finance');
    }


    // Define relationship with jumat model
    public function jumat()
    {
        return $this->hasOne('App\Jumat');
    }

    // Define relationship with news model
    public function news()
    {
        return $this->hasMany('App\News');
    }

    /*
    // Define relationship with statistic model
    public function statistics()
    {
        return $this->hasMany('App\News');
    }
    */



}
