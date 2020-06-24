@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--div class="panel-heading">Dashboard</div-->

                <div class="panel-body">
                <div class="col-sm-12"><br><br></div>
                <div class="col-sm-12 text-center"><h2>Patient Appointments</h2></div>
                <div class="col-sm-12"><hr></div>
                <div class="col-sm-12 text-center"><h4>{{$patients[0]->artnumber}}</h4></div>
                <div class="col-sm-12"><br></div>




                <table id="patientappointments" class="display" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                			 <th scope="col">#</th>
                			 <th scope="col">Appointment</th>
                			 <th scope="col">Test Type</th>
                       <th scope="col">Test (Other)</th>
                			 <th scope="col">Appointment Date</th>
                			 <th scope="col">Edit</th>
                			 <th scope="col">Delete</th>
                		</tr>
                	</thead>
                	<tbody>
                		<?php
                          for($i = 0; $i < count($patientappointment_id); $i++){
                    ?>
                      <tr>
                          <td><?php print_r($i+1); ?> </td>
                          <td><?php print_r($patientappointmenthsp[$patientappointment_id[$i]]); ?> </td>
                          <td>
                            <?php

                          if(isset($patientappointmenttesttype_id[$patientappointment_id[$i]])){

                              print_r($patientappointmenthsp[$patientappointment_id[$i]]);

                          }else{

                              echo '-';

                          }

                            ?>
                        </td>
                        <td><?php

                        if(isset($patientappointmenttest[$patientappointment_id[$i]])){

                            print_r($patientappointmenttest[$patientappointment_id[$i]]);

                        }else{

                            echo '-';

                        }

                          ?>
                      </td>
                      <td>
                        <?php

                            print_r($patientappointmentdate[$patientappointment_id[$i]]);

                        ?>
                      </td>
                      <td align='center'><a href="" ><font color='green'><i class="glyphicon glyphicon-edit"></i></font></a></td>
                      <td align='center'><a href="" ><font color='red'><i class="glyphicon glyphicon-trash"></i></font></a></td>

                      </tr>
<?php

}
 ?>
                	</tbody>

                	</table>

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
