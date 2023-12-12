<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class categories extends Model
{
    public function addCategory($data)
    {
        $result = DB::table('workingcategories')->insert([$data]);
        return $result;
    }
    public function getCategory()
    {
        $arrayVar = [];
        $result = DB::table('workingcategories')->get();
        foreach ($result as $userData) {
            
            $resID = $userData->id;
            $resName = $userData->category;
            $resIcon = $userData->icon;
            $resImage = $userData->catImage;

            $arrayVar[]=['catId' => $resID,'catName'=>$resName,'catIcon'=>$resIcon,'catImage'=>$resImage];
            

        }
        return $arrayVar;
    }
    public function removeCategory($data)
    {
        $result = DB::table('workingcategories')->where('id','=', $data)->delete();
        $message = "success";
        return $message;
    }
    public function updateCategory($data)
    {
        $catName = $data['name'];
        $catId = $data['id'];
        $result = DB::table('workingcategories')->where('id','=', $catId)->update(['category' => $catName]);
        $message = "success";
        return $message;
    }
   
}
