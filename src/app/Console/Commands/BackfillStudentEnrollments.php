<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\StudentEnrollment;
use Illuminate\Console\Command;

class BackfillStudentEnrollments extends Command
{
    protected $signature = 'students:backfill-enrollments
                            {--dry-run : Preview only without inserting data}';

    protected $description = 'Create student enrollments from the student current class room';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');

        $students = Student::query()
            ->with('classRoom')
            ->whereNotNull('class_room_id')
            ->get();

        if ($students->isEmpty()) {
            $this->warn('No students have a class_room_id.');

            return self::SUCCESS;
        }

        $this->info(
            $dryRun
                ? 'DRY RUN - no data will be saved.'
                : 'Starting student enrollment backfill...'
        );

        $created = 0;
        $existing = 0;
        $skipped = 0;

        foreach ($students as $student) {

            $classRoom = $student->classRoom;

            if (! $classRoom) {
                $this->warn(
                    "SKIP: {$student->name} - Class Room #{$student->class_room_id} was not found."
                );

                $skipped++;

                continue;
            }

            if (
                ! $classRoom->academic_session_id ||
                ! $classRoom->semester_id
            ) {
                $this->warn(
                    "SKIP: {$student->name} - Class Room {$classRoom->code} has no academic session / semester."
                );

                $skipped++;

                continue;
            }

            $data = [
                'student_id' => $student->id,
                'academic_session_id' => $classRoom->academic_session_id,
                'semester_id' => $classRoom->semester_id,
                'class_room_id' => $classRoom->id,
            ];

            $this->line('');
            $this->line(
                "Student : {$student->name}"
            );
            $this->line(
                "No      : {$student->student_no}"
            );
            $this->line(
                "Class   : {$classRoom->code}"
            );
            $this->line(
                "Session : {$classRoom->academic_session_id}"
            );
            $this->line(
                "Semester: {$classRoom->semester_id}"
            );

            $exists = StudentEnrollment::query()
                ->where($data)
                ->exists();

            if ($exists) {

                $this->comment(
                    'Already exists - skip.'
                );

                $existing++;

                continue;
            }

            if ($dryRun) {

                $this->info(
                    '[DRY RUN] Would create StudentEnrollment.'
                );

                $created++;

                continue;
            }

            StudentEnrollment::create([
                ...$data,
                'status' => 'Active',
                'enrolled_at' => now(),
            ]);

            $this->info(
                'StudentEnrollment created.'
            );

            $created++;
        }

        $this->newLine();

        $this->info('================================');
        $this->info('Backfill completed.');
        $this->info("Will create / created: {$created}");
        $this->info("Already exists      : {$existing}");
        $this->info("Skipped             : {$skipped}");
        $this->info('================================');

        return self::SUCCESS;
    }
}
