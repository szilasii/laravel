<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Faker\Extension\Extension;

class UserController extends Controller
{
    public function index() {
        $User = User::all();
        return response()->json($User);
    }
    
    public function store (Request $request) {
        try {    
            $User = new User;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password,[PASSWORD_BCRYPT]);
            $User->accountNumber = $request->accountNumber;
            //$User->token = jwt token amit generálok
            $User->save();
           } catch (Exception $e ){
                return response()->json([
                    "message" => "Hiba a mentéskor",
                    "error" => $e],404);
           }
    
            return response()->json([
                "message" => "User hozzáadva",
                "user" => $User
            ],201);
    }

    public function show($id) {
        $User = User::find($id);
        if (empty($User)){
            return response()->json([
                "message" => "Nincs ilyen felhasználó"
            ],404);
        } 
        return response()->json($User);
    }

    public function update(Request $request, int $id) : string {
       if (User::where('id',$id)->exists()) {
        try {   $User = User::find($id);
                $User->name = is_null($request->name) ? $User->name : $request->name ;
                $User->email = is_null($request->email) ? $User->email : $request->email;
                $User->password = is_null($request->password) ? $User->password : bcrypt($request->password,[PASSWORD_BCRYPT]);
                $User->accountNumber = is_null($request->accountNumber) ? $User->accountNumber : $request->accountNumber;
                //$User->token = jwt token amit generálok
                $User->save();
               } catch (Exception $e ){
                    return response()->json([
                        "message" => "Hiba a mentéskor",
                        "error" => $e],404);
               }    
       }

       return response()->json([
        "message" => "Nincs ilyen felhasználó"
        ],404);




    }
}

