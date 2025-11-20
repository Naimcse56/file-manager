<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait ActivityLogTrait
{
    /**
     * Log an activity
     *
     * @param string $action       // Action name e.g., 'upload', 'delete'
     * @param mixed $target        // Model instance
     * @param string|null $description // Optional description
     */
    public function logActivity(string $action, $target = null, string $description = null)
    {
        ActivityLog::create([
            'user_id'     => Auth::id() ?? null,
            'action'      => $action,
            'target_type' => $target ? get_class($target) : null,
            'target_id'   => $target ? $target->id : null,
            'description' => $description ?? ($target ? $action.' performed on '.class_basename($target).' #'.$target->id : $action),
        ]);
    }
}
