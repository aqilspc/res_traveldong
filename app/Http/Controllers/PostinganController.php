<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Postingan;
use Illuminate\Http\Request;
class PostinganController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function model()
    {
        $data = new Postingan();
        return $data;
    }

    public function index()
    {
        return 'none';
    }

    public function getPostinganAll()
    {
        $data = $this->model()->getPostinganAll();
        return $data;
    }

    public function getPostinganByid($id)
    {
        $data = $this->model()->getPostinganByid($id);
        return $data;
    }

    public function getGaleryByIdTravel($id)
    {
        $data = $this->model()->getGaleryByIdTravel($id);
        return $data;
    }

    public function getPostinganByidTravel($id)
    {
        $data = $this->model()->getPostinganByidTravel($id);
        return $data;
    }

    public function postPostingan(Request $request)
    {
        $data = $this->model()->postPostingan($request);
        $gagal = [];
        $gagal[0] = 'Gagal insert data!';
        if($data > 0 || $data){
            $getInserted = $this->model()->getPostinganByid($data);
            return $getInserted;
        }else{
            return $gagal;
        }
    }

    public function updatePostingan(Request $request)
    {
        $data = $this->model()->updatePostingan($request);
        $gagal = [];
        $gagal[0] = 'Gagal update data!';
        if($data){
            $getUpdated = $this->model()->getPostinganByid($request->id);
            return $getUpdated;
        }else{
            return $gagal;
        }
    }

    public function deletePostingan($id)
    {
        $data = $this->model()->deletePostingan($id);
        $gagal = [];
        $gagal[0] = 'Gagal hapus data!';
        if($data){
            $gatDeleted = [];
            $gatDeleted[0] = 'Berhasil hapus data';
            return $gatDeleted;
        }else{
            return $gagal;
        }
    }
}
