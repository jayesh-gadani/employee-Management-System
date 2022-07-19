<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'project_id',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'updated_by'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function Project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }
    /**
     * [displayAll function is used display all task]
     * @return object  it return all task
     */
    public function displayAll()
    {
         $iteams = config('paginate');
        $tasks = Task::paginate($iteams); 
        return($tasks);
    }

    /**
     * [addTask is used to add new task in specific project and assign to specific user]
     * @param array $data [information about task]
     */
    public function addTask(array $data)
    {
        $tasks = new Task();
        $id = Auth::user()->id;
        $tasks->title = $data['title'];
        $tasks->description = $data['description'];
        $tasks->user_id = $data['userId'];
        $tasks->project_id = (int)$data['projectId'];
        $tasks->start_date = $data['startDate'];
        $tasks->end_date = $data['endDate'];
        $tasks->status = $data['task_status'];
        $tasks->created_by = $id;
        $tasks->updated_by = $id;

        return( $tasks->save()?true:false);

    }

    /**
     * [userLoad function is used to load user when you select project]
     * @param  integer $id [project id]
     * @return object     [users who have allocated project]
     */
    public function userLoad($id)
    {
        $users = AssignProject::where('project_id', $id)->get();
        return($users);
    }

    /**
     * [deleteTask function is used to delete task]
     * @param  integer $id [task id]
     * @return boolean     [true on sucess and false on failed]
     */
    public function deleteTask($id)
    {
         $task = Task::find($id);
         return($task->delete()? true : false );
    }

    public function editTask(array $data, $id)
    {
        $tasks = Task::find($id);
        $tasks->title = $data['title'];
        $tasks->description = $data['description'];
        $tasks->user_id = $data['userId'];
        $tasks->project_id = $data['projectId'];
        $tasks->start_date = $data['startDate'];
        $tasks->end_date = $data['endDate'];
        $tasks->status = $data['task_status'];
        return($tasks->save()? true : false);
    }
}
