<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Customers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller{

    public function show() {         
    return Customers::all(); 
    }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [                 
            'nama' => 'required',                                  
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'             
        ]); 
 
        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 
 
        $ubah = Customers::where('id_pelanggan', $id)->update([             
            'nama' => $request->nama,             
            'alamat' => $request->alamat,             
            'telp' => $request->telp,             
            'username' => $request->username,             
            'password' => $request->password       
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
        $hapus = Customers::where('id_pelanggan', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
    }

        else {
            return Response()->json(['status' => 0]);
    }
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
        [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]); 
        
        if($validator->fails()){ 
            return Response()->json($validator->errors());
        }

        $simpan = Customers::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat, 
            'telp' => $request->telp,
            'username' => $request->username, 
            'password' => $request->password]);
            
        if($simpan){
            return Response()->json(['status' => 1]);
        }else {
            return Response()->json(['status' => 0]);
        } 
    }
}