<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientJob extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['todos' => 'array'];

    protected $appends = ['scheduled_date'];

    public function address()
    {
        return $this->belongsTo(\App\Models\ClientAddress::class, 'client_address_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ClientJobImage::class, 'client_job_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }

    public function getScheduledDateAttribute()
    {
        return date('F d, Y', strtotime($this->scheduled));
    }
}
