<?php

namespace App\Http\Controllers\Nurses;

use App\User;
use Alert;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class SMSLogController extends Controller
{
    //

    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayslog()
    {


              $currentdate = Carbon::today('Africa/Harare')->toFormattedDateString();

              $messagelogs = DB::table('messagelog')
                           ->where('SendTime','>=', DB::raw('curdate()'))
                           ->get();

              $messagelogsArray  = json_decode(json_encode($messagelogs), true);


              for($i = 0; $i < count($messagelogsArray); $i++){

                  $messagelog_id[$i]                    = $messagelogsArray[$i]['id'];

                  $messagestatus[$messagelog_id[$i]]    = $messagelogsArray[$i]['StatusCode'];

                  $messagetopatient[$messagelog_id[$i]]    = $messagelogsArray[$i]['MessageTo'];

                  $messagetext[$messagelog_id[$i]]  = $messagelogsArray[$i]['MessageText'];

                  //
                  
                
                  $messagetextperpatient[$messagetopatient[$messagelog_id[$i]]][$messagelogsArray[$i]['StatusCode']] = $messagelogsArray[$i]['MessageText'];

                  if(array_key_exists(300,$messagetextperpatient[$messagetopatient[$messagelog_id[$i]]]) && array_key_exists(201,$messagetextperpatient[$messagetopatient[$messagelog_id[$i]]])){
                    if($messagetextperpatient[$messagetopatient[$messagelog_id[$i]]][300] == $messagetextperpatient[$messagetopatient[$messagelog_id[$i]]][201]){
                      
                                            $failedthensuccessx[$messagetopatient[$messagelog_id[$i]]] = 1;
                      
                                        };
                  }
       

              };

              if(isset($messagelog_id)){

              $messagestatuscountx = array_count_values($messagestatus);

              $key = [200,201,300,301];

              for ($j = 0; $j < count($key); $j++){

              if(array_key_exists($key[$j],$messagestatuscountx)){

              $messagestatuscount[$key[$j]] = $messagestatuscountx[$key[$j]];

            }else{

              $messagestatuscount[$key[$j]] = 0;
              }
            }
              }else{

              $messagestatuscount = [
                '200' => 0,
                '201' => 0,
                '300' => 0,
                '301' => 0
              ];

            }



              $allsmssent = array_sum($messagestatuscount);

                if(isset($failedthensuccessx)){

                  $failedthensuccess = array_sum($failedthensuccessx);

                }else{

                  $failedthensuccess=0;
              
                }
              
              
              //
              $data = compact(
                'messagelogsArray',
                'messagestatuscount',
                'currentdate',
                'allsmssent',
                //'messagetextperpatient',
                'failedthensuccess'
              );

              return view('SMSLogs.todaystats',$data);


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

$currentdate = Carbon::today('Africa/Harare')->toFormattedDateString();

//   patients

      $patients = DB::table('patients')->get();

      $patientsArray = json_decode(json_encode($patients), true);

      for($i = 0 ; $i < count($patientsArray); $i++){

        $patient_id[$i]                  = $patientsArray[$i]['id'];

        $patient_cell[$patient_id[$i]]   = $patientsArray[$i]['primarycell'];

        $patientname[$patient_cell[$patient_id[$i]]] = $patientsArray[$i]['firstname'];

        $patientsurname[$patient_cell[$patient_id[$i]]] = $patientsArray[$i]['surname'];


      }

      //

      if($id != 300){

        $messagelogs = DB::table('messagelog')
        ->where('SendTime','>=', DB::raw('curdate()'))
        ->where('StatusCode', '=', $id)
        ->get();

      }else{

        $messagelogs = DB::select(DB::raw( 'SELECT * FROM messagelog WHERE SendTime >= CURDATE() AND StatusCode = 300 AND MessageTo NOT IN ( SELECT MessageTo FROM messagelog WHERE SendTime >= CURDATE() AND StatusCode= 201)' ));

      }
            
            $messagelogsArray  = json_decode(json_encode($messagelogs), true);

          for($i = 0; $i < count($messagelogsArray); $i++){

            $messagelog_idx[$i]                      = $messagelogsArray[$i]['id'];

            $messagecellnumber[$messagelog_idx[$i]]  = $messagelogsArray[$i]['MessageTo'];

            $messagename[$messagelog_idx[$i]]        = $patientname[$messagecellnumber[$messagelog_idx[$i]]];

            $messagesurname[$messagelog_idx[$i]]     = $patientsurname[$messagecellnumber[$messagelog_idx[$i]]];

            $smsmessage[$messagelog_idx[$i]]         = $messagelogsArray[$i]['MessageText'];

            $smsmessagestatus[$messagelog_idx[$i]]   = $messagelogsArray[$i]['StatusText'];

            $smsstatuscodex[$messagelog_idx[$i]]     =  $messagelogsArray[$i]['StatusCode'];

            if($smsstatuscodex[$messagelog_idx[$i]] == 200){

                $smsstatuscode[$messagelog_idx[$i]] = 'Sent';

            }elseif($smsstatuscodex[$messagelog_idx[$i]] == 201){

              $smsstatuscode[$messagelog_idx[$i]] = 'Delivered';

            }elseif($smsstatuscodex[$messagelog_idx[$i]] == 300){

              $smsstatuscode[$messagelog_idx[$i]] = 'Failed';

            }else{

              $smsstatuscode[$messagelog_idx[$i]] = 'Status Error';

            }

          };

if(!$messagelogsArray){

$messagelog_idx[0] = 0;

$smsstatuscode[0] = NULL;

$messagename[0] = NULL;

$messagesurname[0] = NULL;

$smsmessage[0] = NULL;

$smsmessagestatus[0] = NULL;

$messagecellnumber[0] = NULL;


};

if(isset($messagelog_idx)){
  
              $messagelog_id = $messagelog_idx;
  
          }else{
  
              $messagelog_id = NULL;
  
          }

          $data = compact(
              'messagelog_id',
              'messagecellnumber',
              'messagename',
              'messagesurname',
              'smsmessage',
              'smsmessagestatus',
              'currentdate',
              'smsstatuscode'
             // 'failedthensuccess1'
            );

        return view('SMSLogs.todaypartstats',$data);

    }

  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function Alllogs()
    {
      //   patients

            $patients = DB::table('patients')->get();

            $patientsArray = json_decode(json_encode($patients), true);

            for($i = 0 ; $i < count($patientsArray); $i++){

              $patient_id[$i]                  = $patientsArray[$i]['id'];

              $patient_cell[$patient_id[$i]]   = $patientsArray[$i]['primarycell'];

              $patientname[$patient_cell[$patient_id[$i]]] = $patientsArray[$i]['firstname'];

              $patientsurname[$patient_cell[$patient_id[$i]]] = $patientsArray[$i]['surname'];


            }
      //
      $messagelogs = DB::table('messagelog')
                   ->get();

      $messagelogsArray  = json_decode(json_encode($messagelogs), true);


      for($i = 0; $i < count($messagelogsArray); $i++){

        $messagelog_idx[$i]                      = $messagelogsArray[$i]['id'];

        $messagecellnumber[$messagelog_idx[$i]]  = $messagelogsArray[$i]['MessageTo'];

        $messagename[$messagelog_idx[$i]]        = $patientname[$messagecellnumber[$messagelog_idx[$i]]];

        $messagesurname[$messagelog_idx[$i]]     = $patientsurname[$messagecellnumber[$messagelog_idx[$i]]];

        $smsmessage[$messagelog_idx[$i]]         = $messagelogsArray[$i]['MessageText'];

        $smsmessagestatus[$messagelog_idx[$i]]   = $messagelogsArray[$i]['StatusText'];

        $smsmessagesenddate[$messagelog_idx[$i]]   = $messagelogsArray[$i]['SendTime'];

        $smsstatuscodex[$messagelog_idx[$i]]     =  $messagelogsArray[$i]['StatusCode'];

        $messagedate[$messagelog_idx[$i]]        = Carbon::createFromFormat('Y-m-d H:i:s',$smsmessagesenddate[$messagelog_idx[$i]])->toDateString();

        if($smsstatuscodex[$messagelog_idx[$i]] == 200){

            $smsstatuscode[$messagelog_idx[$i]] = 'Sent';

        }elseif($smsstatuscodex[$messagelog_idx[$i]] == 201){

          $smsstatuscode[$messagelog_idx[$i]] = 'Delivered';

        }elseif($smsstatuscodex[$messagelog_idx[$i]] == 300){

          $smsstatuscode[$messagelog_idx[$i]] = 'Failed';

        }else{

          $smsstatuscode[$messagelog_idx[$i]] = 'Status Error';

        }

      };

      if(isset($messagelog_idx)){
        
                    $messagelog_id = $messagelog_idx;
        
                }else{
        
                    $messagelog_id = NULL;
        
                }

$smstodate = count($messagelogsArray);

      $data = compact(
          'messagelog_id',
          'messagecellnumber',
          'messagename',
          'messagesurname',
          'smsmessage',
          'smsmessagestatus',
          //'currentdate',
          'smsstatuscode',
          'messagedate',
          'smstodate'
        );

    return view('SMSLogs.alllogs',$data);



    }


}
