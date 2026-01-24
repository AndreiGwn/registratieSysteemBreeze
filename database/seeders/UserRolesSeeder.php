<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['rolename' => 'manager'],
            ['rolename' => 'patient'],
            ['rolename' => 'praktijkmanagement'],
        ];

        foreach ($roles as $role) {
            DB::table('userroles')->updateOrInsert(
                ['rolename' => $role['rolename']],
                $role
            );
        }

        $this->command->info('User roles seeded successfully!');
    }
}
