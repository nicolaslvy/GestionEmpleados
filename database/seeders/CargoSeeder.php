<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         // Create cargos
         $cargo1 = Cargo::create(['nombre' => 'Desarrollador']);
         $cargo2 = Cargo::create(['nombre' => 'Gerente']);
 
         // Create employee
         $empleado = Empleado::create([
             'nombres' => 'Juan',
             'apellidos' => 'Pérez',
             'identificacion' => '12345678',
             'direccion' => 'Calle 123',
             'telefono' => '555-1234',
             'ciudad_nacimiento' => 'Ciudad A'
         ]);
 
         // Attach multiple cargos
         $empleado->cargos()->attach([$cargo1->id, $cargo2->id]);
    }
}
