<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'customer_id',
        'subject',
        'body',
        'status',
        'manager_response_at',
    ];

    protected $casts = [
        'manager_response_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function scopeForDay(Builder $query, Carbon $date): Builder
    {
        return $query->whereDate('created_at', $date);
    }

    public function scopeForWeek(Builder $query, Carbon $date): Builder
    {
        return $query->whereBetween('created_at', [
            $date->startOfWeek(),
            $date->endOfWeek(),
        ]);
    }

    public function scopeForMonth(Builder $query, Carbon $date): Builder
    {
        return $query->whereMonth('created_at', $date->month)
            ->whereYear('created_at', $date->year);
    }
}