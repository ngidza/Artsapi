<?php

namespace App\Http\Controllers\Doctors;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patientdatatable = DB::table('patients')->get();
       
        return view('doctors.reports.index',compact('patientdatatable'));
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
        $this->validate(request(),[
            //put fields to be validated here
            'patient_id' =>'required',
            'report' =>'required',
           /*  'duration' =>'required', */
            'type' =>'required',
           
            ]);   

            $patient_id = $request ->input('patient_id');
            $report = $request ->input('report');
            $type = $request ->input('type');

            $patientreportsdata = DB::table($report)->where('patient_id', $patient_id)->get();

            foreach ($patientreportsdata as $key => $reports) {
                # code...
                $reportsx[] = $reports ->value;
            }
            $tb[] = 25;
            
            $selftest[] = [30,35,56,67,65];
            $ancpmtct[] = 5;
            $medicaloupatient[] =25;
            $impatientward[] = 5;
            $cborefered[] = 10;

            if (!$patientreportsdata ->isEmpty()) {
             
            $patientsname =DB::table('patients')->where('id',$patient_id) ->value('firstname');
            
            return view('doctors.reports.showgraphs')    
                                                     ->withPatientsname($patientsname)
                                                    ->withReport($report)
                                                     ->withType($type)
                                                     ->withReportsx(json_encode($reportsx))
                                                     ->withTb(json_encode($tb))                              
                                                     ->withSelftest(json_encode($selftest))
                                                     ->withAncpmtct(json_encode($ancpmtct)) 
                                                     ->withMedicaloupatient(json_encode($medicaloupatient))
                                                     ->withImpatientward(json_encode($impatientward))
                                                     ->withCborefered(json_encode($cborefered));
                                                    
            } else {
                
               Session::flash('error','Patient no data at the moment.');          
                return redirect() ->route('reports.index');
               
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
