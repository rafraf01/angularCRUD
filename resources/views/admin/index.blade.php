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
<script type="text/javascript" src="{{ url('js/admin/controller.js') }}"></script>
<script type="text/javascript" src="{{ url('js/admin/service.js') }}"></script>
@endpush
