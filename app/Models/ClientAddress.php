<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userCanView($user)
    {
        return $user->isAdmin() || $this->user_id === $user->id;
    }
}
