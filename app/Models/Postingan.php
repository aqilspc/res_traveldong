<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
class Postingan{

	public function getPostinganAll()
	{
		$data = DB::table('posts')->get();
		return $data;

	}

	public function getPostinganByid($id)
	{
		$data = DB::table('posts')->where('id',$id)->first();
		$hasil = [$data];
		return $hasil;
	}

	public function getPostinganByidTravel($id)
	{
		$data = DB::table('posts')->where('id_travel',$id)->get();
		return $data;
	}

	public function postPostingan($request)
	{
		$data = DB::table('posts')->insertGetId(
			[
				'id_travel'=>$request->id_travel,
				'nama_post'=>$request->nama_post,
				'foto'=>$request->foto,
				'tanggal_mulai'=>$request->tanggal_mulai,
				'tanggal_akhir'=>$request->tanggal_akhir,
				'harga'=>$request->harga,
				'deskripsi'=>$request->deskripsi,
				'asal'=>$request->asal,
				'tujuan'=>$request->tujuan,
				'promotion'=>$request->promotion,
				'created_at'=>Carbon::now()->toDateTimeString(),
			]);
		return $data;
	}

	public function updatePostingan($request)
	{
		$data = DB::table('posts')->where('id',$request->id)->update(
			[
				'nama_post'=>$request->nama_post,
				'foto'=>$request->foto,
				'tanggal_mulai'=>$request->tanggal_mulai,
				'tanggal_akhir'=>$request->tanggal_akhir,
				'harga'=>$request->harga,
				'deskripsi'=>$request->deskripsi,
				'asal'=>$request->asal,
				'tujuan'=>$request->tujuan,
				'promotion'=>$request->promotion,
				'created_at'=>Carbon::now()->toDateTimeString(),
			]);
		return $data;
	}

	public function deletePostingan($request)
	{
		$data = DB::table('posts')->where('id',$request->id)->delete();
		return $data;
	}
}