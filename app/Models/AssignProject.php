<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignProject extends Model
{
    use HasFactory;

    /**
     * Get all of the projects for the user.
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
