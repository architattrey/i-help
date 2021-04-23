@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="medicalTypeApp" ng-controller="medicalTypeController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Medical Type <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Medical Type</button></a>
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
                        <th width="20%">Medical Type</th>
                        <th width="10%">Created At</th>
                        <th width="10%">Updated At</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="medicaltype in medicalTypeData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{medicaltype.medical_type}}</td>  
                        <td>@{{medicaltype.created_at|limitTo:10}}</td>
                        <td>@{{medicaltype.updated_at|limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(medicaltype)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(medicaltype)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteMedicalType" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deletemedicaltype()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- add model -->
        <div class="modal fade" id="AddMedicalType" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Add Medical Type</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add medical type -->
                                <div class="form-group">
                                    <label for="">Add Medical Type</label>
                                    <input type="text" class="form-control" ng-model="medicalType" placeholder ="Add Medical Type" required><br>
                                </div>
                                 
                            </div>    
                            <!--/ col-sm-12 -->
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addmedicaltype()">Success</button>
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
                                <!-- add medical type -->
                                <div class="form-group">
                                    <label for="">Add Medical Type</label>
                                    <input type="text" class="form-control" ng-model="medicalType" placeholder ="Add Medical Type" required><br>
                                </div>
                                 
                            </div>    
                            <!--/ col-sm-12 -->
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updatemedicaltype()">Update</button>
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
    var medicalTypeApp = angular.module("medicalTypeApp",[]);
    
    medicalTypeApp.controller("medicalTypeController",function($scope, $http) {
        // institutes listing   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.medicalTypeData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-medical-type").then(response =>{
                $scope.medicalTypeData = response.data.data.MedicalTypes;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();

        // add medical Type
        $scope.addOpen = function() {
            $scope.medicalType="";
            $('#AddMedicalType').modal('show');
        }
        $scope.addmedicaltype = function() {
            var reqData={
                medical_type:$scope.medicalType,
            }
            $http.post("{{url('/')}}/add-update-medical-type",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddMedicalType').modal('hide');
                }
                $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // update medical Type
        $scope.update = function(data){
            $scope.updateData= data;
            $scope.medicalType  = $scope.updateData.medical_type;
            $('#myModal').modal('show');
        }
        $scope.updatemedicaltype = function() {
            var reqData={
                id:$scope.updateData.id,
                medical_type:$scope.medicalType,
            }
            $http.post("{{url('/')}}/add-update-medical-type",reqData).then(response =>{
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
        // delete medical type
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteMedicalType').modal('show');
		}
        $scope.deletemedicaltype = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-medical-type",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteMedicalType').modal('hide');
                }
                $scope.getRequest();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection