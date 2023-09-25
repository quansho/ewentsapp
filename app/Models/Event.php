<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $title
 * @property $description
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function subscribers(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(User::class,'subscriptions','event_id','subscriber_id','id','id')
            ->withTimestamps();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id','id');
    }

}
