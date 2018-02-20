<?php
/**
 * Created by PhpStorm.
 * User: rafael.delacruz
 * Date: 2/14/18
 * Time: 1:22 PM
 */

namespace App\Http\Controllers;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ValidateRequest;

class TaskController {

    public function index(){

        $items = Task::paginate(5);

        return response()->json([
            'tasks' => $items,
        ], 200);
    }

    public function store(ValidateRequest $request){
        $task = new Task();

        $task->fill($request->all());
        $task->created_by = Auth::user()->id;
        $task->save();

        return response()->json([
            'task' => $task,
            'message' => 'Success'
        ],200);
    }

    public function update(ValidateRequest $request, $id){

      $tasks = Task::find($id);
      $tasks->fill($request->all());
      $tasks->save();

      return response()->json([
          'data' => $tasks,
          'message' => 'Updated'
      ]);
    }

    public function delete($id){

        $tasks = Task::find($id);
        $tasks->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);


    }
} 