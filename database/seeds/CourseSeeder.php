<?php

use App\Models\Content;
use App\Models\Activity;
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
                $course->activity()->save(factory(Activity::class)->make());
                $course->content()->save(factory(Content::class)->make());
            });
    }
}
