<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\TasksResource;
use App\Models\Tasks;

class TasksController extends Controller
{
    public function index(Request $request) {
        return new TasksResource(
            Tasks::where('user_id', $request->user()->id)->get()
        );
    }

    public function show(Request $request, string $taskId) {
        return new TasksResource(
            Tasks::where('user_id', $request->user()->id)->find($taskId)
        );
    }

    public function store(Request $request) {
        // Because this function handles creating and editing we need to
        // check for the taskId
        if (isset($request->id)) {
            $task = Tasks::find($request->id);
        } else {
            $task = new Tasks();
        }

        $task->user_id = $request->user()->id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->files = $request->input('files') ?? '';

        $task->save();

        return redirect()->back();
    }

    public function destroy(string $taskId) {
        Tasks::destroy($taskId);
    }
}
