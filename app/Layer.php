<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;
class Layer extends Model {

	protected $table = 'layeresri';
	protected $primaryKey = 'id_layer';

	protected $hidden = ['jsonfield'];

	public static $rules = array(
		'layer'=>'required|min:3',
		'layerurl' => 'required|min:3',
	);

	public static $messages = [
	    'layer.required' => 'kode layer harus diisi!',
		'layerurl.required' => 'Url Layer harus di isi',
	];

	public function roles()
    {
        return $this->belongsToMany(Role::class,'role_layer');
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
