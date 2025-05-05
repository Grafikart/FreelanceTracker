<?php

namespace App\Domains\Reporting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperTask
 */
class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
