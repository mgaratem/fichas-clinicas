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

        $appointment = new Appointment();
        $appointment->evolution = "	Calentamiento 10 minutos elíptica, sentadilla en máquina, extensión pierna en máquina, mancuerna postural 1kg, ejercicio futbol de trote en lugar y salto al costado con una pierna, FNP, elongación ISQ con elástico.";
        $appointment->consultation_date = "2022-10-27";
        $appointment->record_id = 1;
        $appointment->save();
    }
}
