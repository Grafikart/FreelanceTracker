<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperEstimate
 */
class Estimate extends Model
{

    use HasFactory;

    const STATUS_DRAFT = 0;

    const STATUS_APPROVED = 1;

    const STATUS_REJECTED = -1;

    const STATUS_SENT = 2;

    const STATUS_OPENED = 3;

    protected $fillable = [
        'label',
        'client_id',
        'created_at',
        'tax',
        'currency',
        'rows',
        'state',
    ];

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
            ->orderBy('estimate_id', 'desc')
            ->first();
        if ($lastEstimate) {
            $estimateId = $lastEstimate->estimate_id + 1;
        }
        return (new static())->forceFill([
            'user_id' => $user->id,
            'currency' => $user->currency,
            'created_at' => now(),
            'estimate_id' => $estimateId,
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
            return $this->rows->sum(fn(InvoiceRow $row) => $row->price * $row->quantity);
        }
    }

    public float $total_tax {
        get {
            return round(
                    $this->total_price * $this->tax
                / 100, 2);
        }
    }

    public int $total {
        get {
            return $this->total_price + $this->total_tax;
        }
    }
}
