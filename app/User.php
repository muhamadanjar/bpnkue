<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function hasTooManyLoginAttempts(Request $request){
        $maxLoginAttempts = 3;
    
        $lockoutTime = 1; // Dalam menit
    
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($name)
    {
        foreach($this->roles as $role) {
            if ($role->name == $name) {
                return true;
            }
        }
 
        return false;
    }
 
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
 
        return $this->roles()->attach($role);
    }
 
    public function revokeRole($role)
    {
        if (is_string($role)) {
            $role = Role::where('name', $role)->first();
        }
 
        return $this->roles()->detach($role);
    }
}
