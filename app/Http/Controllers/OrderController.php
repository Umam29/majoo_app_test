<?php

namespace App\Http\Controllers;

use App\Models\MajooApp\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class OrderController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'pemesanan';
        $data['order'] = Order::all();
        return view('order.index', $data);
    }

    public function order(Request $request)
    {
        $rules = [
            'nama_produk'   => 'required',
            'harga'         => 'required',
            'nama_lengkap'  => 'required',
            'perusahaan'    => 'required',
            'nomor_telepon' => 'required',
            'alamat'        => 'required'
        ];

        $messages = [
            'nama_produk.required'   => 'Nama Produck wajib diisi',
            'harga.required'         => 'Harga Produk wajib diisi',
            'nama_lengkap.required'  => 'Nama Lengkap wajib diisi',
            'perusahaan.required'    => 'Perusahaan wajib diisi',
            'nomor_telepon.required' => 'Nomor Telepon wajib diisi',
            'alamat.required'        => 'Alamat wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->product_id = $request->id_produk;
            $order->nama_pemesan = $request->nama_lengkap;
            $order->perusahaan = $request->perusahaan;
            $order->no_telepon = $request->nomor_telepon;
            $order->alamat = $request->alamat;

            $order->save();

            DB::commit();

            request()->session()->flash('success', 'Berhasil Memesan Produk!');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('errors', 'Gagal Memesan !!!');
            return redirect()->back();
        }
    }
}
