@extends('admin.layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="userApp" ng-controller="userController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Section</li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;"></div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- view list of user -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="5%">Name</th>
                        <th width="10%">Phone Number</th>
                        <th width="12%">Email</th>
                        <th width="6%">Login Method</th>
                        <th width="5%">Gender</th>
                        <th width="5%">DOB</th>
                        <th width="8%">State</th>
                        <th width="10%">City</th>
                        <th width="10%">Image</th>
                        <th width="10%">Created At</th>
                        <th width="5%">Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="user in userData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{user.name}}</td>
                        <td>@{{user.phone_number}}</td>
                        <td>@{{user.mail_id}}</td>
                        <td>@{{user.login_method}}</td>
                        <td>@{{user.gender}}</td>
                        <td>@{{user.dob}}</td>
                        <td>@{{user.state}}</td>
                        <td>@{{user.city}}</td>
                        <td><img ng-src = "@{{baseUrl}}@{{user.image}}" style="width:60px; border:1px solid black;"></td>
                        <td>@{{user.created_at|limitTo:10}}</td>
                        <td ng-show ="@{{user.delete_status==1}}">Enabled</td>
                        <td ng-show ="@{{user.delete_status==0}}">Disabled</td> 
                        <td>
                            <button type="button" class="btn btn-warning"><a href="" ng-click="deleteModel(user)"><i class="fa fa-reply-all" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>
                            <button type="button" class="btn btn-primary"><a href="" ng-click="showtransactions(user)"><i class="fa fa-book" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteuser" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Change Status</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deleteUser()">Change Status</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
         
        <!-- transactions -->
		<div class="modal fade" id="showTransactions" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" id="transections_content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="text-align:center;">All transactions of this user</h4>
                    </div>
                    <!-- search bar -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-sm-6" id="search_div">
                                <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search_transaction">
                            </div>
                        </div>
                    </div>
                    <!--/ search bar -->

                    <!-- all transaction show -->
                    <div class="row">
                        <div class="col-sm-12" id="transaction_column">
                            <!-- get all transections -->
                            <div class="tractions">
                                <!-- Main content -->
                                <section class="content" >
                                    <table id="categories"  datatable="ng" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="1%">#</th>
                                                <th width="8%">Order Id</th>
                                                <th width="8%">Invoice Id</th>
                                                <th width="5%">Amount</th>
                                                <th width="6%">Status</th>
                                                <th width="6%">Expire/Days</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody ng-repeat ="transaction in transactions | filter:search_transaction">
                                            <tr>
                                                <td>@{{$index+1}}</td>
                                                <td>@{{transaction.order_id}}</td>
                                                <td>@{{transaction.invoice_id}}</td>
                                                <td>@{{transaction.amount}}</td>
                                                <td>@{{transaction.status}}</td>
                                                <td>@{{transaction.expire_date}}</td>                 
                                            </tr>
                                        </tbody> 
                                    </table>
                                </section>    
                                <!-- /.content -->
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                    </div>
                </div>
            </div>
        </div>
        <!--/ transactions -->
        
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
    var managerApp = angular.module("userApp",[]);
    
    managerApp.controller("userController",function($scope, $http) {
        // managers listing   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
         
        $scope.userData = [];
        $scope.getData = function() {
            $http.post("{{url('/')}}/get-users").then(response =>{
                $scope.userData = response.data.data.users;
                $scope.baseUrl = response.data.data.base_url;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getData();

        // delete user
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteuser').modal('show');
		}
        $scope.deleteUser = function() {
            var delete_status = $scope.updateData.delete_status;
            var status ="";
            if(delete_status =='0'){
                status='1';
            }else{
                status='0';
            }
            var reqData={
                id:$scope.updateData.id.toString(),
                delete_status:status
            }
            $http.post("{{url('/')}}/delete-user",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteuser').modal('hide');
                }
                $scope.getData();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        //show trasaction 
        $scope.showtransactions = function(data){
            $scope.userDetail = data;
            var reqData={
                user_id:$scope.userDetail.id.toString(),
            }
            $http.post("{{url('/')}}/show-transactions",reqData).then(response =>{
                //console.log(response.data);
        
                if(response.data.status == "data error"){
                    swal("Not Found!", "No Transaction Found Of This User!", "error");
                }else{
                    $scope.transactions = response.data.response;
                    $('#showTransactions').modal('show');
                }
                //$scope.getData();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });

        }
    });
</script>
@endsection	
 
