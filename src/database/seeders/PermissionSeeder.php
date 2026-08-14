<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view dashboard',

            'view programmes',
            'create programmes',
            'update programmes',
            'delete programmes',

            'view courses',
            'create courses',
            'update courses',
            'delete courses',

            'view classes',
            'create classes',
            'update classes',
            'delete classes',

            'view students',
            'create students',
            'update students',
            'delete students',

            'view companies',
            'create companies',
            'update companies',
            'delete companies',

            'view placements',
            'create placements',
            'update placements',
            'delete placements',

            'view daily logbooks',
            'create daily logbooks',
            'update daily logbooks',
            'delete daily logbooks',
            'submit daily logbooks',
            'approve daily logbooks',
            'reject daily logbooks',

            'view assessments',
            'create assessments',
            'update assessments',
            'delete assessments',
            'approve assessments',

            'view reports',

            'view users',

            'create users',
            'update users',
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::findByName(
            'Super Admin',
            'web'
        );

        $wblCoordinator = Role::findByName(
            'WBL Coordinator',
            'web'
        );

        $lecturer = Role::findByName(
            'Lecturer',
            'web'
        );

        $industryMentor = Role::findByName(
            'Industry Mentor',
            'web'
        );

        $student = Role::findByName(
            'Student',
            'web'
        );

        // Super Admin
        $superAdmin->syncPermissions(
            Permission::all()
        );

        // WBL Coordinator
        $wblCoordinator->syncPermissions([
            'view dashboard',

            'view programmes',
            'create programmes',
            'update programmes',
            'delete programmes',

            'view courses',
            'create courses',
            'update courses',
            'delete courses',

            'view classes',
            'create classes',
            'update classes',
            'delete classes',

            'view students',
            'create students',
            'update students',
            'delete students',

            'view companies',
            'create companies',
            'update companies',
            'delete companies',

            'view placements',
            'create placements',
            'update placements',
            'delete placements',

            'view daily logbooks',
            'create daily logbooks',
            'update daily logbooks',
            'delete daily logbooks',
            'submit daily logbooks',
            'approve daily logbooks',
            'reject daily logbooks',

            'view assessments',
            'create assessments',
            'update assessments',
            'delete assessments',
            'approve assessments',

            'view reports',

            'view users',
            'create users',
            'update users',
        ]);

        // Lecturer
        $lecturer->syncPermissions([
            'view dashboard',

            'view programmes',
            'view courses',
            'view classes',

            'view students',

            'view companies',

            'view placements',

            'view daily logbooks',
            'approve daily logbooks',
            'reject daily logbooks',

            'view assessments',
            'create assessments',
            'update assessments',
            'approve assessments',

            'view reports',
        ]);

        // Industry Mentor
        $industryMentor->syncPermissions([
            'view dashboard',

            'view students',
            'view companies',
            'view placements',

            'view daily logbooks',
            'approve daily logbooks',
            'reject daily logbooks',

            'view assessments',
            'create assessments',
            'update assessments',

            'view reports',
        ]);

        // Student
       $student->syncPermissions([
        'view dashboard',

        'view placements',

        'view daily logbooks',
        'create daily logbooks',
        'update daily logbooks',
        'delete daily logbooks',
        'submit daily logbooks',

        'view assessments',
]);
    }
}
