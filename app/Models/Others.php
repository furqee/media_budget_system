<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class others extends Sximo  {
	
	protected $table = 'tb_others';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_others.* FROM tb_others  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_others.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
