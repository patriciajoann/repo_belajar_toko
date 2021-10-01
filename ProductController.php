<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{


    public function show(){
        return Product::all();
    }
    
    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [                 
            'nama_produk' => 'required',                                  
            'deskripsi' => 'required',
            'harga' => 'required',
            'foto_produk' => 'required'
        ]); 
 
        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 
 
        $ubah = Product::where('id_produk', $id)->update([             
            'nama_produk' => $request->nama_produk,                          
            'deskripsi' => $request->deskripsi,             
            'harga' => $request->harga,
            'foto_produk' => $request->foto_produk
        ]); 
 
        if($ubah) {             
            return Response()->json(['status' => 1]);         
        }         
        else {             
            return Response()->json(['status' => 0]);         
        }     
    }

    public function destroy($id)
    {
        $hapus = Product::where('id_produk', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
    }

        else {
            return Response()->json(['status' => 0]);
    }
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
        ['nama_produk' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required',
        'foto_produk' => 'required']); 
        
        if($validator->fails()){ 
            return Response()->json($validator->errors());
        }

        $simpan = Product::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi, 
            'harga' => $request->harga,
            'foto_produk' => $request->foto_produk]);
            
        if($simpan){
            return Response()->json(['status' => 1]);
        }else {
            return Response()->json(['status' => 0]);
        } 
    }
}