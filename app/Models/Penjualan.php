<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $collection = 'penjualan';
    protected $primaryKey = '_id';
    protected $dates = ['tanggal'];
}
