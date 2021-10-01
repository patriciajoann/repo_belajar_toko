<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DetailOrders;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DetailOrdersController extends Controller{

    public function show(){
        $data_detail = DetailOrders::join('orders', 'orders.id_transaksi', 'detail_orders.id_transaksi')->get();
        return Response()->json($data_detail);
    }
    
    public function show2(){
        $data_order2 = DetailOrders::join('product', 'product.id_produk', 'orders.id_produk')->get();
        return Response()->json($data_order2);
    }

    public function detail($id){
        if(DetailOrders::where('id_transaksi', $id)->exists()){
            $data_detail = DetailOrders::join('orders', 'orders.id_transaksi', 'detail_orders.id_transaksi')
            ->where('detail_orders.id_transaksi', '=', $id)
            ->get();
            return Response()->json($data_detail);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }

    public function detail4($id4){
        if(DetailOrders::where('id_produk', $id2)->exists()){
            $data_detail4 = DetailOrders::join('product', 'product.id_produk', 'detail_orders.id_produk')
            ->where('detail_orders.id_produk', '=', $id2)
            ->get();
            return Response()->json($data_detail4);
        }else{
            return Response()->json(['message' => 'Tidak Ditemukan']);
        }
    }

    public function update($id, Request $request) {         
        $validator=Validator::make($request->all(),         
        [                 
            'id_transaksi' => 'required',                                  
            'id_produk' => 'required',
            'qty' => 'required',
            'subtotal' => 'required'
        ]); 
 
        if($validator->fails()) {             
            return Response()->json($validator->errors());         
        } 
 
        $ubah = DetailOrders::where('id_detail_transaksi', $id)->update([             
            'id_transaksi' => $request->id_transaksi,                          
            'id_produk' => $request->id_produk,  
            'qty' => $request->qty,              
            'subtotal' => $request->subtotal
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
        $hapus = DEtailOrders::where('id_detail_transaksi', $id)->delete();

        if($hapus) {
            return Response()->json(['status' => 1]);
    }

        else {
            return Response()->json(['status' => 0]);
    }
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),
        ['id_transaksi' => 'required',
        'id_produk' => 'required',
        'qty' => 'required']); 
        
        if($validator->fails()){ 
            return Response()->json($validator->errors());
        }

        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $harga = DB::table('product')->where('id_produk', $id_produk)->value('harga');
        $subtotal = $harga * $qty;

        $simpan = DetailOrders::create([
            'id_transaksi' => $request->id_transaksi,
            'id_produk' => $id_produk, 
            'qty' => $qty,
            'subtotal' => $subtotal]);
            
        if($simpan){
            return Response()->json(['status' => 1]);
        }else {
            return Response()->json(['status' => 0]);
        } 
    }
}