@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> <a href="{{route('home')}}"class="btn btn-sm btn-outline-primary" >Clinic Art Patient Dashboard</a>
                    
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
                            <th>#</th>
                            <th>First Name</th>                    
                            <th>Artnumber</th>
                            <th>clinical stage</th>
                            <th>Functional status</th>
                            <th>BMI</th>
                            <th>Temp</th>  
                           
                            <th></th>                                      
                            <th></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                    @for($i =0; $i < count($weights_id); $i++) 
                        <tr>
                      
                            <td>{{ $i + 1}}</td>
                            <td>{{  $patientname[$weights_id[$i]] }}</td>
                            <td>{{  $artnumber[$weights_id[$i]]  }}</td>                     
                            <td>{{  $clinicalstages[$weights_id[$i]] }}</td> 
                            <td>{{  $functionalstatus[$weights_id[$i]] }}</td>
                            <td>{{ round($value[$weights_id[$i]], 2) }}</td>                         
                            <td>{{  $temperature[$weights_id[$i]]  }}</td>
                
                            <td>
   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatient_<?php print_r($weights_id[$i]); ?>" >
  
  <i class="fa fa-pencil"></i>
  </button>
                            </td>
                            <td>
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatient_<?php print_r($weights_id[$i]); ?>" >
       <i class="fa fa-eye"></i>
  </button>            
                            </td>
                            
                       
                        </tr>
                        @endfor
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal Edit Patient -->
@for($i =0; $i < count($weights_id); $i++)
<div class="modal fade" id="editPatient_<?php print_r($weights_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Patient Form</h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('weights.update', $weights_id[$i]) }}">
              {{method_field('PATCH')}}
                        @csrf
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Patient No') }}</label>

                            <div class="col-md-6">
                                 
                            <input id="artnumber" type="text" class="form-control{{ $errors->has('artnumber') ? ' is-invalid' : '' }}" name="artnumber"  value ="{{$artnumber[$weights_id[$i]] }}" disabled>   
                             
                                @if ($errors->has('artnumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('artnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                         <div class="form-group row">
                            <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="text" class="form-control{{ $errors->has('weight') ? ' is-invalid' : '' }}" name="weight" value="{{  $weight[$weights_id[$i]] }}" required autofocus>

                                @if ($errors->has('weight'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height') }}</label>

                            <div class="col-md-6">
                                <input id="height" type="text" class="form-control{{ $errors->has('height') ? ' is-invalid' : '' }}" name="height" value="" required autofocus>

                                @if ($errors->has('height'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('height') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="clinical_stages_id" class="col-md-4 col-form-label text-md-right">{{ __('WHO clinical stage') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="clinical_stages_id" id="clinical_stages_id">
                                    @foreach($clinicalstagesd as $clinical)
                                         <option value="{{$clinical ->id}}">{{$clinical ->clinical_stages}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="functional_status_id" class="col-md-4 col-form-label text-md-right">{{ __('Functional status') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="functional_status_id" id="functional_status_id">
                                    @foreach($functionalstatusd as $status)
                                         <option value="{{$status ->id}}">{{$status ->functional_status}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="temperature" class="col-md-4 col-form-label text-md-right">{{ __('Temperature') }}</label>

                            <div class="col-md-6">
                                <input id="temperature" type="text" class="form-control{{ $errors->has('temperature') ? ' is-invalid' : '' }}" name="temperature" value ="{{ $temperature[$weights_id[$i]]}}" required>

                                @if ($errors->has('temperature'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('temperature') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                    
                        
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

<!-- Modal View Patient -->
@for($i =0; $i < count($weights_id); $i++)
<div class="modal fade" id="viewPatient_<?php print_r($weights_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Patient View Detail Form</h4>
      </div>
        <div class="modal-body">
        <form >
              
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right"><strong>{{ __('Patient No') }}</strong></label>

                            <div class="col-md-6">
                                 
                            {{  $artnumber[$weights_id[$i]]  }} 
                             
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 text-md-right"><strong>{{ __('First Name') }}</strong></label>

                            <div class="col-md-6">

                                {{   $patientname[$weights_id[$i]] }}

                               
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="surname" class="col-md-4 text-md-right"><strong>{{ __('Surname') }}</strong></label>

                            <div class="col-md-6">
                              {{$patientsurname[$weights_id[$i]] }}

                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 text-md-right"><strong>{{ __('Height') }}</strong></label>

                            <div class="col-md-6">
                              {{$height[$weights_id[$i]] }}

                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender_id" class="col-md-4 text-md-right"><strong>{{ __('Weight') }}</strong></label>

                            <div class="col-md-6">
                              {{  $weight[$weights_id[$i]] }}
                               
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dateofbirth" class="col-md-4 text-md-right"><strong>{{ __('BMI') }}</strong></label>

                            <div class="col-md-6">
                               {{$value[$weights_id[$i]]   }}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="primarycell" class="col-md-4 text-md-right"><strong>{{ __('Temperature') }}</strong></label>

                            <div class="col-md-6">
                                {{$temperature[$weights_id[$i]]  }} 
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="secondarycell" class="col-md-4 text-md-right"><strong>{{ __('Created At') }}</strong></label>

                            <div class="col-md-6">
                               {{ $created_at[$weights_id[$i]]   }}
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="messagelanguage_id" class="col-md-4  text-md-right"><strong>{{ __('Updated At') }}</strong></label>

                            <div class="col-md-6">
                                 {{ $updated_at[$weights_id[$i]] }}
                            </div>
                        </div>

                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">
                                    {{ __('Close') }} 
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


@endsection
