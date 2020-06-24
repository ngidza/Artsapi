@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <a href="{{route('patient.index')}}" class="btn btn-sm btn-outline-primary" >{{$allsmssent}} SMS's processed
                         <?php print_r($currentdate) ;?>
                </a>
                   
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                    
                            <a class="btn btn-outline-primary btn-block" href="{{route('todaylog.show',[200])}}">
                                <div class="form-group row">
                                    <label for="username" class="col-md-4 text-md-right">{{ __('SMSs Pending') }}</label>

                                    <div class="col-md-6">
                                        <font color="blue"><h1>{{ $messagestatuscount[200] }}</h1></font>
                                    </div>

                                </div>   
                            </a>
                          
                         <a class="btn btn-outline-primary btn-block" href="{{route('todaylog.show',[201])}}">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 text-md-right">{{ __('Delivered SMSs') }}</label>

                                <div class="col-md-6">
                                     <font color="#42c31b"><h1>{{$messagestatuscount[201]}}</h1></font>
                                </div>

                            </div>   
                         </a>
                         <a class="btn btn-outline-primary btn-block" href="{{route('todaylog.show',[301])}}">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 text-md-right">{{ __('Status Errors') }}</label>

                                <div class="col-md-6">
                                      <font color="orange"><h1>{{$messagestatuscount[301]}}</h1></font>
                                </div>

                            </div>   
                         </a>
                         <a class="btn btn-outline-primary btn-block" href="{{route('todaylog.show',[300])}}">
                            <div class="form-group row">
                                <label for="username" class="col-md-4 text-md-right">{{ __('Failed') }}</label>

                                <div class="col-md-6">
                                      <font color="red"><h1>{{$messagestatuscount[300] - $failedthensuccess}}</h1></font>
                                </div>

                            </div>   
                         </a>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
