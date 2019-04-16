<?php namespace App\Http\Controllers;

use App\Models\Digitalads;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class DigitaladsController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'digitalads';
	static $per_page	= '10';

	public function __construct()
	{		
		parent::__construct();
		$this->model = new Digitalads();	
		
		$this->info = $this->model->makeInfo( $this->module);	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'digitalads',
			'return'	=> self::returnUrl()
			
		);
		
	}

	public function index( Request $request )
	{
		// Make Sure users Logged 
		if(!\Auth::check()) 
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');
		$this->grab( $request) ;
		if($this->access['is_view'] ==0) 
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');				
		// Render into template
		//dd($this->data);
		for ($i=0; $i < count($this->data['rowData']) ; $i++) { 
			$utilized_budget = $this->data['rowData'][$i]->utilized_budget;
			$da_id = $this->data['rowData'][$i]->id;
			$budget_approved = $this->data['rowData'][$i]->approved_budget;
			$utilized_budget_approved = $this->data['rowData'][$i]->approved_utilized_budget;
			$status = $this->data['rowData'][$i]->status;

			if($status == 'running'){
				$this->data['rowData'][$i]->status = '<span class="label label-default" >Running</span>';
			} else {
				$this->data['rowData'][$i]->status = '<span class="label label-success" >Done</span>';
			}
			if($budget_approved == '1'){
				if($utilized_budget == '' || is_null($utilized_budget) == true){
					$this->data['rowData'][$i]->utilized_budget = '<a class="dt" data-da-id="'.$da_id.'" ><span class="label label-success" data-toggle="modal" data-target="#myModal">Add</span></a>';
				}
			}
			if(session('gid') == 1 || session('gid') == 2){
				if($budget_approved == '0'){
					$this->data['rowData'][$i]->approved_budget = '<a class="dt approveBudget" data-da-id="'.$da_id.'" ><span class="label label-success" >Approve</span></a>';
				} else {
					$this->data['rowData'][$i]->approved_budget = '<span class="label label-default" >Approved</span>';
				}
				if($utilized_budget != '' || is_null($utilized_budget) == false){
					if($utilized_budget_approved == '0'){
						$this->data['rowData'][$i]->approved_utilized_budget = '<a class="dt approveUtilizedBudget" data-da-id="'.$da_id.'" ><span class="label label-success" >Approve</span></a>';
					} else {
						$this->data['rowData'][$i]->approved_utilized_budget = '<span class="label label-default" >Approved</span>';
					}
				}
			} else {
				if($budget_approved == '0'){
					$this->data['rowData'][$i]->approved_budget = '<span class="label label-warning" data-toggle="modal" data-target="#myModal">Not Approved</span>';
				} else {
					$this->data['rowData'][$i]->approved_budget = '<span class="label label-success" data-toggle="modal" data-target="#myModal">Approved</span>';
				}
				if($utilized_budget_approved == '0'){
					$this->data['rowData'][$i]->approved_utilized_budget = '<span class="label label-warning" data-toggle="modal" data-target="#myModal">Not Approved</span>';
				} else {
					$this->data['rowData'][$i]->approved_utilized_budget = '<span class="label label-success" data-toggle="modal" data-target="#myModal">Approved</span>';
				}
			}
			
		}

		return view( $this->module.'.index',$this->data);
	}	

	function create( Request $request , $id =0 ) 
	{
		$this->hook( $request  );
		if($this->access['is_add'] ==0) 
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');

		$this->data['row'] = $this->model->getColumnTable( $this->info['table']); 
		
		$this->data['id'] = '';
		return view($this->module.'.form',$this->data);
	}
	function edit( Request $request , $id ) 
	{
		$this->hook( $request , $id );
		if(!isset($this->data['row']))
			return redirect($this->module)->with('message','Record Not Found !')->with('status','error');
		if($this->access['is_edit'] ==0 )
			return redirect('dashboard')->with('message',__('core.note_restric'))->with('status','error');
		$this->data['row'] = (array) $this->data['row'];
		
		$this->data['id'] = $id;
		return view($this->module.'.form',$this->data);
	}	
	function show( Request $request , $id ) 
	{
		/* Handle import , export and view */
		$task =$id ;
		switch( $task)
		{
			case 'search':
				return $this->getSearch();
				break;
			case 'lookup':
				return $this->getLookup($request );
				break;
			case 'comboselect':
				return $this->getComboselect( $request );
				break;
			case 'import':
				return $this->getImport( $request );
				break;
			case 'export':
				return $this->getExport( $request );
				break;
			default:
				$this->hook( $request , $id );
				if(!isset($this->data['row']))
					return redirect($this->module)->with('message','Record Not Found !')->with('status','error');

				if($this->access['is_detail'] ==0) 
					return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');

				return view($this->module.'.view',$this->data);	
				break;		
		}
	}
	function store( Request $request  )
	{
		$task = $request->input('action_task');
		switch ($task)
		{
			default:
				$ad_name = $request->input('ad_name');
				$client = $request->input('client');
				$platform = $request->input('platform');
				$ad_type = $request->input('adt');
				$from = $request->input('frd');
				$to = $request->input('tod');
				$strategy = $request->input('strg');
				$budget = $request->input('bdg');
				$card_used = $request->input('crd');
				$entry_by = $request->input('entry_by');
				
				for ($i=0; $i < count($ad_type); $i++) { 
					$data['ad_name'] = $ad_name;
					$data['client'] = $client;
					$data['platform'] = $platform;
					$data['ad_type'] = $ad_type[$i];
					$data['from'] = $from[$i];
					$data['to'] = $to[$i];
					$data['strategy'] = $strategy[$i];
					$data['budget'] = $budget[$i];
					$data['status'] = 'running';
					$data['card_used'] = $card_used[$i];
					$data['entry_by'] = $entry_by;

					$id = $this->model->insertRow($data , $request->input( $this->info['key']));
				
					/* Insert logs */
					$this->model->logs($request , $id);
				} 

				return redirect( $this->module .'?'. $this->returnUrl() )->with('message',__('core.note_success'))->with('status','success');

				break;
			case 'public':
				return $this->store_public( $request );
				break;

			case 'delete':
				$result = $this->destroy( $request );
				return redirect($this->module.'?'.$this->returnUrl())->with($result);
				break;

			case 'import':
				return $this->PostImport( $request );
				break;

			case 'copy':
				$result = $this->copy( $request );
				return redirect($this->module.'?'.$this->returnUrl())->with($result);
				break;		
		}	
	
	}	

	public function destroy( $request)
	{
		// Make Sure users Logged 
		if(!\Auth::check()) 
			return redirect('user/login')->with('status', 'error')->with('message','You are not login');

		$this->access = $this->model->validAccess($this->info['id'] , session('gid'));
		if($this->access['is_remove'] ==0) 
			return redirect('dashboard')
				->with('message', __('core.note_restric'))->with('status','error');
		// delete multipe rows 
		if(count($request->input('ids')) >=1)
		{
			$this->model->destroy($request->input('ids'));
			
			\SiteHelpers::auditTrail( $request , "ID : ".implode(",",$request->input('ids'))."  , Has Been Removed Successfull");
			// redirect
        	return ['message'=>__('core.note_success_delete'),'status'=>'success'];	
	
		} else {
			return ['message'=>__('No Item Deleted'),'status'=>'error'];				
		}

	}	
	
	public static function display(  )
	{
		$mode  = isset($_GET['view']) ? 'view' : 'default' ;
		$model  = new Digitalads();
		$info = $model::makeInfo('digitalads');
		$data = array(
			'pageTitle'	=> 	$info['title'],
			'pageNote'	=>  $info['note']			
		);	
		if($mode == 'view')
		{
			$id = $_GET['view'];
			$row = $model::getRow($id);
			if($row)
			{
				$data['row'] =  $row;
				$data['fields'] 		=  \SiteHelpers::fieldLang($info['config']['grid']);
				$data['id'] = $id;
				return view('digitalads.public.view',$data);			
			}			
		} 
		else {

			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			$params = array(
				'page'		=> $page ,
				'limit'		=>  (isset($_GET['rows']) ? filter_var($_GET['rows'],FILTER_VALIDATE_INT) : 10 ) ,
				'sort'		=> $info['key'] ,
				'order'		=> 'asc',
				'params'	=> '',
				'global'	=> 1 
			);

			$result = $model::getRows( $params );
			$data['tableGrid'] 	= $info['config']['grid'];
			$data['rowData'] 	= $result['rows'];	

			$page = $page >= 1 && filter_var($page, FILTER_VALIDATE_INT) !== false ? $page : 1;	
			$pagination = new Paginator($result['rows'], $result['total'], $params['limit']);	
			$pagination->setPath('');
			$data['i']			= ($page * $params['limit'])- $params['limit']; 
			$data['pagination'] = $pagination;
			return view('digitalads.public.index',$data);	
		}

	}
	function store_public( $request)
	{
		
		$rules = $this->validateForm();
		$validator = Validator::make($request->all(), $rules);	
		if ($validator->passes()) {
			$data = $this->validatePost(  $request );		
			 $this->model->insertRow($data , $request->input('id'));
			return  Redirect::back()->with('message',__('core.note_success'))->with('status','success');
		} else {

			return  Redirect::back()->with('message',__('core.note_error'))->with('status','error')
			->withErrors($validator)->withInput();

		}	
	
	}
	public function utlizedAmount( Request $request)
	{
		$amount = $request->input('amount');
		$da_id = $request->input('da_id');
		\DB::update("UPDATE `tb_digital_ads` SET `utilized_budget` = $amount, `status` = 'done' WHERE id = $da_id");
		return response()->json(['success' => true]);
	}
	public function approvedBudget( Request $request)
	{
		$da_id = $request->input('da_id');
		\DB::update("UPDATE `tb_digital_ads` SET `approved_budget` = 1 WHERE id = $da_id");
		return response()->json(['success' => true]);
	}
	public function approvedUtilizedBudget( Request $request)
	{
		$da_id = $request->input('da_id');
		\DB::update("UPDATE `tb_digital_ads` SET `approved_utilized_budget` = 1 WHERE id = $da_id");
		return response()->json(['success' => true]);
	}
}
