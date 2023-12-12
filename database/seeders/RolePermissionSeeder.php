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
                "Stage-Create",
                "Source-Create",
                "Segement-Create",
                "Tag-Create",
                "Priority-Level-Create"
            ],
            "Admin" => [
                "Administrative",
                "Client-View",
                "Branch-View"
            ],
            "Client Admin" => [
                "User-View",
                "User-Create",
                "User-Update",
                "User-Delete",

                "Branch-View",

                "Branch-Create",

                "Lead-View",
                "Lead-Create",
                "Lead-Update",
                "Lead-Delete",

                "Stage-Create",
                "Source-Create",
                "Segment-Create",
                "Tag-Create",
                "Priority-Level-Create",
                "Designation-Create",
                "Action-Create",

                "Followup-Create"
            ],

            "Branch Admin"=>[

                "Lead-View",
                "Lead-Create",
                "Lead-Update",
                "Lead-Delete",

                "Followup-View",
                "Followup-Create",
                "Followup-Update",
                "Followup-Delete",
                "User-Create",
                
            ],
            "Executive"=>[

                "Lead-View",
                "Lead-Create",
                "Lead-Update",
                "Followup-View",
                "Followup-Create",
                "Followup-Update",
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
