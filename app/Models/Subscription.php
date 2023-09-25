<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $subscriber_id
 * @property $event_id
 * @method isSubscribed($query,$eventId)
 */
class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    public function scopeCurrentUser($query,$eventId)
    {
        return $query->where('subscriber_id', auth()->user()->id)->where('event_id',$eventId);
    }

    public function scopeIsSubscribed($query,$eventId)
    {
        return $this->scopeCurrentUser($query,$eventId)->exists();
    }


}
