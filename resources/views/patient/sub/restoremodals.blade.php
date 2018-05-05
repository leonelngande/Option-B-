{{-- Restore Patient Modals --}}

@foreach($patient as $key => $p)

    @if(!empty($p->transfered))

    <div class="modal fade" id="restore{{$p->given_name . $key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Restore patient</h4>
                </div>

                <form action="{{ route('update-patient', ['patient' => $p->id]) }}" method="POST">

                    {{ csrf_field() }}  

                    <div class="modal-body">
                        <p class="">Are you sure you want to <b>restore</b> {{ title_case($p->given_name) . ' ' . title_case($p->surname) . ' ' }}as a patient in this hospital?</p>
                    </div>
                    {{-- Input for only transfered field is specified coz only it needs to be changed 
                       - The other data is gotten in PatientCotroller@update using the id sent along.
                       - The fields input is also specified and it will tell the update function what 
                       - to update.
                       --}}
                    <input type="hidden" name="fields" value="transfered">
                    <input type="hidden" name="transfered" value="">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <a href="{{ route('update-patient', ['patient' => $p->id]) }}">
                            <button type="submit" class="btn btn-primary">Restore</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endif

@endforeach
