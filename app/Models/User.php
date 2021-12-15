<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class Pesanan{

	public function login($request)
	{
		$data = DB::table('users')->where('username')->first();
		$arr = [];
		if($data)
		{
			if (Hash::check($request->password,$data->password))
			{
				$arr[0] = 'Password yang di masukkan salah';
			}else{
				$role = $data->role;
				if($role == 'customer')
				{
					$arr = [
						'id' =>$data->id,
						'nama'=>$data->nama_depan.' '.$data->nama_belakang,
						'role'=>$role,
						'alamat'=>$data->alamat
					];
				}else{ // travel
					$travel = DB::table('travels')->where('id_user',$data->id)->first();
					if($travel)
					{
						$arr = [
							'id' =>$data->id,
							'nama'=>$travel->nama_travel,
							'role'=>$role,
							'alamat'=>$travel->alamat,
							'logo'=>$travel->logo,
							'no_wa'=>$travel->no_wa,
							'no_rekening'=>$travel->no_rekening,
						];
					}
				}
			}
		}else
		{
			$arr[0] = 'Username tidak ditemukan';
		}

		return $arr;
	}

	public function register($request)
	{
		$data = DB::table('users')->where('username')->first();
		$arr = [];
		if($data)
		{
			$arr[0] = 'Username sudah di gunakan';
		}else
		{
			$data = DB::table('users')->insertGetId(
				[
					'role'=>'customer',
					'password'=>bcrypt($request->password),
					'nama_depan'=>$request->nama_depan,
					'nama_belakang'=>$request->nama_belakang,
					'username'=>$request->username,
					'alamat'=>$request->alamat,
					'created_at'=>Carbon::now()->toDateTimeString()
				]);
			$arr[0] = true;
			$arr[1] = $data;
		}

		return $arr;
	}


	public function updateUser($request)
	{
		$data = DB::table('users')->where('id',$request->id)->update(
				[
					'role'=>'customer',
					'password'=>bcrypt($request->password),
					'nama_depan'=>$request->nama_depan,
					'nama_belakang'=>$request->nama_belakang,
					'username'=>$request->username,
					'alamat'=>$request->alamat,
					'created_at'=>Carbon::now()->toDateTimeString()
				]);
		return $data;
	}

	public function getUserById($id)
	{
		$data = DB::table('users')->where('id',$id)->first();
		return $data;
	}
}