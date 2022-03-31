<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Validator;

class KendaraanController extends Controller
{
    private $pservice;
    private $jwtService;

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
        $data['tahun_keluaran'] = $request->get('tahun_keluaran');
        $data['warna'] = $request->get('warna');
        $data['harga'] = intval($request->get('harga'));       
        $data['jenis'] = $request->get('jenis');
        $data['stok'] = intval($request->get('stok'));
        if($data['jenis']=="mobil"){
            $data['mesin'] = $request->get('mesin');
            $data['kapasitas'] = $request->get('kapasitas');
            $data['tipe'] =$request->get('tipe');
        }else{
            $data['mesin'] = $request->get('mesin');
            $data['suspensi'] = $request->get('suspensi');
            $data['transmisi'] =$request->get('transmisi');
        } 
        
        $test = $this->pservice->savecar($data);
        return response()->json($test, 200);
    }
}
