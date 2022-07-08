<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mail;
use Config;
use Carbon\Carbon;
use Date;


class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        
        $projects = Project::All(); 
        $users = User::All();  
        return view("project.ViewProjects",compact('projects','users'));
    	
        
    }

    /**
     * Add new Project
     * @param Request $request 
     */
    public function addProject(Request $request)
    {
    	$project = new Project();
    	if ($request -> isMethod('POST')) {
           
            $data = $request->all();
            $rules =[
            	'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate'
			];
			//$validated = $request->validate($rules);
			$validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect('add_project')
                        ->withErrors($validator)
                        ->withInput();
             }

          
            $id = Auth::user()->id;
            $project->title=$data['title'];
            $project->description=$data['description'];
            $project->start_date=$data['startDate'];
            $project->end_date=$data['endDate'];
            $project->status=1;
            $project->created_by=$id;
            $project->updated_by=$id;
            $project->save();
            $request->session()->flash('success', 'Project Added Sucessfully!');

            return redirect()->route('listing_project');    

        }
      
    	return view("project.addNewProjects",compact('project'));
    	
    }

    /**
     * delete Project
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function deleteProject(Request $request, $id)
    {
        $project = Project::find($id);
        if ($project -> delete()) {
            $request -> session() -> flash('success','Project is Sucessfully deleted');
        }
        else{
            $request -> session() -> flash('error','Error in project Deeleting');
           
        }
        return redirect()->route('listing_project');

    }
    
    /**
     * edit Project
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function editProject(Request $request, $id)
    {
        $project = Project::find($id);
        if ($request -> isMethod('POST')) {
           
            $data = $request->all();
            $rules =[
                'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate'
            ];
            
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect('add_project')
                        ->withErrors($validator)
                        ->withInput();
             }

          
            $id = Auth::user()->id;
            $project->title=$data['title'];
            $project->description=$data['description'];
            $project->start_date=$data['startDate'];
            $project->end_date=$data['endDate'];
            $project->updated_by=$id;
            $project->save();
            $request->session()->flash('success', 'Project Sucessfully Edited!');

            return redirect()->route('listing_project');    

        }



        return view('project.addNewProjects',compact('project'));    
    }

    public function projectAssign(Request $request)
    {
        echo"hi";
        $data= $data = $request->all();
        
        echo "<pre>"; print_r($data); exit;
       
    }

    
}
