@extends('layouts.app')

@section('head_title', 'Patient List |' )

@section('content')
    <?php
    // foreach($patient as $data)
    // {
    //     print_r($data);
    // }
    ?>
    <div class="container"> 
        <form action="{{ route('send-sms') }}" method="POST" id="sms-form">
        <div class="col-md-10 patient-list">

            {{-- Print status message for an operation succeeding or failing --}}
            @include('patient.sub.status')
            
            <h2>Patient List</h2>
            <hr>

            <table class="table table-hover">
            <thead>
                <tr>
                    <th>...</th>
                    <th>Name</th>
                    <th>HIV Type</th>
                    <th>Drugs</th>
                    <th>Next Appointment</th>
                    <th>Sms</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patient as $key => $data)

                    @if(!empty($data->transfered))
                        @continue
                    @endif

                    <tr  class="info">
                        <!----------------------------------- ACTIONS ---------------------------->
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">

                                    <li  role="presentation">
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#view{{$data->given_name . $key}}">View</button>
                                    </li>

                                    {{-- If its a transfered patient equally display this link --}}
                                    @if($user->level == 'd')
                                        <!--<li  role="presentation">
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#edit{{$data->given_name . $key}}">
                                                Edit
                                            </button>
                                        </li>-->
                                        <li  role="presentation">
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#transfer{{$data->given_name . $key}}">
                                                Transfer
                                            </button>
                                        </li>
                                        <li  role="presentation">
                                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#delete{{$data->given_name . $key}}">
                                                Delete
                                            </button>
                                        </li>
                                    @endif
                                </ul>
                            </div>    
                        </td>
                        <!----------------------------------- NAME ---------------------------->
                        <td>
                            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#view{{$data->given_name . $key}}">
                                {{ title_case($data->given_name) . ' ' . title_case($data->surname) }}
                            </button>  
                        </td>
                        <!----------------------------------- HIV TYPE ---------------------------->
                        <td>{{ $data->d_type }}</td>
                        <!----------------------------------- DRUGS ---------------------------->
                        <td>{{ $data->d_name }}</td>
                        <!--------------------------- NEXT APPOINTMENT ---------------------------->
                        <?php 
                            // Use the php date class to transform the date to a more readable format and then display 
                            $dt = new DateTime($data->a_date);
                        ?>
                        <td>{{ $dt->format("D") . ' ' . $dt->format("d-F-Y") }}</td>
                        <!----------------------------------- SMS ---------------------------->
                        <td>
                            <input type="checkbox" name="patient{{$key}}" value="{{$data->id}}">
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
            </table>
        </div>  <!-- end of patient list -->

        {{---------------------------------- SEND SMS VIEW CODE --------------------------------------}}        
        <div class="col-md-2 send-sms">

            <h3>Send SMS</h3>
            <!--<p id="result">replace</p>-->
            <hr>

            {{ csrf_field() }} <!-- csrf token field for the sms form -->

            <input type="hidden" name="size" id="size" value={{count($patient)}}>
            
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="sms_msg" rows="8">A reminder from BAMENDA GENERAL HOSPITAL to come get your drugs on </textarea>
            </div>

            <div class="form-group">
                <label for="sms-date">Pick a date:</label>
                <input class="form-control" id="sms-date" type="date" name="sms_date">
            </div>

            <a href="{{ route('send-sms') }}">
                <button type="submit" class="btn btn-primary" id="sms-send">SEND</button>
            </a>



        </div>
        </form> <!-- end of form -->


        <!-- View Transfered Patients List -->
        @include('patient.sub.transferedlist')

    </div>


    <!-- View Patient Modals -->
    @include('patient.sub.viewmodals', ['loop_data' => $patient])
    

    <!-- Transfer Patient Modals -->
    @include('patient.sub.transfermodals')


    <!-- Restore Patient Modals -->
    @include('patient.sub.restoremodals')


    <!-- Delete Patient Modals -->
    @include('patient.sub.deletemodals', ['loop_data' => $patient, 'view' => 'patient'])



@endsection