<?php

namespace App\Domains\Clients;

use App\Domains\Clients\Factories\ClientFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperClient
 */
class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'user_id',
    ];

    protected static function newFactory(): Factory
    {
        return ClientFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the list of clients as select options
     */
    public static function clientsOptions(User $user): Collection
    {
        return $user->clients->map(fn ($client) => [
            'value' => $client->id,
            'label' => $client->name,
        ]);
    }
}
