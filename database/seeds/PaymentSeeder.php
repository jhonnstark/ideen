<?php

use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::all()->each(function ($student) {
            $student->payment()->saveMany(factory(\App\Models\Payment::class, 10)->make());
        });
    }
}
