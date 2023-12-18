<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Stevebauman\Location\Position;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;


class StudentController extends Controller
{
   public function create(Request $request){
        return View('students.create');
   }
   public function store(Request $request){
        $student =Student::create($request->all());

        return redirect()->route('student.index')->with(['message'=>'Record  get created']);
   }
   public function index(Request $request){
        $students =Student::all(); 
        return View('students.index',['students'=>$students]);
   }
   public function getCityState(Request $request){
    $ipAddress = $request->ip();
        return View('students.getCityState',['ip'=>$ipAddress]);
    }
   public function fetchIds(Request $request){
        $ids = [];
        $url = "https://opencontext.org/query/Asia/Turkey/Kenan+Tepe.json";

        $response = $this->getCurlResponse($url);
        $data = json_decode($response,true);
        

        foreach($data as $record){

            if(isset($record[0]) && isset($record[0]['id'])){
                
                    $ids[] = $record[0]['id'];
             
            }
            $newArr = array_unique($ids);
            $this->storeInExcel($newArr);

     }
   }
     private function storeInExcel($ids)
    {
        $data = collect($ids)->map(function ($id) {
            return ['id' => $id];
        });

        Excel::create('ids_data', function ($excel) use ($data) {
            $excel->sheet('Sheet1', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->store('xlsx', storage_path('app'));
    }

   public function getCurlResponse($url){

    $ch = curl_init($url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER,false);

    $response = curl_exec($ch);

    curl_close($ch);
   return $response; 


   }

}
