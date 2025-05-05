<?php

namespace App\Models;

use App\Domains\Clients\Client;
use App\Domains\Estimates\Estimate;
use App\Domains\Estimates\HasSettings;
use App\Domains\Reporting\Models\Project;
use App\Domains\Reporting\Models\Task;
use App\Domains\Settings\Theme;
use App\Infrastructure\I18n\MoneyFormat;
use App\Infrastructure\I18n\NumberFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasSettings, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_name',
        'company_address',
        'timezone',
        'date_format',
        'currency',
        'locale',
        'theme',
        'hourly_rate',
        'hours_per_week',
        'currency_format',
        'number_format',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'currency_format' => MoneyFormat::class,
            'number_format' => NumberFormat::class,
            'theme' => Theme::class,
        ];
    }

    /**
     * Relations
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }

    public function estimates(): HasMany
    {
        return $this->hasMany(Estimate::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public string $avatar {
        get {
            return sprintf('https://gravatar.com/avatar/%s', hash('sha256', strtolower(trim($this->email))));
        }
    }
}
