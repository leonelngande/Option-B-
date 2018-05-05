{{-- Delete Patient Modals --}}

@foreach($loop_data as $key => $p)
    <div class="modal fade" id="delete{{$p->given_name . $key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete patient</h4>
                </div>

                @if($view == 'patient')
                    <form action="{{ route('delete-patient', ['patient' => $p->id,]) }}">

                @elseif($view == 'appointment')
                    <form action="{{ route('delete-appointment', ['appointment' => $p->id,]) }}">

                @endif

                    {{ method_field('DELETE') }}
                    <div class="modal-body">

                        @if($view == 'patient')
                        <p>Are you sure you want to delete patient {{ title_case($p->given_name) . ' ' . title_case($p->surname) }} ?</p>
                        @elseif($view == 'appointment')
                        <p>Are you sure you want to delete the appointment on {{$p->a_date}} for patient {{ title_case($p->given_name) . ' ' . title_case($p->surname) }} ?</p>
                        @endif 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                        @if($view == 'patient')
                        <a href="{{ route('delete-patient', ['patient' => $p->id,]) }}">

                        @elseif($view == 'appointment')
                            <a href="{{ route('delete-appointment', ['appointment' => $p->id,]) }}">
                        
                        @endif 

                            <button type="submit" class="btn btn-primary">Delete</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach