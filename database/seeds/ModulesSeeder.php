<?php

use App\Models\Activity;
use App\Models\Content;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Module::class, 1)
            ->create()
            ->each(function ($course) {
                $course->activity()->save(factory(Activity::class)->make());
                $course->content()->save(factory(Content::class)->make());
            });
    }
}
