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

class TraceSMSController extends Controller
{

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function patientindex($patient_id)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $user )
    {
         
      // Today's Date
      $sessiondatex = Carbon::now('Africa/Maputo')->toDateString();

      //

      $datax['patient_id'] = $request->input('patient_id');

      $messageto  = $request->input('patient_cell');

      //

        $messages = DB::table('messages')->get();

        $messagesArray  = json_decode(json_encode($messages), true);

      //

  for($i = 0; $i < count($messagesArray); $i++){

    $message_id[$i]              = $messagesArray[$i]['id'];

    $message[$message_id[$i]]    = $messagesArray[$i]['message'];

    }

    $smsdata[0] = [
        'messageto'  => $messageto,
        'messagetext' => $message[1]
        ];

    $smsdata[1] = [
                'messageto'  => $messageto,
                'messagetext' => $message[2]
                ];

    $sentsms = DB::table('messageout')
                ->insert(
                            $smsdata
                        );

        // Alert::success("SMS successfully sent to $messageto")->persistent("Close");

    /**/
    Session::flash('success','SMS successfully sent.'); 
        return redirect()->route('patient.index');


        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
