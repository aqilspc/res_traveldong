<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
class Pesanan{

	public function getPesananById($id)
	{
		$data = DB::table('orders')->where('id',$id)->first();
		return $data;

	}

	public function getPesananByIdUser($id)
	{
		$data = DB::table('orders')->where('id_user',$id)->first();
		return $data;
	}

	public function getPesananByIdTravel($id)
	{
		$data = DB::table('orders')->where('id_user',$id)->first();
		return $data;
	}

	public function postPesanan($request)
	{
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