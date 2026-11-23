<?php

namespace App\Models;

use App\Enums\EventTypeEnum;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(EventObserver::class)]
class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'date',
        'organizer_id',
    ];

    /*protected $casts = [
        'type' => EventTypeEnum::class,
    ];*/

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }
}
