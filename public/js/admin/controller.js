app.controller('AdminController', ['$scope', '$element', '$http', 'dataFactory', function($scope, $element, $http, dataFactory){
    $scope.tasks = [];
    $scope.totalTasks = 0;

    var config = {};

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

    // Get new list next page
    $scope.pageChanged = function(newPage){
        getResultsPage(newPage);
    };

    // Get List
    function getResultsPage(pageNumber){
        dataFactory.get(pageNumber).then(function(result){
            $scope.tasks = result.data.tasks.data;
            $scope.totalTasks = result.data.tasks.total;
            $scope.currPage = result.data.tasks.current_page
        })
    }

    // Add New Task
    $scope.addTask = function(){
        config = {
            task_name : $scope.task.task_name,
            description: $scope.task.description
        };

        dataFactory.create(config).then(function success(e){
            $scope.form.display = false;
            $scope.task = false;
            $scope.tasks.push(e.data.task)
        },function error(error){
            $scope.recordErrors(error)
        });
    };

    // Save Edit
    $scope.saveEdit = function(index){
            config = {
            task_name: $scope.edit_task.task_name,
            description: $scope.edit_task.description
        };

        dataFactory.update(index,config).then(function success(e){
            alert('Successfully Updated');
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
            dataFactory.destroy(id).then(function success(e){
                $scope.tasks.splice(index, 1);
                getResultsPage($scope.currPage);
            },function error(error){
                $scope.recordErrors(error)
            })
        }
    };

    // Errors validation
    $scope.recordErrors = function(error){
        $scope.errors = [];
        if (error.data.errors){
            $scope.errors.push(error.data.errors.task_name[0]);
            $scope.errors.push(error.data.errors.description[0])
        }

    }
}]);