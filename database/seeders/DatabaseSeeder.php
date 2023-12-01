<?php

namespace Database\Seeders;

use App\Models\Authenticable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(SubscriptionModelSeeder::class);
        $this->call(ClientSeeder::class);

        $this->call(DesignationSeeder::class);
        $this->call(PriorityLevelSeeder::class);
        $this->call(StageSeeder::class);
        $this->call(SegmentSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ActionSeeder::class);
        
        $this->call(UserSeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(FollowupSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(NumberSeeder::class);
        $this->call(EmailSeeder::class);
        $this->call(ChatSeeder::class);
        $this->call(NotificationSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(RemarkSeeder::class);
        $this->call(ClientSubscriptionSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserRoleSeerder::class);
        //$this->call(LeadSeeder::class);
        //$this->call(AppoimentSeeder::class);
        //$this->call(ContactSeeder::class);
    }
}
