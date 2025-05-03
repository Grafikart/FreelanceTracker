<?php

namespace App\Domains\Estimates;

use App\Domains\Clients\Client;
use App\Domains\Estimates\Factories\EstimateFactory;
use App\Domains\Invoicing\InvoiceRow;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * @property Collection<InvoiceRow> $rows
 * @mixin IdeHelperEstimate
 */
class Estimate extends Model
{
    use HasFactory;

    const int STATUS_DRAFT = 0;

    const int STATUS_APPROVED = 1;

    const int STATUS_REJECTED = -1;

    const int STATUS_SENT = 2;

    const int STATUS_OPENED = 3;

    protected $fillable = [
        'label',
        'client_id',
        'created_at',
        'tax',
        'currency',
        'rows',
        'state',
    ];

    protected static function newFactory(): Factory
    {
        return EstimateFactory::new();
    }

    protected function casts()
    {
        return [
            'action_at' => 'immutable_datetime',
            'sent_at' => 'immutable_datetime',
            'rows' => AsCollection::of(InvoiceRow::class),
        ];
    }

    /**
     * RELATIONS
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * SERIALIZERS
     */
    public function asAlpineData(): string
    {
        return json_encode([
            'rows' => $this->rows ?? [],
            'tax' => $this->tax ?? 0,
            'currency' => $this->currency ?? 'EUR',
        ]);
    }

    /**
     * FACTORIES
     */
    public static function makeFromUser(User $user): self
    {
        $estimateId = 1;
        $lastEstimate = self::where('user_id', $user->id)
            ->orderBy('accounting_id', 'desc')
            ->first();
        if ($lastEstimate) {
            $estimateId = $lastEstimate->accounting_id + 1;
        }

        return (new self)->forceFill([
            'user_id' => $user->id,
            'currency' => $user->currency,
            'created_at' => now(),
            'accounting_id' => $estimateId,
            'tax' => $user->tax,
            'rows' => collect([]),
        ]);
    }

    /**
     * SCOPES
     */
    public function scopeOpen(Builder $builder)
    {
        return $builder->whereIn('state', [
            self::STATUS_DRAFT,
            self::STATUS_SENT,
        ]);
    }

    /**
     * GETTERS
     */
    public int $total_price {
        get {
            return $this->rows->sum(fn (InvoiceRow $row) => $row->price * $row->quantity);
        }
    }

    public int $total_tax {
        get {
            return (int) round($this->total_price * $this->tax / 100);
        }
    }

    public int $total {
        get {
            return $this->total_price + $this->total_tax;
        }
    }
}
