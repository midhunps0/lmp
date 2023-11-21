<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Ynotz\AccessControl\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allPermissions=[
            "Administrative",
            "Client-View",
            "Client-Create",
            "Client-Update",
            "Client-Delete",

            "Branch-View",
            "Branch-Create",
            "Branch-Update",
            "Branch-Delete",

            "User-View",
            "User-Create",
            "User-Update",
            "User-Delete",

            "Stage-View",
            "Stage-Create",
            "Stage-Update",
            "Stage-Delete",
            
            "Source-View",
            "Source-Create",
            "Source-Update",
            "Source-Delete",

            "Subscription-View",
            "Subscription-Create",
            "Subscription-Update",
            "Subscription-Delete",

            "Subscription-Model-View",
            "Subscription-Model-Create",
            "Subscription-Model-Update",
            "Subscription-Model-Delete",

            "Lead-View",
            "Lead-Create",
            "Lead-Update",
            "Lead-Delete",

            "Followup-View",
            "Followup-Create",
            "Followup-Update",
            "Followup-Delete",

            "Contact-View",
            "Contact-Create",
            "Contact-Update",
            "Contact-Delete",

            
            "Email-View",
            "Email-Create",
            "Email-Update",
            "Email-Delete",            
        ];

        foreach ($allPermissions as $permission) {
            Permission::create([
                "name"=> $permission,
            ]);
        }
    }
}
