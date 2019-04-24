<?php namespace App\Http\Controllers;

use App\Models\Projectsbudget;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Validator, Input, Redirect ; 


class ProjectsbudgetController extends Controller {

	protected $layout = "layouts.main";
	protected $data = array();	
	public $module = 'projectsbudget';
	static $per_page	= '10';

	public function __construct()
	{		
		parent::__construct();
		$this->model = new Projectsbudget();	
		
		$this->info = $this->model->makeInfo( $this->module);	
		$this->data = array(
			'pageTitle'	=> 	$this->info['title'],
			'pageNote'	=>  $this->info['note'],
			'pageModule'=> 'projectsbudget',
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

		for ($i=0; $i < count($this->data['rowData']) ; $i++) {
			$da_id = $this->data['rowData'][$i]->id;
			$final_budget = $this->data['rowData'][$i]->final_budget;
			$status = $this->data['rowData'][$i]->status;
			if(session('gid') == 1 || session('gid') == 2){
				if($final_budget == '' || is_null($final_budget) == true){
					$this->data['rowData'][$i]->final_budget = '<a class="dt" data-da-id="'.$da_id.'" ><span class="label label-success" data-toggle="modal" data-target="#myModal">Add</span></a>';
				}
				if($status == 'pending'){
					$this->data['rowData'][$i]->status = '<span class="label label-default">Pending</span> &nbsp; <a class="dt statusUpdate" data-da-id="'.$da_id.'" ><span class="label label-primary">On Going</span></a>';
				} elseif ($status == 'ongoing') {
					$this->data['rowData'][$i]->status = '<span class="label label-primary">On Going</span> &nbsp; <a class="dt statusUpdate" data-da-id="'.$da_id.'" ><span class="label label-success">Approved</span></a>';
				} elseif ($status == 'approved') {
					$this->data['rowData'][$i]->status = '<span class="label label-success">Approved</span> &nbsp; <a class="dt statusUpdate" data-da-id="'.$da_id.'" ><span class="label label-info">Delivered</span></a>';
				} elseif ($status == 'delivered') {
					$this->data['rowData'][$i]->status = '<span class="label label-info">Delivered</span> &nbsp; <a class="dt statusUpdate" data-da-id="'.$da_id.'" ><span class="label label-danger">Invoice Able</span></a>';
				} elseif ($status == 'invoiceable') {
					$this->data['rowData'][$i]->status = '<span class="label label-danger">Invoice Able</span>';
				}
			} else {
				if($status == 'pending'){
					$this->data['rowData'][$i]->status = '<span class="label label-default">Pending</span>';
				} elseif ($status == 'ongoing') {
					$this->data['rowData'][$i]->status = '<span class="label label-primary">On Going</span>';
				} elseif ($status == 'approved') {
					$this->data['rowData'][$i]->status = '<span class="label label-success">Approved</span>';
				} elseif ($status == 'delivered') {
					$this->data['rowData'][$i]->status = '<span class="label label-info">Delivered</span>';
				} elseif ($status == 'invoiceable') {
					$this->data['rowData'][$i]->status = '<span class="label label-danger">Invoice Able</span>';
				}
			} 
		}			
		// Render into template dd($this->data);
		return view( $this->module.'.index',$this->data);
	}	

	function create( Request $request , $id =0 ) 
	{
		$this->hook( $request  );
		if($this->access['is_add'] ==0) 
			return redirect('dashboard')->with('message', __('core.note_restric'))->with('status','error');

		$this->data['row'] = $this->model->getColumnTable( $this->info['table']); 
		$this->data['row']['date'] = date("Y-m-d");
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
		$assign_to = \DB::table('tb_projects')->where('id', $id)->pluck('assign_to');
		$this->data['assign_to'] = $assign_to[0];
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
				$rules = $this->validateForm();
				$validator = Validator::make($request->all(), $rules);
				if ($validator->passes()) 
				{
					$data = $this->validatePost( $request );
					$data['assign_to'] = $request->input('assign_to');
					$id = $this->model->insertRow($data , $request->input( $this->info['key']));
					
					/* Insert logs */
					$this->model->logs($request , $id);
					if(!is_null($request->input('apply')))
						return redirect( $this->module .'/'.$id.'/edit?'. $this->returnUrl() )->with('message',__('core.note_success'))->with('status','success');

					return redirect( $this->module .'?'. $this->returnUrl() )->with('message',__('core.note_success'))->with('status','success');
				} 
				else {
					return redirect($this->module.'/'. $request->input(  $this->info['key'] ).'/edit')
							->with('message',__('core.note_error'))->with('status','error')
							->withErrors($validator)->withInput();

				}
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
		$model  = new Projectsbudget();
		$info = $model::makeInfo('projectsbudget');
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
				return view('projectsbudget.public.view',$data);			
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
			return view('projectsbudget.public.index',$data);	
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

	public function finalBudget( Request $request)
	{
		$da_id = $request->input('da_id');
		$amount = $request->input('amount');
		\DB::update("UPDATE `tb_projects` SET `final_budget` = $amount WHERE id = $da_id");
		$this->model->logs($request , $da_id);
		return response()->json(['success' => true]);
	}

	public function status( Request $request)
	{
		$da_id = $request->input('da_id');
		$status = \DB::table('tb_projects')->where('id', $da_id)->pluck('status');
		if ($status[0] == 'pending') {
			\DB::update("UPDATE `tb_projects` SET `status` = 'ongoing' WHERE id = $da_id");
		} elseif ($status[0] == 'ongoing') {
			\DB::update("UPDATE `tb_projects` SET `status` = 'approved' WHERE id = $da_id");
		} elseif ($status[0] == 'approved') {
			\DB::update("UPDATE `tb_projects` SET `status` = 'delivered' WHERE id = $da_id");
		} elseif ($status[0] == 'delivered') {
			\DB::update("UPDATE `tb_projects` SET `status` = 'invoiceable' WHERE id = $da_id");
		} 
		$this->model->logs($request , $da_id);
		return response()->json(['success' => true]);
	}
}
