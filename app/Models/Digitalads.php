<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class digitalads extends Sximo  {
	
	protected $table = 'tb_digital_ads';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_digital_ads.* FROM tb_digital_ads  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_digital_ads.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
