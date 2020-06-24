@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a href="{{route('home')}}" class="btn btn-sm btn-outline-primary" >Health Care Worker Dashboard</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm"  style ="float:right" data-toggle="modal" data-target="#addPatient">
                        Add ART Patient
                    </button>

                    <a href="{{route('sms.todaystats')}}" class="btn btn-sm btn-outline-primary"> <strong> Today's  SMS Report</strong> </a>
                   
                    <a href="{{route('sms.log')}}" class="btn btn-sm btn-outline-primary">   <strong>SMS  Log History</strong> </a>
                   
                    <button type="button" class="btn btn-sm btn-outline-primary"  data-toggle="modal" data-target="#support">
                         <strong>Systems Support</strong>
                    </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            
                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">               
                                      <thead>
                                        <tr>
                                           <th scope="col">#</th>
                                           <th scope="col">Name</th>
                                           <th scope="col">Surname</th>
                                           <th scope="col">Art Number</th>
                                           <th scope="col">Cell Number</th>
                                           <th scope="col">Facility</th>
                                           <th scope="col"></th>
                                           <th scope="col"></th>
                                           <th scope="col"></th>
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
                                              <td><?php print_r( $healthunits[$patient_id[$i]] ); ?></td>
                                              <td>
                                             
                         <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePatient_<?php print_r($patient_id[$i]); ?>" >
                                               
                                      <i class="fa fa-trash-o"></i>
                         </button> 
                                              </td>
                                              <td>
                         <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatient_<?php print_r($patient_id[$i]); ?>">
                                <i class="fa fa-pencil"></i>
                            </button> 
                                              </td>
                                              <td>
                             <a href="{{route('patient.show',[$patient_id[$i]])}}" class="btn btn-info btn-sm" >  <i class="fa fa-eye"></i> </a>
                                             </td>
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


<!-- Modal New Patient -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Patient Form</h4>
      </div>
        <div class="modal-body">
        <form id="form" method="POST" action="{{ route('patient.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender_id" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="gender_id" id="">
                                   @foreach($genders as $gender)
                                        <option value="{{ $gender ->id }}">{{$gender ->gender}}</option>                                       
                                    @endforeach
                               </select>
                                @if ($errors->has('gender_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dateofbirth" type="date" class="form-control{{ $errors->has('dateofbirth') ? ' is-invalid' : '' }}" name="dateofbirth" value="{{ old('dateofbirth') }}" max="2010-06-30" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                         <label for="artnumber" class="col-md-4 col-form-label text-md-right">{{ __('Art Number') }}</label>

                            <div class="col-md-6">
                                 <input id="artnumber" type="text" class="form-control" name="artnumber" placeholder=" e.g PPDDSSYYYYANNNNN"  value="{{ old('artnumber') }}" minlength ="16" required>

                                @if ($errors->has('artnumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('artnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="primarycell" class="col-md-4 col-form-label text-md-right">{{ __('Mobile phone no. 1') }}</label>

                            <div class="col-md-6">
                                <input id="primarycell" type="tel" class="form-control"placeholder ="eg 0775654020" name="primarycell"  value="{{ old('primarycell') }}" minlength ="10" maxlength ="10" required>
                              
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="secondarycell" class="col-md-4 col-form-label text-md-right">{{ __('Mobile phone no. 2') }}</label>

                            <div class="col-md-6">
                                <input id="secondarycell" type="tel" class="form-control" placeholder ="eg 0775654020" name="secondarycell" value="{{ old('secondarycell') }}"  minlength ="10" maxlength ="10" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="messagelanguage_id" class="col-md-4 col-form-label text-md-right">{{ __('Texts Languages 1') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="messagelanguage_id" id="">
                                     @foreach($messagelanguages as $languages)
                                        <option value="{{$languages ->id}}">{{$languages ->messagelanguage}}</option>                                   
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <!--  <div class="form-group row">
                            <label for="messagemode_id" class="col-md-4 col-form-label text-md-right">{{ __('text Languages 2') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="messagemode_id" id="">
                                    @foreach($messagemodes as $modes)
                                         <option value="{{$modes ->id}}">{{$modes ->messagemode}}</option>                                   
                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="healthunit_id" class="col-md-4 col-form-label text-md-right">{{ __('Zaka Health Unit') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="healthunit_id" id="healthunit_id">
                                    @foreach($healthunit as $units)
                                         <option value="{{$units ->id}}">{{$units ->healthunit}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->

<!-- Modal Edit Patient -->
@for($i =0; $i < count($patient_id); $i++)
<div class="modal fade" id="editPatient_<?php print_r($patient_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Patient Form</h4>
      </div>
        <div class="modal-body">
        <form id ="form" method="POST" action="{{ route('patient.update', $patient_id[$i]) }}">
              {{method_field('PATCH')}}
                        @csrf
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                                 
                            <input id="artnumber" type="text" class="form-control{{ $errors->has('artnumber') ? ' is-invalid' : '' }}" name="artnumber"  value ="{{ $patientartnumber[$patient_id[$i]] }}" required autofocus>   
                             
                                @if ($errors->has('artnumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('artnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ $patientname[$patient_id[$i]] }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $patientsurname[$patient_id[$i]]  }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender_id" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="gender_id" id="">
                                   @foreach($genders as $gender)
                                        <option value="{{ $gender ->id }}">{{$gender ->gender}}</option>                                       
                                    @endforeach
                               </select>
                                @if ($errors->has('gender_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dateofbirth" type="date" class="form-control{{ $errors->has('dateofbirth') ? ' is-invalid' : '' }}" name="dateofbirth" value ="{{ $dateofbirth[$patient_id[$i]] }}" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="primarycell" class="col-md-4 col-form-label text-md-right">{{ __('Mobile phone no. 1') }}</label>

                            <div class="col-md-6">
                                <input id="primarycell" type="cellphone" class="form-control" name="primarycell" value ="{{$patientcellnumber[$patient_id[$i]]}}" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="secondarycell" class="col-md-4 col-form-label text-md-right">{{ __('Mobile phone no. 2') }}</label>

                            <div class="col-md-6">
                                <input id="secondarycell" type="cellphone" class="form-control" name="secondarycell" value ="{{ $secondarycell[$patient_id[$i]] }}" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="messagelanguage_id" class="col-md-4 col-form-label text-md-right">{{ __('Texts Languages 1') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="messagelanguage_id" id="">
                                     @foreach($messagelanguages as $languages)
                                        <option value="{{$languages ->id}}">{{$languages ->messagelanguage}}</option>                                   
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="healthunit_id" class="col-md-4 col-form-label text-md-right">{{ __('Zaka Health Unit') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="healthunit_id" id="healthunit_id">
                                    @foreach($healthunit as $units)
                                         <option value="{{$units ->id}}">{{$units ->healthunit}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div> 
                       <!--  <div class="form-group row">
                            <label for="messagemode_id" class="col-md-4 col-form-label text-md-right">{{ __('text Languages 2') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="messagemode_id" id="">
                                    @foreach($messagemodes as $modes)
                                         <option value="{{$modes ->id}}">{{$modes ->messagemode}}</option>                                   
                                    @endforeach
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor



@for($i =0; $i < count($patient_id); $i++)
<!-- Modal Delete Patient -->
<div class="modal fade" id="deletePatient_<?php print_r($patient_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Patient Record</h4>
      </div>
      <div class="modal-body">
      <form role ="form" method="POST" action="{{ route('patient.destroy', $patient_id[$i]) }}">
                     {{method_field('DELETE')}} 
                        @csrf
                       
                        <p> Are you sure you want to delete? </p>

                        <div class="form-group row">
                            <label for="patient_name" class="col-md-6 text-md-right"><strong>{{  $patientartnumber[$patient_id[$i]] }}</strong></label>

                            <div class="col-md-6">                              
                                     {{$patientsurname[$patient_id[$i]] }} 
                              
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No, Close</button>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Yes, Delete') }}
                             </button>                         
                    </div> 
             </form>
             </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->
@endfor

@endsection
