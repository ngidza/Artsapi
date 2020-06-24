<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Medication;
use DB;
use Session;
class MedicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $countArtPatients = DB::table('patients')->select('id')->where('activestatus_id',1)->count();
        $transfers = DB::table('patients')->select('id')->where('activestatus_id',2)->count();
        $stage3 = DB::table('counts')->select('stage')->where('stage', 'A3')->count();
        $stage2 = DB::table('counts')->select('stage')->where('stage', 'A2')->count();      
        $deaths = DB::table('patients')->select('id')->where('activestatus_id',3)->count();
      
        $patientdatatable = DB::table('patients')->get();
        $patientdataarray  = json_decode(json_encode($patientdatatable), true);
        for ($i=0; $i < count($patientdataarray) ; $i++) { 
            # code...
            $artnumberx_id[$i]                =$patientdataarray[$i]['id'];
            $patientnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['firstname']; 
            $patientsurnamex[$artnumberx_id[$i]]  =$patientdataarray[$i]['surname']; 
            $artnumberx[$artnumberx_id[$i]]  =$patientdataarray[$i]['artnumber']; 
            $primarycellx[$artnumberx_id[$i]]  =$patientdataarray[$i]['primarycell']; 
        }

        $medicinedatatable = DB::table('medicines')->get();
        $medicinedataarray = json_decode(json_encode($medicinedatatable), true);
        for ($i=0; $i < count($medicinedataarray) ; $i++) { 
            # code...
            $medicinex_id[$i]            =$medicinedataarray[$i]['id'];
            $artmedicationx[$medicinex_id[$i]]   =$medicinedataarray[$i]['art_type']; 
                    
        }

        $dosagedatatable = DB::table('dosages')->get();
        $dosagedataarray = json_decode(json_encode($dosagedatatable), true);
        for ($i=0; $i < count($dosagedataarray) ; $i++) { 
            # code...
            $dosagex_id[$i]            =$dosagedataarray[$i]['id'];
            $dosagex[$dosagex_id[$i]]   =$dosagedataarray[$i]['dosage']; 
                    
        }

        $effectsd = DB::table('effects')->get();
        $effectsa = json_decode(json_encode($effectsd), true);
        for ($i=0; $i < count($effectsa) ; $i++) { 
            # code...
            $effectsx_id[$i]            =$effectsa[$i]['id'];
            $effectsx[$effectsx_id[$i]]   =$effectsa[$i]['effect']; 
                    
        }

        $healthunitd= DB::table('health_units')->get();
        $healthunita = json_decode(json_encode($healthunitd), true);

        for($i = 0; $i < count($healthunita); $i++){

          $healthunit_idx[$i]                             = $healthunita[$i]['id'];

          $healthunitx[$healthunit_idx[$i]]               = $healthunita[$i]['healthunit'];

         
        };

        $medicationdatatable = DB::table('medications')->latest()->get();
        $medicationdataarray = json_decode(json_encode($medicationdatatable),true);
        for ($i=0; $i <count($medicationdataarray) ; $i++) {          
            # code...
             $medications_id[$i]                = $medicationdataarray[$i]['id'];           
             $patient_id[$medications_id[$i]]    =  $medicationdataarray[$i]['patient_id'];
             $medication[$medications_id[$i]]   =  $medicationdataarray[$i]['medication_id'];
             $dosage_id[$medications_id[$i]]       =  $medicationdataarray[$i]['dosage_id'];
             $stage[$medications_id[$i]]       =  $medicationdataarray[$i]['stage'];
             $value[$medications_id[$i]]       =  $medicationdataarray[$i]['value'];
             $effects_id[$medications_id[$i]]        = $medicationdataarray[$i]['effects_id'];
             $effects[$medications_id[$i]]        = $effectsx[$effects_id[$medications_id[$i]]];  
             $pills[$medications_id[$i]]   = $medicationdataarray[$i]['pills'];
             $nextcolldate[$medications_id[$i]]   = $medicationdataarray[$i]['nextcolldate'];
             $notes[$medications_id[$i]]        = $medicationdataarray[$i]['notes'];
             $updated_at[$medications_id[$i]]   = $medicationdataarray[$i]['updated_at'];
             $created_at[$medications_id[$i]]   = $medicationdataarray[$i]['created_at'];
             $healthunit_id[$medications_id[$i]]   = $medicationdataarray[$i]['healthunit_id'];        
             $patientname[$medications_id[$i]]  =$patientnamex[$patient_id[$medications_id[$i]]];
             $patientsurname[$medications_id[$i]] = $patientsurnamex[$patient_id[$medications_id[$i]]];      
             $artnumber[$medications_id[$i]]        =$artnumberx[$patient_id[$medications_id[$i]]];
             $dosage[$medications_id[$i]]       = $dosagex[$dosage_id[$medications_id[$i]]];
             $artmedication[$medications_id[$i]]     = $artmedicationx[$medication[$medications_id[$i]]];
             $primarycell[$medications_id[$i]]     =  $primarycellx[$patient_id[$medications_id[$i]]];
             $healthunit[$medications_id[$i]]     =  $healthunitx[$healthunit_id[$medications_id[$i]]];
        }
        
        $data = compact(
            'dosage',
            'medications_id', 
            'nextcolldate',     
            'dosagedatatable',
            'medicinedatatable',
            'created_at',
            'updated_at',
            'artnumber',
            'value',
            'stage', 
            'healthunit',
            'healthunitd',
            'patientname',
            'patientsurname', 
            'primarycell',       
              'effects',
              'artmedication',
              'notes',
              'pills',
              'effectsd',
              'countArtPatients',
              'transfers',
              'stage3',
              'stage2',
              'deaths'
           
            );

       
            return view('doctors.medications.index',$data);
       
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
        $medicationdatatable =DB::table('medications')
        ->select('stage','value','artnumber','medications.created_at','art_type','dosage','medicines.updated_at','firstname','surname')
        ->join('patients','medications.patient_id','=','patients.id')
        ->join('dosages','medications.dosage_id','=','dosages.id')
        ->join('medicines','medicines.id','=','medications.medication_id')
        ->where('medications.id', $id)
        ->get();

        $data = compact('medicationdatatable');  

        return view('doctors.medications.show',$data);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
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
        // $this->validate(request(),[

        //     'medication_id' =>'required',
        //     'dosage_id' =>'required',
        //     'roa' =>'required',   
        //     'duration' =>'required',
        //     'frequency' =>'required' 

        //     ]); 

            $datax['medication_id'] = $request['medication_id'];
            $datax['dosage_id'] = $request['dosage_id'];
            $datax['healthunit_id'] = $request['healthunit_id'];
            $artnumber = $request->input('artnumber');
            $messageto = $request->input('primarycell'); 
            $datax['pills'] = $request['pills'];
            $datax['effects_id'] = $request['effects_id'];
            $datax['notes'] = $request['notes'];   
            $datax['nextcolldate'] = $request['nextcolldate'];       

            $data = Medication::find($id);
           
            $today = date('Y-m-d');         
//             $collectiondate       =  $datax['nextcolldate'];
// dd($collectiondate );
            if ( $today < $datax['nextcolldate']) {
               # code...
               Session::flash('error','Patient '.$artnumber.' had aleady collected the medication.');
               return redirect()->route('medications.index');
    
            } else {
               
                 # code...
                 $data ['pills']               =trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['pills'])))));
                 $data ['healthunit_id']               =trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['healthunit_id'])))));
                 $data['effects_id']          = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['effects_id'])))));
                 $data['notes']               =trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['notes'])))));
                 $data['nextcolldate']        = date('Y-m-d', strtotime($datax['nextcolldate']. ' + 30 days'));
 
                 Session::flash('success','Patient '.$artnumber.' Medication successfully given. Your next collection date is'. $data['nextcolldate']);
                 $data ->save();

                 $smsdata = [
                    'messageto'  => $messageto,
                    'messagetext' => "Patient '.$artnumber.' Medication successfully given. Your next collection date is '". $data['nextcolldate']
                    ];
            
         
                $sentsms = DB::table('messageout')
                            ->insert(
                                        $smsdata
                                    );
                 return redirect()->route('medications.index'); 
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
