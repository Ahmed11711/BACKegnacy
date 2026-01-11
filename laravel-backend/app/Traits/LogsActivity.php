<?php

namespace App\Traits;

use App\Models\ActivityLog;

trait LogsActivity
{
    /**
     * Log activity
     */
    protected function logActivity(string $action, $model = null, ?array $oldValues = null, ?array $newValues = null, ?string $description = null): void
    {
        ActivityLog::log(
            $action,
            $model ? get_class($model) : null,
            $model?->id,
            auth()->id(),
            $oldValues,
            $newValues,
            $description
        );
    }
}
