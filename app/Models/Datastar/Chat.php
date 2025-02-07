<?php

namespace App\Models\Datastar;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Chat extends Model
{
    protected $connection = 'wave';
    
    use SoftDeletes;
    
    protected $casts = [
        'sent_at'    => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Mutator for "ago" timestamp
    public function getAgoAttribute()
    {
        $agoTime = $this->sent_at;

        if (!$agoTime) {
            $agoTime = $this->updated_at;
        }

        $diffInSeconds = (int) $agoTime->diffInSeconds(now());
        $diffInMinutes = (int) $agoTime->diffInMinutes(now());
        $diffInHours = (int) $agoTime->diffInHours(now());
        $diffInDays = (int) $agoTime->diffInDays(now());
        $diffInMonths = (int) $agoTime->diffInMonths(now());
        $diffInYears = (int) $agoTime->diffInYears(now());

        return match (true) {
            $diffInSeconds < 60 => "{$diffInSeconds}s ago",
            $diffInMinutes < 180 => "{$diffInMinutes}m ago",
            $diffInHours < 24 => "{$diffInHours}h ago",
            $diffInDays < 30 => "{$diffInDays}d ago",
            $diffInMonths < 12 => "{$diffInMonths}mo ago",
            default => "{$diffInYears}y ago",
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($chat) {
            $chat->updated_milliseconds = round(microtime(true) * 1000); // Current time in milliseconds
        });
    }
}

