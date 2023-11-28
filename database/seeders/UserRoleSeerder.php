<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Modules\Ynotz\AccessControl\Models\Role;
use Illuminate\Support\Str;

class UserRoleSeerder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=User::all();
        foreach ($users as $user) {
            if ($user->name == 'System Admin') {
                $user->assignRole("System Admin");
            } elseif ($user->name == 'Admin') {
                $user->assignRole("Admin");
            } elseif (Str::contains($user->name, 'client') && Str::contains($user->name, 'user')) {
                $user->assignRole('Client Admin');
            } elseif (Str::contains($user->name, 'Branch manger ') || Str::contains($user->name,' of client ')) {
                $user->assignRole('Branch Admin');
            } 
            else {
                $user->assignRole("Executive");
            }
        }
    
    }
}
