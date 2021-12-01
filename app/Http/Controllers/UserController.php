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
        return 'THIS INDEX OF BACKEND OF API TRAVELANDONG.MY.ID';
    }

    public function login()
    {
        $data = ['Success'=>'run'];
        return response()->json(
                    [
                        'status' => 'success',
                        'result' => $data,
                    ], 200);
    }
}
