<?php

namespace App\Domains\Reporting\Models;

use App\Domains\Clients\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperProject
 */
class Project extends Model
{

    protected $fillable = [
        'name',
        'client_id',
        'budget',
        'rate',
        'currency',
    ];

    /**
     * Relations
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Scopes
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereNull('archived_at');
    }

    /**
     * Factories
     */
    public static function makeFromUser(User $user): self
    {
        $project = self::make([
            'user_id' => $user->id,
            'budget' => $user->budget,
            'rate' => $user->hourly_rate,
            'currency' => $user->currency
        ]);
        $project->user = $user;
        return $project;
    }
}
