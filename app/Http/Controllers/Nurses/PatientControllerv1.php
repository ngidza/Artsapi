<?php

namespace App\Http\Controllers\Nurses;
use DB;
use Alert;
use App\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Session;

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




  protected function index()
  {

      $genders = DB::table('gender')->get();

      $messagelanguages = DB::table('messagelanguage')->get();

      $messagemodes = DB::table('messagemode')->get();



      return view('patientregister' , compact('genders','messagelanguages','messagemodes'));

  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */

  protected function validator(array $data)
  {
      return Validator::make($data, [
        'firstname'      => 'required',
        'surname'        => 'required',
        'gender_id'      => 'required',
        'artnumber'      => 'required|min:16|confirmed',
        'primarycell'    => 'required',
        'messagelanguage_id'    => 'required',
        'messagemode_id'        => 'required',
      ]);
  }


      /**
       * Create a new patient instance after a valid registration.
       *
       * @param  array  $data
       * @return \App\Patient
       */


      protected function store(Request $request)
      {

     $this->validate($request, [
          'firstname'      => 'required',
          'surname'        => 'required',
          'gender_id'      => 'required',
          'artnumber'      => 'required|min:16',
          'primarycell'    => 'required',
          'messagelanguage_id'    => 'required',
          'messagemode_id'        => 'required',
    ]);

    $datax['firstname'] = $request->input('firstname');
    $datax['surname'] = $request->input('surname');
    $datax['gender_id'] = $request->input('gender_id');
    $datax['dateofbirth'] = $request->input('dateofbirth');
    $datax['artnumber'] = $request->input('artnumber');
    $datax['primarycell'] = $request->input('primarycell');
    $datax['secondarycell'] = $request->input('secondarycell');
    $datax['messagelanguage_id'] = $request->input('messagelanguage_id');
    $datax['messagemode_id'] = $request->input('messagemode_id');

    ///

    $data['firstname']             = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['firstname'])))));
    $data['surname']               = trim(ucfirst(strtolower(strip_tags(htmlspecialchars($datax['surname'])))));
    $data['gender_id']             = trim(strip_tags(htmlspecialchars($datax['gender_id'])));
    $data['dateofbirth']           = trim(strip_tags(htmlspecialchars($datax['dateofbirth'])));
    $data['artnumber']             = trim(strtoupper(strip_tags(htmlspecialchars($datax['artnumber']))));
    $data['primarycell']           = '+263'.substr(trim(strip_tags(htmlspecialchars($datax['primarycell']))),1);
    $data['secondarycell']         = '+263'.substr(trim(strip_tags(htmlspecialchars($datax['secondarycell']))),1);
    $data['messagelanguage_id']    = trim(strip_tags(htmlspecialchars($datax['messagelanguage_id'])));
    $data['messagemode_id']        = trim(strip_tags(htmlspecialchars($datax['messagemode_id'])));


$patientartnumber = $data['artnumber'];

    /**inserting into register database**/
$insert = DB::table('patients')->insert(
$data
);


/**/
         //Alert::message('Robots are working!');

       //  Alert::success("$patientartnumber successfully registered. Now Make an appointment!")->persistent("Close");
/**/
Session::flash('success','Patient successfully registered. Now Make an appointment!'); 
          return redirect()->route('home');

      }



}
