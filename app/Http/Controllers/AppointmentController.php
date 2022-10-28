<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Repositories\AppointmentRepository;
use App\Repositories\RecordRepository;

use Validator;


class AppointmentController extends Controller
{
    protected $appointment;

    public function __construct(
        AppointmentRepository $appointment_repository
        )
    {
        $this->middleware('auth');
        $this->appointment = $appointment_repository;
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        Log::debug("------------------AppointmentController/store---------------------------");

        try{
            $validator = Validator::make($request->all(),
            [
                'evolution'         => ['required', 'string'],
                'consultation_date' => ['required', 'date'],
                'record_uuid'       => ['required', 'string']
            ]);

            if ($validator->fails()){
                return redirect()->back()->with(['create-modal' => '1'])->withErrors($validator)->withInput();
            }

            $record = $this->record->findByUuid($request->record_uuid);

            // CREATE PATIENT OBJECT
            $appointment_repository = $this->appointment->create(
                $request->evolution,
                $request->consultation_date,
                $record->id
            );

            return redirect()->route('records')->with(['message' => 'Consulta agregada exitosamente ✨']);


        } catch(\Exception $e){
            Log::error("APPOINTMENT STORE ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar crear consulta 😢']);
        }
    }
}
