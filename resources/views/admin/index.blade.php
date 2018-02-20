@extends('layouts.admin-layout')

@push('styles')
<link type="text/css" rel="stylesheet" href="/css/index.css">
@endpush

@include('components.angular')

@section('content')
<div class="wrapper" ng-controller="AdminController">
    <div class="header">
        <div class="logout">@include('components.logout')</div>
    </div>
    <div class="aside">
        @include('components.admin-menu')
    </div>
    <div class="content-1">
        <div ng-show="form.display">
            <div ng-hide="form.editor">
                @include('admin.form')
            </div>
            <div ng-show="form.editor">
                @include('admin.edit')
            </div>
        </div>
        <div ng-hide="form.display">
            <div class="table-wrapper">
                <form class="form-inline">
                    <div class="form-group">
                        <label >Search</label>
                        <input type="text" id="search" name="search" type="text" ng-model="search" class="form-control" placeholder="Search">
                    </div>
                    <button ng-click="add()">Add</button>
                </form>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr dir-paginate="(index, task) in tasks | filter:search | itemsPerPage: 5" total-items="totalTasks" current-page="pagination.current">
                        <td><% index + 1 %></td>
                        <td><% task.task_name %></td>
                        <td><% task.description %></td>
                        <td>
                            <button class="btn btn-success btn-xs" ng-click="initEdit(index)">Edit</button>
                            <button class="btn btn-danger btn-xs" ng-click="deleteTask(index)" >Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <dir-pagination-controls
                    on-page-change="pageChanged(newPageNumber)"
                    max-size="10"
                    direction-links="true"
                    boundary-links="true" >
                </dir-pagination-controls>
            </div>
        </div>
        <div ng-hide="form.editor">

        </div>
    </div>
    <div class="footer">FOOTER</div>
</div>
@endsection


@push('scripts')

<script type="text/javascript">

    app.controller('AdminController', ['$scope', '$element', '$http', function($scope, $element, $http){
        $scope.tasks = [];
        $scope.totalTasks = 0;

        getResultsPage(1);

        $scope.form = {
            display: false,
            task: {},
            editor: false
        };

        $scope.task = {
            task_name: '',
            description: ''
        };

        $scope.add = function(){
            $scope.form.display = true;
            $scope.task = {};
        };

        $scope.initEdit = function (value) {
            $scope.errors = [];
            $scope.edit_task = $scope.tasks[value];
            $scope.form.editor = true;
            $scope.form.display = true;
        };

        $scope.closeEdit = function(){
            $scope.form.display = false;
            $scope.editor = false;
        };

        $scope.close = function(){
            $scope.form.display = false;
            $scope.task = {};
        };

        $scope.pagination = {
            current: 1
        };

        // Pagination
        $scope.pageChanged = function(newPage){
            getResultsPage(newPage);
        };

        // Get LIST
        function getResultsPage(pageNumber){
            $http.get('/task?page=' + pageNumber)
                .then(function(result){
                    $scope.tasks = result.data.tasks.data;
                    $scope.totalTasks = result.data.tasks.total;
                    $scope.currPage = result.data.tasks.current_page
                })
        }


        // Add new TASK
        $scope.addTask = function(){
            $http.post('/task/create',{task_name: $scope.task.task_name, description: $scope.task.description})
                .then(function success(e){
                    $scope.form.display = false;
                    $scope.task = false;
                    $scope.tasks.push(e.data.task)
            },function error(error){
               $scope.recordErrors(error)
            });
        };

        // Save Edit
        $scope.saveEdit = function(index){

            $http.post('/task/update/'+ index,{task_name: $scope.edit_task.task_name, description: $scope.edit_task.description})
                .then(function success(e){
                    $scope.form.display = false;
                    $scope.task = false;

            },function error(error){
                    $scope.recordErrors(error)
            })
        };

        // Delete Task
        $scope.deleteTask = function(index){
            var id =  $scope.tasks[index].id;
            var conf = confirm("Do you want to delete this task?");

            if (conf === true){
                $http.post('/task/delete/'+ id)
                    .then(function success(e){
                        $scope.tasks.splice(index, 1);
                        getResultsPage($scope.currPage);
                    },function error(error){
                        $scope.recordErrors(error)
                    })
            }

        };

        $scope.recordErrors = function(error){
           $scope.errors = [];
            if (error.data.errors){
                $scope.errors.push(error.data.errors.task_name[0]);
                $scope.errors.push(error.data.errors.description[0])
            }

        }
    }]);
</script>
@endpush
