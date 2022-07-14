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

class TaskController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
 
    public function index()
    {
        //$tasks = Task::All();
        $tasks=new Task();
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
            $id = Auth::user()->id;
            $tasks->title = $data['title'];
            $tasks->description = $data['description'];
            $tasks->user_id = $data['userId'];
            $tasks->project_id = (int)$data['projectId'];
            $tasks->start_date = $data['startDate'];
            $tasks->end_date = $data['endDate'];
            $tasks->status = 1;
            $tasks->created_by = $id;
            $tasks->updated_by = $id;
            $tasks->save();
            $request->session()->flash('success', 'Task Added Sucessfully!');

            return redirect()->route('listing_task');   

            echo "<pre>"; print_r($data); exit;
        }    
          
        return view("task.addNewTask",compact('tasks','projects'));
    }

    public function userLoad(Request $request)
    {
      
       $id = $request['id'];
       // $project = AssignProject::find(project_id,'=',$id);
       $users = AssignProject::where('project_id', $id)->get();


       return view('task.loadUser',compact('users'));
       

    }
    public function deleteTask(Request $request)
    {
        $data = $request -> all();

        $task = Task::find($data['id']);
         if ($task -> delete()) {
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
            $id = Auth::user()->id;
            //echo "<pre>"; print_r($data); exit;
            $tasks->title = $data['title'];
            $tasks->description = $data['description'];
            $tasks->user_id = $data['userId'];
            $tasks->project_id = $data['projectId'];
            $tasks->start_date = $data['startDate'];
            $tasks->end_date = $data['endDate'];
            $tasks->save();
            $request->session()->flash('success', 'Task Updated Sucessfully!');

            return redirect()->route('listing_task');           
         }
          return view("task.addNewTask", compact('tasks','projects')); 
     }

}
