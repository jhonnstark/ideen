<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LearningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = \App\Models\User::select('id')->get()->toArray();
        $student = collect($student)->flatten()->all();
        \App\Models\Course::all()->each(function ($course) use ($student){
            $course->student()->attach(Arr::random($student, rand(1,9)));
        });
    }
}
