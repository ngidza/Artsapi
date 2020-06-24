@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <!--div class="panel-heading">Dashboard</div-->

                <div class="panel-body">
                <div class="col-sm-12"><br><br></div>
                <div class="col-sm-12 col-md-6 col-md-offset-4"><h2>Silveira Hospital</h2></div>
                <div class="col-sm-12"><br><br></div>



                    <div class="col-sm-3">
                        <a class="btn btn-default btn-block" href="{{route('patient.create')}}">
                            <strong>Register <br> New Patient</strong>
                        </a>
                    </div>
                    <div class="col-sm-3">
                        <a class="btn btn-default btn-block" href="{{route('sms.todaystats')}}">
                          <strong>Today's <br> SMS Report</strong>
                        </a>
                    </div>
                    <div class="col-sm-3">
                      <a class="btn btn-default btn-block" href="{{route('sms.log')}}">
                            <strong>SMS <br> Log History</strong>
                      </a>
                    </div>
                    <div class="col-sm-3">
                      <a class="btn btn-default btn-block" data-toggle="modal" data-target="#support" >
                          <strong>Systems<br> Support</strong>
                      </a>
                   </div>

                    <div class="col-sm-12"><hr></div>



                                    <table id="patients" class="display" cellspacing="0" width="100%">
                                      <thead>
                                        <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">Name</th>
                                           <th scope="col">Surname</th>
                                           <th scope="col">Art Number</th>
                                           <th scope="col">Cell Number</th>
                                           <th scope="col">Delete</th>
                                           <th scope="col">Edit</th>
                                           <th scope="col">Trace</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                              for($i = 0; $i < count($patient_id); $i++){
                                        ?>
                                          <tr>
                                              <td><?php print_r($i+1); ?> </td>
                                              <td><?php print_r($patientname[$patient_id[$i]]); ?></td>
                                              <td><?php print_r($patientsurname[$patient_id[$i]]); ?></td>
                                              <td><?php print_r($patientartnumber[$patient_id[$i]]); ?></td>
                                              <td><?php print_r($patientcellnumber[$patient_id[$i]]); ?></td>
                                              <td align='center'><a class="delete-patient" data-patient-id="{{$patient_id[$i]}}" ><font color='red'><span style="cursor:pointer"> Delete<i class="glyphicon glyphicon-trash"></i></span></font></a></td>
                                              <td align='center'><a href="{{route('patient.edit',[$patient_id[$i]])}}" ><font color='green'> Edit<i class="glyphicon glyphicon-edit"></i></font></a></td>
                                              <td align='center'><a href="{{route('patient.show',[$patient_id[$i]])}}" ><font color='orange' size='6'> View<i class="glyphicon glyphicon-search"></i></font></a></td>
                                          </tr>
                    <?php

                    }
                     ?>
                                      </tbody>

                                      </table>

                    <div class="col-sm-12"><br><br></div>

                </div>

            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="support" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Having Trouble</h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('user.support') }}">
              {{method_field('POST')}}
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Health Worker') }}</label>

                            <div class="col-md-6">
                           
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"  value =" {{ Auth::user()->name }} " disabled>   
                             
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>               

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Text Area') }}</label>

                            <div class="col-md-6">
                               
                            <textarea id="supportsms" class="form-control{{ $errors->has('supportsms') ? ' is-invalid' : '' }}" name="supportsms"  cols="30" rows="10"  required></textarea>   
                             
                                @if ($errors->has('supportsms'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('supportsms') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Sms') }}
                                </button>
                            </div>
                        </div>
                    </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->

@endsection
