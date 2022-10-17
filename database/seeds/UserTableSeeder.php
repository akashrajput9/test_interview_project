<?php

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
        $token = Str::random(80);
        $user = User::create([
            'api_token' => hash('sha256', $token),
            'name' => "Akash Ahmed",
            'email' => "akashrajput9@hotmail.com",
            'password' => Hash::make("admin12345"),
        ]);

        echo $token."\n";
        echo "user created successfully";
    }
}
