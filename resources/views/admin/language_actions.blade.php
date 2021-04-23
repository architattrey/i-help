@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="languageApp" ng-controller="languageController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Language <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Languages</button></a>
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
                        <th width="20%">Language</th>
                        <th width="10%">Created At</th>
                        <th width="10%">Updated At</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="language in languageData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{language.languages}}</td>  
                        <td>@{{language.created_at|limitTo:10}}</td>
                        <td>@{{language.updated_at|limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(language)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(language)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteLanguage" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deletelanguage()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- add model -->
        <div class="modal fade" id="AddLanguage" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Language</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add Language -->
                                <div class="form-group">
                                    <label for="">Add Language</label>
                                    <input type="text" class="form-control" ng-model="Language" placeholder ="Add Language" required><br>
                                </div>
                                 
                            </div>    
                            <!--/ col-sm-12 -->
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addlanguage()">Success</button>
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
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add Language -->
                                <div class="form-group">
                                    <label for="">Add Language</label>
                                    <input type="text" class="form-control" ng-model="Language" placeholder ="Add Language" required><br>
                                </div>
                                 
                            </div>    
                            <!--/ col-sm-12 -->
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updatelanguage()">Update</button>
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
    $(document).ready(function() {
        // datatable
        // var table = $('#categories').removeAttr('width').DataTable({
        //     scrollY:        "400px",
        //     scrollX:        true,
        //     scrollCollapse: true,
        //     paging:         true,
        //     columnDefs: [
        //         { width: 200 }
        //     ],
        //     fixedColumns: true
        // });
    });
</script>

<script>
    var languageApp = angular.module("languageApp",[]);
    
    languageApp.controller("languageController",function($scope, $http) {
        // institutes listing   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.languageData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-languages").then(response =>{
                $scope.languageData = response.data.data.languages;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // add Language
        $scope.addOpen = function() {
            $scope.Language="";
            $('#AddLanguage').modal('show');
        }
        $scope.addlanguage = function() {
            var reqData={
                languages:$scope.Language,
            }
            $http.post("{{url('/')}}/add-update-language",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddLanguage').modal('hide');
                }
                $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // update Language
        $scope.update = function(data){
            $scope.updateData= data;
            $scope.Language  = $scope.updateData.languages;
            $('#myModal').modal('show');
        }
        $scope.updatelanguage = function() {
            var reqData={
                id:$scope.updateData.id,
                languages:$scope.Language,
            }
            $http.post("{{url('/')}}/add-update-language",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#myModal').modal('hide');
                }
            $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete institute
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteLanguage').modal('show');
		}
        $scope.deletelanguage = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-language",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteLanguage').modal('hide');
                }
                $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection