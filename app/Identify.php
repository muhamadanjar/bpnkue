<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Identify extends Model {

	protected $table = 'identify';
	protected $fillable = [
		'layerid',
		'layername'
	];
	protected $primaryKey = 'id_identify';

}
