<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\Task;
use App\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function index(Request $request)
    {
        //index
        $tags = Tag::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $taskStatuses = TaskStatus::orderBy('name')->get();

        if (count($request->all()) == 0) {
            $tasks = Task::paginate(10);
            return view('task.index', compact('tasks', 'taskStatuses', 'users', 'tags'));
        }
       //search
        $query = Task::query();
        if ($request->tag_id) {
            $query->whereHas('tags.tasks', function ($q) use ($request) {
                return $q->where('tag_id', $request->tag_id);
            });
        }
        if ($request->status_id) {
            $query->where('status_id', $request->status_id);
        }
        if ($request->assigned_to_id) {
            $query->where('assigned_to_id', $request->assigned_to_id);
        }
        if ($request->myTasks) {
            $query->where('creator_id', \Auth::user()->id);
        }
        $tasks = $query->paginate(10);
        return view('task.index', compact('tasks', 'taskStatuses', 'users', 'tags'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $defaultTaskStatus = TaskStatus::firstOrCreate(['name' => 'новый']);
        $taskStatuses = TaskStatus::orderBy('name')->get();
        return view('task.create', compact('taskStatuses', 'defaultTaskStatus', 'users'));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'assigned_to_id' => 'required'
        ]);
        
        $task = new Task();
        $task->fill($request->all());
        $task->creator()->associate(\Auth::user());
        $task->save();

        flash(__('Added'))->success();
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }
    
    public function edit(Task $task)
    {
        $tags = Tag::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        $taskStatuses = TaskStatus::orderBy('name')->get();
        $defaultTaskStatus = TaskStatus::firstOrCreate(['name' => 'новый']);
        return view('task.edit', compact('task', 'defaultTaskStatus', 'taskStatuses', 'users', 'tags'));
    }

    public function update(Request $request, Task $task)
    {
        $task->fill($request->all());
        $task->save();
        flash(__('Saved'))->success();
        return redirect()->route('tasks.edit', $task);
    }
    
    public function destroy(Task $task)
    {
        $task->delete();
        flash(__('Deleted'))->success();
        return redirect()->route('tasks.index');
    }
}
