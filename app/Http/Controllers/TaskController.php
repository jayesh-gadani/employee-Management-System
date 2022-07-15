<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AssignProject;
use Response;
use Config;
use Exception;

class TaskController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 
    public function index()
    {
        //$tasks = Task::All();
        $tasks = new Task();
        $tasks = $tasks->displayAll(); 
        return view("task.ViewTasks",compact('tasks'));
    }
 
    public function addTask(Request $request)
    {
        $tasks = new Task(); 
        $projects=Project::All();
        
        if ($request -> isMethod('POST')) {
            $data = $request->all();

            $rules =[
                'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate',
                'userId' => 'required',
                'projectId' => 'required',
            ];
            
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect('add_task')
                        ->withErrors($validator)
                        ->withInput();
            }
            $result = $tasks->addTask($data);
            if ($result)
                $request->session()->flash('success', 'Task Added Sucessfully!');
            else
                $request->session()->flash('error', 'Failed to add Task !');

            return redirect()->route('listing_task');   

            
        }    
          
        return view("task.addNewTask",compact('tasks','projects'));
    }

    public function userLoad(Request $request)
    {
      
       $id = $request['id'];
       // $project = AssignProject::find(project_id,'=',$id);
       $tasks = new Task();
       $users = $tasks->userLoad($id);
       return view('task.loadUser',compact('users'));
    }
    public function deleteTask(Request $request)
    {
        $data = $request -> all();
        $id = $data['id'];
        $tasks = new Task();
        $result = $tasks->deleteTask($id);
         if ($result) {
            $request -> session() -> flash('success','Task is Sucessfully deleted');
        }
        else{
            $request -> session() -> flash('error','Error in Task Deeleting');
           
        }
        return redirect()->route('listing_task');
    }
    public function editTask(Request $request, $id)
    {
        
        //$tasks = new Task();
        $tasks = Task::find($id);
        if (!$tasks) {
            throw new Exception("Error Processing Request", 401);
        } 
        $projects = Project::All();
        if ($request -> isMethod('POST')) {
            $data = $request->all();

            $rules =[
                'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate',
                'userId' => 'required',
                'projectId' => 'required',
            ];
            
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect('add_task')
                        ->withErrors($validator)
                        ->withInput();
             }
        
            $task = new Task();
            $result = $task->editTask($data, $id);
            if($result)
                $request->session()->flash('success', 'Task Updated Sucessfully!');
            else
                $request->session()->flash('error', 'Task not Updated Sucessfully!');
            return redirect()->route('listing_task');           
         }
          return view("task.addNewTask", compact('tasks','projects')); 
     }

}
