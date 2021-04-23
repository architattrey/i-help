@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="transactionApp" ng-controller="transactionController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Transactions <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                
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
                        <th width="10%">Order Id</th>
                        <th width="10%">Invoice Id</th>
                        <th width="10%">Amount</th>
                        <th width="10%">Status</th>
                        <th width="10%">Expiry Days</th>
                        <th width="10%">Created At</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="transaction in transactionData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        <td>@{{transaction.order_id}}</td>
                        <td>@{{transaction.invoice_id}}</td>
                        <td>@{{transaction.amount}}</td>
                        <td ng-show="@{{transaction.status=='Success'}}"><span class="label label-success">Success</span></td>
                        <td ng-show="@{{transaction.status=='Fail'}}"><span class="label label-danger">Fail</span></td>
                        <td>@{{transaction.expire_days}}</td>
                        <td>@{{transaction.created_at|limitTo:10}}</td>     
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
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
    var transactionApp = angular.module("transactionApp",[]);
    
    transactionApp.controller("transactionController",function($scope, $http) {
        // transaction listing   
        //$scope.dtOptions = DTOptionsBuilder.newOptions().withOption('order', [0, 'asc']);
        $scope.transactionData = [];
        $scope.getRequest = function() {
            $http.get("{{url('/')}}/get-transactions").then(response =>{
                $scope.transactionData = response.data.response;
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getRequest();
    });
</script>
@endsection