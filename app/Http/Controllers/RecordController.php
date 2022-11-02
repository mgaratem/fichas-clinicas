<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Repositories\RecordRepository;
use App\Repositories\PatientRepository;
use App\Repositories\AppointmentRepository;

use App\Models\Record;

use Validator;
use Freshwork\ChileanBundle\Rut;


class RecordController extends Controller
{
    protected $record;
    protected $patient;
    protected $appointment;

    public function __construct(
        RecordRepository $record_repository, 
        PatientRepository $patient_repository,
        AppointmentRepository $appointment_repository
        )
    {
        $this->middleware('auth');
        $this->record = $record_repository;
        $this->patient = $patient_repository;
        $this->appointment = $appointment_repository;
    }

    /**
    * Display a listing of the resource.
    *
    * @param Request $request
    * @return Response
    */
    public function index(Request $request)
    {
        Log::debug("------------------RecordController/index---------------------------");

        $filter = $request->has('filter') ? $request->get('filter') : 'uuid';
        $query = trim($request->get('search'));

        if (auth()->user()->isAdmin()) {
            $records = $this->record->findAll();
        } else {
            $userId = auth()->user()->id;
            $records = $this->record->find($filter, $query, $userId);
        }
        
        $filters = array(
            'professional' => 'Profesional',
        );

        $filter_date = date("d-m-Y");

        return view('record.index', compact('records', 'filter_date', 'filters'));
    }


    /**
    * Display the specified resource.
    *
    * @param  string  $uuid
    * @return \Illuminate\Http\Response
    */
    public function show($uuid)
    {
        Log::debug("------------------RecordController/show---------------------------");

        try {

            $record = $this->record->findByUuid($uuid);
            $appointments = $this->appointment->findByRecord($record->id);
            $patient = $this->patient->findById($record->patient_id);

            $anamnesis = json_decode($record->anamnesis, true);

            return view('record.show', compact('record', 'appointments', 'anamnesis', 'patient'));

        } catch(\Exception $e){
            Log::error("RECORD SHOW ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar ver ficha 🔥']);
        }
        
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function nextStep(Request $request)
    {

        Log::debug("------------------RecordController/nextStepCreate---------------------------");

        try{
            $validator = Validator::make($request->all(),
            [
                'name'                  => ['required', 'string'],
                'paternal_name'         => ['required', 'string'],
                'maternal_name'         => ['nullable', 'string'],
                'rut'                   => ['required', 'string', 'cl_rut'],
                'gender'                => ['required', 'digits:1'],
                'birth_date'            => ['required', 'date'],
                'occupation'            => ['required', 'string'],
                'address'               => ['required', 'string'],
                'city'                  => ['required', 'string'],
                'email'                 => ['required', 'email']
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $maternal_name = null;
            $genders = array(
                '1' => 'Masculino',
                '2' => 'Femenino', 
                '3' => 'No binario',
                '4' => 'Otro'
            );

            $userData = [
                'name'                  => ucwords(strtolower($request->name)),
                'paternal_name'         => ucwords(strtolower($request->paternal_name)),
                'rut'                   => Rut::parse($request->rut)->format(Rut::FORMAT_COMPLETE),
                'gender'                => $genders[$request->gender],
                'birth_date'            => date("d-m-Y", strtotime($request->birth_date)),
                'occupation'            => ucfirst(strtolower($request->occupation)),
                'address'               => ucfirst(strtolower($request->address)),
                'city'                  => ucwords(strtolower($request->city)),
                'email'                 => strtolower($request->email)
            ];


            if ($request->maternal_name) {
                $maternal_name = ucwords(strtolower($request->maternal_name));
            }

            $userData['maternal_name'] = $maternal_name;

            if (auth()->user()->occupation == 'KINESIOLOGO' || auth()->user()->isAdmin()) {
                $view = 'record.kine.next';
            }

            return view($view, compact('userData'));

        } catch(\Exception $e){
            Log::error("RECORD CREATE ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar ingresar datos de paciente 😢'])->withInput();
        }

    }


    /**
    * Store a newly created resource in storage.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        Log::debug("------------------RecordController/store---------------------------");

        try{
            $validator = Validator::make($request->all(),
            [
                'physical_activity'         => ['required', 'string'],
                'morbid_background'         => ['required', 'string'],
                'reason_consultation'       => ['required', 'string'],
                'postural_observation'      => ['required', 'string'],
                'palpation'                 => ['required', 'string'],
                'flexibility'               => ['required', 'string'],
                'muscle_evaluation'         => ['required', 'string'],
                'neurological_evaluation'   => ['required', 'string'],
                'functional_testing'        => ['required', 'string']
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // CREATE PATIENT OBJECT
            $patient = $this->patient->create(
                $request->name,
                $request->paternal_name,
                $request->maternal_name,
                $request->rut,
                $request->gender,
                date('Y-m-d', strtotime($request->birth_date)),
                $request->occupation,
                $request->address,
                $request->city,
                $request->email
            );

            $anamnesis = json_encode([
                "remote_anamnesis" => [
                    "physical_activity" => $request->physical_activity,
                    "morbid_background" => $request->morbid_background
                ],
                "next_anamnesis" => [
                    "reason_consultation" => $request->reason_consultation
                ],
                "clinical_evaluation" => [
                    "postural_observation" => $request->postural_observation,
                    "palpation" => $request->palpation,
                    "flexibility" => $request->flexibility,
                    "muscle_evaluation" => $request->muscle_evaluation,
                    "neurological_evaluation" => $request->neurological_evaluation,
                    "functional_testing" => $request->functional_testing
                ]
            ]);

            // CREATE RECORD OBJECT
            $record = $this->record->create($anamnesis, $patient->id, auth()->user()->id);

            return redirect()->route('records')->with(['message' => 'Ficha clínica creada exitosamente! ✨']);


        } catch(\Exception $e){
            Log::error("RECORD STORE ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar crear ficha 😢'])->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        Log::debug("------------------RecordController/edit---------------------------");

        $record = $this->record->findByUuid($uuid);
        return view('record.edit', ['record' => $record]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        Log::debug("------------------RecordController/update---------------------------");

        try{
            $validator = Validator::make($request->all(),
            [
                'physical_activity'         => ['required', 'string'],
                'morbid_background'         => ['required', 'string'],
                'reason_consultation'       => ['required', 'string'],
                'postural_observation'      => ['required', 'string'],
                'palpation'                 => ['required', 'string'],
                'flexibility'               => ['required', 'string'],
                'muscle_evaluation'         => ['required', 'string'],
                'neurological_evaluation'   => ['required', 'string'],
                'functional_testing'        => ['required', 'string']
            ]);

            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $anamnesis = json_encode([
                "remote_anamnesis" => [
                    "physical_activity" => $request->physical_activity,
                    "morbid_background" => $request->morbid_background
                ],
                "next_anamnesis" => [
                    "reason_consultation" => $request->reason_consultation
                ],
                "clinical_evaluation" => [
                    "postural_observation" => $request->postural_observation,
                    "palpation" => $request->palpation,
                    "flexibility" => $request->flexibility,
                    "muscle_evaluation" => $request->muscle_evaluation,
                    "neurological_evaluation" => $request->neurological_evaluation,
                    "functional_testing" => $request->functional_testing
                ]
            ]);

            // UPDATE RECORD OBJECT
            $record->anamnesis = $anamnesis;
            $record->save();

            return redirect()->back()->with(['message' => 'Actualización éxitosa! ✨',])->withInput();


        } catch(\Exception $e){
            Log::error("RECORD UPDATE ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar actualizar ficha 😢'])->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        Log::debug("------------------RecordController/destroy---------------------------");

        try {

            $record = $this->record->findByUuid($uuid);
            $appointments = $this->appointment->findByRecord($record->id);
            $patient = $this->patient->findById($record->patient_id);

            // * DELETES APPOINTMENTS OBJECTS
            foreach ($appointments as $appointment){
                $appointment->delete();
            }

            // * DELETES RECORD OBJECT
            $record->delete();

            // * DELETES PATIENT OBJECT
            $patient->delete();

            return redirect()->route('records')->with(['message' => 'Ficha clínica eliminada exitosamente! ✨']);

        }catch(\Exception $e){
            Log::error("RECORD DESTROY ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar borrar ficha clínica 😢']);
        }
    }

}
