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


class SupportController extends Controller
{
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
    public function supportsms(Request $request,User $user)
    {
      // Today's Date
      $sessiondatex = Carbon::now('Africa/Maputo')->toDateString();

      //

      $datax['username'] = $request->input('username');

      $messageto  = '+263775654020'; //make this number active status = 2 in patients table;

      $messagex = $request->input('supportsms');

      $messagesender = $request->input('username');
      ///

      $message   = $messagex." ".$messagesender;

      ///

               $smsdata = [
                'messageto'  => $messageto,
                'messagetext' => $message
                ];

    ///



$sentsms = DB::table('messageout')
         ->insert(
                   $smsdata
                 );




//Alert::success("SMS successfully sent to $messageto (Support), we'll be in touch")->persistent("Close");

/**/
Session::flash('success','SMS successfully sent to (Support), well be in touch.'); 
return redirect()->route('patient.index');


    }



}
