<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(LecturingSeeder::class);
        $this->call(LearningSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(ContentSeeder::class);
        $this->call(MaterialSeeder::class);
    }
}
