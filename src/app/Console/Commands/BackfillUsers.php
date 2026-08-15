<?php

namespace App\Console\Commands;

use App\Models\IndustrySupervisor;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BackfillUsers extends Command
{
    protected $signature = 'users:backfill';

    protected $description = 'Create system users for existing students, lecturers and industry supervisors';

    public function handle(): int
    {
        $this->info('Starting user backfill...');

        DB::transaction(function () {

            $this->backfillStudents();

            $this->backfillLecturers();

            $this->backfillIndustrySupervisors();
        });

        $this->newLine();

        $this->info('User backfill completed successfully.');

        return self::SUCCESS;
    }

    private function backfillStudents(): void
    {
        $students = Student::query()
            ->whereNull('user_id')
            ->get();

        $this->info("Students found: {$students->count()}");

        foreach ($students as $student) {

            if (! $student->email) {
                $this->warn(
                    "Student {$student->id} skipped: no email."
                );

                continue;
            }

            $user = User::firstOrCreate(
                [
                    'email' => $student->email,
                ],
                [
                    'name' => $student->name,
                    'password' => Hash::make(Str::random(32)),
                ]
            );

            $student->update([
                'user_id' => $user->id,
            ]);

            if (! $user->hasRole('Student')) {
                $user->assignRole('Student');
            }

            $this->line(
                "Student {$student->name} → User #{$user->id}"
            );
        }
    }

    private function backfillLecturers(): void
    {
        $lecturers = Lecturer::query()
            ->whereNull('user_id')
            ->get();

        $this->info("Lecturers found: {$lecturers->count()}");

        foreach ($lecturers as $lecturer) {

            if (! $lecturer->email) {
                $this->warn(
                    "Lecturer {$lecturer->id} skipped: no email."
                );

                continue;
            }

            $user = User::firstOrCreate(
                [
                    'email' => $lecturer->email,
                ],
                [
                    'name' => $lecturer->name,
                    'password' => Hash::make(Str::random(32)),
                ]
            );

            $lecturer->update([
                'user_id' => $user->id,
            ]);

            if (! $user->hasRole('Lecturer')) {
                $user->assignRole('Lecturer');
            }

            $this->line(
                "Lecturer {$lecturer->name} → User #{$user->id}"
            );
        }
    }

    private function backfillIndustrySupervisors(): void
    {
        $supervisors = IndustrySupervisor::query()
            ->whereNull('user_id')
            ->get();

        $this->info(
            "Industry supervisors found: {$supervisors->count()}"
        );

        foreach ($supervisors as $supervisor) {

            if (! $supervisor->email) {
                $this->warn(
                    "Industry Mentor {$supervisor->id} skipped: no email."
                );

                continue;
            }

            $user = User::firstOrCreate(
                [
                    'email' => $supervisor->email,
                ],
                [
                    'name' => $supervisor->name,
                    'password' => Hash::make(Str::random(32)),
                ]
            );

            $supervisor->update([
                'user_id' => $user->id,
            ]);

            if (! $user->hasRole('Industry Mentor')) {
                $user->assignRole('Industry Mentor');
            }

            $this->line(
                "Industry Mentor {$supervisor->name} → User #{$user->id}"
            );
        }
    }
}
