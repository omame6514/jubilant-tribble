<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            //$data += $this->counts($user);
            return view('tasks.show', $data);
        }else {
            return view('welcome');
        }
    }
    
    public function create()
    {
        if (\Auth::check() == false)
        {
            return redirect("/");    
        }
        
        $task = new Task;
        $user = \Auth::user();
        $task->user_id = $user->id;
        
        return view("tasks.create", [
            "task" => $task,
        ]);
    }
    
    public function show($id)
    {
        if (\Auth::id() <> $id)
        {
            return redirect("/");
        }
        
        $user = User::find($id);
        $tasks = $user->tasks()->orderBy("created_at", "desc")->paginate(10);

        return  view("tasks.show", [
            "tasks" => $tasks,
            "user" => $user,
        ]);
    }
    
    public function store(Request $request)
    {
        if (\Auth::check() == false)
        {
            return redirect("/");    
        }
        
        $this->validate($request, [
            'content' => 'required|max:191',
            "status" => "required|max:191",
            // "user_id" => "required|max:191",
        ]);
        
        $user = \Auth::user();
        $request->user()->tasks()->create([
            "content" => $request->content,
            "status" => $request->status,
            "user_id" => $user->id,
        ]);

        return redirect()->back();
    }
    
    // $id = Task.id
    public function edit($id)
    {
        $task = Task::find($id);
        if (\Auth::id() <> $task->user_id)
        {
            return redirect("/");
        }
        $user = \Auth::user();
        // dd($user,$task);
        return view("tasks.edit", [
            "task" => $task, 
            "user" => $user,
        ]);
    }
    
    //$id = Task.id
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (\Auth::id()<> $task->user_id)
        {
            return redirect("/");    
        }
        
        //dd($id,$task,$request);
        $task->content = $request->content;
        $task->status = $request->status;
        $task->save();
        
        return redirect("/");
    }
    
    public function destroy($id)
    {
        $task = \App\Task::find($id);
        
        if (\Auth::id() === $task->user_id)
        {
            $task->delete();
        }
        
        return redirect("/");
    }
    
    public function counts($user) 
    {
        $count_tasks = $user->tasks()->count();
    }
}
