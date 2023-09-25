<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property $title
 * @property $description
 * @property $author_id
 */
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'subscriptions','event_id','subscriber_id','id','id')
            ->withTimestamps();
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id','id');
    }

}
