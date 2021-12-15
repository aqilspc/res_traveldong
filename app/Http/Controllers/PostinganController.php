<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Postingan;
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
        return response()->json(
                    [
                        $data
                    ], 200);
    }
}
