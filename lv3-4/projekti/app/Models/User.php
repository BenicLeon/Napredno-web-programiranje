<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    
    public function ledProjects()
    {
        return $this->hasMany(Project::class);
    }

    
    public function teamProjects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }
}