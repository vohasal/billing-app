<?php

namespace App\Models;

use App\Enums\CategoryType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Нужно для enum
    protected function casts(): array
    {
        return [
            'type' => CategoryType::class
        ];
    }

    // Нужно для подтягивание всех записей, как общих так и созданным юзером
    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId)
            ->orWhereNull('user_id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
