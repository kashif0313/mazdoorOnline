<?php

namespace App\Models;

use GrahamCampbell\ResultType\Success;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class jobPost extends Model
{
    public function postJob($data)
    {
        
        $result = DB::table('jobposting')->insert([$data]);
        return $result;
    }
    public function getUserJob()
    {   $arrayVar = [];
        //  dd("backendCalled!Get");
        $result = DB::table('jobposting')->get();
        //$resultid = DB::table('jobposting')->select('id')->get();
        foreach ($result as $blog) {
            $resID = $blog->id;
            $res = $blog->uploadedBy;
            $jTitle = $blog->jobTitle;
            $jDetail = $blog->jobDetails;
            $jImg = $blog->jobImage;
            $jLabour = $blog->jobLabour;
            $jLocation = $blog->jobLocation;
             $jCost = $blog->jobCost;
            $jupload = $blog->uploadedBy;
            
        //     $res = $result->implode('id');
        //   $jTitle = $result->implode('jobTitle');
            // print_r($res);
            // print_r("\n");
            // print_r($jTitle);
            $resultid = DB::table('webusers')->where('id','=', $res)->get();
            foreach ($resultid as $blogName) {
                $resName = $blogName->name;
                //dd($jLocation);
                //$resultArray=['jobTitle'=>$jTitle,'name'=>$resName];
                $arrayVar[]=['jobID'=>$resID,'jobTitle' => $jTitle,'name'=>$resName,'jobDetail'=>$jDetail,'jobLocation'=>$jLocation,'jobImage'=>$jImg,'jobLabour'=>$jLabour,'jobCost'=>$jCost,'jobuploadedBY'=>$jupload];
                
            }
           
           // print_r($arrayVar);
            }
            //print_r($arrayVar);
        //dd($resultid);
        return $arrayVar;

    }
    public function getSpecificJob($data)
    {
        // print_r("gettingData");
        // print_r($data);
        $JobArrayVar = [];
        //  dd("backendCalled!Get");
        $result = DB::table('jobposting')->where('id','=', $data)->get();
        foreach ($result as $blog) {
            $jTitle = $blog->jobTitle;
            $jDetail = $blog->jobDetails;
            $jImg = $blog->jobImage;
            $jLabour = $blog->jobLabour;
            $jLocation = $blog->jobLocation;
            $res = $blog->uploadedBy;
            $resultid = DB::table('webusers')->where('id','=', $res)->get();
            foreach ($resultid as $blogName) {
                $resName = $blogName->name;
                //dd($jLocation);
                //$resultArray=['jobTitle'=>$jTitle,'name'=>$resName];
                $JobArrayVar[]=['jobTitle' => $jTitle,'name'=>$resName,'jobDetail'=>$jDetail,'jobLocation'=>$jLocation,'jobImage'=>$jImg,'jobLabour'=>$jLabour,'jobUploadedBy'=>$res];
                
            }
        }
        
        return $JobArrayVar;

    }
    public function delSpecificJob($data)
    {
        print_r($data);
        $result = DB::table('jobposting')->where('id','=', $data)->delete();
        $Message = "success";
        return $Message;
    }
}
