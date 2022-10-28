<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Appointment;

class AppointmentRepository  {

    public function create($evolution, $consultation_date, $record_id)
    {
        $appointment = new Appointment;
        $appointment->evolution = $evolution;
        $appointment->consultation_date = $consultation_date;
        $appointment->record_id = $record_id;
        $appointment->save();

        return $appointment;
    }

    public function findById($id)
    {
        $appointment = Appointment::findOrFail($id); 
        return $appointment; 
    }

    public function findByRecord($record_id)
    {
        $appointments = Appointment::select('*')
                    ->where('record_id', $record_id)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);

        return $appointments;
    }
}
