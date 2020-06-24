<?php

namespace App\Http\Controllers\Nurses;

use App\Http\Controllers\Controller;
use DB;
use Alert;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Http\Resources\Patient as PatientResources;
use App\Http\Resources\HealthResources;

class PatientController extends Controller
{

  /**
   * @var \Illuminate\Http\Request
   */
  private $request;


  public function __construct(Request $request)
  {

      $this->request = $request;

  }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        //
        $patients = DB::table('patients')->
                         select('patients.id','firstname','surname','gender.gender',
                         'dateofbirth','artnumber','primarycell','secondarycell',
                         'messagemode.messagemode','activestatus_id','health_units.healthunit','messagelanguage.messagelanguage')
                         ->join('gender','patients.gender_id','=','gender.id')
                         ->join('messagelanguage','patients.messagelanguage_id','=','messagelanguage.id')
                          ->join('messagemode','patients.messagemode_id','=','messagemode.id') 
                          ->join('health_units','patients.healthunit_id','=','health_units.id')
                          ->paginate(10);
    
                       return PatientResources::collection($patients);
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $patient = $request->isMethod('put') ? Patient::findOrfail($request->patient_id): new Patient ;

       $patient ->id = $request -> input('patient_id');
       $patient->firstname =$request -> input('firstname');
       $patient->surname  = $request -> input('surname');
       $patient->artnumber = $request -> input('artnumber');
       $patient->gender_id = $request -> input('gender_id');
       $patient->primarycell = $request -> input('primarycell');
       $patient->secondarycell = $request -> input('secondarycell');
       $patient->messagemode_id  = $request -> input('messagemode_id');
       $patient->activestatus_id = $request -> input('activestatus_id');
       $patient->healthunit_id = $request -> input('healthunit_id');
       $patient->messagelanguage_id = $request -> input('messagelanguage_id');
     
       if ($patient ->save()) {
           # code...
           return new PatientResources($patient);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $patientx = Patient::findOrfail($id);

        return new PatientResources($patientx);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        //DB::table('patients')->where('id', '=', $id)->delete();

      //Softdelete
    //  DB::table('patients')->where('id', '=', $id)
       //   ->update(['activestatus_id'=>2]);

       
      // return redirect()->route('patient.index');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient =Patient::findOrfail($id);

        if ($patient->delete()) {
            # code...
            return new PatientResources($patient);
        }
    }


}
