<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
	//protected $connection = 'pgsqlsde';
    protected $table = 'poi_pandeglang';
    protected $primaryKey = 'id';

	protected $hidden = [];
}
