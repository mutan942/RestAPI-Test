<?php 
namespace App\Repositories;

use App\Models\User;

class UserRepo {
    
    public function register($param){
        $user = new User();
        $user->name = $param["name"];
        $user->email = $param["email"];
        $user->password = bcrypt($param["password"]);
        $post = $user->save();
        return $post;
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