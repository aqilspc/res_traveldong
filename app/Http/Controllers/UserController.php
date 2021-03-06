<?php

namespace App\Http\Controllers;
use DB;
use App\Models\User;
use Illuminate\Http\Request;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function model()
    {
        $data = new User();
        return $data;
    }

    public function login(Request $request)
    {
        $data = $this->model()->login($request);
        return response()->json($data, $data[1]);
    }

    public function register(Request $request)
    {
        $data = $this->model()->register($request);
        if($data[0])
        {
            $hasil = $this->model()->getUserById($data[1]);
            return response()->json($hasil, $data[2]);
        }else{
            return response()->json($data[1], $data[2]);
        }
    }

    public function getUserById($id)
    {
        $data = $this->model()->getUserById($id);
        $hasil = [];
        if($data)
        {
            return $data;
        }else
        {   
            $hasil[0] = 'User tidak ditemukan';
            return $hasil;
        }
    }

    public function getUserByUsername($username)
    {
        $data = $this->model()->getUserByUsername($username);
        $hasil = [];
        if($data)
        {
            return $data;
        }else
        {   
            $hasil[0] = 'User tidak ditemukan';
            return $hasil;
        }
    }

    public function updateUser(Request $request)
    {
        $data = $this->model()->updateUser($request);
        $hasil = [];
        if($data)
        {
            $hasil[0] = 'Berhasil update profile!';
        }else
        {
            $hasil[0] = 'Gagal update profile username telah digunakan';
        }

        return $hasil;
    }

}
