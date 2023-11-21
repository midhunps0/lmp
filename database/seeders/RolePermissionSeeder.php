<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Role;
use Modules\Ynotz\AccessControl\Models\Permission;

class RolePermissionSeeder extends Seeder
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

        $rolePermissions = [
            "System Admin" => [
                "Administrative",
                
            ],
            "Admin" => [
                "Administrative",
                "Client-View",
                "Branch-View"
                
            ],
            "Client Admin" => [
                "Client-View",
                "Client-Create",
                "Branch-View",
                
            ],
            "Branch Admin"=>[
                "Lead-View",
                "Lead-Create",
                "Lead-Update",
                "Followup-View",
                "Followup-Create"
            ],
            "Executive"=>[
                "Lead-View",
                "Lead-Create",
                "Lead-Update",
                "Followup-View",
                "Followup-Create"
            ]
           
        ];
        foreach ($allRoles as $role) {
            Role::create([
                "name" => $role,
            ]);
        }
        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();
            $role->permissions()->attach(Permission::whereIn('name', $permissions)->get());
        }
    }
}