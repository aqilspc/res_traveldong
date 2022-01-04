<?php

namespace App\Models;
use DB;
use Carbon\Carbon;
class Postingan{

	public function getPostinganAll()
	{
		$data = DB::table('posts as ps')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->select('ps.*','ts.nama_travel','ts.logo')
		->get();
		return $data;

	}

	public function getPostinganByid($id)
	{
		$data = DB::table('posts as ps')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->select('ps.*','ts.nama_travel','ts.no_wa')
		->where('ps.id',$id)
		->first();
		$galery_posts = $this->getGaleryByIdTravel($id);
		$hasil = [$data,$galery_posts];
		return $hasil;
	}

	public function getGaleryByIdTravel($id)
	{
		$data = DB::table('galery_posts')->where('id_post',$id)->get();
		return $data;
	}

	public function getGaleryTravelProfiel($id)
	{
		$data = DB::table('galery_travels')->where('id_travel',$id)->get();
		return $data;
	}

	public function getPostinganByidTravel($id)
	{
		$data = DB::table('posts as ps')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->where('ps.id_travel',$id)
		->get();
		return $data;
	}

	public function cariPostingan($request)
	{
		$awal = $request->tanggal_mulai;
		$akhir = $request->tanggal_mulai;
		$parseAwal = Carbon::parse($awal)->format('Y-m-d');
		$parseAkhir = Carbon::parse($akhir)->format('Y-m-d');
		$data = DB::table('posts as ps')
		->join('travels as ts','ts.id','=','ps.id_travel')
		->whereBetween('tanggal_mulai',[$parseAwal,$parseAkhir])
		->whereBetween('tanggal_akhir',[$parseAwal,$parseAkhir])
		->where('asal',$request->asal)
		->Orwhere('tujuan',$request->tujuan)
		->select('ps.*','ts.nama_travel','ts.logo')
		->get();
		if(!$data->isEmpty()){
			return $data;
		}else{
			$hasil = [];
			$hasil[0] = 'Maaf Data Yang Kamu Cari Belum Ada';
			return $hasil;
		}
		
	}

	public function postPostingan($request)
	{
		$data = DB::table('posts')->insertGetId(
			[
				'id_travel'=>$request->id_travel,
				'nama_post'=>$request->nama_post,
				//'foto'=>$request->foto,
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
				//'foto'=>$request->foto,
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

	public function deletePostingan($id)
	{
		$data = DB::table('posts')->where('id',$id)->delete();
		return $data;
	}
}