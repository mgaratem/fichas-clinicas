<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patient = new Patient();
        $patient->name = 'Macarena';
        $patient->paternal_last_name = 'Gárate';
        $patient->maternal_last_name = 'Muñoz';
        $patient->rut = '19.041.272-5';
        $patient->gender = 'No binario';
        $patient->birth_date = '1995-07-28';
        $patient->occupation = 'Desarrollador backend';
        $patient->address = 'Jardines de Paso Hondo 2330';
        $patient->city = 'Quilpué';
        $patient->email = 'mgarate@jumpitt';
        $patient->save();
    }
}
