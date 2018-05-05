{{-- Show form to create a patient's next appointment if the previous appointment's status was successfully updated --}}

@if (session('next_appointment'))

    <form class="form-inline" role="form" action="{{ route('store-appointment') }}" method="POST">

        {{ csrf_field() }}

        <div class="list-group col-md-7 col-md-offset-4">
            <h3>Appointment Creation</h3>
            <hr>
            <li class="list-group-item active">
                <h4 class="list-group-item-heading">Create Next Appointment for 
                    <?php
                        // Get the patient's name and display 
                        $id = session('next_appointment.patients_id');
                        $name = App\Patient::select('given_name', 'surname')->where('id', $id)->first();
                        echo title_case($name->given_name) . ' ' . title_case($name->surname);

                        // Just format the last appointment date displayed bellow 
                        $a_next = new DateTime(session('next_appointment.a_date'));
                    ?>
                    
                </h4>
            </li>
                
            <input type="hidden" name="patients_id" value="{{ session('next_appointment.patients_id') }}">

            <input type="hidden" name="users_id" value="{{ session('next_appointment.users_id') }}">

            <input type="hidden" name="frequency" value="{{ session('next_appointment.frequency') }}">

            <li class="list-group-item">Last appointment was on:       <b> {{ $a_next->format("D") . ' ' . $a_next->format("d-F-Y") }}</b></li>
            <li class="list-group-item">Appointment Frequency is:       <b>{{ title_case(session('next_appointment.frequency')) }}</b></li>
            <li class="list-group-item">Select date of next appointment: 
                <input type="date" class="form-control" name="a_date">
            </li>
            <a href="{{ route('store-appointment') }}">
                <button type="submit" class="btn btn-primary">Create Appointment</button>
            </a>
            
        </div>
    </form>


    


    
@endif