<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Patient extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           
            'id'         =>$this -> id,
            'firstname' =>$this -> firstname,         
            'surname' =>$this -> surname,
            'artnumber' =>$this -> artnumber,  
            'gender' =>$this -> gender,          
            'primarycell' =>$this -> primarycell,
            'secondarycell' =>$this -> secondarycell,
            'messagemode' =>$this -> messagemode,
            'artnumber' =>$this -> artnumber,          
            'activestatus_id' =>$this -> activestatus_id,
            'healthunit' =>$this -> healthunit,
            'messagelanguage' =>$this -> messagelanguage
            
          ];
    }
    public function with($request){

        return [
            'version' => '1.0.0',
            'author_url'=>url('http://ngidza.com')
         ];
    }
}
