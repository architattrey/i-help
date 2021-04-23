@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="questionApp" ng-controller="questionController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">All Questions <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                    <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Questions</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- all Questions -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="6%">Video</th>
                        <th width="6%">Blog</th>
                        <th width="7%">Language</th>
                        <th width="5%">Type</th>
                        <th width="35%">Questions</th>
                        <th width="6%">Opt. 1</th>
                        <th width="6%">Opt. 2</th>
                        <th width="6%">Opt. 3</th>
                        <th width="6%">Opt. 4</th>
                        <th width="11%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="question in questionData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{question.video.name}}</td>  
                        <td>@{{question.blog.name}}</td>  
                        <td>@{{question.language.languages}}</td>  
                        <td ng-show="@{{question.type==1}}"><span class="label label-primary"><i class="fa fa-video-camera" aria-hidden="true"></i>&nbsp; Video</span></td>  
                        <td ng-show="@{{question.type==2}}"><span class="label label-warning"><i class="fa fa-rss-square" aria-hidden="true"></i>&nbsp; Blog</span></td>  
                        <td><textarea class="md-textarea form-control" rows="3" disabled>@{{question.question}}</textarea></td>  
                        <td>@{{question.option_one}}</td>  
                        <td>@{{question.option_two}}</td>  
                        <td>@{{question.option_three}}</td>  
                        <td>@{{question.option_four}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(question)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(question)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteQuestion" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deletequestion()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- add model -->
        <div class="modal fade" id="AddQuestion" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Question</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- video -->
                                <div class="form-group">
                                    <label for="video">Select video</label>
                                    <select ng-model="video" class="form-control">
                                        <option value="" label="Please Select Video"></option>
                                        <option ng-repeat="video in videoData" value="@{{video.id}}">@{{video.name}}</option>
                                    </select>
                                </div>
                                <!-- language -->
                                <div class="form-group">
                                    <label for="language">Select Language</label>
                                    <select ng-model="language" class="form-control">
                                        <option value="" label="Please Select Language"></option>
                                        <option ng-repeat="language in languageData" value="@{{language.id}}">@{{language.languages}}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                               <!-- blog -->
                                <div class="form-group">
                                    <label for="blog">Select Blog</label>
                                    <select ng-model="blog" class="form-control">
                                        <option value="" label="Please Select Blog"></option>
                                        <option ng-repeat="blog in blogData" value="@{{blog.id}}">@{{blog.name}}</option>
                                    </select>
                                </div>
                                <!-- type -->
                                <div class="form-group">
                                    <label for="type">Select Type</label>
                                    <select ng-model="type" class="form-control">
                                        <option value="" label="Please Select Type"></option>
                                        <option value="1">Video</option>
                                        <option value="2">Blog</option>
                                    </select>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add question -->
                                <div class="form-group">
                                    <label for="question">Add Question हिंदी/English</label>
                                    <textarea class="form-control" row="4" ng-model="question" placeholder ="Add Question" required></textarea>
                                </div>
                            </div>    
                            <!--/ col-sm-12 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- add option 1 -->
                                <div class="form-group">
                                    <label for="option1">Option 1</label>
                                    <input type="text" class="form-control" ng-model="option_one" placeholder ="Add Option 1" required><br>
                                </div>
                                <!-- add option 3 -->
                                <div class="form-group">
                                    <label for="option3">Option 3</label>
                                    <input type="text" class="form-control" ng-model="option_three" placeholder ="Add Option 3" required><br>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- add option 2 -->
                                <div class="form-group">
                                    <label for="option2">Option 2</label>
                                    <input type="text" class="form-control" ng-model="option_two" placeholder ="Add Option 2" required><br>
                                </div>
                                <!-- add option 4 -->
                                <div class="form-group">
                                    <label for="option4">Option 4</label>
                                    <input type="text" class="form-control" ng-model="option_four" placeholder ="Add Option 4" required><br>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addquestion()">Success</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
        <!-- update model -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Update</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- video -->
                                <div class="form-group">
                                    <label for="video">Select video</label>
                                    <select ng-model="video" class="form-control">
                                        <option value="" label="Please Select Video"></option>
                                        <option ng-repeat="video in videoData" value="@{{video.id}}">@{{video.name}}</option>
                                    </select>
                                </div>
                                <!-- language -->
                                <div class="form-group">
                                    <label for="language">Select Language</label>
                                    <select ng-model="language" class="form-control">
                                        <option value="" label="Please Select Language"></option>
                                        <option ng-repeat="language in languageData" value="@{{language.id}}">@{{language.languages}}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                               <!-- blog -->
                                <div class="form-group">
                                    <label for="blog">Select Blog</label>
                                    <select ng-model="blog" class="form-control">
                                        <option value="" label="Please Select Blog"></option>
                                        <option ng-repeat="blog in blogData" value="@{{blog.id}}">@{{blog.name}}</option>
                                    </select>
                                </div>
                                <!-- type -->
                                <div class="form-group">
                                    <label for="type">Select Type</label>
                                    <select ng-model="type" class="form-control">
                                        <option value="" label="Please Select Type"></option>
                                        <option value="1">Video</option>
                                        <option value="2">Blog</option>
                                    </select>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add question -->
                                <div class="form-group">
                                    <label for="question">Add Question हिंदी/English</label>
                                    <textarea class="form-control" row="4" ng-model="question" placeholder ="Add Question" required></textarea>
                                </div>
                            </div>    
                            <!--/ col-sm-12 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- add option 1 -->
                                <div class="form-group">
                                    <label for="option1">Option 1</label>
                                    <input type="text" class="form-control" ng-model="option_one" placeholder ="Add Option 1" required><br>
                                </div>
                                <!-- add option 3 -->
                                <div class="form-group">
                                    <label for="option3">Option 3</label>
                                    <input type="text" class="form-control" ng-model="option_three" placeholder ="Add Option 3" required><br>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- add option 2 -->
                                <div class="form-group">
                                    <label for="option2">Option 2</label>
                                    <input type="text" class="form-control" ng-model="option_two" placeholder ="Add Option 2" required><br>
                                </div>
                                <!-- add option 4 -->
                                <div class="form-group">
                                    <label for="option4">Option 4</label>
                                    <input type="text" class="form-control" ng-model="option_four" placeholder ="Add Option 4" required><br>
                                </div>
                            </div>
                            <!--/ col-sm-6 -->
                        </div>  
                    </div>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updatequestion()">Update</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
        
       
    </div>
@endsection
@section('script')

<script>
    var questionApp = angular.module("questionApp",[]);
    
    questionApp.controller("questionController",function($scope, $http) {

        // question listing
        $scope.questionData = [];
        $scope.getquestion = function() {
            $http.get("{{url('/')}}/get-questions").then(response =>{
                $scope.questionData = response.data.questions;
                console.log($scope.questionData);
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getquestion();

        // videos for dropdown
        $scope.videoData = [];
        $scope.getvideos = function() {
            $http.get("{{url('/')}}/get-videos").then(response =>{
                $scope.videoData = response.data.data.videos;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getvideos();

        // get blogs
        $scope.blogData = [];
        $scope.getblogs = function() {
            $http.get("{{url('/')}}/get-blogs").then(response =>{
                $scope.blogData = response.data.data.blogs;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getblogs();

        // institutes listing
        $scope.languageData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-languages").then(response =>{
                $scope.languageData = response.data.data.languages;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // add Question
        $scope.addOpen = function() {
            $scope.video="";
            $scope.blog="";
            $scope.language="";
            $scope.type="";
            $scope.question="";
            $scope.option_one="";
            $scope.option_two="";
            $scope.option_three="";
            $scope.option_four="";
            $('#AddQuestion').modal('show');
        }
        $scope.addquestion = function() {
            var reqData={
                video_id:$scope.video,
                blog_id:$scope.blog,
                lang_id:$scope.language,
                type:$scope.type,
                question:$scope.question,
                option_one:$scope.option_one,
                option_two:$scope.option_two,
                option_three:$scope.option_three,
                option_four:$scope.option_four,
            }
            $http.post("{{url('/')}}/add-update-question",reqData).then(response =>{
                if(response.data.status=='double_data_error'){
                    swal("Can't Select Both!", "Please Choose Only one Video or Blog!", "error"); 
                }else if(response.data.status=="data_error"){
                    swal("Required Data!", "Please Choose Video or Blog!", "error"); 
                }else if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddQuestion').modal('hide');
                }
                $scope.getquestion();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // update Question
        $scope.update = function(data){
            $scope.updateData= data;
            $scope.video  = $scope.updateData.video_id;
            $scope.blog  = $scope.updateData.blog_id;
            $scope.language  = $scope.updateData.lang_id;
            $scope.type  = $scope.updateData.type;
            $scope.question  = $scope.updateData.question;
            $scope.option_one  = $scope.updateData.option_one;
            $scope.option_two  = $scope.updateData.option_two;
            $scope.option_three  = $scope.updateData.option_three;
            $scope.option_four  = $scope.updateData.option_four;
            $('#myModal').modal('show');
        }
        
        $scope.updatequestion = function() {
            var reqData={
                id:$scope.updateData.id,
                video_id:$scope.video,
                blog_id:$scope.blog,
                lang_id:$scope.language,
                type:$scope.type,
                question:$scope.question,
                option_one:$scope.option_one,
                option_two:$scope.option_two,
                option_three:$scope.option_three,
                option_four:$scope.option_four
               
            }
            $http.post("{{url('/')}}/add-update-question",reqData).then(response =>{
                if(response.data.status=="data_error"){
                    swal("Required Data!", "Please Choose Video or Blog!", "error"); 
                }else if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#myModal').modal('hide');
                }
            $scope.getquestion();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete question
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteQuestion').modal('show');
		}
        $scope.deletequestion = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-question",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteQuestion').modal('hide');
                }
                $scope.getquestion();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection