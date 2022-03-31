<?php 
namespace App\Repositories;

use App\Models\Kendaraan;

class ProductRepo {
    
    public function getall($param){
        if(!empty($param["cari"])){
            $test = Kendaraan::where('detail.mesin', 'like', "%$param[cari]%")->get();
            return $test;
        }else{
            $test = Kendaraan::all();
            return $test;
        }
    }

    public function savecar($data){
        $car = new Kendaraan();
        $car->tahun_keluaran = $data['tahun_keluaran'];
        $car->warna = $data['warna'];
        $car->harga = $data['harga'];        
        $car->jenis = $data['jenis']; 
        $car->stok = $data['stok']; 
        if($data['jenis']=="mobil"){
            $car->detail = [
                "mesin" => $data['mesin'],
                "kapasitas" => $data['kapasitas'],
                "tipe" => $data['tipe'],
            ];   
        }else{
            $car->detail = [
                "mesin" => $data['mesin'],
                "suspensi" => $data['suspensi'],
                "transmisi" => $data['transmisi'],
            ];   
        }    
             
        $post = $car->save();
        return $post;
    }
}