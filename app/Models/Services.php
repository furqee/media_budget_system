<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class services extends Sximo  {
	
	protected $table = 'tb_service';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_service.* FROM tb_service  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_service.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
