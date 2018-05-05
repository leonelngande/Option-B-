<div class="col-md-8 patient-list add-top-margin">

    <div class="list-group">
        <li class="list-group-item active">
            <h2>Upcoming Appointments</h2>
        </li>       

        <li class="list-group-item">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Appointment Date</th>
                        <th>Frequency</th>
                        <th>Drugs</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($upcoming as $key => $data)

                        <tr  class="success">

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

                            <td>{{ $data->frequency }}</td>

                            <td>{{ $data->d_name }}</td>

                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </li>
    </div>
</div>