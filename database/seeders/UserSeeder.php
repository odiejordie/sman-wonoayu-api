<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            "name" => "Superadmin",
            "email" => "superadmin@local.test",
            "password" => bcrypt("1234567890"),
        ]);
        $user->save();
    }
}
