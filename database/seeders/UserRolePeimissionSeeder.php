<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePeimissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Superadmin',
            'Teacher',
            'Student',
            'Guest'
        ];

        $permissions = [
            'user' => ['list', 'create', 'edit', 'delete'],
            'role' => ['list', 'create', 'edit', 'delete'],
            'permission' => ['list', 'create', 'edit'],
            'course' => ['list', 'create', 'edit', 'delete'],
            'learningActivity' => ['list', 'create', 'edit', 'delete'],
            'attendance' => ['list', 'create', 'edit', 'delete'],
            'info' => ['list', 'create', 'edit', 'delete'],
            'student' => ['activitySubmission', 'view-grades', 'download-materials'],
        ];

        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => $module . '-' . $action]);
            }
        }

        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);

            // Superadmin gets everything
            if ($role['name'] == 'Superadmin') {
                $permissions = Permission::all();
                $role->syncPermissions($permissions);
            }

            // Teacher can manage courses + attendance + activities
            if ($role['name'] == 'Teacher') {
                $teacher_permissions = Permission::whereIn('name', [
                    'course-list','course-create','course-edit',
                    'learningActivity-list','learningActivity-create','learningActivity-edit',
                    'attendance-list','attendance-create','attendance-edit',
                    'student-activitySubmission'
                ])->get();
                $role->syncPermissions($teacher_permissions);
            }

            // Student can only submit activities + view
            if ($role['name'] == 'Student') {
                $student_permissions = Permission::whereIn('name', [
                    'student-activitySubmission',
                    'student-view-grades',
                    'student-download-materials',
                    'course-list',
                    'learningActivity-list',
                    'attendance-list',
                    'info-list'
                ])->get();
                $role->syncPermissions($student_permissions);
            }

            if ($role['name'] != 'Superadmin' && $role['name'] != 'Teacher' && $role['name'] != 'Student') {
                $guest_permissions = Permission::whereIn('name', ['info-list'])->get();
                $role->syncPermissions($guest_permissions);
            }
        }

        $admin_users = [
            [
                'fullname' => 'Super Admin',
                'username' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => 'admin!@#232',
            ],
        ];

        $teachers = [
            [
                'fullname' => 'Teacher1',
                'username' => 'teacher1',
                'email' => 'teacher1@gmail.com',
                'password' => 'teacher!@#232',
            ],
        ];

        foreach ($admin_users as $admin_user) {
            $user = User::firstOrCreate([
                'fullname' => $admin_user['fullname'],
                'username' => $admin_user['username'],
                'email' => $admin_user['email'],
                'password' => bcrypt($admin_user['password']),
            ]);

            $user->assignRole('Superadmin');
        }

        foreach ($teachers as $teacher) {
            $user = User::firstOrCreate([
                'fullname' => $teacher['fullname'],
                'username' => $teacher['username'],
                'email' => $teacher['email'],
                'password' => bcrypt($teacher['password']),
            ]);

            $user->assignRole('Teacher');
        }
    }
}
