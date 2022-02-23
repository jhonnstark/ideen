<?php

use App\Models\Concept;
use Illuminate\Database\Seeder;

class ConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        factory(Concept::class, 10)->create();
    }
}
