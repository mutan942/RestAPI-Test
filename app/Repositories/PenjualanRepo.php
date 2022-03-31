<?php 
namespace App\Repositories;

use App\Models\Kendaraan;
use App\Models\Penjualan;
use MongoDB\BSON\UTCDateTime;

class PenjualanRepo {
    
    public function jualbarang($data){
        $selisih = 0;
        $aksi = new Kendaraan();
        $stok = $aksi::where('_id', '=', $data["id_barang"]);
        //$res = [false,$stok->detail["mesin"]];
        if($stok->count()>0){
            $stok = $stok->first();
            $selisih = intval($stok->stok)-$data['qty'];
            if($selisih>=0){
                $update = $aksi::find($data['id_barang']);
                $update->stok = $selisih;
                $update->save();

                $p = new Penjualan();
                $p->id_barang = $data['id_barang'];
                $p->mesin = $stok->detail["mesin"];
                $p->jenis = $stok->jenis;        
                $p->qty = intval($data['qty']);        
                $p->harga = intval($stok->harga);        
                $p->total = intval($data['qty'])*intval($stok->harga);        
                $p->tanggal = $data['tanggal'];     
                $post = $p->save();

                $res = [true,"Penjualan berhasil !"];
                return $res;
            }else{
                $res = [false,"Stok tidak mencukupi !"];
                return $res;
            }
        }else{
            $res = [false,"Product tidak ditemukan !"];
            return $res;
        }
    }

    public function laporan($data){
        //$res = Penjualan::where('created_at', '>=', new UTCDateTime(new \DateTime('now')));
        $res = Penjualan::where('tanggal', '>=', new \DateTime($data['tgl1']))
                ->where('tanggal', '<=', new \DateTime($data['tgl2']))
                ->get();
        $arr = ["Selamat menikmati !",$res];
        return $arr; 
    }
}