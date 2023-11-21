<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allRoles=[
            "System Admin",
            "Admin",
            "Client Admin",
            "Branch Admin",
            "Executive"
        ];
        foreach ($allRoles as $role) {
            Role::create([
                "name"=> $role,
            ]);
    }
}
}