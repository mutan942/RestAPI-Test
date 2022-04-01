<?php
namespace App\Services;

use App\Repositories\UserRepo;
use Illuminate\Support\Facades\Validator;

class UserService{
    private $userrepo;

    public function __construct(UserRepo $userrepo){
        $this->userrepo = $userrepo;
    }

    public function register($param){
        try{
            $post = $this->userrepo->register($param);
        }catch (Exception $e){
            return $this->responseku(false,$e->getMessage(),'');
        }
        return $this->responseku(true,"User berhasil ditambahkan !",'');
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