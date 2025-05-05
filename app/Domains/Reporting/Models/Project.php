<?php

namespace App\Domains\Reporting\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProject
 */
class Project extends Model
{
    /**
     * Scopes
     */
    public function scopeActive(Builder $query)
    {
        return $query->whereNull('archived_at');
    }
}
