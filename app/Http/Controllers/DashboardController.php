<?php namespace App\Http\Controllers;

use App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;

class DashboardController extends Controller {

	public function __construct()
	{
		parent::__construct();
        $this->data = array(
            'pageTitle' =>  $this->config['cnf_appname'],
            'pageNote'  =>  'Welcome to Dashboard',
            
        );			
	}

	public function index( Request $request )
	{	
		$clients = \DB::table('tb_clients')->pluck('name','id'); 
		foreach ($clients as $key => $value) {
			$result[$key] = $value;   
	    }
	    $this->data['clients'] = $result;
		return view('dashboard.index',$this->data);
	}	

	public function clientData( Request $request )
	{
		$c_id = $request->input('c_id');
		$clientData = \DB::select("SELECT MONTH(`from`) Months, IFNULL(SUM(`budget`), 0) Budget, IFNULL(SUM(`utilized_budget`), 0) Utilized FROM `tb_digital_ads` WHERE client = $c_id AND YEAR(`from`) = YEAR(CURDATE()) GROUP BY MONTH(`from`) ORDER BY Months ASC");
		return $clientData;
	}
}