<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Log;
use App\Models\Record;

use Ramsey\Uuid\Uuid;

class RecordRepository  {

    public function create($anamnesis, $patient_id, $professional_id)
    {
        $record = new Record();
        $record->uuid = Uuid::uuid4()->toString();
        $record->anamnesis = $anamnesis;
        $record->patient_id = $patient_id;
        $record->professional_id = $professional_id;
        $record->save();

        return $record;
    }

    public function findById($id)
    {
        $record = Record::findOrFail($id); 
        return $record; 
    }

    public function findAll(){
        
        $records = Record::select('*')
                    ->with('patient')
                    ->orderBy('id', 'DESC')
                    ->paginate(10);

        return $records;
    }

    public function find($filter, $query, $user_id){
        
        $records = Record::select('*')
                    ->with('patient')
                    ->where('professional_id', $user_id)
                    ->orderBy('id', 'DESC')
                    ->paginate(10);

        return $records;
    }

    public function findByUuid($uuid)
    {
        $record = Record::where('uuid', $uuid)->firstOrFail();
        return $record; 
    }
}
