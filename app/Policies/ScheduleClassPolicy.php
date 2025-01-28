<?php

namespace App\Policies;

use App\Models\ScheduledClass;
use App\Models\User;

class ScheduleClassPolicy
{
    /**
     * Determine if the given user can delete schedule
     */
    public function delete(User $user, ScheduledClass $scheduledClass): bool
    {
        return $user->id === $scheduledClass->instructor_id && $scheduledClass->date_time > now()->addHours(2);
    }
}
