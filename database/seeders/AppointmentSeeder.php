<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointment = new Appointment();
        $appointment->evolution = "Se realiza ejercicio de localización abdominal y Facilitación muscular neuroceptiva para ambos isquiotibiales.";
        $appointment->consultation_date = "2022-10-20";
        $appointment->record_id = 1;
        $appointment->save();
    }
}
