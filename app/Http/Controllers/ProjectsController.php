<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DateTime;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Config;

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
          
           /* $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate',
            ]);*/

            $rules =[
            	'title' => 'required',
                'description' => 'required',
                'startDate' => 'required',
                'endDate' => 'required|after:startDate'
			];
			//$validated = $request->validate($rules);
			$validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                echo"fail";
             }

            echo "<pre>"; print_r($data); exit;
        }
        else
        {

    	return view("project.addNewProjects",compact('project'));
    	}
    }

    /**
     * delete Project
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function deleteProject(Request $request, $id)
    {
        
    }
    
    /**
     * edit Project
     * @param  Request $request [description]
     * @param  [number]  $id      [description]
     * @return [void]           [description]
     */
    public function editProject(Request $request, $id)
    {
        
    }

    
}
