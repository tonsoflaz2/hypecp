<?php

namespace App\Models\Structure;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $connection = 'structure';

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
}
