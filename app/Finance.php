<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Finance extends Model
{

    use SoftDeletes;

    protected $fillable     = ['masjid_id', 'income', 'expense', 'balance'];
    protected $hidden = [
        'id',
        'masjid_id',
        'created_at',
        // 'updated_at',
        'deleted_at',
    ];

    public function masjid()
    {
        return $this->belongsTo('App\Masjid');
    }
}
