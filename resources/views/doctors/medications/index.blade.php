@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{route('admin.dashboard')}}" class="btn btn-sm btn-outline-primary">Medication Dashboard</a>
                </div>

                <div class="card-body">
                <div class="row">
                      
                        <div class="col-md-2">
                            <div class="card  box-shadow" style ="text-align: center;">

                                       Total ART Patient 
                                   <h3 style ="font-size: 50px; color:Green; text-align: center;" > {{$countArtPatients}}  </h3>  
                                                                  
                             </div>
                        </div>
                      
                        <div class="col-md-2">
                            <div class="card  box-shadow" style ="text-align: center;">

                                        Transfer
                                   <h3 style ="font-size: 50px; color:Yellow; text-align: center;" > {{ $transfers}} </h3>  
                                                                  
                             </div>
                        </div>

                         <div class="col-md-2">
                            <div class="card  box-shadow"style ="text-align: center;">

                                      Stage 3
                                   <h3 style ="font-size: 50px; text-align: center;" > {{$stage3}}   </h3>  
                                                                  
                             </div>
                        </div>

                         <div class="col-md-2">
                            <div class="card  box-shadow" style ="text-align: center;">

                                        Stage 2
                                   <h3 style ="font-size: 50px; color:Blue; text-align: center;" >{{$stage2}}  </h3>  
                                                                  
                             </div>
                        </div>

                        <div class="col-md-2">
                            <div class="card  box-shadow"style ="text-align: center;" >

                                        Deaths
                                   <h3 style ="font-size: 50px; color:pink; text-align: center;" > {{$deaths}}  </h3>  
                                                                  
                             </div>
                        </div>

                      </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table id="myTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Artnumber</th> 
                            <th>Name</th>  
                            <th>CD4</th>                       
                            <th>Cat</th>   
                            <th>Health Facility</th>                              
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @for($i =0; $i < count($medications_id); $i++)
                        <tr>
                      
                            <td>{{ $i + 1}}</td>                           
                            <td>{{   $artnumber[$medications_id[$i]]  }}</td>   
                            <td>{{   $patientname[$medications_id[$i]]   }}</td>                                              
                            <td>{{  $value[$medications_id[$i]] }}</td> 
                            <td>{{  $stage[$medications_id[$i]]    }}</td>   
                            <td>{{   $healthunit[$medications_id[$i]]  }}</td> 
                                                                         
                            <td>
   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatient_<?php print_r($medications_id[$i]); ?>" >
         Edit
  </button>
                            </td>
                            <td>
  <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPatient_<?php print_r($medications_id[$i]); ?>" >
         View <i class="fa fa-angle-double-right" aria-hidden="true"></i>
  </button>
                            </td>
                            <td>
    <a href="{{route('medications.show', $medications_id[$i])}}" class="btn btn-info btn-sm" > 
         Patient History <i class="fa fa-angle-double-right" aria-hidden="true"></i>
    </a>
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
@for($i =0; $i < count($medications_id); $i++)
<div class="modal fade" id="editPatient_<?php print_r($medications_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Medication Administration Patient Form</h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('medications.update', $medications_id[$i]) }}">
              {{method_field('PATCH')}}
                        @csrf
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Patient Artnumber') }}</label>

                            <div class="col-md-6">
                                 
                            <input id="artnumber" type="text" class="form-control{{ $errors->has('artnumber') ? ' is-invalid' : '' }}" name="artnumber"  value ="{{  $artnumber[$medications_id[$i]] }}" disabled>   
                            <input id="artnumber" type="hidden" class="form-control{{ $errors->has('artnumber') ? ' is-invalid' : '' }}" name="artnumber"  value ="{{  $artnumber[$medications_id[$i]] }}">  
                            <input id="nextcolldate" type="hidden" class="form-control{{ $errors->has('nextcolldate') ? ' is-invalid' : '' }}" name="nextcolldate"  value ="{{  $nextcolldate[$medications_id[$i]] }}">  
                            <input id="primarycell" type="hidden" class="form-control{{ $errors->has('primarycell') ? ' is-invalid' : '' }}" name="primarycell"  value ="{{   $primarycell[$medications_id[$i]] }}">  
                          
                           
                                @if ($errors->has('artnumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('artnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="medication_id" class="col-md-4 col-form-label text-md-right">{{ __('Medication') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="medication_id" id="">
                                    @foreach($medicinedatatable as $medicine )
                                         <option value="{{$medicine ->id}}">{{$medicine ->art_type}}</option>
                                     @endforeach
                                </select>
                                  @if ($errors->has('formula_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('formula_id') }}</strong>
                                    </span>
                                 @endif                                
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="dosage_id" class="col-md-4 col-form-label text-md-right">{{ __('Dosage') }}</label>

                            <div class="col-md-6">
                                 <select class ="form-control" name="dosage_id" id="">
                                    @foreach($dosagedatatable as $dosage )
                                         <option value="{{$dosage ->id}}">{{$dosage ->dosage}}</option>
                                     @endforeach
                                 </select>
                                  @if ($errors->has('formula_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('formula_id') }}</strong>
                                    </span>
                                 @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="roa" class="col-md-4 col-form-label text-md-right">{{ __('Pills/day') }}</label>

                            <div class="col-md-6">
                                <input id="pills" type="number" class="form-control" name="pills" value ="{{  $pills[$medications_id[$i]]}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="effects_id" class="col-md-4 col-form-label text-md-right">{{ __('Side Effects or Other Problems') }}</label>

                            <div class="col-md-6">
                             <select class ="form-control" name="effects_id" id="">
                                    @foreach($effectsd as $effects )
                                         <option value="{{$effects ->id}}">{{$effects ->effect}}</option>
                                     @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="healthunit_id" class="col-md-4 col-form-label text-md-right">{{ __('Zaka Health Unit') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="healthunit_id" id="healthunit_id">
                                    @foreach($healthunitd as $units)
                                         <option value="{{$units ->id}}">{{$units ->healthunit}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="notes" class="col-md-4 col-form-label text-md-right">{{ __('Food  restrictions') }}</label>

                            <div class="col-md-6">
                                <textarea name="notes" id="" cols="30" rows="2" value ="{{  $notes[$medications_id[$i]]}}" required></textarea>
                               
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


@for($i =0; $i < count($medications_id); $i++)
                    
<div class="modal fade" id="viewPatient_<?php print_r($medications_id[$i]); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">View Patient Medication</h4>
       </div>
             <div class="modal-body"> 

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Patient No') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $artnumber[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('First Name') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $patientname[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Last Name ') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $patientsurname[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Medication') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{   $artmedication[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('CD4') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{  $value[$medications_id[$i]]   }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Health Facility') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{   $healthunit[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Next Collection Date') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{ $nextcolldate[$medications_id[$i]] }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Notes') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{ $notes[$medications_id[$i]]   }} 
                                                        
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Collected On') }}</strong></label>
                            
                            <div class="col-md-6">

                                     {{  $created_at[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="value" class="col-md-4  text-md-right"><strong>{{ __('Updated On') }}</strong></label>
                            
                            <div class="col-md-6">
                            
                                     {{   $updated_at[$medications_id[$i]]  }} 
                                                        
                            </div>
                        </div> 

                         <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                

                         </div>                 
                 </div>
             </div>
      </div>
 </div>

@endfor


@endsection