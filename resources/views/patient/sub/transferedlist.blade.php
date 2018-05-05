{{-- List of transfered patients and their operations --}}

<div class="col-md-8 patient-list">
            
    <h3>Transfered Patients</h3>
    <hr>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>...</th>
                <th>Name</th>
                <th>HIV Type</th>
                <th>Drugs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patient as $key => $data)

                @if(empty($data->transfered))
                    @continue
                @endif

                <tr  class="success transfered-row">
                    <td>
                        <button class="btn btn-default" data-toggle="modal" data-target="#view{{$data->given_name . $key}}">
                            View
                        </button>

                        @if($user->level == 'd')
                            <button class="btn btn-default" data-toggle="modal" data-target="#restore{{$data->given_name . $key}}">
                                Restore Patient
                            </button>

                            <button class="btn btn-default" data-toggle="modal" data-target="#delete{{$data->given_name . $key}}">
                                Delete
                            </button>
                        @endif
                    </td>
                    <td>{{ title_case($data->given_name) . ' ' . title_case($data->surname) }}</td>
                    <td>{{ $data->d_type }}</td>
                    <td>{{ $data->d_name }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>