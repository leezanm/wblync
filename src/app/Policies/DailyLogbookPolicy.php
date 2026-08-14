<?php

namespace App\Policies;

use App\Models\DailyLogbook;
use App\Models\User;

class DailyLogbookPolicy
{
    public function view(
        User $user,
        DailyLogbook $logbook
            ): bool {
                if ($user->hasAnyRole([
                    'Super Admin',
                    'WBL Coordinator',
                    'Lecturer',
                    'Industry Mentor',
                ])) {
                    return true;
                }

                if ($user->hasRole('Student')) {
                    return $logbook->placement
                        ->student
                        ->user_id === $user->id;
                }

                return false;
            }



    public function create(User $user): bool
    {
        return $user->can('create daily logbooks');
    }


    public function update(
    User $user,
    DailyLogbook $logbook
        ): bool {
            if ($logbook->status === 'Approved') {
                return false;
            }

            if ($user->hasAnyRole([
                'Super Admin',
                'WBL Coordinator',
            ])) {
                return true;
            }

            if ($user->hasRole('Student')) {
                return $logbook->placement
                    ->student
                    ->user_id === $user->id;
            }

            return false;
        }


    public function delete(
    User $user,
    DailyLogbook $logbook
        ): bool {
            if ($logbook->status === 'Approved') {
                return false;
            }

            if ($user->hasAnyRole([
                'Super Admin',
                'WBL Coordinator',
            ])) {
                return true;
            }

            if ($user->hasRole('Student')) {
                return $logbook->placement
                    ->student
                    ->user_id === $user->id;
            }

            return false;
        }

    public function submit(
        User $user,
        DailyLogbook $logbook
    ): bool {
        return $user->can('submit daily logbooks')
            && $logbook->status === 'Draft';
    }


    public function approve(
        User $user,
        DailyLogbook $logbook
    ): bool {
        return $user->can('approve daily logbooks')
            && $logbook->status === 'Submitted';
    }


    public function reject(
        User $user,
        DailyLogbook $logbook
    ): bool {
        return $user->can('reject daily logbooks')
            && $logbook->status === 'Submitted';
    }
}
