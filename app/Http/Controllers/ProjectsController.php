<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\Project;
use App\Models\User;
use App\Models\AssignProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Mail;
use Config;
use Carbon\Carbon;
use Date;
use Response;
use DB;
use Exception;

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
        
        //$projects = Project::All();
       $projects=new Project();
       $projects=$projects->displayAll();
        return view("project.ViewProjects",compact('projects'));
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
                'endDate' => 'required|after_or_equal:startDate'
			];

			//$validated = $request->validate($rules);
			$validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return redirect()->route('add_project')
                        ->withErrors($validator)
                        ->withInput();
            }

            $result = $project->addProject($data);
            if ($result) {
                $request->session()->flash('success', 'Project Added Sucessfully!');
            } else {
                $request->session()->flash('error', 'Error in inserting Project!');

            } 
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
    public function deleteProject(Request $request)
    {
        $data = $request -> all();
        
       $project = new Project();
       $result = $project->deleteProject($data['id']);
       
        if ($result) {
            $request -> session() -> flash('success','Project is Sucessfully deleted');
        } else {
            $request -> session() -> flash('error','Error in project Deeleting');
           
        }
        return Response::json(array('status' => 'success', 'message' => 'Project assigned sucessfully '));
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
        if (!$project) {
            throw new Exception("Error Processing Request", 401);
        }
        if ($request -> isMethod('POST')) {
           
            $data = $request->all();
            $rules =[
                'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after_or_equal:startDate'
            ];
            
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect()->route('edit_project',['id' => $id])
                        ->withErrors($validator)
                        ->withInput();
             }

            $project = new Project();
            $result = $project->editProject($data, $id);
           if ($result)
                $request->session()->flash('success', 'Project Sucessfully Edited!');
            else
                $request->session()->flash('error', 'Failes in Project Edited!');

            return redirect()->route('listing_project');    

        }



        return view('project.addNewProjects',compact('project'));    
    }

    public function projectAssign(Request $request)
    {
        
        $data = $request->all();

        
         $users_id = $request->get('userId');
         
        if($users_id[0] == null) {
            return Response::json(array('status' => 'failed', 'message' => 'Please select users'));
            
        } 
        if($users_id == null) {
            return Response::json(array('status' => 'failed', 'message' => 'Please select users'));
        }
        if(sizeof($users_id)>3) {
            return Response::json(array('status' => 'failed', 'message' => 'you can select only three users'));   
        }

        $users_id = $data['userId'];
        $project = new Project();
        $result = $project->assignProject($users_id, $data['projectId']);

        if($result == true) {
            $request -> session() -> flash('success', 'Sucessfully Assigned Project!');
            return Response::json(array('status' => 'success', 'message' => 'Project assigned sucessfully '));
        }
        else if($result == false) {
            $request -> session() -> flash('Error', 'Failed to assigned Project!');
            return Response::json(array('status' => 'error', 'message' => 'Failed to assigned Project'));
        }
        else
            return Response::json(array('status' => '0', 'message' => 'Project is already assigned to the user'));
        

       ///return view('listing_project');
    }

    public function ajaxLoad(Request $request)
    {
       
        $data = $request->all();
        $id = $data['id'];

        $project = new Project();
        $array = $project->modalLoad($id);
        $project = $array['project'];
        $users = $array['users'];
        $selected_user = $array['selected_user'];

        return view('project.loadAjax',compact('project','users','selected_user'));

    }

    
}
