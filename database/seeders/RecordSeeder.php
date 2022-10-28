<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Record;

use Ramsey\Uuid\Uuid;


class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = json_encode(
            array(
                "remote_anamnesis" => array(
                    "physical_activity" => "1 a 2 veces por semana, futbol",
                    "morbid_background" => "familiares de HTA y Colesterol alto. TLP (tratado). Hace años desgarro cuádriceps pierna derecha.",
                ),
                "next_anamnesis" => array(
                    "reason_consultation" => "- Rango limitado de pierna en extensión, le molesta sobre todo al jugar futbol, pues no puede extender del todo al golpear pelota\n- Mejora rendimiento futbol, quiere mejorar fuerza de golpe de balón\n- Dolor de espalda y cuello, al estar largos periodos jugando en computador o trabajando sin pausa activa"
                ),
                "clinical_evaluation" => array(
                    "postural_observation" => "hiperlordosis, anteversión de cuello",
                    "palpation" => "aumento de tensión cuello y espalda",
                    "flexibility" => "acortamiento isquiotibial bilateral",
                    "muscle_evaluation" => "pobre control abdominal",
                    "neurological_evaluation" => "no aplicable",
                    "functional_testing" => "no aplicable",
                )
            ));

        $record = new Record();
        $record->uuid = Uuid::uuid4()->toString();
        $record->anamnesis = $json;
        $record->patient_id = 1;
        $record->professional_id = 1;
        $record->save();
    }
}
