<?php

namespace App\Models\Datastar;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $connection = 'wave';
    
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
