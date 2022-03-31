<?php
namespace App\Services;

use App\Repositories\ProductRepo;
use Illuminate\Support\Facades\Validator;

class ProductService{
    private $productrepo;

    public function __construct(ProductRepo $productrepo){
        $this->productrepo = $productrepo;
    }

    public function getall($param){
        $data = $this->productrepo->getall($param);
        return $this->responseku(true,'Selamat menikmati',$data);
    }

    public function savecar($car){
        try{
            $post = $this->productrepo->savecar($car);
        }catch (Exception $e){
            return $this->responseku(false,$e->getMessage(),'');
        }
        return $this->responseku(true,"Product berhasil ditambahkan !",'');
    }

    public function responseku($success, $pesan, $data){
        $res = [
            'success' => $success,
            'message' => $pesan
        ];
        if(empty($data)){
            $res["data"] = "Not to show";
        }else{
            $res["data"] = $data;
        }
        return $res;
    }
}