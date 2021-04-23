@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="blogApp" ng-controller="blogController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Blogs <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Blogs</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- view list of agents -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="10%">Medical type</th>
                        <th width="10%">Blog Name</th>
                        <th width="15%">Description</th>
                        <th width="15%">Thumbnail</th>
                        <th width="15%">Blog</th>
                        <th width="8%">Blog Type</th>
                        <th width="8%">Created At</th>
                    
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="blog in blogData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{blog.medical_type.medical_type}}</td>
                        <td>@{{blog.name}}</td>
                        <td><textarea class="form-control" row="3" disabled>@{{blog.description}}</textarea></td>
                        <td><img ng-src ="@{{imageUrl}}@{{blog.thumbnail}}" style="width:33%;"></td>
                        <td><textarea class="form-control" row="3" disabled>@{{blog.blog}}</textarea></td>
                        <td ng-show="@{{blog.blog_type==1}}"><span class="label label-success">Sample</span></td>
                        <td ng-show="@{{blog.blog_type==2}}"><span class="label label-primary">Full</span></td>
                        <td>@{{blog.created_at|limitTo:10}}</td>
                    
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(blog)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(blog)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteBlog" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deleteblog()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- add model -->
        <div class="modal fade" id="AddBlog" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Language</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- language -->
                                <div class="form-group">
                                    <label for="language">Select Language</label>
                                    <select ng-model="languageId" class="form-control">
                                        <option value="" label="Please Select Language"></option>
                                        <option ng-repeat="language in languageData" value="@{{language.id}}">@{{language.languages}}</option>
                                    </select>
                                </div>
                                <!-- add blog name -->
                                <div class="form-group">
                                    <label for="add_blog">Add Blog Name</label>
                                    <input type="text" class="form-control" ng-model="name" placeholder ="Add Blog Name" required><br>
                                </div>
                            </div>    
                            <!--/ col-sm-6 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- medical type -->
                                <div class="form-group">
                                    <label for="medical-type">Select Medical Type</label>
                                    <select ng-model="medicalTypeId" class="form-control">
                                        <option value="" label="Please Select Medical Type"></option>
                                        <option ng-repeat="medicalType in medicalTypeData" value="@{{medicalType.id}}">@{{medicalType.medical_type}}</option>
                                    </select>
                                </div>
                                <!-- blog type -->
                                <div class="form-group">
                                    <label for="blog-type">Select Blog Type</label>
                                    <select ng-model="blogType" class="form-control">
                                        <option value="" label="Please Select Blog Type"></option>
                                        <option value="1">Sample</option>
                                        <option value="2">Full</option>
                                    </select>
                                </div>
                            </div>    
                            <!--/ col-sm-6 -->
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- description -->
                                <div class="form-group">
                                    <label for="add_description">Add Blog Description</label>
                                    <textarea class="form-control" row="4" ng-model="description" placeholder ="Add Blog Description" required></textarea><br>
                                </div>
                                <!-- thumbnail
                                <div class="form-group">
                                    <label for="add_thumbnail">Add Blog Thumbnail</label>
                                    <textarea class="form-control" row="3" ng-model="thumbnail" placeholder ="Add Blog Thumbnail" required></textarea><br>
                                </div> -->
                                <!-- blog -->
                                <div class="form-group">
                                    <label for="add_blog">Add Blog </label>
                                    <textarea class="form-control" row="5" ng-model="blog" placeholder ="Add Blog " required></textarea><br>
                                </div>
                            </div>
                            <!--/ col-sm-12 -->
                            <div class ="col-sm-6">
                                <!-- Thumbnail Image -->
                                <div class="form-group">
                                    <label for="">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" accept="image/*"onchange="angular.element(this).scope().uploadedFile(this)"placeholder="Select thumbnail Image" /><br>
                                </div>
                                <!-- image show div -->
                                <img ng-src="@{{baseUrl}}@{{thumbnail}}" style="width:164px; height:139px;"/>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addblog()">Success</button>
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
                                <!-- language -->
                                <div class="form-group">
                                    <label for="language">Select Language</label>
                                    <select ng-model="languageId" class="form-control">
                                        <option value="" label="Please Select Language"></option>
                                        <option ng-repeat="language in languageData" value="@{{language.id}}">@{{language.languages}}</option>
                                    </select>
                                </div>
                                <!-- add blog name -->
                                <div class="form-group">
                                    <label for="add_blog">Add Blog Name</label>
                                    <input type="text" class="form-control" ng-model="name" placeholder ="Add Blog Name" required><br>
                                </div>
                            </div>    
                            <!--/ col-sm-6 -->
                            <!-- col-sm-6 -->
                            <div class="col-sm-6">
                                <!-- medical type -->
                                <div class="form-group">
                                    <label for="medical-type">Select Medical Type</label>
                                    <select ng-model="medicalTypeId" class="form-control">
                                        <option value="" label="Please Select Medical Type"></option>
                                        <option ng-repeat="medicalType in medicalTypeData" value="@{{medicalType.id}}">@{{medicalType.medical_type}}</option>
                                    </select>
                                </div>
                                <!-- blog type -->
                                <div class="form-group">
                                    <label for="blog-type">Select Blog Type</label>
                                    <select ng-model="blogType" class="form-control">
                                        <option value="" label="Please Select Blog Type"></option>
                                        <option value="1">Sample</option>
                                        <option value="2">Full</option>
                                    </select>
                                </div>
                            </div>    
                            <!--/ col-sm-6 -->
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- description -->
                                <div class="form-group">
                                    <label for="add_description">Add Blog Description</label>
                                    <textarea class="form-control" row="4" ng-model="description" placeholder ="Add Blog Description" required></textarea><br>
                                </div>
                                <!-- thumbnail
                                <div class="form-group">
                                    <label for="add_thumbnail">Add Blog Thumbnail</label>
                                    <textarea class="form-control" row="3" ng-model="thumbnail" placeholder ="Add Blog Thumbnail" required></textarea><br>
                                </div> -->
                                <!-- blog -->
                                <div class="form-group">
                                    <label for="add_blog">Add Blog </label>
                                    <textarea class="form-control" row="5" ng-model="blog" placeholder ="Add Blog " required></textarea><br>
                                </div>
                            </div>
                            <!--/ col-sm-12 -->
                            <div class ="col-sm-6">
                                <!-- Thumbnail Image -->
                                <div class="form-group">
                                    <label for="">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" accept="image/*"onchange="angular.element(this).scope().uploadedFile(this)"placeholder="Select thumbnail Image" /><br>
                                </div>
                                <!-- image show div -->
                                <img ng-src="@{{baseUrl}}@{{thumbnail}}" style="width:164px; height:139px;"/>
                            </div>
                        </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateblog()">Update</button>
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
    var blogApp = angular.module("blogApp",[]);
    
    blogApp.controller("blogController",function($scope, $http) {
        // get blogs   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.blogData = [];
        $scope.getblogs = function() {
            $http.get("{{url('/')}}/get-blogs").then(response =>{
                $scope.blogData = response.data.data.blogs;
                $scope.imageUrl = response.data.base_url;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getblogs();
        // medical type for dropdown
        $scope.medicalTypeData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-medical-type").then(response =>{
                $scope.medicalTypeData = response.data.data.MedicalTypes;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        //languages for dropdown
        $scope.languageData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-languages").then(response =>{
                $scope.languageData = response.data.data.languages;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // add blog
        $scope.addOpen = function() {
            $scope.languageId="";
            $scope.name="";
            $scope.medicalTypeId="";
            $scope.blogType="";
            $scope.description="";
            $scope.thumbnail="";
            $scope.blog="";
            $('#AddBlog').modal('show');
        }
        $scope.addblog = function() {
            var reqData={
                lang_id:$scope.languageId,
                name:$scope.name,
                medical_type_id:$scope.medicalTypeId,
                blog_type:$scope.blogType,
                description:$scope.description,
                thumbnail:$scope.thumbnail,
                blog:$scope.blog,
            }
            $http.post("{{url('/')}}/add-update-blog",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddBlog').modal('hide');
                }
                $scope.getblogs();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        //update blog
        $scope.update = function(data){
            $scope.updateData= data;
            $scope.languageId=$scope.updateData.lang_id;
            $scope.name=$scope.updateData.name;
            $scope.medicalTypeId=$scope.updateData.medical_type_id;
            $scope.blogType=$scope.updateData.blog_type;
            $scope.description=$scope.updateData.description;
            $scope.thumbnail=$scope.updateData.thumbnail;
            $scope.blog=$scope.updateData.blog;
            $('#myModal').modal('show');
        }
        $scope.updateblog = function() {
            var reqData={
                id:$scope.updateData.id,
                lang_id:$scope.languageId,
                name:$scope.name,
                medical_type_id:$scope.medicalTypeId,
                blog_type:$scope.blogType,
                description:$scope.description,
                thumbnail:$scope.thumbnail,
                blog:$scope.blog,
            }
            $http.post("{{url('/')}}/add-update-blog",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#myModal').modal('hide');
                }
            $scope.getblogs();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete blog
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteBlog').modal('show');
		}
        $scope.deleteblog = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-blog",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteBlog').modal('hide');
                }
                $scope.getblogs();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // upload thumbnail image
        $scope.uploadFile = function (files) {
           //debugger;
           var file = files;
           var uploadUrl = "{{url('/')}}/image-upload";
           var fd = new FormData();
           fd.append('thumbnail', file);
           $http.post(uploadUrl, fd, {
               transformRequest: angular.identity,
               headers: { 'Content-Type': undefined }
           })
           .then(res => {
               
               $scope.thumbnail = res.data.image_url;
               $scope.baseUrl = res.data.base_url;
           })
           .catch(err => {
                swal("Something went wrong!", "Contact to administrator!", "error");
           });
        };
        $scope.uploadedFile = function(element) {
            $scope.currentFile = element.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                $scope.thumbnail = event.target.result
                $scope.$apply(function($scope) {
                    $scope.files = event.target.result;
                    $scope.uploadFile(event.target.result);
                });
            }
            reader.readAsDataURL(element.files[0]);
        }
    });
</script>
@endsection