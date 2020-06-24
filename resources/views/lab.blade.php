@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lab Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     <div class="row">
                       
                       <div class="col-xs-6 col-md-4">
                            <div class="card mb-4 box-shadow">
                               <img class="card-img-top" >
                                     <div class="card-body">
                                       <p class="card-text"> 
                                       CD4 Count Viral Load
                                       </p>   
                                           <div class="d-flex justify-content-between align-items-center">
                                               <div class="btn-group">
                                                   <a  href="{{route('counts.index')}}" class="btn btn-sm btn-outline-secondary"> CD4 Count <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                           
                                               </div>
                                           </div>
                                        </div>
                             </div>
                        </div>

                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
