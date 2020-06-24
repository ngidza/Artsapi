@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  
                          <a href="{{route('patient.index')}}" class="btn btn-sm btn-outline-primary" >{{ __('SMS Tracing Portal') }}</a>
                      {{$patient->firstname}} {{$patient->surname}}
                </div>

                <div class="card-body">
                  <div class="row">
                        <div class="col-md-6">
                             <div class="card panel-default">
                                 <div class="card-body">
                                     <div class="text-center">
                                         <h4><font color="brown"><b>Defaulter Zone</b></font></h4>
                                             <p>Use this side if patient has defaulted on his/her ART treatment.</p>
                                           <button type="submit" class="btn btn-outline btn-lg" data-toggle="modal" data-target="#myModal1ART" id='submitBtn'><font color="brown"><b>Enter</b></font></button>

                                      </div>                           
                                  </div>
                              </div>
                          </div>

                        <div class="col-md-6">
                             <div class="card panel-default">
                                 <div class="card-body">
                                     <div class="text-center">
                                        <h4><font color="#fe6903"><b>Test Results</b></font></h4>
                                          <p>Click button below to send sms to patient with regards to Tests.SMS will be sent to the patient only once.</p>
                                           <button type="submit" class="btn btn-outline btn-lg" data-toggle="modal" data-target="#myModal1Test" id='submitBtn'><font color="#fe6903"><b>Enter</b></font></button>
                                      </div>                           
                                  </div>
                              </div>
                        </div>

                        <div class="col-md-6">
                             <div class="card panel-default">
                                 <div class="card-body">
                                     <div class="text-center">
                                        <h4><font color="#fe6903"><b>Patients Appointments</b></font></h4>
                                          <p>Click button below to send sms to patient appointment will be sent only once.</p>
                                           <button type="submit" class="btn btn-outline btn-lg" data-toggle="modal" data-target="#myModalApp" id='submitBtn'><font color="#fe6903"><b>Enter</b></font></button>
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

<div class="modal fade" id="myModal1Test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send SMS for Tests </h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('sms.testresults') }}">
              {{method_field('POST')}}
                        @csrf

                         <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id"   value="{{ $patient->id }}">   
                         <input id="username" type="hidden" class="form-control{{ $errors->has('patient_cell') ? ' is-invalid' : '' }}" name="patient_cell"   value="{{ $patient->primarycell }}">  
                         <font color='green'> Select <b>ONE</b> option from below depending on the situation</font>

                         <table class="display">
                        <?php

                        $msgtype = array(

                          'Routine Results',
                          'Urgent Results'
                            /*'Collect - English',
                            'Collect - Shona',
                            'Urgent - English',
                            'Urgent - Shona'*/
                        );


                        $msg = array(
                            'Dear Client, your result is back. You will recieve the results when you come to the clinic as per your next booked appointment.',
                            'Hamayadiwa,(maresults)dudziro dzenyu dzakadzoka. Tichakupai dudziro idzi pamunouya kukiriniki pazuva ramakapiwa',
                            'Dear Client, your result is back. We encourage you to come to the clinic as soon as possible. Hope to see you soon.Thank you.',
                            'Hamayadiwa,(maresults) dudziro dzenyu dzakadzoka.Tinokurudzira kuti muuye kukiriniki nekukasira. Tinotarisira kukuonai munguva shoma inotevera, tatenda.'
                        );

                        $key =[3,4,5,6];

                        for($i = 0; $i < 2; $i++) {


                            echo "

            <tr class = \"msgs\">
                <th><td align=\"left\"><b>$msgtype[$i]</b></td>
                <td align=\"left\"><font color=\"white\">abc</font></td>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"messagetype\" value=\"$msgtype[$i] \" data-toggle=\"collapse\" data-target=\"#demomsg$i\">
                        </label>
                    </td>
                </th>
            </tr>

                                ";
                        };

                        ?>
                    </table>

                    <div id="demomsg0" class="collapse">
                       <div class="form-group row">                       
                            <label for="username" class="col-md-4 text-md-right">{{ __('You are about to sent these messages:') }}</label>

                            <div class="col-md-6">
                                     <p><b>Message 1</b>: {{ $msg[0] }}</p>
                                      
                                      <p><b>Message 1(Shona)</b>: {{ $msg[1] }}</p>
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{$patient->primarycell}}</font>
                            </div>
                         </div>  

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>

                 </div> 

 
 
               <div id="demomsg1" class="collapse">
               <font color='red'>You are about to sent this message:</font>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Message 1') }}</label>
                           
                            <div class="col-md-6">
                           
                            {{ $msg[0] }}
                            </div>
                        </div>  

                          <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Message 1(Shona)') }}</label>
                           
                            <div class="col-md-6">
                           
                            {{ $msg[1] }}
                            </div>
                        </div>                

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('You are about to send these messages:') }}</label>

                            <div class="col-md-6">
                               
                           
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{ $patient->primarycell }}</font>
                               
                            </div>
                        </div> 
                       
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->


<div class="modal fade" id="myModal1ART" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Defaulter Reminder SMS </h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('tracepatient.store') }}">
              {{method_field('POST')}}
                        @csrf

                         <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id"   value="{{ $patient->id }}">   
                         <input id="username" type="hidden" class="form-control{{ $errors->has('patient_cell') ? ' is-invalid' : '' }}" name="patient_cell"   value="{{ $patient->primarycell }}">  

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
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('You are about to send these messages:') }}</label>

                            <div class="col-md-6">
                               
                            <p><b>Message 1</b>: Dear Client, you have missed your booked appointment. We encourage you to come for review as soon as possible.</p>
                            <p><b>Message 1(Shona)</b>: Hamayadiwa, hamuna kuvuya pataitarisira kuti muchavuya. Tirikukurudzirai kuti muuye nekukasira.</p>
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{ $patient->primarycell }}</font>
                               
                            </div>
                        </div> 
                       
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
         </div>
      </div><!--modal-body -->
    </div><!--modal-content -->
  </div><!--modal-dialog -->
</div><!--modal fade -->


<div class="modal fade" id="myModalApp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send SMS for Appointments </h4>
      </div>
        <div class="modal-body">
        <form method="POST" action="{{ route('sms.appointment') }}">
              {{method_field('POST')}}
                        @csrf

                         <input id="patient_id" type="hidden" class="form-control{{ $errors->has('patient_id') ? ' is-invalid' : '' }}" name="patient_id"   value="{{ $patient->id }}">   
                         <input id="username" type="hidden" class="form-control{{ $errors->has('patient_cell') ? ' is-invalid' : '' }}" name="patient_cell"   value="{{ $patient->primarycell }}">  
                         <font color='green'> Select <b>ONE</b> option from below for on the situation</font>

                         <table class="display">
                        <?php

                        $msgtype = array(

                          'Appointments',
                          'Drug Collection Date',
                          'Testing/ Review'
                           
                        );


                        $msg = array(
                            'Remember: you have a doctor’s appointment tomorrow',
                            'drug collection',
                            'testing',
                            'review.'
                        );

                        $key =[4,5,6,7];

                        for($i = 0; $i < 3; $i++) {


                            echo "

            <tr class = \"msgs\">
                <th><td align=\"left\"><b>$msgtype[$i]</b></td>
                <td align=\"left\"><font color=\"white\">abc</font></td>
                    <td>
                        <label>
                            <input type=\"checkbox\" name=\"messagetype\" value=\"$msgtype[$i] \" data-toggle=\"collapse\" data-target=\"#demomsg$i\">
                        </label>
                    </td>
                </th>
            </tr>

                                ";
                        };

                        ?>
                    </table>

                    <div id="demomsg0" class="collapse">
                       <div class="form-group row">                       
                            <label for="username" class="col-md-4 text-md-right">{{ __('You are about to sent these messages:') }}</label>

                            <div class="col-md-6">
                                     <p><b>Message 1</b>: {{ $msg[0] }}</p>
                                      
                                      <p><b>Message 1(Shona)</b>: {{ $msg[0] }}</p>
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{$patient->primarycell}}</font>
                            </div>
                         </div>  

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>

                 </div> 

                 <div id="demomsg2" class="collapse">
                       <div class="form-group row">                       
                            <label for="username" class="col-md-4 text-md-right">{{ __('You are about to sent these messages:') }}</label>

                            <div class="col-md-6">
                                     <p><b>Message 1</b>: {{ $msg[2] }}</p>
                                      
                                      <p><b>Message 1(Shona)</b>: {{ $msg[2] }}</p>
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{$patient->primarycell}}</font>
                            </div>
                         </div>  

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>

                 </div> 
 
               <div id="demomsg1" class="collapse">
               <font color='red'>You are about to sent this message:</font>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Message 1') }}</label>
                           
                            <div class="col-md-6">
                           
                            {{ $msg[1] }}
                            </div>
                        </div>  

                          <div class="form-group row">
                            <label for="username" class="col-md-4 text-md-right">{{ __('Message 1(Shona)') }}</label>
                           
                            <div class="col-md-6">
                           
                            {{ $msg[1] }}
                            </div>
                        </div>                

                        <div class="form-group row">
                            <label for="patient_no" class="col-md-4 text-md-right">{{ __('You are about to send these messages:') }}</label>

                            <div class="col-md-6">
                               
                           
                            To:<b> {{$patient->firstname}} {{$patient->surname}} </b> <br> cell:<font color="blue">{{ $patient->primarycell }}</font>
                               
                            </div>
                        </div> 
                       
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
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
