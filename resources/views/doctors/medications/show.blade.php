@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <a href="{{route('medications.index')}}" class="btn btn-sm btn-outline-primary">ARVs Medication Patient History</a>
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
                            <th>Surname</th>
                            <th>Artnumber</th>   
                            <th>CD4</th>                       
                            <th>Level</th>   
                            <th>Doasage</th>   
                            <th>ARVs</th>                                              
                            <th>Visited On</th>                         
                            <th>Updated On</th> 
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($medicationdatatable as $key => $CD4countdata )
                        <tr>
                      
                            <td>{{ $key + 1}}</td>
                            <td>{{ $CD4countdata ->firstname }}</td>
                            <td>{{  $CD4countdata ->surname }}</td>
                            <td>{{  $CD4countdata ->artnumber}}</td>   
                            <td>{{ $CD4countdata ->value}}</td>                                              
                            <td>{{ $CD4countdata ->stage }}</td>
                            <td>{{ $CD4countdata ->dosage }}</td>
                            <td>{{ $CD4countdata  ->art_type}}</td>                                                              
                            <td>{{ $CD4countdata  ->created_at}}</td> 
                            <td>{{ $CD4countdata  ->updated_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                  
            
                </div>
            </div>
        </div>
    </div>
</div>

@endsection