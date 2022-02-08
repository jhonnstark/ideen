<?php

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Course::class, 10)
            ->create()
            ->each(function ($course) {
                $course->module()->save(factory(\App\Models\Module::class)->make());
            });
    }
}
