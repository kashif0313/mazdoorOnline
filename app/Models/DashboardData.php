<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DashboardData extends Model
{
    public function getDashboardData()
    {
        $arrayVar = [];
        $result = DB::table('webusers')->get();
        // foreach ($result as $userData) {
            
        //     $resID = $userData->id;
        //     $resName = $userData->name;
        //     $resEmail = $userData->email;
        //     $resPhone = $userData->phoneNo;
        //     $resUser = $userData->user;
        //     $resAddress = $userData->address;
        //     $resBlocked = $userData->address;
            
        //     $arrayVar[]=['id' => $resID,'name'=>$resName,'email'=>$resEmail,'phone'=>$resPhone,'user'=>$resUser,'address'=>$resAddress];
            

            
                
        // }
        return $result;
    }
    
}
