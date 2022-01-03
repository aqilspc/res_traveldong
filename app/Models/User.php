<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Oracle;
use Illuminate\Http\Request;
class User{

	public function oracle()
    {
        $data = new Oracle;
        return $data;
    }

    public function uploadFile(Request $request,$oke)
    {
            $result ='';
            $file = $request->file($oke);
            $name = $file->getClientOriginalName();
            // $tmp_name = $file['tmp_name'];

            $extension = explode('.',$name);
            $extension = strtolower(end($extension));

            $key = rand().'-'.$oke;
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = "customer/";
            $file->move($tmp_file_path,$tmp_file_name);
            $result = 'customer'.'/'.$tmp_file_name;
        return $result;
    }

	public function login($request)
	{
		$data = DB::table('users')->where('username',$request->username)->first();
		$arr = [];
		if($data)
		{
			if (!Hash::check($request->password,$data->password))
			{
				$arr[0] = 'Password yang di masukkan salah';
				$arr[1] = 401;
			}else{
				$role = $data->role;
				if($role == 'customer')
				{
					array_push($arr, [
						'id' =>$data->id,
						'nama'=>$data->nama_depan.' '.$data->nama_belakang,
						'role'=>$role,
						'alamat'=>$data->alamat
					]);
					$arr[1] = 200;
				}else{ // travel
					$travel = DB::table('travels')->where('id_user',$data->id)->first();
					if($travel)
					{
						array_push($arr, [
							'id' =>$data->id,
							'nama'=>$travel->nama_travel,
							'role'=>$role,
							'alamat'=>$travel->alamat,
							'logo'=>$travel->logo,
							'no_wa'=>$travel->no_wa,
							'no_rekening'=>$travel->no_rekening,
						]);
						$arr[1] = 200;
					}
				}
			}
		}else
		{
			$arr[0] = 'Username tidak ditemukan';
			$arr[1] = 401;
		}

		return $arr;
	}

	public function register($request)
	{
		$data = DB::table('users')->where('username',$request->username)->first();
		$arr = [];
		if($data)
		{
			$arr[0] = false;
			$arr[1] = 'Username sudah di gunakan';
			$arr[2] = 401;
		}else
		{
			$data = DB::table('users')->insertGetId(
				[
					'role'=>'customer',
					'password'=>Hash::make($request->password),
					'nama_depan'=>$request->nama_depan,
					'nama_belakang'=>$request->nama_belakang,
					'username'=>$request->username,
					'alamat'=>$request->alamat,
					'created_at'=>Carbon::now()->toDateTimeString()
				]);
			$arr[0] = true;
			$arr[1] = $data;
			$arr[2] = 200;
			DB::table('customers')
			->insert(['id_user'=>$data,
				'photo'=>'https://akumenulis.com/wp-content/uploads/2020/09/495-4952535_create-digital-profile-icon-blue-user-profile-icon.png',
				'created_at'=>Carbon::now()->toDateTimeString()
			]);
		}

		return $arr;
	}


	public function updateUser(Request $request)
	{
		$cek = DB::table('users')->where('username',$request->username)->first();
		if(!$cek)
		{
			return false;
		}
		$data = DB::table('users')->where('id',$request->id)->update(
				[
					'password'=>Hash::make($request->password),
					'nama_depan'=>$request->nama_depan,
					'nama_belakang'=>$request->nama_belakang,
					'username'=>$request->username,
					'alamat'=>$request->alamat,
					'created_at'=>Carbon::now()->toDateTimeString()
				]);
		if($request->file('customer')!=null){
			$sg = $this->uploadFile($request,'customer');
			$file_name = $sg ;
			$upfoto = $this->oracle()->upFileOracle($file_name);
			DB::table('customers')->where('id_user',$request->id)->update(['photo'=>$upfoto['message']]);
		}
		return $data;
	}

	public function getUserById($id)
	{
		$data = DB::table('users as us')
		->join('customers as cs','cs.id_user','=','us.id')
		->where('us.id',$id)
		->select('us.*','cs.photo')
		->first();
		$hasil = [$data];
		return $hasil;
	}
}