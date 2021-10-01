<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Orders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{

        public function show()
    {
        $data_orders = Orders::join('officers', 'officers.id_petugas', 'orders.id_petugas')->get();
        return Response()->json($data_orders);

    }

        public function detail($id_petugas)
    {
        if(Orders::where('id_petugas', $id_petugas)->exists()) {
        $data_orders = Orders::join('officers', 'officers.id_petugas', 'orders.id_petugas')
        ->where('orders.id_petugas', '=', $id_petugas)
        ->get();
 
            return Response()->json($data_orders);
    }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }

        public function show2()
    {
        $data_orders = Orders::join('customers', 'customers.id_pelanggan', 'orders.id_pelanggan')->get();
        return Response()->json($data_orders);
    }

        public function detail2($id_pelanggan)
    {
        if(Orders::where('id_pelanggan', $id_pelanggan)->exists()) {
        $data_orders = Orders::join('customers', 'customers.id_pelanggan', 'orders.id_pelanggan')
        ->where('orders.id_pelanggan', '=', $id_pelanggan)
        ->get();
 
            return Response()->json($data_orders);
    }
        else {
            return Response()->json(['message' => 'Tidak ditemukan' ]);
        }
    }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [                 
            'id_pelanggan' => 'required',                                  
            'id_petugas' => 'required',
            'tgl_transaksi' => 'required'
        ]); 
 
        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 
 
        $ubah = Orders::where('id_transaksi', $id)->update([             
            'id_pelanggan' => $request->id_pelanggan,                          
            'id_petugas' => $request->id_petugas,             
            'tgl_transaksi' => $request->tgl_transaksi
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
            $hapus = Orders::where('id_transaksi', $id)->delete();

            if($hapus) {
                return Response()->json(['status' => 1]);
        }

            else {
                return Response()->json(['status' => 0]);
        }
        }


        public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'id_pelanggan' => 'required',
                'id_petugas' => 'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan = Orders::create(
            [
                'id_pelanggan' => $request->id_pelanggan,
                'id_petugas' => $request->id_petugas,
                'tgl_transaksi' => date("Y-m-d")
            ]
        );

        if($simpan){
            return Response() -> json(['status' => 1]);
        } else{
            return Response() -> json(['status' => 0]);
        }
    }
}