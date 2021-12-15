<?php

namespace App\Models;
use DB;
class Postingan{

	public function getPostinganAll()
	{
		$data = DB::table('posts')->get();
		return $data;

	}
}