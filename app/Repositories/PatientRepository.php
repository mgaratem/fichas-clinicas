<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Patient;

class PatientRepository  {

    public function create($name, $paternal_last_name, $maternal_last_name, $rut, $gender, $birth_date, $occupation, $address, $city, $email)
    {
        $patient = new Patient;
        $patient->name = $name;
        $patient->paternal_last_name = $paternal_last_name;
        $patient->maternal_last_name = $maternal_last_name;
        $patient->rut = $rut;
        $patient->gender = $gender;
        $patient->birth_date = $birth_date;
        $patient->occupation = $occupation;
        $patient->address = $address;
        $patient->city = $city;
        $patient->email = $email;
        $patient->save();

        return $patient;
    }

    public function findById($id)
    {
        $patient = Patient::findOrFail($id); 
        return $patient; 
    }

    public function findByRut($rut)
    {
        $patient = Patient::where('rut', $rut)->first(); 
        return $patient; 
    }

    public function findAll(){
        $patients = Patient::select('*')
                    ->orderBy('paternal_last_name', 'ASC')
                    ->paginate(10);

        return $patients;
    }
}
