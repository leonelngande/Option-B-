<div class="col-md-10 patient-list add-top-margin">

    <div class="list-group">
        <li class="list-group-item active">
            <h2>Not Respected/Overdue Appointments</h2>
        </li>

        <li class="list-group-item">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>...</th>
                        <th>Name</th>
                        <th>Appointment Date</th>
                        <th>Days Overdue</th>
                        <th>Frequency</th>
                        <th>Drugs</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($overdue as $key => $data)

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

                                $today_date = date('Y-m-d');
                            ?>
                            <td>{{ $dt->format("D") . ' ' . $dt->format("d-F-Y") }}</td>

                            <td>{{ date("d", strtotime($today_date) - strtotime($data->a_date)) }} days</td>

                            <td>{{ title_case($data->frequency) }}</td>

                            <td>{{ $data->d_name }}</td>

                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </li>
    </div>
</div>