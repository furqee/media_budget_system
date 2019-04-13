<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class clients extends Sximo  {
	
	protected $table = 'tb_clients';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		return "  SELECT tb_clients.* FROM tb_clients  ";
	}	

	public static function queryWhere(  ){
		
		return "  WHERE tb_clients.id IS NOT NULL ";
	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
