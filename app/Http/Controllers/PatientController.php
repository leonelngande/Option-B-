<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Drug;
use App\Patient;
use App\Appointment;

class PatientController extends Controller
{
    /**
    *
    * @var stores the current user's information  
    *
    **/
    protected $user = null;



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
        $user = Auth::user();

        $patients = DB::table('patients')
                        ->select('patients.*', 'drugs.d_name', 'drugs.d_type', 'appointments.a_date', 
                            'appointments.a_status', 'appointments.frequency', 'users.name', 
                            'users.level', 'users.name')
                        ->whereNull('patients.deleted_at')
                        ->whereNull('appointments.a_status')
                        ->leftJoin('drugs', 'drugs.id', '=', 'patients.drugs_id')
                        ->leftJoin('appointments', 'appointments.patients_id', '=', 'patients.id')
                        ->leftJoin('users', 'users.id', '=', 'patients.users_id')
                        ->orderBy('a_date', 'asc')
                        ->orderBy('transfered', 'desc')
                        ->get();
                        
        
        return view('patient.index', ['patient' => $patients,
                                    'user' => $user]);
        // return 'all good';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $drugs_data = Drug::all();

    return view('patient.create', ['drugs_data' => $drugs_data,
                                'user' => $user,
                                ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'users_id' => 'required',
            'given_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'gender' => 'required|size:1',
            'marital_status' => 'required|min:5',
            'dob' => 'required|date',
            'phone' => 'required|digits:9',
            'address' => 'required',
            'other_phone' => 'sometimes|digits:9',
            'email' => 'sometimes|email|max:255|unique:patients',
            'drugs_id' => 'required|size:1',
            'a_date' => 'required|date',
            'frequency' => 'required|min:5',
        ]);

        //this array includes only the records related to a patient and excludes those related to an appointment 
        $patient_array = array_except($request->all(), ['_token', 'a_date', 'frequency']); 
        
        /*****************************  store or create new patient *************************/

        // verify this patient has not been created already, if so skip storage and create appointment, else store/create
        if(empty(Patient::where($patient_array)->value('id')))
        {
            $inputs = $request->all();
            $patient = Patient::Create($inputs);
        }
        

        /*****************************store or create first appointment***********************/
        // get the id of the just created patient 
        $patient_id = Patient::where($patient_array)->value('id');

        // verify this appointment has not been created already, if so skip storage and create appointment, else store/create
        if(empty(Appointment::where([['patients_id', $patient_id],
                                    ['users_id', $request->users_id],
                                    ['a_date', $request->a_date],
                                    ['frequency', $request->frequency]
                                ])
                                ->value('id')))
        {
            $appointment = new Appointment;

            $appointment->patients_id = $patient_id; 
            $appointment->users_id = $request->users_id;
            $appointment->a_date = $request->a_date;
            $appointment->frequency = $request->frequency;

            $appointment->save();
        }


        $sucess_msg = 'Patient ' . $request->given_name . ' ' . $request->surname . ' and first appointment on ' . $request->a_date . ' successfully created!';
        // return redirect()->action('PatientController@Create')->with('status', $sucess_msg);
        return redirect()->action('PatientController@create')->with('status', $sucess_msg);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        return view('patient.show', ['patient' => $patient]);
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
        $patient = Patient::find($id);

        $fields = explode(',', $request->fields);
        
        foreach($fields as $field)
        {
            $patient->$field = $request->$field;
        }

        $patient->save();

        $sucess_msg = 'Patient ' . $patient->given_name . ' ' . $patient->surname . ' successfully transfered!';
        return redirect()->action('PatientController@index')->with('status', $sucess_msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);

        $patient->delete();

        $sucess_msg = 'Patient ' . $patient->given_name . ' ' . $patient->surname . ' successfully deleted!';
        return redirect()->action('PatientController@index')->with('status', $sucess_msg);
    }
}
