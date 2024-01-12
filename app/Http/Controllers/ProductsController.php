<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        $Products = Products::all();
        return response()->json($Products);
    }
    
    public function store (Request $request) {
        request()->validate([
            'file' => 'required|image|mimes:jpg,png|max:2048',
        ]);

        if($request->hasfile('file')) {
           // $name = $request->file->getClientOriginalName();
            $path = $request->file->store('images','public');
        }
        try {    
            $Products = new Products;
            $Products->productName = $request->productName;
            $Products->description = $request->description;
            $Products->stock = $request->stock;
            $Products->price = $request->price;
            $Products->path = $path;
            $Products->save();
           } catch (Exception $e ){
                return response()->json([
                    "message" => "Hiba a mentéskor",
                    "error" => $e],404);
           }
    
            return response()->json([
                "message" => "A termék hozzáadva",
                "products" => $Products
            ],201);
    }

    public function show($id) {
        $Products = Products::find($id);
        if (empty($Products)){
            return response()->json([
                "message" => "Nincs ilyen felhasználó"
            ],404);
        } 
        return response()->json($Products);
    }

    public function update(Request $request, int $id) : string {
       if (Products::where('id',$id)->exists()) {
        try {   $Products =Products::find($id);
                $Products->productName = is_null($request->productName) ? $Products->productName : $request->productName ;
                $Products->description = is_null($request->description) ? $Products->description : $request->description;
                $Products->stock = is_null($request->stock) ? $Products->stock : $request->stock;
                $Products->price = is_null($request->price) ? $Products->price : $request->price;
                $Products->path = is_null($request->path) ? $Products->path : $request->path;
                $Products->save();
                return response()->json($Products);
    
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
    public function destroy($id) {
        if (Products::where('id',$id)->exists()) {
            $Products =Products::find($id);
            $Products->delete();
            return response()->json([
                "message" => "A termék törölve"
                ],202);

        }

        return response()->json([
            "message" => "Nincs ilyen felhasználó"
            ],404);
    } //
}
