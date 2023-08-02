<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class Employee extends Controller
{

    private $arrayCity=["bandung","cimahi","cmbon","jayapura","makasar"];
    private $arrayNumber=[9,1,6,4,8,6,6,3,8,2,3,3,4,1,8,2];

    //Soal No 2
    function getNameEmployeeStillWork() {
        
        $data = DB::table('employee')->selectRaw('lastname,firstname')->whereNotNull('terminationdate')->orderBy('id',"ASC")->get();

        return response()->json($data)->getContent();
    }

      //Soal No 3
    function getEmployeeUnreviewSortbyHireddate(){

        $data = DB::table('employee')->selectRaw('lastname,firstname,hiredate')->whereNotIn('id',DB::table('annualreviews')->pluck('empid'))->orderBy('hiredate',"DESC")->get();

        return response()->json($data)->getContent();
        
    }

      //Soal No 4
    function getEmployeeDiffdate() {

        $data = DB::table('employee')->selectRaw('MIN(hiredate) as start_hire,MAX(hiredate) as end_hire,ABS(DateDiff(MIN(hiredate),MAX(hiredate))) as difference_day')->get();

        return response()->json($data)->getContent();
        
    }

      //Soal No 5
    function getEmployeeUpsalary(){

        $data = DB::SELECT("SELECT a.firstname,a.lastname,(a.salary*15/100) AS perkiraan_kenaikan_salary,COUNT(b.empid) AS total_review FROM employee a INNER JOIN annualreviews b ON a.id = b.empid GROUP BY a.id,a.firstname,a.lastname,a.salary ORDER BY a.salary DESC,COUNT(b.empid) ASC ");

        return response()->json($data)->getContent();
        
    }

      //Soal No 6
    function saveToTxt() : JsonResponse {

        $filesystem = Storage::disk("public");
        $status["Contoh2"]= $filesystem->put("contoh2.txt", $this->getNameEmployeeStillWork());
        $status["Contoh3"]= $filesystem->put("contoh3.txt", $this->getEmployeeUnreviewSortbyHireddate());
        $status["Contoh4"]= $filesystem->put("contoh4.txt", $this->getEmployeeDiffdate());
        $status["Contoh5"]= $filesystem->put("contoh5.txt", $this->getEmployeeUpsalary());

        return response()->json($status, Response::HTTP_OK);
    }

      //Soal No 7
    function getTxt(String $filename){

        $filesystem = Storage::disk("public");

        if ($filesystem->exists($filename)) {
            $content =$filesystem->get($filename);
        }else{
            $content ="File With Name $filename Not Found";
        }

        return json_decode($content);
    }

      //Soal No 8-a
      function getInputCity(String $inputcity) : JsonResponse {
        $result=[];

        if (in_array(Str::lower($inputcity),$this->arrayCity))
            {
                $result["Result"]=true;
            }
            else
            {
                $result["Result"]=false;
                for ($i=0; $i <count($this->arrayCity) ; $i++) { 
                    if (Str::lower($inputcity[0]==$this->arrayCity[$i][0])||Str::lower(substr($inputcity,-1)==substr($this->arrayCity[$i],-1)) ) {
                       $result["Saran_City"][]=$this->arrayCity[$i];
                       
                    }
                   
                }
            }
            
        return response()->json($result, 200);
      }

      //soal No 9-a
      function getOrderArrayAscToDescNoDuplicate() : JsonResponse {

        $uniqarra=array_unique($this->arrayNumber);
        sort($uniqarra);
        return response()->json($uniqarra, Response::HTTP_OK);
        
      }

      //soal No 9-b
      function getCountduplicatevaluesarray() : JsonResponse {

        sort($this->arrayNumber);

        $uniqarra=array_count_values($this->arrayNumber);
       
        return response()->json($uniqarra, Response::HTTP_OK);
        
      }

      //soal No 9-c ( http Method Post & key name inputnumber)
      function getRemovevalues(Request $req) : JsonResponse {
       
        $uniqarra= array_values(array_diff($this->arrayNumber,json_decode($req->inputnumber)));       
        return response()->json($uniqarra, Response::HTTP_OK);
        
      }

      //Soal No 9-d ( TIDAK PAHAM SAMA SOALNYA )
      function getInputplusvalue(Int $val) : JsonResponse {
        if ($val >10) {
            $val=10;
        }
        $beginarray[0]=$val;
        $merged_array=array_merge($beginarray,$this->arrayNumber);   
        return response()->json( $merged_array, Response::HTTP_OK);
      }

     
      function getRandomString(int $val){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $val; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
      }

      function getRandomInt(int $val){
        $characters = '0123456789';
        $randomInt = '';
        for ($i = 0; $i < $val; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomInt .= $characters[$index];
        }
        return $randomInt;
      }

    //Soal no 10
      function getrandomstringandNumber() : JsonResponse {
        $getstring = $this->getRandomString(50).$this->getRandomInt(50);
        $getint = $this->getRandomInt(50);

        $shuffled = str_shuffle($getstring);
        $even = 0;

        $data["randomstring"]=  $shuffled;
        $data["total_character"]=preg_match_all( "( *?[a-zA-Z] *?)", $shuffled );
        $data["total_character_vowel"]=preg_match_all("/[aeiou]/i",$shuffled,$matches);
        $data["total_number"]= preg_match_all( "/[0-9]/", $shuffled );
        foreach (str_split($getint) as $number ) {
            $number % 2 == 0 ? $even++ :0;
        }
        $data["total_number_even"]=$even;
        $data+=$this->getOrderChar($shuffled);
       return response()->json( $data, Response::HTTP_OK);

      }

      function getOrderChar($string) {
       
        foreach (str_split(strtolower($string)) as $key => $value) {
            if (is_numeric($value)) {
                $dataNumeric[]=$value;
            }else{
                $datachar[]=$value;
            }

        }
        $dataarraynumeric=array_unique( $dataNumeric);
        $dataarraychar=array_unique( $datachar);
        rsort($dataarraynumeric);
        sort($dataarraychar);
        $data["orderstring"]=implode(', ',array_merge($dataarraynumeric,$dataarraychar));
        $data["concatString"]=$this->getconcatstring($dataarraynumeric,$dataarraychar);
        return $data;

      }

      function getconcatstring($numeric,$string) {
        $data="";
        for ($i=0; $i <count($numeric) ; $i++) { 
            $data .=$numeric[$i].$string[$i].",";
        }

        return $data;
      }
    
    
}
