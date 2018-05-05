{{-- View Patient Modals --}}

@foreach($loop_data as $key => $p)
    <div class="modal fade" id="view{{$p->given_name . $key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Patient details</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">Given name:        {{ title_case($p->given_name) }}</li>
                        <li class="list-group-item">Surname:           {{ title_case($p->surname) }}</li>
                        <li class="list-group-item">Gender:            {{ $p->gender }}</li>
                        <li class="list-group-item">Date of birth:     {{ $p->dob }}</li>
                        <li class="list-group-item">Address:           {{ title_case($p->address) }}</li>
                        <li class="list-group-item">Doctor:            {{ title_case($p->name) }}</li>
                        <li class="list-group-item">Phone:             {{ $p->phone }}</li>
                        <li class="list-group-item">Other phone:       {{ $p->other_phone }}</li>
                        <li class="list-group-item">Email:             {{ $p->email }}</li>
                        <li class="list-group-item">Marital Status:    {{ $p->marital_status }}</li>
                        <li class="list-group-item">HIV type:          {{ $p->d_type }}</li>
                        <li class="list-group-item">Drugs:             {{ $p->d_name }}</li>
                        <li class="list-group-item">Transfered:        {{ $p->transfered == '1' ? 'Yes' : 'No' }}</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
    @endforeach