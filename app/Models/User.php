<?php

namespace App\Models;

use Illuminate\Http\Request;
Use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AssignProject;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Mail;
use Config;
use Response;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'contact',
        'address',
        'role',
        'position',
        'status',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * [saveData method is used to save User]
     * @param  array  $data  [request data to store in user table]
     * @param  string  $token [email varification token]
     * @return bollean        [sucess for 1 and failed for 0]
     */
    public function saveData(array $data, $token)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact'=> $data['contact'],
            'address'=> $data['address'],
            'password' => Hash::make($data['password']),
            'role'=>'ROLE_EMPLOYEE',
            'position'=>'Employee',
            'status' => '0',
            'token' => $token    
        ]);
        if ($user)
            return(1);
        else
            return(0);
        
    }

    /**
     * [displayAll function is used to display all data of user]
     * @return [object] [it return all data of user table]
     */
    public function displayAll()
    {
        $perPage = config('paginate');

        $users = User::paginate($perPage);

        return($users);
    }

    /**
     * [addUser function is used to add new user]
     * @param array  $data     [data of user]
     * @param [string] $password [temporary password]
     */
    public function addUser(array $data,$password)
    {
        $id = Auth::user()->id;
        
        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->contact = $data["contact"];
        $user->address = $data["address"]; 
        $user->password = Hash::make($password);
        $user->role = $data["role"];
        $user->position = $data["position"];

        $user->status = 1;
        $user->created_by = $id;
        $user->updated_by = $id;
        $user->save();
        if ($user)
            return(1);
        else
            return(0);
    }
    /**
     * [deleteUser function is used to delete user]
     * @param  array  $request [it retrives id of user]
     * @return [boolean]          [1 for sucess and 0 for failed]
     */
    public function deleteUser(array $request)
    {
        $id = $request['id'];
        $user = User::find($id);

        if ($user->delete()) {
            return(1);
        } else {
           return(0);
        }
    }

    /**
     * [editUser function is used to update user]
     * @param  array  $data [value that you want to change]
     * @param  [int] $id   [id of user]
     * @return [boolean]   [sucess for true and false for failed]
     */
    public function editUser(array $data, $id)
    {
        $user = User::find($id);
            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->contact = $data["contact"];
            $user->address = $data["address"]; 
            $user->role = $data["role"];
            $user->position = $data["position"];
          
            if($user->save())
                return(true);
            else
                return(false);
    }

    /**
     * [parmittiion is used to set the user parmission]
     * @param  int $id [id of user whom you want to set parmission]
     * @return  [boolean]      [true for sucess and false on failer]
     */
    public function parmission($id)
    {
        $user = User::find($id);
        $status = $user['status'];
        $message = "";
        if ( $status == 0 ) {
            $user->status = '1';
        } else {
            $user->status = '0';
        }   
        
        if ( $user->save() )
            return(true);
        else
            return(false);

    }

    /**
     * [changePassword function is used to change password]
     * @param  [object] $user [data of user table]
     * @param  [object] $data [data of user form]
     * @return [boolean]      [true for sucess and false on failer]
     */
    public function changePassword($user, $data)
    {
        if (Hash::check($data['password'], $user['password'])) {

            $user->password = Hash::make($data['newPassword']);
            $user->save();
            return(true);
        } else {
            return(false);
        }
    }
}
