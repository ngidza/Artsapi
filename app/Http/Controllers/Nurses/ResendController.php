<?php

namespace App\Http\Controllers\Nurses;

use App\Http\Controllers\Controller;
use App\User;
use Alert;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class ResendController extends Controller
{
    //
     //
    /**
     * @var \Illuminate\Http\Request
     * @param \App\User         $user
     */
    private $request;
    
    
        public function __construct(Request $request ,User $user )
        {
    
            $this->request  = $request;
            $this->user     = $user;
    
        }
    
        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function resendsms(Request $request,User $user)
        {
          // Today's Date
          $sessiondatex = Carbon::now('Africa/Maputo')->toDateString();

    
          $messageto = $request->input('patient_cell');
    
          $message = $request->input('patient_sms');
    
          
    
          ///
    
                   $smsdata = [
                    'messageto'  => $messageto,
                    'messagetext' => $message
                    ];
    
    //
    
    
    $sentsms = DB::table('messageout')
             ->insert(
                       $smsdata
                     );
    
    
    
    
    //::success("SMS successfully resent to $messageto")->persistent("Close");
    
    /**/
    Session::flash('success','SMS successfully resent.'); 
    return redirect()->route('sms.todaystats');
    
    
        }
    
}
