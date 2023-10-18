<?php

namespace App\Models\Traits\Scopes;

use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Builder;

trait ScopesTrait
{
    /**
     * Scope a query to only include active records.
     *
     * @param Builder    $query
     * @param bool|false $active
     * @return $this
     */
    public function scopeWhenActive(Builder $query, bool $active = false)
    {
        return $query->when($active, function ($query) {
            return $query->where('status', UserStatus::Active);
        });
    }
}
