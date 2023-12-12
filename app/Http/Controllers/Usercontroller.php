<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Bidding;
use App\Models\categories;
use App\Models\DashboardData;
use App\Models\jobPost;
use Illuminate\Http\Request;
use App\Models\Users;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;


class Usercontroller extends Controller
{
    public function addData(Request $request)
    {
        $file = $request->file('file');
        $allData = $request->all();
       if ($request->file('file')!=null)
       {
          
       $uploadpath = "E:\AngularProjects\FYP_mazdoorOnline\src\assets\profileImages";
        $orignalImage = $file->getClientOriginalName();
        $file->move($uploadpath,$orignalImage);
       }
        //$request['password'] = Hash::make($request->password);
        $request['password'] = Crypt::encryptString($request->password);
        $userModel = new Users();
        $result = $userModel->addUserDB($request->only('name','phoneNo','email','password','user','address','profileImage'));
        return response()->json($result);
        
    }
    public function getData()
    {
       
        $userModel = new Users();
        $result = $userModel ->getUser();
        return response()->json($result);
    }
    public function updateData(Request $request)
    {
        $userModel = new Users();
        $result = $userModel->updateUser($request->all());
    }
    
    public function removeData(Request $request)
    {
       
        $userModel = new Users();
        $result = $userModel ->removeUser($request->all());
        return response()->json($result);
    }
   
    public function getJob()
    {
        $JobModel = new jobPost();
        $result = $JobModel->getUserJob();
        return response()->json($result);

    }
    
    public function postJob(Request $request)
    {
        
          $file = $request->file('file');
         if ($request->file('file')!=null)
         {
            
         $uploadpath = "E:\AngularProjects\FYP_mazdoorOnline\src\assets\Jobs";
          $orignalImage = $file->getClientOriginalName();
          $file->move($uploadpath,$orignalImage);
          
          $userModel = new jobPost();
           $userModel->postJob($request->only('jobTitle','jobDetails','jobLocation','jobCost','jobLabour','uploadedby','jobImage'));
          print_r("\n file Moved \n ");
         }
          else
          {
            print_r("file not uploaded!!");
            print_r($request->all());
          }
     
    }
    public function loginUser(Request $request)
    {
        $userModel = new Users();
        $result = $userModel ->getLoginDetails($request->only('email','password'));
        return response()->json($result);
        
    }
    public function getDashboardData()
    {
        $dashboardData = new DashboardData();
        $result = $dashboardData->getDashboardData();
        return response()->json($result);

    }
    public function addNewCategory(Request $request)
    {
        $file = $request->file('file');
        $file1 = $request->file('file1');
        $newName = $request->category;
         $fileExt = $request->file('file')->extension();
        $renameFile = $newName.'.'.$fileExt;
        // print_r($file);
        // print_r($file1);
         if ($request->file('file')!=null)
         {
            
         $uploadpath = "E:\AngularProjects\FYP_mazdoorOnline\src\assets\icons";
         
          $file->move($uploadpath,$renameFile);
          print_r($renameFile);
          if ($request->file('file1')!=null)
         {
            $fileExt1 = $request->file('file1')->extension();
            $renameFile1 = $newName.'.'.$fileExt1;
            $uploadpath1 = "E:\AngularProjects\FYP_mazdoorOnline\src\assets\Category";
          
          $file1->move($uploadpath1,$renameFile1);
          print_r($renameFile1);
          $dashboardData = new categories();
          $result =  $dashboardData->addCategory($request->only('category','icon','catImage'));
           return response()->json($result);
         }
         }

       
        
    }
    public function updateCategory(Request $request)
    {
        $dashboardData = new categories();
        $result = $dashboardData->updateCategory($request->all());
        return $result;
    }
    public function deleteCategory(Request $request)
    {
        $dashboardData = new categories();
        $result = $dashboardData->removeCategory($request->all());
        return $result;
    }
    public function getAllCategory()
    {
        $dashboardData = new categories();
        $result = $dashboardData->getCategory();
        return response()->json($result);
    }
    public function updateUserData(Request $request)
    {
         
        $userModel = new Users();
        $result = $userModel->updateExtUserData($request->all());
    }
    public function getUserProfile(Request $request)
    {
        $userModel = new Users();
        $result = $userModel ->getProfileDetails($request->all());
        return response()->json($result);
    }
    public function updateUserProfile(Request $request)
    {   
        
        $file = $request->file('file');
        $allData = $request->all();
       if ($request->file('file')!=null)
       {
          
       $uploadpath = "E:\AngularProjects\FYP_mazdoorOnline\src\assets\profileImages";
        $orignalImage = $file->getClientOriginalName();
        $file->move($uploadpath,$orignalImage);
        
        
        $allData['jobImage'] = $orignalImage;
        
        $userModel = new Users();
         $userModel->updateUserProfile($request->only('id','profileImage'));
        print_r("\n file Moved \n ");
       }
        else
        {
          print_r("file not uploaded!!");
          print_r($request->all());
        }

    }
    public function getJobfromDB(Request $request)
    {
        //print_r($request->all());
        $dashboardData = new jobPost();
        $result = $dashboardData->getSpecificJob($request->all());
        return response()->json($result);
        
    }
    public function rejectJob(Request $request)
    {
        $image_name =$request->imageSrc;
        $image_path = ('E:\AngularProjects\FYP_mazdoorOnline\src\assets\Jobs/'.$image_name);
        //print_r($image_path);
        if(file_exists($image_path)){
          unlink($image_path);
        }
        $dashboardData = new jobPost();
        $delId =  $request->jobID;
        $result = $dashboardData->delSpecificJob($delId);
        return response()->json($result);
        
    }
    public function bidJob(Request $request)
    {
        $dashboardData = new Bidding();
        $result = $dashboardData->postBidding($request->all());
        return response()->json($result);
    }
    public function bidJobGet(Request $request)
    {
        $dashboardData = new Bidding();
        $result = $dashboardData->getBidding($request->all());
        return response()->json($result);
    }
    public function bidprofile(Request $request)
    {
        $dashboardData = new Users();
        $result = $dashboardData->getBiddingProfile($request->all());
        return response()->json($result);
    }
    public function rating(Request $request)
    {
        $dashboardData = new Users();
        $result = $dashboardData->postRating($request->all());
        return response()->json($result);
    }
    public function getrating(Request $request)
    {
        $dashboardData = new Users();
        $result = $dashboardData->getRating($request->all());
        return response()->json($result);
    }
}
