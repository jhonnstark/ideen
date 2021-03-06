<?php

use App\Models\User;
use App\Models\UserProfile;
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
        factory(User::class, 1)->create()
            ->each(function ($user) {
                $user->userProfile()->save(factory(UserProfile::class)->make());
            });
    }
}
