<?php
namespace App\Functions;

use App\Models\Record;
use App\Models\Patient;
use App\Models\User;
use App\Models\Appointment;

//* Calls auxiliar functions
include('aux.php');

class createJson{

    /**
     * Returns a HTML based String with necessary data to create a clinical record
     *
     * @param  Record $record
     * @return string
     */
    function getHTMLRecord(Record $record, Patient $patient, User $user, $appointments)
    {

      //* Local Variables
      $img_logo           = 'logo.png';
      $img_company        = 'company.png';
      $months             = array(
                              'Enero',
                              'Febrero',
                              'Marzo',
                              'Abril',
                              'Mayo',
                              'Junio',
                              'Julio',
                              'Agosto',
                              'Septiembre',
                              'Octubre',
                              'Noviembre',
                              'Diciembre'
                            );
      $now                = date("d-m-Y");
      $html_template      = file_get_contents(public_path('/html/TEMPLATE_RECORD.html')); //* Get blank HTML template

      //* Basic data
      $emission_date            = $now;
      $emission_hour            = date("H:s:i");
      $year                     = date("Y");
      $anamnesis                = json_decode($record->anamnesis, true);

      $json = [];
      $json['TITLE'] = 'Ficha_' . $patient->getFriendlyRut();
      $json['DATE_YEAR'] = $year;
      $json['EMISSION_DATE'] = $emission_date;


      //-------------------------------------------------------------------------------------------------
      //* PROFFESIONAL DATA

      $professional_name        = $user->name;
      $professional_occupation  = $user->getUserFriendlyIdentifier();
      $company_name             = "Jumpitt"; // TODO: make company part of the model schema

      $json['PROFESSIONAL_TITLE'] = $professional_occupation;
      $json['PROFESSIONAL_NAME']  = $professional_name;
      $json['COMPANY_NAME']       = $company_name;

      //-------------------------------------------------------------------------------------------------
      //* PATIENT DATA


      $patient_name         = $patient->getFriendlyName();
      $patient_rut          = $patient->getFriendlyRut();
      $patient_birth_date   = date('d-m-Y', strtotime($patient->birth_date));
      $patient_gender       = $patient->gender;
      $patient_email        = $patient->email;
      $patient_occupation   = $patient->occupation;
      $patient_address      = $patient->address;
      $patient_city         = $patient->city;

      $json['PATIENT_NAME']         = $patient_name;
      $json['PATIENT_RUT']          = $patient_rut;
      $json['PATIENT_BIRTH_DATE']   = $patient_birth_date;
      $json['PATIENT_GENDER']       = $patient_gender;
      $json['PATIENT_EMAIL']        = $patient_email;
      $json['PATIENT_OCCUPATION']   = $patient_occupation;
      $json['PATIENT_ADDRESS']      = $patient_address;
      $json['PATIENT_CITY']         = $patient_city;



      //-------------------------------------------------------------------------------------------------
      //* ANAMNESIS DATA

      $aux_html = '<div class="row justify-content-between mt-3">
                    <div class="col-8">
                        <dl>
                            <dt>Anamnesis Remota</dt>
                            <dd>Actividad Física: ' . $anamnesis["remote_anamnesis"]["physical_activity"] . '</dd>
                            <dd>Antecedentes Mórbidos: ' . $anamnesis["remote_anamnesis"]["morbid_background"] . '</dd>
                            <dt>Anamnesis Próxima</dt>
                            <dd>Motivo de Consulta: ' . $anamnesis["next_anamnesis"]["reason_consultation"] . '</dd>
                            <dt>Evaluación Clínica</dt>
                            <dd>Observación Postural: ' . $anamnesis["clinical_evaluation"]["postural_observation"] . '</dd>
                            <dd>Palpación: ' . $anamnesis["clinical_evaluation"]["palpation"] . '</dd>
                            <dd>Flexibilidad: ' . $anamnesis["clinical_evaluation"]["flexibility"] . '</dd>
                            <dd>Evaluación muscular: ' . $anamnesis["clinical_evaluation"]["muscle_evaluation"] . '</dd>
                            <dd>Evaluación Neurológica: ' . $anamnesis["clinical_evaluation"]["neurological_evaluation"] . '</dd>
                            <dd>Pruebas Funcionales: ' . $anamnesis["clinical_evaluation"]["functional_testing"] . '</dd>
                        </dl>
                    </div>
                </div>';
      $json['ANAMNESIS_TABLE'] = $aux_html;


      //-------------------------------------------------------------------------------------------------
      //* APPOINTMENTS DATA

      $aux_html = '<table class="table table-date table-hover" border="0" align="center" cellpadding="0" cellspacing="0">
              <thead>
                <tr class="title-table">
                  <th>N°</th>          
                  <th>Fecha</th>
                  <th>Evolución</th>
                </tr>
              </thead>
              <tfoot></tfoot>
              <tbody>';
      $i=0;
      foreach ($appointments as $appointment) {
        $aux_html = $aux_html . '<tr> <td>' . (string)($i+1) . '</td>
            <td>' . $appointment->consultation_date . '</td>
            <td>' . $appointment->evolution . '</td></tr>';
        $i++;
      }
      $aux_html = $aux_html . '</tbody></table>';
      $json['APPOINTMENTS_TABLE'] = $aux_html;


      //-------------------------------------------------------------------------------------------------
      //* REPLACES KEYS IN HTML TEMPLATE

      if(!empty($json)){
        $html_template = replace_tags_json($json, $html_template);
      }

      //-------------------------------------------------------------------------------------------------
      //* REPLACES VALUES IN THE TEMPLATE AND CLEAN UP OF STRANGE CHARACTERS

      $html_template = preg_replace('/\$\$\$[a-z_A-Z0-9]*\$\$\$/', '______', $html_template);
      $html_template = preg_replace('/\#\#\#[a-z_A-Z0-9]*\#\#\#/', '', $html_template);

      //-------------------------------------------------------------------------------------------------
      //* REPLACES FILES PATH

      if (app()->environment() === 'local') {
        $path_img = env('FILE_PATH') . "public/html/img/";
        $path_css = env('FILE_PATH') . "public/html/css/";
        $path_js  = env('FILE_PATH') . "public/html/js/";

      } else {      
        $path_img = "file:///var/www/html/public/html/img/";
        $path_css = "file:///var/www/html/public/html/css/";
        $path_js = "file:///var/www/html/public/html/js/";
      }

      $html_template = preg_replace('/\.\.\/img\//', $path_img, $html_template);
      $html_template = preg_replace('/\.\.\/css\//', $path_css, $html_template);

      return $html_template;
    }

}
