<div class="alert alert-danger" ng-if="errors.length > 0">
    <ul>
        <li ng-repeat="error in errors"><% error %></li>
    </ul>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" ng-model="edit_task.task_name">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" rows="3" class="form-control" ng-model="edit_task.description"></textarea>
    </div>
    <button type="button" class="btn btn-default" ng-click="closeEdit()">Close</button>
    <button type="button" class="btn btn-primary" ng-click="saveEdit(edit_task.id)">Update</button>
</div>

