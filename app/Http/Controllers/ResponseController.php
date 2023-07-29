<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResponseModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class ResponseController extends Controller
{

    function isPalindrome(String $text)
    {
        if (strrev($text) == $text) {
            return response()->json("Palindrome", Response::HTTP_OK);
        } else {
            return response()->json("Not palindrome", Response::HTTP_BAD_REQUEST);
        }
    }

    public function index()
    {
        return response("Hello Go developers", Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        Session::push("data", $request->all());
        return response()->json(session('data'), Response::HTTP_OK);
    }


    public function show($id = null)
    {

        // $ModelRespone = new ResponseModel();
        // $dataGlobal = [
        //     "language" => $ModelRespone->language,
        //     "appeared" => $ModelRespone->appeared,
        //     "created" => [$ModelRespone->created],
        //     "functional" => $ModelRespone->functional,
        //     "object-oriented" => $ModelRespone->object_oriented,
        //     "relation" => [$ModelRespone->relation]
        // ];
        // return response()->json($dataGlobal, Response::HTTP_OK);

        $dataarray = session('data');
        if (is_numeric($id) && isset($dataarray)) {

            $index = array_keys($dataarray);

            if (!in_array($id, $index)) {
                return response()->json("Id Not Found", Response::HTTP_OK);
            } else {
                return response()->json($dataarray[$id], Response::HTTP_OK);
            }
        } else {
            return response()->json($dataarray, Response::HTTP_OK);
        }
    }


    public function update(Request $request, $idupdate = null)
    {

        if (!empty(session('data'))) {
            $dataarray = session('data');
            $index = array_keys($dataarray);
            if (!in_array($idupdate, $index)) {
                return response()->json("Id Not Found", Response::HTTP_OK);
            } else {
                $dataArrayNew = $dataarray[$idupdate];
                $dataarray[$idupdate] = array_merge($dataArrayNew, $request->all());
                Session::forget("data");
                Session::put('data', $dataarray);
                return response()->json($dataarray[$idupdate], Response::HTTP_OK);
            }
        } else {
            return response()->json("Id Not found", Response::HTTP_OK);
        }
    }


    public function destroy($id = null)
    {
        if (is_numeric($id)) {
            $dataarray = session("data");
            unset($dataarray[$id]);
            Session::put('data', $dataarray);
            return response()->json(session('data'), Response::HTTP_OK);
        }
    }
}
