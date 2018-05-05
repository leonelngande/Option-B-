<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\AppointmentReminder;

use App\Patient;

class SMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'sms sent successfully!';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Send SMS Notification
        for($counter = $request->size; $counter >= 0; $counter--)
        {
            $patient = 'patient'.$counter;
            // $message = $request->sms_msg . ' ' . "$request->sms_date" . '.';
            $message = "$request->sms_msg " . (string)$request->sms_date;
            // return $message;
            $patient_data = Patient::find($request->$patient); //get the current user 
            
            if(!empty($patient_data))
            {
                //Send SMS Notification
                $sms = new \App\Ozekimessageout;
                $sms->receiver = '+237'.$patient_data->phone;
                $sms->sender = env('PHONE_NUMBER');
                $sms->msg = "$request->sms_msg $request->sms_date";
                $sms->status = "send";
                $sms->save();
                /*$nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to' => '237'.$patient_data->phone,
                    'from' => env('NEXMO_NUMBER'),
                    'text' => $request->sms_msg . ' ' . $request->sms_date
                ]);*/
                
            }
        }
        $sucess_msg = 'Appointment messages for ' . $request->sms_date .' sent!';
        return redirect()->action('PatientController@index')->with('status', $sucess_msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo 'edit';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Send an sms to a patient or several patients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send()
    {
        // 
    }
}
