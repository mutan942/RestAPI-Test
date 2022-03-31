<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenjualanService;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    private $pservice;

    public function __construct(PenjualanService $pservice){
        $this->pservice = $pservice;
    }

    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'id_barang'   => 'required',
            'qty' => 'required'
        ]);
        
        //response error validation
        if ($validator->fails()) {
            $res = [
                'success' => false,
                'message' => $validator->errors()
            ];
            return response()->json($res, 400);
        }

        $car["id_barang"] = $request->get('id_barang');
        $car["qty"] = intval($request->get('qty')); 
        $car["tanggal"] = date("Y-m-d H:i:s");
        $test = $this->pservice->jualbarang($car);
        return response()->json($test, 200);
    }

    public function laporan(Request $request)
    {
        $car["tgl1"] = $request->get('tgl1');
        $car["tgl2"] = $request->get('tgl2');
        $test = $this->pservice->laporan($car);
        return response()->json($test, 200);
    }
}
