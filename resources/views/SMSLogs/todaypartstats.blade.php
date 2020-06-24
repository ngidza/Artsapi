@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> 
                <a href="{{route('sms.todaystats')}}" class="btn btn-sm btn-outline-primary" >
                <?php print_r($currentdate) ;?>
                
                </a>
                SMS's {{$smsstatuscode[$messagelog_id[0]]}}
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
                                       <th scope="col">Cell Number</th>
                                			 <th scope="col">SMS Status</th>
                                			 <th scope="col">View SMS</th>
                                		</tr>
                                	</thead>
                                	<tbody>
                                		
                                         @for($i = 0; $i < count($messagelog_id); $i++)
                                  
                                      <tr>
                                          <td><?php print_r($i+1); ?> </td>
                                          <td><?php print_r($messagename[$messagelog_id[$i]]); ?></td>
                                          <td><?php print_r($messagesurname[$messagelog_id[$i]]); ?></td>
                                          <td><?php print_r($messagecellnumber[$messagelog_id[$i]]); ?></td>
                                          <td><?php print_r($smsstatuscode[$messagelog_id[$i]]); ?></td>
                                          <td><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#sms_<?php print_r($messagelog_id[$i]);?>"> view >></button></td>
                                      </tr>
                                        @endfor
                                	</tbody>

                                	</table>
                </div>
            </div>
        </div>
    </div>
</div>


@for($i = 0; $i < count($messagelog_id); $i++)

<div class="modal fade" id="sms_<?php print_r($messagelog_id[$i]);?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> <?php print_r($messagecellnumber[$messagelog_id[$i]]);?></h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('sms.resend') }}">
              {{method_field('POST')}}
                        @csrf
                        <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                           
                            <?php print_r($smsstatuscode[$messagelog_id[$i]]); ?>
                                
                            </div>
                        </div>               

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('SMS') }}</label>

                            <div class="col-md-6">
                               
                            <?php print_r($smsmessage[$messagelog_id[$i]]); ?>
                               
                            </div>
                        </div>

                          <input id="patient_cell" type="hidden" class="form-control{{ $errors->has('patient_cell') ? ' is-invalid' : '' }}" name="patient_cell" value="{{ $messagecellnumber[$messagelog_id[$i]] }}" required autofocus>
                           <input id="patient_sms" type="hidden" class="form-control{{ $errors->has('patient_sms') ? ' is-invalid' : '' }}" name="patient_sms" value="{{ $smsmessage[$messagelog_id[$i]] }}" required autofocus>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('re-send SMS') }}
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
