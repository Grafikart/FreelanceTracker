<?php

namespace App\Domains\Settings;

use Illuminate\Database\Schema\Blueprint;

class SettingFields
{

    /**
     * Add settings fields for the "users" table
     */
    public static function forUser(Blueprint $table)
    {
        // Company infos
        $table->string('company_name')->nullable();
        $table->string('company_address')->nullable();

        // Worker settings
        $table->integer('hourly_rate')->unsigned()->default(0);
        $table->integer('hours_per_week')->unsigned()->default(35);
        $table->integer('tax')->unsigned()->default(0);

        // Site settings
        $table->string('timezone')->default('UTC');
        $table->string('currency')->default('EUR');
        $table->string('locale')->default('en');
        $table->string('date_format')->default('d/m/Y');
        $table->string('theme')->default('system');
    }
}
