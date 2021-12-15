<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Pesanan;
use Illuminate\Http\Request;
class PesananController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function model()
    {
        $data = new Pesanan();
        return $data;
    }

    public function getPesananById($id)
    {
        $data = $this->model()->getPesananById($id);
        if($data)
        {
            return $data;
        }else
        {
            $hasil = ['Data pesanan tidak ditemukan'];
            return $hasil;
        }
    }

    public function getPesananByIdUser($id)
    {
        $data = $this->model()->getPesananByIdUser($id);
        return $data;
    }

    public function getPesananByIdTravel($id)
    {
        $data = $this->model()->getPesananByIdTravel($id);
        return $data;
    }

    public function postPesanan(Request $request)
    {
        $data = $this->model()->postPesanan($request);
        $gagal = [];
        $gagal[0] = 'Gagal melakukan pemesanan ada pesanan yang belum diselesaikan';
        if($data > 0 || $data){
            $getInserted = $this->model()->getPesananById($data);
            return $getInserted;
        }else{
            return $gagal;
        }
    }

    public function updatePesanan(Request $request)
    {
        $data = $this->model()->updatePesanan($request);
        $gagal = [];
        $gagal[0] = 'Gagal mengupdate pesanan!';
        if($data){
            $getUpdated = $this->model()->getPesananById($request->id);
            return $getUpdated;
        }else{
            return $gagal;
        }
    }
}
