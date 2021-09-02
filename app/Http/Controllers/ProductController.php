<?php

namespace App\Http\Controllers;

use App\Models\MajooApp\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        $data['sidebar'] = 'produk';
        $data['produk'] = Product::all();
        return view('product.index', $data);
    }

    public function save(Request $request)
    {
        if ($request->id_edit) {
            $rules = [
                'nama'                  => 'required|min:3|unique:products',
                'harga'                 => 'required',
                'deskripsi'             => 'required'
            ];

            $messages = [
                'nama.required'         => 'Nama Produk wajib diisi',
                'nama.min'              => 'Nama Produk minimal 3 karakter',
                'nama.unique'           => 'Nama Produk sudah terdaftar',
                'harga.required'        => 'Harga wajib diisi',
                'deskripsi.required'    => 'Deskripsi wajib diisi'
            ];

            $messages_success = 'Berhasil memperbarui produk !';
        } else {
            $rules = [
                'gambar'                => 'required',
                'nama'                  => 'required|min:3|unique:products',
                'harga'                 => 'required',
                'deskripsi'             => 'required'
            ];

            $messages = [
                'gambar.required'       => 'Gambar Produk wajib diisi',
                'nama.required'         => 'Nama Produk wajib diisi',
                'nama.min'              => 'Nama Produk minimal 3 karakter',
                'nama.unique'           => 'Nama Produk sudah terdaftar',
                'harga.required'        => 'Harga wajib diisi',
                'deskripsi.required'    => 'Deskripsi wajib diisi'
            ];

            $messages_success = 'Berhasil menyimmpan produk baru !';
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        DB::beginTransaction();
        try {
            if ($request->id_edit) {
                if ($request->has('gambar')) {
                    $path = 'public/upload/img/';
                    $img = $request->gambar;
                    $new_img = time().$img->getClientOriginalName();
                    $img->move($path, $new_img);

                    $product = Product::find($request->id_edit);
                    $product->nama = $request->nama;
                    $product->harga = $request->harga;
                    $product->deskripsi = $request->deskripsi;
                    $product->gambar = $path.$new_img;
                } else {
                    $product = Product::find($request->id_edit);
                    $product->nama = $request->nama;
                    $product->harga = $request->harga;
                    $product->deskripsi = $request->deskripsi;
                }
            } else {
                $path = 'public/upload/img/';
                $img = $request->gambar;
                $new_img = time().$img->getClientOriginalName();
                $img->move($path, $new_img);

                $product = new Product();
                $product->nama = $request->nama;
                $product->harga = $request->harga;
                $product->deskripsi = $request->deskripsi;
                $product->gambar = $path.$new_img;
            }

            $product->save();

            DB::commit();
            Session::flash('success', $messages_success);
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('errors', ['Gagal Menyimpan !!!']);
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $produk = Product::find($request->id_delete);
            $produk->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('errors', 'Gagal Menghapus !!!');
            return redirect()->back();
        }

        request()->session()->flash('success', 'Berhasil Menghapus Produk!');
        return redirect()->back();
    }
}
