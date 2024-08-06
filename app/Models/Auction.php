<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{


    protected $fillable = [
        'item',
        'current_bid',
        'end_time',
    ];

    // Relationships
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // Methods
    public function isActive()
    {
        return $this->end_time ? $this->end_time > now() : true;
    }
}
