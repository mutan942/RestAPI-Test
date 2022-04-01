<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    private $pservice;

    public function __construct(ProductService $pservice){
        $this->pservice = $pservice;
    }

    public function index(Request $request)
    {
        $p["cari"] = $request->get('cari');
        $test = $this->pservice->getall($p);
        return response()->json($test, 200);
    }

    public function store(Request $request)
    {        
        //set validation
        $validator = Validator::make($request->all(), [
            'tahun_keluaran'   => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'jenis' => 'required',
            'stok' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($res, 400);
        }
        
        
        $test = $this->pservice->savecar($request->all());
        return response()->json($test, 200);
    }
}
