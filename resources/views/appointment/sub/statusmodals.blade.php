{{-- Restore Patient Modals --}}

@foreach($loop_data as $key => $p)

    <div class="modal fade" id="status{{$p->given_name . $key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change appointment status to respected</h4>
                </div>

                <form action="{{ route('update-appointment', ['appointment' => $p->id]) }}" method="POST">

                    {{ csrf_field() }}  

                    <div class="modal-body">
                        <p>Are you sure you want to change the status of the appointment on {{$p->a_date}} for patient {{ title_case($p->given_name) . ' ' . title_case($p->surname) }} to respected?</p>
                    </div>
                    {{-- Input for only transfered field is specified coz only it needs to be changed 
                       - The other data is gotten in PatientCotroller@update using the id sent along.
                       - The fields input is also specified and it will tell the update function what 
                       - to update.
                       --}}
                    <input type="hidden" name="fields" value="a_status">
                    <input type="hidden" name="a_status" value="1">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <a href="{{ route('update-appointment', ['appointment' => $p->id]) }}">
                            <button type="submit" class="btn btn-primary">Okay</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach