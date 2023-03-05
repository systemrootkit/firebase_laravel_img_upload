<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserTypes;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $active_users = User::where('status',1)->get();
        $in_active_users = User::where('status',0)->get();
        return view('userArray.index',compact('active_users','in_active_users'));
    }

    public function dataStore(Request $request)
    {
        $active=json_encode($request->acive);
        dd($active);
        $inactive=json_decode($request->inactive);

        $status['status']=array();

        foreach($active as $activeval)
        {
            echo $activeval;
           $status['status']['active']['id']=$activeval;
           $status['status']['active']['name']=$activeval;
        }
dd($status);

        // $ac_users=new UserTypes();
        // $dataArray=array();
        // $data = $request->data;
        // array_push($dataArray,$data);
        // $ac_users->active_users =
        // dd($dataArray);
        // return response()->json($dataArray);

    }
    public function processData(Request $request)
    {
        $parentArray=[];
        // dd($request->all());
        if($request->arrayactive){
            // dd("active data",$request->arrayactive);
            $array1=$request->arrayactive;
        }
        if($request->arrayinactive){
            //dd("in-active data",$request->arrayinactive);
            $array2=$request->arrayactive;
        }
        array_push($parentArray,$array1);
        dd($parentArray);


        // $ac_users=new UserTypes();
        // $dataArray=array();
        // $data = $request->data;
        // array_push($dataArray,$data);
        // $ac_users->active_users =
        // dd($dataArray);
        // return response()->json($dataArray);

    }

}
