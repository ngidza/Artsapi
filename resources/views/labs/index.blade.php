@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{route('lab.dashboard')}}" class="btn btn-sm btn-outline-primary">CD4 Count Dashboard</a>
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
                            <th>CD4</th>   
                            <th>Category</th>                       
                            <th>Art Summary</th>   
                            <th>TB</th>                         
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @for($i =0; $i < count($count_id); $i++) 
                        <tr>
                      
                            <td>{{ $i + 1}}</td>
                            <td>{{ $patientname[$count_id[$i]]  }}</td>
                            <td>{{   $artnumber[$count_id[$i]] }}</td>
                            <td>{{   $cd4number[$count_id[$i]] }}</td>   
                            <td>{{  $stage[$count_id[$i]] }}</td>                                              
                            <td>{{ $artsummary[$count_id[$i]]   }}</td>            
                            <td>{{  $tb[$count_id[$i]] }}</td>                                                           
                            <td>
   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editPatient_{{  $count_id[$i] }}" >
         Edit
  </button>
                            </td>
                            <td>
    <a href="{{route('counts.show',$count_id[$i])}}" class="btn btn-info btn-sm" > Lab History</a>
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
@for($i =0; $i < count($count_id); $i++)
<div class="modal fade" id="editPatient_{{ $count_id[$i] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> ART Patient Form</h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('counts.update', $count_id[$i] ) }}">
              {{method_field('PATCH')}}
                        @csrf
                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('Patient Artnumber') }}</label>

                            <div class="col-md-6">
                                 
                            <input id="artnumber" type="text" class="form-control{{ $errors->has('artnumber') ? ' is-invalid' : '' }}" name="artnumber"  value ="{{ $artnumber[$count_id[$i]] }}" disabled>   
                            <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id"  value ="{{   $patient_id[$count_id[$i]]   }}" > 
                                @if ($errors->has('artnumber'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('artnumber') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cd4" class="col-md-4 col-form-label text-md-right">{{ __('CD4') }}</label>

                            <div class="col-md-6">
                                <input id="cd4" type="number" class="form-control" name="cd4" value ="{{$cd4number[$count_id[$i]]}}" required>
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="tb_id" class="col-md-4 col-form-label text-md-right">{{ __('TB status') }}</label>

                            <div class="col-md-6">
                              <select class ="form-control" name="tb_id" id="tb_id">
                                    @foreach($tbd as $tbs)
                                         <option value="{{$tbs ->id}}">{{$tbs ->tb}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>
                                               
                         <div class="form-group row">
                            <label for="careentry_id" class="col-md-4 col-form-label text-md-right">{{ __('Care entry point') }}</label>

                            <div class="col-md-6">
                               <select class ="form-control" name="careentry_id" id="careentry_id">
                                    @foreach($careentryd as $careentrys)
                                         <option value="{{$careentrys ->id}}">{{$careentrys ->careentry}}</option>                                   
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="artsummary_id" class="col-md-4 col-form-label text-md-right">{{ __('ART summary') }}</label>

                            <div class="col-md-6">
                             <select class ="form-control" name="artsummary_id" id="artsummary_id">
                                    @foreach($artsummaryd as $artsummarys)
                                         <option value="{{$artsummarys ->id}}">{{$artsummarys ->artsummary}}</option>                                   
                                    @endforeach
                                   
                                </select>
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

@endsection