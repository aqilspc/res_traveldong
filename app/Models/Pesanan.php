<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
class Pesanan{

	public function getPesananById($id)
	{
		$data = DB::table('orders as os')
		->join('users as us','us.id','=','os.id_user')
		->join('posts as ps','ps.id','=','os.id_post')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->select('os.*','us.nama_depan as nama_depan_user'
			,'us.nama_belakang as nama_belakang_user'
			,'us.alamat as alamat_user','us.username'
			,'ts.nama_travel','ts.alamat as alamat_travel'
			,'ts.logo as logo','ts.no_wa','ts.no_rekening')
		->where('os.id',$id)
		->first();
		$hasil = [$data];
		return $hasil;

	}

	public function getPesananByIdUser($id)
	{
		$data = DB::table('orders as os')
		->join('users as us','us.id','=','os.id_user')
		->join('posts as ps','ps.id','=','os.id_post')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->select('os.*','us.nama_depan as nama_depan_user'
			,'us.nama_belakang as nama_belakang_user'
			,'us.alamat as alamat_user','us.username'
			,'ts.nama_travel','ts.alamat as alamat_travel'
			,'ts.logo as logo','ts.no_wa','ts.no_rekening')
		->where('os.id_user',$id)
		->first();
		$hasil = [$data];
		return $hasil;
	}

	public function getPesananByIdTravel($id)
	{
		$data = DB::table('orders as os')
		->join('users as us','us.id','=','os.id_user')
		->join('posts as ps','ps.id','=','os.id_post')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->select('os.*','us.nama_depan as nama_depan_user'
			,'us.nama_belakang as nama_belakang_user'
			,'us.alamat as alamat_user','us.username'
			,'ts.nama_travel','ts.alamat as alamat_travel'
			,'ts.logo as logo','ts.no_wa','ts.no_rekening')
		->where('ps.id_travel',$id)
		->first();
		$hasil = [$data];
		return $hasil;
	}

	public function postPesanan($request)
	{
		$cek = DB::table('orders')
			  ->where('id_user',$request->id_user)
			  ->where('id_post',$request->id_post)
			  ->where('status','belum')
			  ->first();
		if($cek)
		{
			return 0;
		}
		$data = DB::table('orders')->insertGetId(
			[
				'id_user'=>$request->id_user,
				'id_post'=>$request->id_post,
				'tanggal_order'=>Carbon::now()->format('Y-m-d'),
				'no_order'=>rand(),
				'status'=>'belum',
				'created_at'=>Carbon::now()->toDateTimeString(),
			]);
		return $data;
	}

	public function updatePesanan($request)
	{
		$data = DB::table('orders')->where('id',$request->id)->update(
			[
				'status'=>$request->status,
			]);
		return $data;
	}
}