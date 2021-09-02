<?php

namespace App\Http\Controllers;

use App\Models\MajooApp\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $rules = [
            'username'              => 'required',
            'password'              => 'required'
        ];

        $messages = [
            'username.required'     => 'Username wajib diisi',
            'password.required'     => 'Password wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'username'  => $request->username,
            'password'  => $request->password,
        ];

        Auth::attempt($data);

        if (Auth::check()) {
            return redirect('admin/product');
        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }

    public function save(Request $request)
    {
        $rules = [
            'nama'                  => 'required|min:3',
            'username'              => 'required|unique:users',
            'password'              => 'required|confirmed|min:3'
        ];

        $messages = [
            'name.required'         => 'Nama wajib diisi',
            'name.min'              => 'Nama minimal 3 karakter',
            'username.required'     => 'Username wajib diisi',
            'username.unique'       => 'Username sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.min'          => 'Password minimal 3 karakter',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->nama;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);

            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            request()->session()->flash('errors', 'Gagal Menyimpan !!!');
            return redirect()->back();
        }

        request()->session()->flash('success', 'Berhasil Membuat Akun Baru ! Silahkan Login');
        return redirect('login');
    }
}
