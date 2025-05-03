<?php

namespace App\Domains\Estimates;

use DateTimeInterface;

/**
 * Add settings linked methods
 *
 * @property string $date_format
 */
trait HasSettings
{

    public function formatDate(DateTimeInterface $date): string
    {
        return $date->format($this->date_format);
    }

    public function formatDateTime(DateTimeInterface $date): string
    {
        return $date->format($this->date_format . ' ' . 'H:i');
    }

}
