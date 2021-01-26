<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientJobImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image'];

    public function client_job()
    {
        return $this->belongsTo(\App\Models\ClientJob::class);
    }

    public function getImageAttribute()
    {
        return url(Storage::url($this->path));
    }

    public function userCanDelete($user)
    {
        return $this->client_job->user_id === $user->id || $user->isAdmin();
    }
}
