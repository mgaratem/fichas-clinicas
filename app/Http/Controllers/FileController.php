<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Repositories\RecordRepository;
use App\Repositories\PatientRepository;
use App\Repositories\AppointmentRepository;

use App\Functions\createJson;
use PDF;


class FileController extends Controller
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
     * Create a PDF of a Record.
     *
     * @param  Request $request
     * @param  string $uuid
     * @return string
     */
    public function createPDF(Request $request, $uuid)
    {
        try {

            $record = $this->record->findByUuid($uuid);
            $appointments = $this->appointment->findByRecord($record->id);
            $patient = $this->patient->findById($record->patient_id);
            
            $htmlCreator = new createJson();
            $template = $htmlCreator->getHTMLRecord($record, $patient, auth()->user(), $appointments);

            $pdf = PDF::loadHTML($template);
            $filename = 'Ficha_' . $patient->getFriendlyRut() . '.pdf';
            $payload = $pdf->inline($filename);

            //$base64 = base64_encode($payload);

            return $payload; // Visualize pdf
            
        } catch (\Exception $e){
            Log::error("🔥 FILE PDF GENERATION ERROR 🔥", [$e]);
            return back()->with(['error' => 'Error al intentar crear PDF de ficha 🔥']);
        }
    }
}