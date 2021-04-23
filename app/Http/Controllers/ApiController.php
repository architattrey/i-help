<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\User;
use App\models\Appusers;
use App\models\Languages;
use App\models\Video;
use App\models\MedicalType;
use App\models\Blogs;
use App\models\Questions;
use App\models\Answers;
use App\models\UserTransactions;
use DB;

class ApiController extends Controller
{
   #user login or register
   public function login(Request $request){
    try{
        $appUsers = new Appusers();
        #login with phone number  
        if(!empty($request->phone_number)){
            #get data of user if phone_number will match
            $response['appusers'] = $appuser = Appusers::where('phone_number',$request->phone_number)->first();
            if(!empty($response['appusers']) && isset($response['appusers'])) {
                $transaction = UserTransactions::where('user_id',$appuser->id)->first();
                if(!empty($transaction->expire_date) && $transaction->expire_date <= date('Y-m-d')){
                    $updateToken = Appusers::where('id',$appuser->id)->update([
                        'firebase_token'    => $request->firebase_token,
                    ]);
                    #send response
                    return response()->json([
                        'message'=>'login successfully.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success',
                        'if_paid'=>'yes'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Please Buy plan before login',
                        'status'=>'success',
                        'if_paid'=>'no',
                        'data'=>$response
                    ]);
                }      
            }else{
                #register if user not found in database
                //$appUsers->user_type = $appUsers->user_type;
                $appUsers->name           = " ";
                $appUsers->email_id       = " ";
                $appUsers->phone_number   = $request->phone_number;
                $appUsers->firebase_token = $request->firebase_token;
                $appUsers->gender         = " ";
                $appUsers->state          = " ";
                $appUsers->city           = " ";                   
                $appUsers->dob            = " ";
                $appUsers->image          = " ";
                $appUsers->delete_status  = "1";
                $appUsers->created_at     = date("Y-m-d");
                $appUsers->save();
                if($appUsers->id){
                    $response['appusers'] = Appusers::where('id',$appUsers->id)->first();
                    return response()->json([
                        'message'=>'Registered successfully. But plan has not purchased yet.',
                        'code'=>200,
                        'data' => $response,
                        'status'=>'success',
                        'if_paid'=>'no'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error',
                       
                    ]);
                }
            }
        }elseif(!empty($request->email_id)){
            #get data of user if email will match
            $response['appusers']= $appuser = Appusers::where('email_id',$request->email_id)->first();
            if(!empty($response['appusers']) && isset($response['appusers'])) {
                $transaction = UserTransaction::where('user_id',$appuser->id)->first();
                if(!empty($transaction->expire_days) && $transaction->expire_date <= date('Y-m-d')){
                    $updateToken = Appusers::where('id',$appuser->id)->update([
                        'firebase_token' => $request->firebase_token,
                    ]);
                    #send response
                    return response()->json([
                        'message'=>'login successfully.',
                        'code'=>200,
                        'data'=>$response,
                        'status'=>'success',
                        'if_paid'=>'yes'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Please Buy plan before login',
                        'status'=>'error',
                        'if_paid'=>'no',
                        'data'=>$response,
                    ]);
                }
            }else{
                #register if user not found in database
                $appUsers->name           = " ";
                $appUsers->email_id       = $request->email_id;
                $appUsers->phone_number   = "";
                $appUsers->firebase_token = $request->firebase_token;
                $appUsers->gender         = " ";
                $appUsers->state          = " ";
                $appUsers->city           = " ";                   
                $appUsers->dob            = " ";
                $appUsers->image          = " ";
                $appUsers->delete_status  = "1";
                $appUsers->created_at     = date("Y-m-d");
                $appUsers->save();
                if($appUsers->id){
                    $response['appusers'] = Appusers::where('id',$appUsers->id)->first();
                    return response()->json([
                        'message'=>'Registered successfully. But plan has not purchased yet.',
                        'code'=>200,
                        'data' => $response,
                        'status'=>'success',
                        'if_paid'=>'no'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                }
            }
        }else{
            return response()->json([
                'message'=>"Please provide atleast one login detail",
                'status'=>'error'
            ]);
        }
    }catch(\Exception $e){
        return response()->json([
            'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
            'status'=>'error'
        ]);
    }
}
    # user image upload
    public function imageUpload(Request $request){
        try{
            //return  response()->json([base64_decode($request->userImage)]);
            $appUserId = $request['user_id'];
            //check request have data or not
            if(!empty($appUserId) && isset($appUserId)){
                $appUser = Appusers::where('id',$appUserId)->first();
                //check user is in database
                if (!empty($appUser) && isset($appUser)) {
                    $validator = Validator::make($request->all(), ['image' => 'required']);
                    if ($validator->fails()) {
                        return response()->json([
                            'message'=>$validator->messages(),
                            'status'=>'error'
                        ]);
                    }
                    if($request->image){
                        $file_name = 'public/user_images/_user'.time().'.png';
                        $path = Storage::put($file_name, base64_decode($request->image),'public');
                        if($path==true){
                            //update image in agent table of agent
                            $appUsers =   Appusers::where('id', $appUserId)->first();
                            $appUsers->update(['image' => $file_name]);
                            $finalPath = $file_name ? url('/').'/storage/app/'.$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                            return response()->json([
                                'message'=>'Image successfully uploaded',
                                'status'=>'success',
                                'response'=>$finalPath,
                                'code'=>200
                            ]);

                        }else{
                            return response()->json([
                                'message'=>'Something went wrong with request.Please try again later',
                                'status'=>'error'
                            ]);
                        }
                    }else{
                        return response()->json([
                            'message'=>'Please provide image for uploading',
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'User not found',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'You are not able to performe this task',
                    'status'=>'error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "error" =>true,
            ]);
        }
    }
    #update firebase token
    public function updateFireBaseToken(Request $request){
        try{
            if($request->id  &&  $request->fireBaseToken){
                $appUsers = Appusers::where('id',$request->id)->first();
                if($appUsers){
                    $updateToken = Appusers::where('id',$request->id)->update([
                        'firebase_token'    => $request->fireBaseToken,
                    ]);
                    if($updateToken){
                        return response()->json([
                            'message'=>"token successfully updated",
                            'status' =>'success',
                            'code' =>200,
                        ]);
                    }else{
                        return  response()->json([
                            'message'=>'token is not updated yet. please try again',
                            'status' =>'error',
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>'user is not found in database',
                        'status' =>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>' userId or token not provided',
                    'status' =>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"something went wrong.Please contact administrator.".$e->getMessage(),
                'error' =>true,
            ]);
        }
    }
    #app user profile update
    public function appUserProfileUpdate(Request $request){
        try{
            $appUserId = $request['user_id'];
            //check request have data or not
            if(!empty($appUserId) && isset($appUserId)){
                $appUser = Appusers::where('id',$appUserId)->first();
                //check user is in database
                if(!empty($appUser) && isset($appUser)) {
                    Appusers::where('id',$appUserId)->update([
                        
                       'name'         => $request->name,
                       'email_id'     => $request->email_id,
                       'phone_number' => $request->phone_number,
                       'gender'       => $request->gender,
                       'state'        => ucfirst($request->state),
                       'city'         => ucfirst($request->city),
                       'dob'          => $request->dob,
                       'updated_at'   => date("Y-m-d"),
                    ]);
                    $response = [];
                    $response['appUser'] =  Appusers::where('id', $appUserId)->first();
                    return response()->json([
                        'message'=>'Profile successfully updated',
                        'status'=>'success',
                        'data'=>$response
                    ]);
                }else{
                    return response()->json([
                        'message'=>'User not found',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'You are not able to performe this task',
                    'status'=>'error'
                ]);
            }        
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "error" =>true,
            ]);
        }

    }
    #get languages
    public function getLanguages(Request $request){
        try{
            $languages = Languages::all();
            if(count($languages) != 0){
                return response()->json([
                    'message'=>'All languages',
                    'status'=>'success',
                    'code'=>200,
                    'languages'=>$languages
                ]);
            }else{
                return response()->json([
                    'message'=>'Languages not found',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status"=>"error",
            ]);
        }
    }
    #get languages
    public function getMedicalType(Request $request){
        try{
            $languages = MedicalType::all();
            if(count($languages) != 0){
                return response()->json([
                    'message'=>'All medicaltypes',
                    'status'=>'success',
                    'code'=>200,
                    'languages'=>$languages
                ]);
            }else{
                return response()->json([
                    'message'=>'Languages not found',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status"=>"error",
            ]);
        }
    }
    #get videos
    public function getVideos(Request $request){
        try{
            if(!empty($request->lang_id) && !empty($request->video_type)){
                $videos = Video::where('lang_id',$request->lang_id)
                                ->where('video_type',$request->video_type)
                                ->where('delete_status',"1")
                                ->where('medical_type_id',$request->medical_type_id)
                                ->get();
                $base_url = url('/')."/storage/app/public/";
                if(count($videos) !=0){
                    return response()->json([
                        'message'=>'All related videos',
                        'status'=>'success',
                        'code'=>200,
                        'videos'=>$videos,
                        'base_url'=> $base_url
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Videos not found',
                        'status'=>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Languages not found',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
    #get videos
    public function getBlogs(Request $request){
        try{
            if(!empty($request->lang_id) && !empty($request->blog_type)){
                $blogs = Blogs::where('lang_id',$request->lang_id)
                                ->where('blog_type',$request->blog_type)
                                ->where('delete_status','1')
                                ->where('medical_type_id',$request->medical_type_id)
                                ->get();
                if(count($blogs) !=0){
                    return response()->json([
                        'message'=>'All related blogs',
                        'status'=>'success',
                        'code'=>200,
                        'blogs'=>$blogs
                    ]);
                }else{
                    return response()->json([
                        'message'=>'blogs not found',
                        'status'=>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Provide language id and blog type',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
    #search filter by medical type
    public function searchMedicalType(Request $request){
        try{
            if(!empty($request->medical_type_id)){
                $medicalType = MedicalType::where('id',$request->medical_type_id)
                                ->where('delete_status','1')
                                ->get();
                if(count($medicalType) !=0){
                    return response()->json([
                        'message'=>'All related medical Type',
                        'status'=>'success',
                        'code'=>200,
                        'medical_type'=>$medicalType
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Medical Type not found',
                        'status'=>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Provide medical type id',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
    # get questions
    public function getQuestions(Request $request){
        try{
            if(!empty($request->blog_id) && !empty($request->lang_id)){
                $questions = Questions::where('blog_id',$request->blog_id)
                                          ->where('delete_status','1')
                                          ->where('type','2')
                                          ->where('lang_id',$request->lang_id)
                                          ->get();
                if(count($questions) !=0){
                    return response()->json([
                        'message'=>'All blogs related Questions with options',
                        'status'=>'success',
                        'code'=>200,
                        'questions'=>$questions
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Blogs not found',
                        'status'=>'error',
                    ]);
                }
            }elseif(!empty($request->video_id) && !empty($request->lang_id)){
                $questions = Questions::where('video_id',$request->video_id)
                                          ->where('delete_status','1')
                                          ->where('type','1')
                                          ->where('lang_id',$request->lang_id)
                                          ->get();
                if(count($questions) !=0){
                    return response()->json([
                        'message'=>'All videos related Questions with options',
                        'status'=>'success',
                        'code'=>200,
                        'questions'=>$questions
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Questions not found',
                        'status'=>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'provide video id or blog id and language id',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
    # get answer
    public function getAnswer(Request $request){
        try{
            if(!empty($request->ques_id)){
                $answer = Answers::where('ques_id',$request->ques_id)
                                          ->where('delete_status','1')
                                          ->first();
                if(!empty($answer)){
                    return response()->json([
                        'message'=>'Answer of this question.',
                        'status'=>'success',
                        'code'=>200,
                        'answer'=>$answer
                    ]);
                }else{
                    return response()->json([
                        'message'=>'Not found',
                        'status'=>'error',
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>'Provide question id',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
    #submit transaction
    public function submitTransaction(Request $request){
        try{
            if(!empty($request->order_id) && !empty($request->user_id)){
                $model = new UserTransactions();
                $model->order_id   = $request->order_id;
                $model->user_id    = $request->user_id;
                $model->invoice_id = rand(100,10000);
                $model->amount     = $request->amount;
                $model->status     = $request->status;
                $model->expire_date = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
                $model->created_at = date('Y-m-d');
                $model->save();
                if($model->id){
                    $userData = Appusers::where('id',$request->user_id)
                                        ->where('delete_status','1')
                                        ->first();
                    if($request->status=="Fail"){
                       
                        #send response
                        $authKey = "782a3998b8c705c6f6a650897f4f3403";
                        $mobileNumber = $userData->phone_number;
                        $senderId = "IHELPX";
                        $message = "Your Transaction has been faild. Your order id : ".$request->order_id." and Your final amount : ".$request->amount;
                        $route = "4";
                        //Prepare you post parameters
                        $postData = array(
                            'authkey' => $authKey,
                            'mobiles' => $mobileNumber,
                            'message' => $message,
                            'sender'  => $senderId,
                            'route'   => $route
                        );
                        //API URL
                        $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));
                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //get response
                        $output = curl_exec($ch);
                        //return curl_error($ch);
                        //Print error if any
                        if (curl_errno($ch)) {
                            return response()->json([
                                'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                'status' =>'error'
                            ]);
                        }
                        curl_close($ch); 
                        return response()->json([
                            'message'=>'Transaction faild added.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        #send response
                        $authKey = "782a3998b8c705c6f6a650897f4f3403";
                        $mobileNumber = $userData->phone_number;
                        $senderId = "IHELPX";
                        $message = "Your Transaction has been succeed. Your order id : ".$request->order_id." and Your final amount : ".$request->amount;
                        $route = "4";
                        //Prepare you post parameters
                        $postData = array(
                            'authkey' => $authKey,
                            'mobiles' => $mobileNumber,
                            'message' => $message,
                            'sender'  => $senderId,
                            'route'   => $route
                        );
                        //API URL
                        $url = "http://sms.bulksmsserviceproviders.com/api/send_http.php";
                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));
                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                        //get response
                        $output = curl_exec($ch);
                        //Print error if any
                        if (curl_errno($ch)) {
                            return response()->json([
                                'message'=>curl_error($ch)."sms did not send but all operation has been successful",
                                'status' =>'error'
                            ]);
                        }
                        curl_close($ch); 
                        return response()->json([
                            'message'=>'Transaction successfully added.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }
                }else{
                    return response()->json([
                        'message'=>'transaction not saved yet.',
                        'status' =>'error'
                    ]);
                } 
            }else{
                return response()->json([
                    'message'=>'Provide user id and order id.',
                    'status'=>'error',
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                "message" => "Something went wrong. Please contact administrator.".$e->getMessage(),
                "status" =>"error",
            ]);
        }
    }
}
