<?php

namespace App\Http\Controllers\Labs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Count;
use DB;
use App\Medication;

class CD4countController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientdatatable = DB::table('patients')->get();
        $patientdataarray  = json_decode(json_encode($patientdatatable), true);
        for ($i=0; $i < count($patientdataarray) ; $i++) { 
            # code...
            $artnumberx_id[$i]                =$patientdataarray[$i]['id'];
            $patientnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['firstname']; 
            $patientsurnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['surname']; 
            $artnumberx[$artnumberx_id[$i]]  =$patientdataarray[$i]['artnumber']; 
        }

        $careentryd = DB::table('care_entrys')->get();
        $careentrya  = json_decode(json_encode($careentryd), true);
        for ($i=0; $i < count($careentrya) ; $i++) { 
            # code...
            $careentry_idx[$i]                =$careentrya[$i]['id'];
            $careentryx[$careentry_idx[$i]]  =$careentrya[$i]['careentry']; 
           
        }

        $artsummaryd = DB::table('artsummarys')->get();
        $artsummarya  = json_decode(json_encode($artsummaryd), true);
        for ($i=0; $i < count($artsummarya) ; $i++) { 
            # code...
            $artsummary_idx[$i]                =$artsummarya[$i]['id'];
            $artsummaryx[$artsummary_idx[$i]]  =$artsummarya[$i]['artsummary']; 
           
        }
        $tbd = DB::table('tbs')->get();
        $tbda  = json_decode(json_encode($tbd), true);
        for ($i=0; $i < count($tbda) ; $i++) { 
            # code...
            $tb_idx[$i]                =$tbda[$i]['id'];
            $tbx[$tb_idx[$i]]  =$tbda[$i]['tb']; 
           
        }

        $CD4countdatatable = DB::table('counts')->latest()->get();
        $CD4countdataarray = json_decode(json_encode($CD4countdatatable),true);
        for ($i=0; $i <count($CD4countdataarray) ; $i++) {          
            # code...
             $count_id[$i]                =$CD4countdataarray[$i]['id'];           
             $patient_id[$count_id[$i]]    = $CD4countdataarray[$i]['patient_id'];
             $stage[$count_id[$i]]       = $CD4countdataarray[$i]['stage'];
             $cd4number[$count_id[$i]]       = $CD4countdataarray[$i]['value'];
             $tb_id[$count_id[$i]]   =$CD4countdataarray[$i]['tb_id'];
             $created_at[$count_id[$i]]       = $CD4countdataarray[$i]['created_at'];
             $careentry_id[$count_id[$i]]   =$CD4countdataarray[$i]['careentry_id'];
             $artsummary_id[$count_id[$i]]   =$CD4countdataarray[$i]['artsummary_id'];
             $artnumber[$count_id[$i]]    =   $artnumberx[$patient_id[$count_id[$i]]];
             $patientname[$count_id[$i]]    =  $patientnamex[$patient_id[$count_id[$i]]];
             $patientsurname[$count_id[$i]]  =  $patientsurnamex[$patient_id[$count_id[$i]]];
             $careentry[$count_id[$i]]   = $careentryx[$careentry_id[$count_id[$i]]];
             $artsummary[$count_id[$i]]   = $artsummaryx[$artsummary_id[$count_id[$i]]];
             $tb[$count_id[$i]]   = $tbx[$tb_id[$count_id[$i]]];
        }

        $data = compact(
                    'count_id',
                    'tb',
                    'tbd',
                    'artsummaryd',
                    'careentryd',
                    'artsummary',
                    'careentry',
                    'cd4number',
                    'patient_id',
                    'created_at',
                    'artnumber',
                    'stage',            
                    'patientname'
                 
                );

        return view('labs.index',$data);
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
        $CD4countdatatable =DB::table('counts')
                            ->select('stage','artsummary','tb','value','careentry','artnumber','counts.created_at','counts.updated_at','firstname','surname')
                            ->join('patients','counts.patient_id','=','patients.id')
                            ->join('tbs','counts.tb_id','=','tbs.id')
                            ->join('artsummarys','counts.artsummary_id','=','artsummarys.id')
                            ->join('care_entrys','counts.careentry_id','=','care_entrys.id')
                            ->where('counts.id', $id)
                            ->get();
              $data =compact('CD4countdatatable');  
              
              return view('labs.show',$data);
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
     
     $this->validate(request(),[
         
            'cd4' =>'required',        
            'patient_id' =>'required',        
            'tb_id' =>'required',
            'careentry_id' =>'required',
            'artsummary_id' =>'required',
            ]); 
           
            $datax['cd4'] = $request['cd4'];
                             switch ($request['cd4']) {
                                    case ($request['cd4'] < 200 ):
                                    $datax['stage'] =  'A3';       
                                        break;

                                    case ($request['cd4'] < 500):
                                    $datax['stage'] =  'A2';      
                                            break;

                                    case ($request['cd4'] > 500):
                                    $datax['stage'] =   'A1';      
                                         break;                                 
                                                           
                                    default:
                                    $datax['stage'] =   'Error'; 
                                        break;
                                } 
          
                    $datax['tb_id'] = $request['tb_id'];
                    $datax['careentry_id'] = $request['careentry_id'];
                    $datax['artsummary_id'] = $request['artsummary_id'];                 
                   
                        $data = Count::find($id);
        
                        $data['stage']          = trim(strip_tags(htmlspecialchars($datax['stage'])));
                        $data['value']          = trim(strip_tags(htmlspecialchars($datax['cd4'])));
                        $data['tb_id']    = trim(strip_tags(htmlspecialchars($datax['tb_id'])));
                        $data['careentry_id']          = trim(strip_tags(htmlspecialchars($datax['careentry_id'])));
                        $data['artsummary_id']          = trim(strip_tags(htmlspecialchars($datax['artsummary_id'])));                     
                   
                    $data ->save();

          $data = new  Medication();
  
            $data -> patient_id= $request['patient_id'];
            $data['stage']          = trim(strip_tags(htmlspecialchars($datax['stage'])));
            $data['value']          = trim(strip_tags(htmlspecialchars($datax['cd4'])));   
            $data['dosage_id']      = 1;
            $data['medication_id']     = 1;    
            $data['nextcolldate']        = date('Y-m-d', strtotime(date('Y-m-d'). ' - 3 days'));
                   
            $data ->save();

//         $data=  Medication::find($id);
        
//             $data['level']             = trim(strip_tags(htmlspecialchars($datax['level'])));
//             $data['cd4']           = trim(strip_tags(htmlspecialchars($request['cd4'])));
   
//         $data ->save();
        return redirect()->route('counts.index'); 
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
