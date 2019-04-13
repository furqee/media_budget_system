<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class adplatforms extends Sximo  {
	
	protected $table = 'tb_platforms';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_platforms.* FROM tb_platforms  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_platforms.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
