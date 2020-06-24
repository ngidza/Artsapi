<?php

namespace App\Http\Controllers\Nurses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Weight;
use DB;
use Session;

class WeightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       

        $patientdatatable = DB::table('patients')->get();
        $patientdataarray  = json_decode(json_encode($patientdatatable), true);
        for ($i=0; $i < count($patientdataarray) ; $i++) { 
            # code...
            $artnumberx_id[$i]                =$patientdataarray[$i]['id'];
            $patientnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['firstname']; 
            $patientsurnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['surname']; 
            $artnumberx[$artnumberx_id[$i]]  =$patientdataarray[$i]['artnumber']; 
        }

        
        $clinicalstagesd = DB::table('clinical_stages')->get();
        
        $clinicalstagesarray  = json_decode(json_encode($clinicalstagesd), true);
        for ($i=0; $i < count($clinicalstagesarray) ; $i++) { 
            # code...
            $clinical_stages_idx[$i]                =$clinicalstagesarray[$i]['id'];
            $clinicalstagesx[$clinical_stages_idx[$i]]  =$clinicalstagesarray[$i]['clinical_stages']; 
   
        }

        $functionalstatusd =DB::table('functional_status')->get();
        $functionalstatusarray  = json_decode(json_encode($functionalstatusd), true);
        for ($i=0; $i < count($functionalstatusarray) ; $i++) { 
            # code...
            $functional_status_idx[$i]                =$functionalstatusarray[$i]['id'];
            $functional_statusx[$functional_status_idx[$i]]  =$functionalstatusarray[$i]['functional_status']; 
   
        }
        
        $weightsdatatable = DB::table('weights')->get();
        $weightsdataarray = json_decode(json_encode($weightsdatatable),true);
        for ($i=0; $i <count($weightsdataarray) ; $i++) {          
            # code...
             $weights_id[$i]                =$weightsdataarray[$i]['id'];           
             $patient_id[$weights_id[$i]]    = $weightsdataarray[$i]['patient_id'];
             $value[$weights_id[$i]]       = $weightsdataarray[$i]['value'];
             $weight[$weights_id[$i]]       = $weightsdataarray[$i]['weight'];
             $height[$weights_id[$i]]       = $weightsdataarray[$i]['height'];
             $clinical_stages_id[$weights_id[$i]]       = $weightsdataarray[$i]['clinical_stages_id'];
             $clinicalstages[$weights_id[$i]]       =   $clinicalstagesx[$clinical_stages_id[$weights_id[$i]]];
             $functional_status_id[$weights_id[$i]]       = $weightsdataarray[$i]['functional_status_id'];
             $functionalstatus[$weights_id[$i]]       =  $functional_statusx[$functional_status_id[$weights_id[$i]]];
             $temperature[$weights_id[$i]]   =$weightsdataarray[$i]['temperature'];
             $created_at[$weights_id[$i]]   =$weightsdataarray[$i]['created_at'];
             $updated_at[$weights_id[$i]]   =$weightsdataarray[$i]['updated_at'];
             $artnumber[$weights_id[$i]]    =   $artnumberx[$patient_id[$weights_id[$i]]];
             $patientname[$weights_id[$i]]    =  $patientnamex[$patient_id[$weights_id[$i]]];
             $patientsurname[$weights_id[$i]]    =  $patientsurnamex[$patient_id[$weights_id[$i]]];

          
        }

        $data = compact('value','height','clinicalstagesd','functionalstatusd','clinicalstages','created_at','functionalstatus','updated_at','patientsurname','weight','weights_id','patientname','temperature','artnumber');

        return view('nurses.weights.index',$data);
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
    public function store(Request $request)
    {
        //
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
        $this->validate(request(),[
            //put fields to be validated here  
            'clinical_stages_id' =>'required',     
            'functional_status_id' =>'required',
            'weight' =>'required',
            'height' =>'required',
            'temperature' =>'required',
           
            ]); 
                
    $weight = Weight::find($id);

    $weight-> clinical_stages_id = $request['clinical_stages_id'];
    $weight-> functional_status_id = $request['functional_status_id'];
    $weight-> weight = $request['weight'];
    $weight-> height = $request['height'];
    $weight-> value =$request['weight']/($request['height']*$request['height']);
    $weight-> temperature= $request['temperature'];
    $weight->save();

    if ($weight->save()) {
        Session::flash('success','Patient weights successfuly Upadated.');
            return redirect()->route('weights.index');
    }
   
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
