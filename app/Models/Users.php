<?php

namespace App\Models;

use Illuminate\Contracts\Session\Session as SessionSession;
use Throwable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class Users extends Model

{
  
    public function addUserDB($data)
    {   
     
       //print_r($data);
         $result = DB::table('webusers')->insert([$data]);
           //return $result;
        //echo("posted successfully");
        $result1 = DB::getPdo()->lastInsertId();
        //echo("\n"); 
       // echo($result1);
        //echo("\n");
        $message="Success";
        return ([$message,$result1]);
        

    }
    public function getUser()
    {   
        //  dd("backendCalled!Get");
        $result = DB::table('webusers')->get();
        return $result;

    }
    public function removeUser($data)
    { $removeUser = "true";
      $result = DB::table('webusers')->where('id','=', $data)->update(['blocked'=>$removeUser]);
        $message = "success";
        return $message;
    }
    public function updateUser($data)
    {
      $removeUser = "false";
      $result = DB::table('webusers')->where('id','=', $data)->update(['blocked'=>$removeUser]);
        $message = "success";
        return $message;
     }
    public function getLoginDetails($data)
    {
       $datapassword = $data['password'];
       $dataemail = $data['email'];
        if($data["email"] == "admin@gmail.com")
        {
          if($data["password"] == "admin")
          {
            $resultID = "admin";
            $message = "Admin";
            $resultUser = "Admin";
            return ( [$message,$resultID,$resultUser]);
          }
         
        }
        else{
        $message="";
        $blockUser = "true";
        $result = DB::table('webusers')->where('email', '=', $dataemail)->orWhere('phoneNo', '=', $dataemail)->get();
          $resultPass = $result->implode('password'); 
          $resultID = $result->implode('id');
          $resultUser = $result->implode('name');
          $resultEmploye = $result->implode('user');
          $resultBlocked = $result->implode('blocked');
          $decryptPass= Crypt::decryptString($resultPass);
          if($datapassword == $decryptPass)
          {
            
            if($resultBlocked == $blockUser)
            {
              $message="Blocked";
            //print_r("blocked");
            
            return ( [$message,$resultID,$resultUser]);

            }
            else
            {
              $message="success";
              //print_r("ok");
            
            return ( [$message,$resultID,$resultUser,$resultEmploye]);
            }
            
          }
          else
          {
            //print_r("login Failed");
            $message = "failed";
            return null;
          }
        }
    }
    public function getProfileDetails($userID)
    {
      $result = DB::table('webusers')->where('id','=',$userID)->get();
      return $result;
    }
    public function updateUserProfile($data)
    {
      $imgSrc=$data["profileImage"];
      $result = DB::table('webusers')->where('id','=',$data)->update(['profileImage' => $imgSrc]);
        return $result;
    }
    public function updateExtUserData($data)
    {
      $dataID = $data['id'];
      $dataEmail = $data['email'];
      $dataPhone = $data['phoneNo'];
      $dataAddr = $data['address'];
      $dataName = $data['name'];
      $result = DB::table('webusers')->where('id','=',$dataID)->update(['name' => $dataName , 'email'=>$dataEmail,'phoneNo'=>$dataPhone,'address'=>$dataAddr]);
        return $result;
    }
    public function getBiddingProfile($data)
    {
        
    $result = DB::table('webusers')->where('id','=', $data)->get();
     return $result;
    }
    public function postRating($data)
    {
      $result = DB::table('LabourRatings')->insert([$data]);
     return $result;
    }
    public function getRating($data)
    {
      $result = DB::table('LabourRatings')->where('profileID','=', $data)->get();
     return $result;
    }
}
