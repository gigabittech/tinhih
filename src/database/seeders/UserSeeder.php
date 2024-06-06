<?php

namespace Database\Seeders;

use App\Models\Admin\CommunityMember;
use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin\Provider;
use App\Models\Admin\Client;

// Import the Provider model

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a superadmin user
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@tinhih.com',
            'password' => bcrypt('12345678'),
            'type' => 'super_admin',
        ]);

        // Create an admin user
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@tinhih.com',
            'password' => bcrypt('12345678'),
            'type' => 'admin',
        ]);

        Admin::create([
            'user_id' => $adminUser->id,
            // Add other fields as needed
        ]);

        // Create a provider user in the users table
        $providerUser = User::create([
            'name' => 'Provider',
            'email' => 'provider@tinhih.com',
            'password' => bcrypt('12345678'),
            'type' => 'provider',
        ]);



        // Create a provider record in the providers table with the user's ID
        Provider::create([
            'user_id' => $providerUser->id,
            // Add other fields as needed
        ]);




        // Create a client user in the users table
        $clientUser = User::create([
            'name' => 'Client',
            'email' => 'client@tinhih.com',
            'password' => bcrypt('12345678'),
            'type' => 'client',
        ]);

        // Create a client record in the clients table with the user's ID
        Client::create([
            'user_id' => $clientUser->id,
            // Add other fields as needed
        ]);

        // Create a community member user
        $communityUser = User::create([
            'name' => 'Community Member',
            'email' => 'community@tinhih.com',
            'password' => bcrypt('12345678'),
            'type' => 'community_member',
        ]);


        CommunityMember::create([
            'user_id' => $communityUser->id,
            // Add other fields as needed
        ]);
    }
}