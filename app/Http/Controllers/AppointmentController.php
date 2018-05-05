<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Appointment;
use App\Patient;

class AppointmentController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the current user's data 
        $user = Auth::user();

        // Get the date of today 
        $today = date('Y-m-d');

        //select appointments whose date is today 
        $appointments_today = Appointment::select('appointments.*', 'patients.drugs_id', 'patients.given_name', 
                                            'patients.surname', 'patients.marital_status','patients.gender',
                                            'patients.dob', 'patients.phone', 'patients.other_phone', 'patients.address', 
                                            'patients.email', 'patients.transfered', 'drugs.d_type', 'drugs.d_name')
                                        ->whereDate('appointments.a_date', $today)
                                        ->whereNull('appointments.a_status')
                                        ->leftJoin('patients', 'patients.id', '=', 'appointments.patients_id')
                                        ->leftJoin('drugs', 'drugs.id', '=', 'patients.drugs_id')
                                        ->orderBy('patients.given_name', 'asc')
                                        ->get();

        // print_r($appointments_today->toArray());

        // select appointments whose date is less than today(), set their dates to today, if no msg is found 
        $appointments_overdue = Appointment::select('appointments.*', 'patients.drugs_id', 'patients.given_name', 
                                            'patients.surname', 'patients.marital_status','patients.gender',
                                            'patients.dob', 'patients.phone', 'patients.other_phone', 'patients.address', 
                                            'patients.email', 'patients.transfered', 'drugs.d_type', 'drugs.d_name')
                                        ->whereDate('appointments.a_date', '<', $today)
                                        ->whereNull('appointments.a_status')
                                        ->leftJoin('patients', 'patients.id', '=', 'appointments.patients_id')
                                        ->leftJoin('drugs', 'drugs.id', '=', 'patients.drugs_id')
                                        ->get();
        // echo '<br><br>';
        // print_r($appointments_overdue->toArray());

        // For each overdue appointment, check if a reminder sms has been sent already and send if it's not been 
        if(!empty($appointments_overdue))
        {
            foreach($appointments_overdue as $data)
            {
                $this->checkSmsReminderStatus($data);
            }
        }

        // Select appointments whose date is greater than today, that is upcoming appointments 
        $appointments_upcoming = Appointment::select('appointments.*', 'patients.drugs_id', 'patients.given_name', 
                                            'patients.surname', 'patients.marital_status','patients.gender',
                                            'patients.dob', 'patients.phone', 'patients.other_phone', 'patients.address', 
                                            'patients.email', 'patients.transfered', 'drugs.d_type', 'drugs.d_name')
                                        ->whereDate('appointments.a_date', '>', $today)
                                        ->whereNull('appointments.a_status')
                                        ->leftJoin('patients', 'patients.id', '=', 'appointments.patients_id')
                                        ->leftJoin('drugs', 'drugs.id', '=', 'patients.drugs_id')
                                        ->orderBy('appointments.a_date', 'asc')
                                        ->get();
        
        // return lists of today's and the overdue appointments and the current user's data  
        return view('appointment.index', ['today' => $appointments_today,
                                    'overdue' => $appointments_overdue,
                                    'upcoming' => $appointments_upcoming,
                                    'user' => $user,
                                ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the creation request 
        $this->validate($request, [
            'a_date' => 'required',
        ]);

        // Create the new appointment if it has not been created already
        if(empty(Appointment::where('patients_id', $request->patient_id)
                            ->where('users_id', $request->user_id)
                            ->whereNotNull('a_status')
                            ->value('id') ) )
        {
            $inputs = $request->all();
            $appointment = Appointment::Create($inputs);
        }

        // Delete the session data stored when this patient's last appointment data was updated 
        session()->forget('next_appointment');

        $patient_name = Patient::select('given_name', 'surname')->where('id', $request->patients_id)->first();

        $sucess_msg = 'Appointment on ' . $request->a_date . ' for patient ' . $patient_name->given_name . ' ' . $patient_name->surname . ' successfully created!';
        return redirect()->action('AppointmentController@index')->with('status', $sucess_msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        // Within the form that sends these update requests, a fields variable is set which contains the fields to be updated by this function 
        $fields = explode(',', $request->fields);
        
        foreach($fields as $field)
        {
            $appointment->$field = $request->$field;
        }

        $appointment->save();

        // This helps show the form for creating the next appointment for  a patient whose appointment has been respected
        // search the fields string sent from the form if it contains a_status, wc is used to change an appointment's status 
        if(str_contains($request->fields, 'a_status'))
        {
            $next_appointment = $appointment;
        }

        // Add the patient's information to the session such that it can be retrieved in the appointment view for new appointment creation
        // When the new appointment is created in the create fuction above, this session date will be destroyed so it doesn't appear again. 
        session(['next_appointment' => $next_appointment]);

        $patient_name = Patient::select('given_name', 'surname')->where('id', $appointment->patients_id)->first();

        $sucess_msg = 'Appointment on ' . $appointment->a_date . ' for patient ' . $patient_name->given_name . ' ' . $patient_name->surname . ' successfully updated!';
        return redirect()->action('AppointmentController@index')->with('status', $sucess_msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        $appointment->delete();

        $patient_name = Patient::select('given_name', 'surname')->where('id', $appointment->patients_id)->first();

        $sucess_msg = 'Appointment on ' . $appointment->a_date . ' for patient ' . $patient_name->given_name . ' ' . $patient_name->surname . ' successfully deleted!';
        return redirect()->action('AppointmentController@index')->with('status', $sucess_msg);
    }

    protected function checkSmsReminderStatus($data = null)
    {
        // Query sms storage table for sms sent today with this patient's id, if found do nothing, else send the sms 
    }
}
