@extends('layouts.app')

@section('head_title', 'Appointments |' )

@section('content')

<div class="container">
    
    <div class="col-md-10 patient-list">

        @include('patient.sub.status')
        
        {{-- Form to create next appointment for a patient whose status has just been updated --}}
        @include('appointment.sub.nextappointment')
    
    {{-- Display the rest of the content only when the next appointment has been created for the patietn whose 
       - appointment was just marked as respected.
       --}}
    @if (!session('next_appointment')) 
        <div class="list-group">
            <li class="list-group-item active">
                <h2>Today's Appointments</h2>
            </li>

            <li  class="list-group-item">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>...</th>
                            <th>Name</th>
                            <th>Appointment Date</th>
                            <th>Frequency</th>
                            <th>Drugs</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($today as $key => $data)

                            <tr  class="info">
                                <td>
                                    <button class="btn btn-default" data-toggle="modal" data-target="#status{{$data->given_name . $key}}">
                                        Respected?
                                    </button>

                                    @if($user->level == 'd')
                                        <button class="btn btn-default" data-toggle="modal" data-target="#delete{{$data->given_name . $key}}">
                                            Delete
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-link" data-toggle="modal" data-target="#view{{$data->given_name . $key}}">
                                        {{ title_case($data->given_name) . ' ' . title_case($data->surname) }}
                                    </button> 
                                </td>
                                <?php 
                                    // Use the php date class to transform the date to a more readable format and then display 
                                    $dt = new DateTime($data->a_date);
                                ?>
                                <td>{{ $dt->format("D") . ' ' . $dt->format("d-F-Y") }}</td>
                                <td>{{ title_case($data->frequency) }}</td>
                                <td>{{ $data->d_name }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </li>
        </div>

    </div>

    <!-- Overdue appointments View -->
    @include('appointment.sub.overdue')

    <!-- upcoming appointments View -->
    @include('appointment.sub.upcoming')

    <!-- View Patient Modals -->
    @include('patient.sub.viewmodals', ['loop_data' => $today])

    @include('patient.sub.viewmodals', ['loop_data' => $upcoming])

    @include('patient.sub.viewmodals', ['loop_data' => $overdue])

    @include('patient.sub.deletemodals', ['loop_data' => $today, 'view' => 'appointment'])

    @include('patient.sub.deletemodals', ['loop_data' => $overdue, 'view' => 'appointment'])

    @include('appointment.sub.statusmodals', ['loop_data' => $today])

    @include('appointment.sub.statusmodals', ['loop_data' => $overdue])

    @endif

</div>


@endsection