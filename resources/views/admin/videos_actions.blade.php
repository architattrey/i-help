@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="videoApp" ng-controller="videoController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Videos <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Videos</button></a>
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
                        <th width="10%">Video Name</th>
                        <th width="15%">Description</th>
                        <th width="15%">Thumbnail</th>
                        <th width="15%">Video</th>
                        <th width="8%">Video Type</th>
                        <th width="8%">Created At</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="video in videoData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{video.medical_type.medical_type}}</td>
                        <td>@{{video.name}}</td>
                        <td><textarea class="form-control" row="3" disabled>@{{video.description}}</textarea></td>
                        <td><img ng-src ="@{{imageUrl}}@{{video.thumbnail}}" style="width:33%;"></td>
                        <!-- <td><textarea class="form-control" row="3" disabled>@{{video.thumbnail}} @{{base_url}} @{{video.video}}</textarea></td> -->
                        <td><video width="213px" controls> 
                                <source ng-src="@{{base_url}}@{{video.video}}" type="video/mp4">
                            </video>
                        </td>
                        <td ng-show="@{{video.video_type==1}}"><span class="label label-success">Sample</span></td>
                        <td ng-show="@{{video.video_type==2}}"><span class="label label-primary">Full</span></td>
                        <td>@{{video.created_at|limitTo:10}}</td>
                    
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(video)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(video)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteVideo" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deletevideo()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- add model -->
        <div class="modal fade" id="AddVideo" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Videos</h4>
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
                                <!-- add video name -->
                                <div class="form-group">
                                    <label for="add_video">Add Video Name</label>
                                    <input type="text" class="form-control" ng-model="name" placeholder ="Add video Name" required><br>
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
                                <!-- video type -->
                                <div class="form-group">
                                    <label for="video-type">Select Video Type</label>
                                    <select ng-model="videoType" class="form-control">
                                        <option value="" label="Please Select Video Type"></option>
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
                                    <label for="add_description">Add Video Description</label>
                                    <textarea class="form-control" row="4" ng-model="description" placeholder ="Add Video Description" required></textarea><br>
                                </div>
                                <!-- thumbnail
                                <div class="form-group">
                                    <label for="add_thumbnail">Add Video Thumbnail</label>
                                    <textarea class="form-control" row="3" ng-model="thumbnail" placeholder ="Add Video Thumbnail" required></textarea><br>
                                </div>
                               -->
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
                            <div class="col-sm-6">    
                                <!-- video -->
                                <div class="form-group">
                                    <label for="">Video</label>
                                    <input type="file" class="form-control" id="video" accept="video/mp4,video/x-m4v,video/*" onchange="angular.element(this).scope().uploadedVideo(this)"placeholder="Select Video" /><br>
                                </div>
                                <!-- video show div -->
                                <video controls  style="width:164px" preload=auto ng-src="@{{base_url}}@{{video}}"></video>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addvideo()">Success</button>
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
                                <!-- add video name -->
                                <div class="form-group">
                                    <label for="add_video">Add Video Name</label>
                                    <input type="text" class="form-control" ng-model="name" placeholder ="Add Video Name" required><br>
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
                                <!-- Video type -->
                                <div class="form-group">
                                    <label for="video-type">Select Video Type</label>
                                    <select ng-model="videoType" class="form-control">
                                        <option value="" label="Please Select video Type"></option>
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
                                    <label for="add_description">Add Video Description</label>
                                    <textarea class="form-control" row="4" ng-model="description" placeholder ="Add Video Description" required></textarea><br>
                                </div>
                                <!-- thumbnail
                                <div class="form-group">
                                    <label for="add_thumbnail">Add Video Thumbnail</label>
                                    <textarea class="form-control" row="3" ng-model="thumbnail" placeholder ="Add Video Thumbnail" required></textarea><br>
                                </div> -->
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
                            <div class="col-sm-6">    
                                <!-- video -->
                                <div class="form-group">
                                    <label for="">Video</label>
                                    <input type="file" class="form-control" id="video" accept="video/mp4,video/x-m4v,video/*" onchange="angular.element(this).scope().uploadedVideo(this)"placeholder="Select Video" /><br>
                                </div>
                                <!-- video show div -->
                                <video controls  style="width:164px" preload=auto ng-src="@{{base_url}}@{{video}}"></video>
                            </div>
                        </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updatevideo()">Update</button>
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
    var videoApp = angular.module("videoApp",[]);
    
    videoApp.controller("videoController",function($scope, $http,$timeout) {
        // get videos   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.videoData = [];
        $scope.getvideos = function() {
            $http.get("{{url('/')}}/get-videos").then(response =>{
                $scope.videoData = response.data.data.videos;
				$scope.base_url = response.data.base_url;
                $scope.imageUrl = response.data.base_url;
				
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getvideos();
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
        // upload video
        $scope.uploadedFile1 = function (files) {
           //debugger;
            var file = files;
            var uploadUrl = "{{url('/')}}/video-upload";
            var fd = new FormData();
            fd.append('video', file);
            $http.post(uploadUrl, fd, {
                transformRequest: angular.identity,
                headers: { 'Content-Type': undefined }
            })
            .then(res => {
                $scope.video = res.data.video_url;
                $scope.base_url = res.data.base_url;
				
            })
            .catch(err => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.uploadedVideo = function(element) {
            $scope.currentFile = element.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                $scope.video = event.target.result
                $scope.$apply(function($scope) {
                    $scope.videos = event.target.result;
                    $scope.uploadedFile1(event.target.result);
                });
            }
            reader.readAsDataURL(element.files[0]);
        }

        // add video
        $scope.addOpen = function() {
            $scope.languageId="";
            $scope.name="";
            $scope.medicalTypeId="";
            $scope.videoType="";
            $scope.description="";
            $scope.thumbnail="";
            $scope.video="";
            $('#AddVideo').modal('show');
        }
        $scope.addvideo = function() {
            var reqData={
                lang_id:$scope.languageId,
                name:$scope.name,
                medical_type_id:$scope.medicalTypeId,
                video_type:$scope.videoType,
                description:$scope.description,
                thumbnail:$scope.thumbnail,
                video:$scope.video,
            }
            $http.post("{{url('/')}}/add-update-video",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddVideo').modal('hide');
                }
                $scope.getvideos();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        //update video
        $scope.update = function(data){
			$scope.updateData = {};
			
            $timeout(function () {
                $scope.updateData = angular.copy(data);
                $scope.languageId=$scope.updateData.lang_id;
                $scope.name=$scope.updateData.name;
                $scope.medicalTypeId=$scope.updateData.medical_type_id;
                $scope.videoType=$scope.updateData.video_type;
                $scope.description=$scope.updateData.description;
                $scope.thumbnail=$scope.updateData.thumbnail;
                $scope.video=$scope.updateData.video;
                $('#myModal').modal('show');
            }, 200);
          
        }
        $scope.updatevideo = function() {
            var reqData={
                id:$scope.updateData.id,
                lang_id:$scope.languageId,
                name:$scope.name,
                medical_type_id:$scope.medicalTypeId,
                video_type:$scope.videoType,
                description:$scope.description,
                thumbnail:$scope.thumbnail,
                video:$scope.video,
            }
            $http.post("{{url('/')}}/add-update-video",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#myModal').modal('hide');
                }
            $scope.getvideos();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete video
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteVideo').modal('show');
		}
        $scope.deletevideo = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-video",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteVideo').modal('hide');
                }
                $scope.getvideos();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
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