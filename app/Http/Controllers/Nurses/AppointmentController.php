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

class AppointmentController extends Controller
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

      $messagetype = $request->input('messagetype');


   

        // to show appointments
        $rhspappointments = DB::table('hspappointment')->get();

        $rhspappointmentx   = json_decode(json_encode($rhspappointments), true);

        for($i = 0 ; $i < count($rhspappointmentx); $i++){

            $hspappointment_idx[$i] = $rhspappointmentx[$i]['id'];

            $hspappointmentx[$hspappointment_idx[$i]] = $rhspappointmentx[$i]['hspappointment'];

        };


        //art periods artresupplyperiod
        $rartperiods      = DB::table('artresupplyperiod')->get();

        $rartsupplyperiod   = json_decode(json_encode($rartperiods), true);

        for($i = 0 ; $i < count($rartsupplyperiod); $i++){

            $artsupplyperiod_id[$i] = $rartsupplyperiod[$i]['id'];

            $artsupplyperiod[$artsupplyperiod_id[$i]] = $rartsupplyperiod[$i]['artresupplyperiod'];

        };

        //tests
        $tests           = DB::table('tests')->get();

        $rtests   = json_decode(json_encode($tests), true);

        for($i = 0 ; $i < floor(count($rtests)/2); $i++){

                $testtype_idx[$i]                          = $rtests[$i]['id'];

                $testtypex[$testtype_idx[$i]]               = $rtests[$i]['testtype'];

                }

                for($i = floor(count($rtests)/2) ; $i < count($rtests); $i++){

                $testtype_idy[$i]                          = $rtests[$i]['id'];

                $testtypey[$testtype_idy[$i]]               = $rtests[$i]['testtype'];

                };

                for($i = 0 ; $i < count($rtests) ;$i++){

                $testtype_id[$i]                = $rtests[$i]['id'];

                $testtype[$testtype_id[$i]]     = $rtests[$i]['testtype'];

                }

                if ($messagetype == 'Appointments') {
                    # code...
                    $smsdata[0] = [
                        'messageto'  => $messageto,                                          
                        'messagetext' => $hspappointmentx[1]
                        ];
            
                } elseif ($messagetype == 'Drug Collection Date') {
                    # code...
                    $smsdata[1] = [
                        'messageto'  => $messageto,
                        'messagetext' => $artsupplyperiod[1]
                        ];
                }else {
                    # code...
                    $smsdata[2] = [
                        'messageto'  => $messageto,
                        'messagetext' => $testtype[1]
                        ];                         
                }
              
 $sentsms = DB::table('messageout')
         ->insert(
                   $smsdata
                 );

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
