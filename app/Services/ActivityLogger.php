<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public function logActivity($userId, $action, $description)
    {
        ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description,
        ]);
    }
}
