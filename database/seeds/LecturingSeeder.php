<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LecturingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher = \App\Models\Teacher::select('id')->get()->toArray();
        $teacher = collect($teacher)->flatten()->all();
        \App\Models\Course::all()->each(function ($course) use ($teacher){
            $course->teacher()->attach(Arr::random($teacher));
        });
    }
}
