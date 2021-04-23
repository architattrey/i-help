<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\models\Languages;
use App\models\MedicalType;
use App\models\Appusers;
use App\models\Blogs;
use App\models\Video;
use App\models\Questions;
use App\models\Answers;
use App\models\UserTransactions;

use DB,Image,Password,File,Validator;

class AjaxController extends Controller
{
    #Category image upload
    public function imageUpload(Request $request){
        try{
           
            if($request->thumbnail){
                
                $file_data = $request->thumbnail;
                $file_name = 'thumbnail_images/' . time() . '.' . explode('/', explode(':', substr($file_data, 0, strpos($file_data, ';')))[1])[1];
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    //dd($request->file_data);
                    \Storage::disk('public')->put($file_name, base64_decode($file_data));
                }
                // $finalPath = $file_name ? url('/')."/storage/app/public/".$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                $finalPath = $file_name;
                $base_url = url('/')."/storage/app/public/";
                if($finalPath){
                    return response()->json([
                        'message'=>' uploaded successfully.',
                        'image_url'=> $finalPath,
                        'base_url' => $base_url,
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'thumbnail not uploaded yet.',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please prvide the image.",
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
    #get all languages
    public function getLanguages(Request $request){
        try{
            $response['languages'] = Languages::get()->all();
            if(!empty($response['languages'])){
                #send response
                return response()->json([
                    'message'=>'All Languages',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no Languages found",
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
    #add Update language
    public function addUpdateLanguages(Request $request){
        try{
            #check if id 
            if($request->id){
                $languageData = Languages::where('id',$request->id)->first();
                if($languageData){
                    $returnData = Languages::where('id',$request->id)->update([
                       
                        'languages' => $request->languages,
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                        
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add Languages
                $model = new Languages();
                $model->languages = $request->languages;
                $model->created_at    = date("Y-m-d");
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Language added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    # delete Product
    public function deleteLanguages(Request $request){
        try{
            if($request->id){
                $languageData = Languages::where('id',$request->id)->first();
                if($languageData){
                    $returnData = DB::table('languages')->where('id',$request->id)->delete();
                    if($returnData){
                        return response()->json([
                            'message'=>'Language Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Language  not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #get all medical type
    public function getMedicalType(Request $request){
        try{
            $response['MedicalTypes'] = MedicalType::where('delete_status','1')->get();
            if(!empty($response['MedicalTypes'])){
                #send response
                return response()->json([
                    'message'=>'All MedicalTypes',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no MedicalType found",
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
    #add Update language
    public function addUpdateMedicalType(Request $request){
        try{
            #check if id 
            if($request->id){
                $medicalTypeData = MedicalType::where('id',$request->id)->first();
                if($medicalTypeData){
                    $returnData = MedicalType::where('id',$request->id)->update([
                       
                        'medical_type' => $request->medical_type,
                        'updated_at'=> date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add medical type
                $model = new MedicalType();
                $model->medical_type  = $request->medical_type;
                $model->created_at    = date("Y-m-d");
                $model->delete_status = "1";
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Medical Type added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    # delete Product
    public function deleteMedicalType(Request $request){
        try{
            if($request->id){
                $languageData = MedicalType::where('id',$request->id)->first();
                if($languageData){
                    $returnData = MedicalType::where('id',$request->id)->update([
                        'delete_status'=>'0'
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Medical Type Deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Medical Type  not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #get app user
    public function getUsers(Request $request){
        try{
            $response['users'] = Appusers::get()->all();
            if(!empty($response['users'])){
                $response['base_url'] = url('/')."/storage/app/";
                #send response
                return response()->json([
                    'message'=>'All Users',
                    'code'=>200,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no users found",
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
    # delete user
    public function deleteUser(Request $request){
        try{
            if(!empty($request->id)){
                $data = Appusers::where('id',$request->id)->first();
                if(!empty($data)){
                    $returnData = Appusers::where('id',$request->id)->update([
                        'delete_status'  => $request->delete_status,
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'User Status changed successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Product  not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    # show user transactions
    public function showTransactions(Request $request){
        try{
            if(!empty($request->user_id)){
                $userTreansactions = UserTransactions::where('user_id',$request->user_id)->get();
                if(count($userTreansactions) !=0){
                    return response()->json([
                        'message'=>'User Status changed successfully.',
                        'code'=>200,
                        'status'=>'success',
                        'response'=>$userTreansactions
                    ]);
                }else{
                    return response()->json([
                        'message'=>"Data not found",
                        'status'=>'data error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    # get all transactions
    public function getTransactions(Request $request){
        try{
            $transactions = UserTransactions::get()->all();
            if(count($transactions) !=0){
                return response()->json([
                    'message'=>'all transactions',
                    'code'=>200,
                    'status'=>'success',
                    'response'=>$transactions
                ]);
            }else{
                return response()->json([
                    'message'=>"Data not found",
                    'status'=>'data error'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #get all blogs
    public function getBlogs(Request $request){
        try{
            $response['blogs'] = Blogs::with(['medicalType'])->where('delete_status','1')->get();
            if(!empty($response['blogs'])){
                $base_url = url('/')."/storage/app/public/";
                #send response
                return response()->json([
                    'message'=>'All blogs',
                    'code'=>200,
                    'base_url' => $base_url,
                    'data'=>$response,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no blogs found",
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
    #add Update blog
    public function addUpdateBlog(Request $request){
        try{
            #check if id 
            if($request->id){
                $blogData = Blogs::where('id',$request->id)->where('delete_status','1')->first();
                if($blogData){
                    $returnData = Blogs::where('id',$request->id)->update([
                       
                        'lang_id'=>$request->lang_id,
                        'medical_type_id' => $request->medical_type_id,
                        'name'=> $request->name,
                        'description'=>$request->description,
                        'thumbnail'  =>$request->thumbnail,
                        'blog'       =>$request->blog,
                        'blog_type'  =>$request->blog_type,
                        'updated_at' => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add blog
                $model = new Blogs();
                $model->lang_id = $request->lang_id;
                $model->medical_type_id  = $request->medical_type_id;
                $model->name       = $request->name;
                $model->description= $request->description;
                $model->thumbnail  = $request->thumbnail;
                $model->blog       = $request->blog;
                $model->blog_type  = $request->blog_type;
                $model->created_at = date("Y-m-d");
                $model->delete_status = "1";
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Blog added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #delete Blog
    public function deleteBlog(Request $request){
        try{
            if(!empty($request->id)){
                $data = Blogs::where('id',$request->id)->first();
                if(!empty($data)){
                    $returnData = Blogs::where('id',$request->id)->update([
                        'delete_status'  => '0',
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Blog Status changed successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Blog not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #video upload
    public function videoUpload(Request $request){
        try{
            if($request->video){
                
                $file_data = $request->video;
                $file_name = 'videos/' . time() . '.' . explode('/', explode(':', substr($file_data, 0, strpos($file_data, ';')))[1])[1];
                @list($type, $file_data) = explode(';', $file_data);
                @list(, $file_data) = explode(',', $file_data);
                if ($file_data != "") {
                    //dd($request->file_data);
                    \Storage::disk('public')->put($file_name, base64_decode($file_data));
                }
                // $finalPath = $file_name ? url('/')."/storage/app/public/".$file_name : url('/')."/public/dist/img/user-dummy-pic.png";
                $finalPath = $file_name;
                //dd($finalPath);
                $base_url = url('/')."/storage/app/public/";
                if($finalPath){
                    return response()->json([
                        'message'=>' uploaded successfully.',
                        'video_url'=> $finalPath,
                        'base_url' => $base_url,
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>'video not uploaded yet.',
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Please prvide the image.",
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
    #get all blogs
    public function getVideos(Request $request){
        try{
            $response['videos'] = Video::with(['medicalType'])->where('delete_status','1')->get();
            $base_url = url('/')."/storage/app/public/";

            if(!empty($response['videos'])){
                #send response
                return response()->json([
                    'message'=>'All videos',
                    'code'=>200,
                    'data'=>$response,
                    'base_url'=> $base_url,
                    'status'=>'success'
                ]);
            }else{
                return response()->json([
                    'message'=>"no videos found",
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
    #add Update video
    public function addUpdateVideo(Request $request){
        try{
            #check if id 
            if($request->id){
                $blogData = Video::where('id',$request->id)->where('delete_status','1')->first();
                if($blogData){
                    $returnData = Video::where('id',$request->id)->update([
                       
                        'lang_id'=>$request->lang_id,
                        'medical_type_id' => $request->medical_type_id,
                        'name'=> $request->name,
                        'description'=>$request->description,
                        'thumbnail'  =>$request->thumbnail,
                        'video'       =>$request->video,
                        'video_type'  =>$request->video_type,
                        'updated_at' => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add blog
                $model = new Video();
                $model->lang_id = $request->lang_id;
                $model->medical_type_id  = $request->medical_type_id;
                $model->name       = $request->name;
                $model->description= $request->description;
                $model->thumbnail  = $request->thumbnail;
                $model->video       = $request->video;
                $model->video_type  = $request->video_type;
                $model->created_at = date("Y-m-d");
                $model->delete_status = "1";
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'video added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #delete video
    public function deleteVideo(Request $request){
        try{
            if(!empty($request->id)){
                $data = Video::where('id',$request->id)->first();
                if(!empty($data)){
                    $returnData = Video::where('id',$request->id)->update([
                        'delete_status'  => '0',
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Video deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry video not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #getQuestions
    public function getAllQuestions(Request $request){
        try{
            $questions = Questions::with(['video','blog','language'])->where('delete_status','1')->get()->all();
            if(!empty($questions)){
                return response()->json([
                    'message'=>'Question data.',
                    'code'=>200,
                    'status'=>'success',
                    'questions'=>$questions
                ]);
            }else{
                return response()->json([
                    'message'=>"Sorry questions not found with our data",
                    'status'=>'not found'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #add Update questions
    public function addUpdateQuestion(Request $request){
        try{
            #first check
            //dd($request->all());
            if(empty($request->video_id) && empty($request->blog_id)){
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
                    'status'=>'data_error'
                ]);
            }elseif(!empty($request->video_id) && !empty($request->blog_id)){
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
                    'status'=>'double_data_error'
                ]);
            }
            #check if id 
            if($request->id){
                $questionData = Questions::where('id',$request->id)->where('delete_status','1')->first();
                if($questionData){
                    $returnData = Questions::where('id',$request->id)->update([
                       
                        'lang_id'  =>$request->lang_id,
                        'video_id' =>$request->video_id,
                        'blog_id'  =>$request->blog_id,
                        'type'     =>$request->type,
                        'question' =>$request->question,
                        'option_one'  =>$request->option_one,
                        'option_two'  =>$request->option_two,
                        'option_three'=>$request->option_three,
                        'option_four' =>$request->option_four,
                        'updated_at'  => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add Questions
                $model = new Questions();
                $model->lang_id   = $request->lang_id;
                $model->video_id  = $request->medical_type_id;
                $model->blog_id   = $request->blog_id;
                $model->type      = $request->type;
                $model->question  = $request->question;
                $model->option_one= $request->option_one;
                $model->option_two= $request->option_two;
                $model->option_three = $request->option_three;
                $model->option_four  = $request->option_four;
                $model->created_at   = date("Y-m-d");
                $model->delete_status = "1";
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Questions added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
        
    }
    #delete question
    public function deleteQuestion(Request $request){
        try{
            if(!empty($request->id)){
                $data = Questions::where('id',$request->id)->first();
                if(!empty($data)){
                    $returnData = Questions::where('id',$request->id)->update([
                        'delete_status'  => '0',
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Questions deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Question not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
    #get answers
    public function getAllAnswers(Request $request){
        try{
            $answers = Answers::with(['questions'])->where('delete_status','1')->get()->all();
            if(!empty($answers)){
                return response()->json([
                    'message'=>'Answers data.',
                    'code'=>200,
                    'status'=>'success',
                    'answers'=>$answers
                ]);
            }else{
                return response()->json([
                    'message'=>"Sorry answers not found with our data",
                    'status'=>'not found'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
    }
    #add Update Answers
    public function addUpdateAnswer(Request $request){
        try{
            #first check
            //dd($request->all());
            if(empty($request->question_id)){
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
                    'status'=>'data_error'
                ]);
            }
            #check if id 
            if($request->id){
                $answerData = Answers::where('id',$request->id)->where('delete_status','1')->first();
                if($answerData){
                    $returnData = Answers::where('id',$request->id)->update([
                       
                        'ques_id' =>$request->question_id,
                        'answer' =>$request->answer,
                        'updated_at'  => date('Y-m-d')
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Updated successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Data not found",
                        'status'=>'error'
                    ]);
                }
            }else{
                #add Answers
                $model = new Answers();
                $model->ques_id   = $request->question_id;
                $model->answer  = $request->answer;
                $model->created_at   = date("Y-m-d");
                $model->delete_status = "1";
                $model->save();
                if($model->id){
                    return response()->json([
                        'message'=>'Answer added successfully.',
                        'code'=>200,
                        'status'=>'success'
                    ]);
                }else{
                    return response()->json([
                        'message'=>"something went wrong contact with administrator.",
                        'status'=>'error'
                    ]);
                } 
            }
        }catch(\Exception $e){
            return response()->json([
                'message'=>"Something went wrong. Please contact administrator.".$e->getMessage(),
                'status'=>'error'
            ]);
        }
        
    }
    #delete answer
    public function deleteAnswer(Request $request){
        try{
            if(!empty($request->id)){
                $data = Answers::where('id',$request->id)->first();
                if(!empty($data)){
                    $returnData = Answers::where('id',$request->id)->update([
                        'delete_status'  => '0',
                    ]);
                    if($returnData){
                        return response()->json([
                            'message'=>'Answer deleted successfully.',
                            'code'=>200,
                            'status'=>'success'
                        ]);  
                    }else{
                        return response()->json([
                            'message'=>"Something went wrong with this request.Please try again later",
                            'status'=>'error'
                        ]);
                    }
                }else{
                    return response()->json([
                        'message'=>"Sorry Answer not found with our data",
                        'status'=>'error'
                    ]);
                }
            }else{
                return response()->json([
                    'message'=>"Something went wrong with this request.Please try again later",
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
}
