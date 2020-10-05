<?php

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(State::class)->create([
            'name' =>  'Aguascalientes',
        ]);
        factory(State::class)->create([
            'name' =>  'Baja California',
        ]);
        factory(State::class)->create([
            'name' =>  'Baja California Sur',
        ]);
        factory(State::class)->create([
            'name' =>  'Campeche',
        ]);
        factory(State::class)->create([
            'name' =>  'Coahuila de Zaragoza',
        ]);
        factory(State::class)->create([
            'name' =>  'Colima',
        ]);
        factory(State::class)->create([
            'name' =>  'Chiapas',
        ]);
        factory(State::class)->create([
            'name' =>  'Chihuahua',
        ]);
        factory(State::class)->create([
            'name' =>  'Distrito Federal',
        ]);
        factory(State::class)->create([
            'name' =>  'Durango',
        ]);
        factory(State::class)->create([
            'name' =>  'Guanajuato',
        ]);
        factory(State::class)->create([
            'name' =>  'Guerrero',
        ]);
        factory(State::class)->create([
            'name' =>  'Hidalgo',
        ]);
        factory(State::class)->create([
            'name' =>  'Jalisco',
        ]);
        factory(State::class)->create([
            'name' =>  'México',
        ]);
        factory(State::class)->create([
            'name' =>  'Michoacán de Ocampo',
        ]);
        factory(State::class)->create([
            'name' =>  'Morelos',
        ]);
        factory(State::class)->create([
            'name' =>  'Nayarit',
        ]);
        factory(State::class)->create([
            'name' =>  'Nuevo León',
        ]);
        factory(State::class)->create([
            'name' =>  'Oaxaca',
        ]);
        factory(State::class)->create([
            'name' =>  'Puebla',
        ]);
        factory(State::class)->create([
            'name' =>  'Querétaro',
        ]);
        factory(State::class)->create([
            'name' =>  'Quintana Roo',
        ]);
        factory(State::class)->create([
            'name' =>  'San Luis Potosí',
        ]);
        factory(State::class)->create([
            'name' =>  'Sinaloa',
        ]);
        factory(State::class)->create([
            'name' =>  'Sonora',
        ]);
        factory(State::class)->create([
            'name' =>  'Tabasco',
        ]);
        factory(State::class)->create([
            'name' =>  'Tamaulipas',
        ]);
        factory(State::class)->create([
            'name' =>  'Tlaxcala',
        ]);
        factory(State::class)->create([
            'name' =>  'Veracruz de Ignacio de la Llave',
        ]);
        factory(State::class)->create([
            'name' =>  'Yucatán',
        ]);
        factory(State::class)->create([
            'name' =>  'Zacatecas',]);
    }
}
