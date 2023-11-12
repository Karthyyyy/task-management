<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TasksController extends Controller
{
    public function index() {
        return Inertia::render('Tasks/TaskIndex');
    }

    public function edit(string $taskId) {
        return Inertia::render('Tasks/TaskEdit', [
            'id' => $taskId
        ]);
    }

    public function create() {
        return Inertia::render('Tasks/TaskCreate');
    }
}
