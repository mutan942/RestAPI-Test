<?php
namespace App\Services;

use App\Repositories\PenjualanRepo;
use Illuminate\Support\Facades\Validator;

class PenjualanService{
    private $productrepo;

    public function __construct(PenjualanRepo $productrepo){
        $this->productrepo = $productrepo;
    }

    public function jualbarang($car){
        try{
            $post = $this->productrepo->jualbarang($car);
        }catch (Exception $e){
            return $this->responseku(false,$e->getMessage(),'');
        }
        
        return $this->responseku($post[0],$post[1],"");
    }

    public function laporan($car){
        try{
            $post = $this->productrepo->laporan($car);
        }catch (Exception $e){
            return $this->responseku(false,$e->getMessage(),'');
        }
        
        return $this->responseku(true,$post[0],$post[1]);
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