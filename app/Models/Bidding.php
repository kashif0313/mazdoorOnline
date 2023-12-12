<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bidding extends Model
{
    public function postBidding($data)
    {
        
    $result = DB::table('bidding')->insert([$data]);
    $message = "success";
     return ($message);
    }
    
    public function getBidding($data)
    {
        
    $result = DB::table('bidding')->where('jobID','=', $data)->get();
     return $result;
    }
    
}
