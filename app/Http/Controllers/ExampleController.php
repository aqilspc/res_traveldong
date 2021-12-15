<?php

namespace App\Http\Controllers;
use DB;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return 'none';
    }

    public function getImage()
    {
        $data = DB::table('gambar')->get();
        return response()->json(
                    [
                        'status' => 'success',
                        'result' => $data,
                    ], 200);
    }
}
