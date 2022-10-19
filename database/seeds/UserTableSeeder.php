<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $role = Role::create([
            'name' => 'Admin',
        ]);

        $token = Str::random(80);
        $role->users()->create([
            'api_token' => hash('sha256', $token),
            'name' => "Akash Admin",
            'email' => "admin@hotmail.com",
            'password' => Hash::make("admin12345"),
        ]);

        $role = Role::create([
            'name' => 'Customer',
        ]);

        $token = Str::random(80);
        $role->users()->create([
            'api_token' => hash('sha256', $token),
            'name' => "Customer Name",
            'email' => "customer@hotmail.com",
            'password' => Hash::make("admin12345"),
        ]);

    }
}
