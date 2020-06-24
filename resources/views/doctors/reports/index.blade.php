@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <a href="{{route('admin.dashboard')}}" class="btn btn-sm btn-outline-primary">ART Patients Reports Dashboard</a>    
                 </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{route('reports.store')}}">
                        @csrf

                        <div class="form-group row">
                            <label for="patient_id" class="col-md-4 col-form-label text-md-right">{{ __('Patient Name') }}</label>

                            <div class="col-md-6">
                                <select class ="form-control" name="patient_id" id="">
                                  @foreach( $patientdatatable  as  $patient)
                                    <option value="{{$patient ->id}}">{{$patient->firstname}}</option>
                                  @endforeach
                                 </select>

                                @if ($errors->has('patient_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('patient_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="report" class="col-md-4 col-form-label text-md-right">{{ __('Reports') }}</label>

                            <div class="col-md-6">
                                    <select class ="form-control" name="report" id="">
                                    
                                            <option value="medications">CD4 Count </option>                                      
                                            <option value="weights">BMI</option>
                                           
                                          
                                    </select>

                                @if ($errors->has('report'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('report') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Types Of Graph') }}</label>

                            <div class="col-md-6">
                                    <select class ="form-control" name="type" id="">

                                          <option value ="scatter">Scatter Graph</option>
                                          <option value ="area"> Area Chart</option>
                                          <option value ="areaspline"> Area Spine Chart </option>
                                          <option value ="spline"> Spline Chart</option>
                                          <option value ="column">Column Chart</option> 
                                          <option value ="line">  Line graph</option>
                                          <option value ="bar"> Bar Graph </option>
                                          <option value ="pie"> Pie Chart</option>

                                    </select>
                               
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
