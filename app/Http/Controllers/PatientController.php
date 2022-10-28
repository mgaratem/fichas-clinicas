<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Repositories\PatientRepository;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    protected $patient;

    public function __construct(PatientRepository $patient_repository)
    {
        $this->patient = $patient_repository;
        $this->middleware('auth');
    }

    /**
     * Show landing view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(Request $request)
    {
        Log::debug("----------------------PatientController/index----------------------------");

        $patients = $this->patient->findAll();

        return view('patient.index', compact('patients'));
    }

}
