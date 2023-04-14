<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class EventController extends Controller{
    /******************** 
     * 
     *    EVENT LISTING 
     * 
    *********************/
    public function list(Request $request){
        try{
            $data=Event::with(['eventtype'])->get();
            return $this->response($this->success,200,$data,'Events list fetched successfully ');
          }
          catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
          }
        }
    /******************** 
     * 
     *  CREATE  NEW EVENT
     * 
    *********************/        
     public function create(Request $request){
        try{ 
            $validator = Validator::make($request->all(), [
                'event_name' => 'required',
                'type_id'=>'required',
                'description'=>'required'
            ],[
                'event_name.required'=>"Event name is required",
                'type_id'=>'Type is required',
                'description'=>'Description is required' 
            ]);
            /**  IF VALIDATION FAILED  ***/
            if ($validator->fails()) { 
                return response()->json(['errors' => $validator->errors(),'status'=>'validErr']);
            }
            if($request->file('image')){
                $path='public/';
                $photo=$request->file('image')->getClientOriginalName();
                $photo=rand().'_'.time().'_'.$photo;   
                Storage::putFileAs($path, $request->file('image'),$photo);
            }
            else{
                $photo="";
            }
            Event::create(["event_name"=>$request->event_name,"description"=>$request->description,"type_id"=>$request->type_id,"image"=>$photo]);
             return $this->response($this->success,200,'','Event created successfully');
            }
        catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
        }           
      }
    /*********************** 
     * 
     *   GET EVENT INFORMATION 
     * 
    ************************/      
     public function get(Request $request,$id){
        try{ 
            $data= Event::where('id',$id)->first();
            return $this->response($this->success,200,$data,'Event get successfully');        
        }
        catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
         }             
        }
    /******************** 
     * 
     *   UPDATE EVENT  
     * 
    *********************/        
     public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'event_name' => 'required',
            'type_id'=>'required',
            'description'=>'required'
        ],[
            'event_name.required'=>"Event name is required",
            'type_id'=>'Type is required',
            'description'=>'Description is required' 
        ]);
        /******IF VALIDATION FAILED*********** */
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'status'=>'validErr']);
        }
        try{
            if($request->file('image')){
                $path='public/';
                $photo=$request->file('image')->getClientOriginalName();
                $photo=rand().'_'.time().'_'.$photo;   
                Storage::putFileAs($path, $request->file('image'),$photo);
            }
            else{
                $photo=$request->oldimage;
            }
            Event::where('id',$request->event_id)->update(["event_name"=>$request->event_name,
                        "description"=>$request->description,
                        "type_id"=>$request->type_id,
                        "image"=>$photo]);        
        return $this->response($this->success,200,'','Event updated  successfully');       
        }
        catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
        }                   
     }
    /******************** 
     * 
     *   DELETE  EVENT  
     * 
    *********************/     
     public function delete(Request $request){
        try{
            Event::where('id',$request->event_id)->delete();
            return $this->response($this->success,200,'','Event deleted successfully');            
        }
        catch(Exception $ex){
            return $this->response($this->faliure,500,'',$this->errorMessage);
        }                           

     }
}

