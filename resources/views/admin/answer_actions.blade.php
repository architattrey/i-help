@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" ng-app="answerApp" ng-controller="answerController">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">All Answers <Section></Section></li>
        </ol>
        </section>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="col-sm-6" id="search_div">
                    <button type="button" class="btn btn-success" id="search_button"><i class="fa fa-search-plus" aria-hidden="true"></i>&nbsp; Search</button><input type="text" id="search" placeholder="&nbsp; Seach By Any.." ng-model="search">
                </div>
                <div class="back-bg" style="background-color:#fff; height: 64px; margin-top: 20px;">
                    <a style="margin-top: 5px; padding: 10px 17px; float: right;b margin-right: 17px;"><button type="button" class="btn btn-primary" id="flip" href="" ng-click="addOpen()">Add More Answer</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
        <!-- all Answers -->
        <!-- Main content -->
        <section class="content" >
            <table id="categories" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th width="2%">#</th>
                        <th width="20%">Questions</th>
                        <th width="10%">Answers</th>
                        <th width="8%">CreatedAt</th>
                        <th width="6%">UpdatedAt</th>
                        <th width="11%">Action</th>
                    </tr>
                </thead>
                <tbody ng-repeat ="answer in answerData | filter:search">
                    <tr>
                        <td>@{{$index+1}}</td>
                        
                        <td><textarea class="md-textarea form-control" rows="3" disabled>@{{answer.questions.question}}</textarea></td>  
                        <td>@{{answer.answer}}</td> 
                        <td>@{{answer.created_at |limitTo:10}}</td>  
                        <td>@{{answer.updated_at |limitTo:10}}</td>
                        <td>
                            <button type="button" class="btn btn-success"><a href="" ng-click="update(answer)"><i class="fa fa-pencil" style="font-size:16px;color:white" aria-hidden="true"></i></a></button>&nbsp;&nbsp;
                            <button type="button" class="btn btn-danger"><a href=""  ng-click="deleteModel(answer)"><i class="fa fa-trash" style="font-size:16px;color:white" aria-hidden="true"></i></a></button> 
                        </td>
                    </tr>
                </tbody> 
            </table>
        </section>    
        <!-- /.content -->
        <!-- delete model -->
        <div class="modal fade" id="deteteAnswer" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Do you want to Delete</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" ng-click="deleteanswer()">Delete</button>
                        {{ Form::button('Cancel',['class'=>'btn btn-default','data-dismiss'=>'modal']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- /modal close -->
        <!-- add model -->
        <div class="modal fade" id="AddAnswer" role="dialog">
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
                            <div class="col-sm-12">
                                <!-- Question -->
                                <div class="form-group">
                                    <label for="answer">Select Question</label>
                                    <select ng-model="question" class="form-control">
                                        <option value="" label="Please Select Question"></option>
                                        <option ng-repeat="question in questionData" value="@{{question.id}}">@{{question.question}}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add answer -->
                                <div class="form-group">
                                    <label for="answer">Add Answer हिंदी/English</label>
                                    <textarea class="form-control" row="4" ng-model="answer" placeholder ="Add Answer" required></textarea>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="addanswer()">Success</button>
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
                            <div class="col-sm-12">
                                <!-- Question -->
                                <div class="form-group">
                                    <label for="answer">Select Question</label>
                                    <select ng-model="question" class="form-control">
                                        <option value="" label="Please Select Question"></option>
                                        <option ng-repeat="question in questionData" value="@{{question.id}}">@{{question.question}}</option>
                                    </select>
                                </div>
                            </div>
                            <!-- col-sm-12 -->
                            <div class="col-sm-12">
                                <!-- add answer -->
                                <div class="form-group">
                                    <label for="answer">Add Answer हिंदी/English</label>
                                    <textarea class="form-control" row="4" ng-model="answer" placeholder ="Add Answer" required></textarea>
                                </div>
                            </div>
                        </div>    
                    </div>  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" ng-click="updateanswer()">Update</button>
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
    var answerApp = angular.module("answerApp",[]);
    
    answerApp.controller("answerController",function($scope, $http) {

        // answer listing
        $scope.answerData = [];
        $scope.getanswer = function() {
            $http.get("{{url('/')}}/get-answers").then(response =>{
                if(response.data.status == "not found"){
                    swal("Not Found!", "Answers Not Found!", "error");
                }
                $scope.answerData = response.data.answers;
                console.log($scope.answerData);
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        $scope.getanswer();

        // question for drop down
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

        // add Answers
        $scope.addOpen = function() {
            $scope.question="";
            $scope.answer="";
            $('#AddAnswer').modal('show');
        }
        $scope.addanswer = function() {
            var reqData={
                question_id:$scope.question,
                answer:$scope.answer,
            }
            $http.post("{{url('/')}}/add-update-answer",reqData).then(response =>{
                if(response.data.status=="data_error"){
                    swal("Required Data!", "Please choose Question!", "error"); 
                }else if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#AddAnswer').modal('hide');
                }
                $scope.getanswer();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // update Answer
        $scope.update = function(data){
            $scope.updateData = data;
            $scope.question  = $scope.updateData.ques_id;
            $scope.answer  = $scope.updateData.answer;
            $('#myModal').modal('show');
        }
        $scope.updateanswer = function() {
            var reqData={
                id:$scope.updateData.id,
                question_id:$scope.question,
                answer:$scope.answer,
            }
            $http.post("{{url('/')}}/add-update-answer",reqData).then(response =>{
                if(response.data.status=="data_error"){
                    swal("Required Data!", "Please Choose Question!", "error"); 
                }else if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#myModal').modal('hide');
                }
            $scope.getanswer();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
        // delete answer
        $scope.deleteModel = function(data){
            $scope.updateData = data;
            $('#deteteAnswer').modal('show');
		}
        $scope.deleteanswer = function() {
            var reqData={
                id:$scope.updateData.id.toString(),
            }
            $http.post("{{url('/')}}/delete-answer",reqData).then(response =>{
                if(response.data.status=="error"){
                    swal("Something went wrong!", "Contact to administrator!", "error"); 
                }else{
                    $('#deteteAnswer').modal('hide');
                }
                $scope.getanswer();
            }).catch(error => {
                swal("Something went wrong!", "Contact to administrator!", "error");
            });
        };
    });
</script>
@endsection