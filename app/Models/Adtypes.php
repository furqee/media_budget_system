<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class adtypes extends Sximo  {
	
	protected $table = 'tb_ad_type';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_ad_type.* FROM tb_ad_type  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_ad_type.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
