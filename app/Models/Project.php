<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AssignProject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Config;
use Carbon\Carbon;
use Date;
use Response;
use DB;

class Project extends Model
{
    use HasFactory;

    /**
     * [displayAll function is used to retrieve all project
     * @return object  used to return all project
     */
    public function displayAll()
    {
        $iteams=config('paginate');
        $projects = Project::paginate($iteams);
        return($projects);
    }

    /**
     * [addProject is used save new project]
     * @param array $data details of project
     */
    public function addProject(array $data)
    {
        $project = new Project();
        $id = Auth::user()->id;
        $project->title=$data['title'];
        $project->description=$data['description'];
        $project->start_date=$data['startDate'];
        $project->end_date=$data['endDate'];
        $project->status=1;
        $project->created_by=$id;
        $project->updated_by=$id;

        return ($project->save() ? true :false) ;
    }

    /**
     * [deleteProject function is used to delete project]
     * @param  integer $id project id that you want to remove
     * @return boolean     true for sucess and false for failed
     */
    public function deleteProject($id)
    {
        $project = Project::find($id);

        if ($project -> delete()) {
            return(true);
        } else {
            return(false);
           
        }
    } 

    /**
     * [editProject function is used to edit project ]
     * @param  array  $data details of project that you want to edit
     * @param  number $id  project id that you want to edit
     * @return boolean     true for sucess and false for failed
     */
    public function editProject( array $data, $id)
    {
        $project = Project::find($id);
        $id = Auth::user()->id;
        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->start_date = $data['startDate'];
        $project->end_date = $data['endDate'];
        $project->updated_by = $id;
        return( $project->save() ? true :false);
    }

    /**
     * [assignProject function is used to assign project to the user]
     * @param  array  $users_id  list of user whom you want to use assign project
     * @param  integer $projectId  id of project that we want to assign to the user
     * @return  boolean   true for sucess and false on failed
     */
    public function assignProject(array $users_id, $projectId)
    {
        //echo "<pre>"; print_r($users_id); exit;
        $flag=false;
        foreach($users_id as $user_id)
        {

            $projects = DB::table('assign_projects')
                ->where('user_id', '=', $user_id)
                ->where('project_id', '=', $projectId)
                ->get();

                $n=sizeof($projects);
                if($n>0)
                {
                    //return("This Project is already Assign to this user !");
                    
                }
                else
                {
                    $project = new AssignProject();
                    $project->user_id=$user_id;
                    $project->project_id=$projectId;
                    $project->status=1;
                    $id = Auth::user()->id;
                    $project->created_by=$id;
                    $project->updated_by=$id;
                    
                    $project->save();
                    $flag=true;

                    
                }
        
        }
        return($flag==true?true:false);
    }


    public function modalLoad($id)
    {

         $project = Project::find($id);
         $users = User::All(); 
         return [
            'project' => $project,
            'users' => $users
         ];
    }

}
