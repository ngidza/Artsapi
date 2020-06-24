<?php

namespace App\Http\Controllers\Nurses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Alert;
use DB;
use Auth;
use Carbon\Carbon;
use Session;


class TestResultsSMSController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request ,User $user)
    {
        $this->middleware('auth');
        $this->request  = $request;
        $this->user     = $user;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function testresults(Request $request,User $user)
    {
      // Today's Date
      $sessiondatex = Carbon::now('Africa/Maputo')->toDateString();
      
      //

      $datax['patient_id'] = $request->input('patient_id');

      $messageto  = $request->input('patient_cell');

      $messagetype = $request->input('messagetype');

      //

        $messages = DB::table('messages')->get();

        $messagesArray  = json_decode(json_encode($messages), true);

        for($i = 0; $i < count($messagesArray); $i++){

          $message_id[$i]    = $messagesArray[$i]['id'];

          $message[$message_id[$i]]    = $messagesArray[$i]['message'];
    }

      //
if($messagetype == 'Collection'){


             $smsdata[0] = [
              'messageto'  => $messageto,
              'messagetext' => $message[3]
              ];

              $smsdata[1] = [
                    'messageto'  => $messageto,
                    'messagetext' => $message[4]
                    ];


}else{


               $smsdata[0] = [
                'messageto'  => $messageto,
                'messagetext' => $message[5]
                ];

                $smsdata[1] = [
                      'messageto'  => $messageto,
                      'messagetext' => $message[6]
                      ];

};

//


$sentsms = DB::table('messageout')
         ->insert(
                   $smsdata
                 );




//Alert::success("SMS successfully sent to $messageto")->persistent("Close");

/**/
Session::flash('success','SMS successfully sent.'); 
return redirect()->route('patient.index');


    }
}
