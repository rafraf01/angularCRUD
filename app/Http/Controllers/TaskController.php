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
    /**
     * @param Task $task
     */
    public function __construct(Task $task){
        $this->task = $task;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){

        $items = Task::paginate(5);

        return response()->json([
            'tasks' => $items,
        ], 200);
    }

    /**
     * @param ValidateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ValidateRequest $request){

        $this->task->create(array_merge($request->all(),['created_by' => Auth::user()->id]));

        return response()->json([
            'message' => 'Success'
        ],200);
    }

    /**
     * @param ValidateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ValidateRequest $request, $id){

      if (!$tasks = null){
          $tasks = $this->task->find($id);
          $tasks->fill($request->all());
          $tasks->save();

          return response()->json([
              'data' => $tasks,
              'message' => 'Updated'
          ]);
      }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $tasks = Task::find($id);
        $tasks->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);


    }
} 