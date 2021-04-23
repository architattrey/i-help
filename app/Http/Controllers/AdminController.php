<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\models\User;
use App\models\Appusers;
use App\models\Languages;
use DateTime;
use HTML,Form,Auth,Validator,Mail,Response,Session,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,Input,URL;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','languageActions','medicalTypeActions','getUsers','getTransactions','getBlogs','getVideos','getQuestions']);
    }
    public function index()
    {
        //return view('home');
        $data = [];
        return view('admin.dashboard',$data);   
    }
    #login admin
    public function login(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'email'              => 'required|Email',
                'password'           => 'required',
            ]);
            if($validator->fails()) {
                Session::flash('flash_message', $validator->messages());    
                return back();
            }
            $userdata = array(
                'email'     =>  $request['email'],
                'password'  =>  $request['password'],
            );
            //check in auth for login
            $user = User::where('email',$request->email)->first();
           
            if(Auth::attempt($userdata)){
               
                $user_role = User::where('email',$request['email'])->value('role');
                if($user_role == "1"){
                    $admin = User::where('email',$request['email'])->first();
                    // $request->session()->put('data', $admin);
                    return redirect('/dashboard');
                }else{
                    Session::flash('flash_message','User is not exist.');
                    return back();
                }
            }else{
                Session::flash('flash_message','User is not exist.');    
                return back();
            }    
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        } 
    }
    #language
    public function languageActions(Request $request){
        try{
            return view('admin.language_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #medical type
    public function medicalTypeActions(Request $request){
        try{
            return view('admin.medical_type_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get Users
    public function getUsers(Request $request){
        try{
            return view('admin.users_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get Transactions
    public function getTransactions(Request $request){
        try{
            return view('admin.transactions_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get Blogs
    public function getBlogs(Request $request){
        try{
            return view('admin.blogs_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get Videos
    public function getVideos(Request $request){
        try{
            return view('admin.videos_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get questions
    public function getQuestions(Request $request){
        try{
            return view('admin.questions_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
    #get answers
    public function getAnswers(Request $request){
        try{
            return view('admin.answer_actions');
        }catch(\Exception $e){
            Session::flash('flash_message',"Something went wrong. please contact to administration"); 
            return back();
        }
    }
}