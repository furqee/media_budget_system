@extends('layouts.app')

@section('content')
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li><a href="{{ url($pageModule) }}"> {{ $pageTitle }} </a></li>
		<li class="active"> Form  </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin">

		{!! Form::open(array('url'=>'projectsbudget?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
		<div class="sbox">
			<div class="sbox-title clearfix">
				<div class="sbox-tools " >
					<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
				</div>
				<div class="sbox-tools pull-left" >
					<!-- <button name="apply" class="tips btn btn-sm btn-default  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button> -->
					<button name="save" class="tips btn btn-sm btn-default"  title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> 
				</div>
			</div>	
			<div class="sbox-content clearfix">
				<ul class="parsley-error-list">
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>		
				<div class="col-md-12">
					<fieldset><legend> Projects Budget</legend>
						{!! Form::hidden('id', $row['id']) !!}
						<div class="form-group  " >
								<label for="Date" class=" control-label col-md-4 text-left"> Date <span class="asterix"> * </span></label>
								<div class="col-md-6">

									<div class="input-group m-b" style="width:150px !important;">
										<input  type='text' name='date' id='date' value='{{ $row["date"] }}' class='form-control input-sm ' required readonly />
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div> 
								</div> 
								<div class="col-md-2">

								</div>
						</div>			
						<div class="form-group  " >
							<label for="Description" class=" control-label col-md-4 text-left"> Project Description <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<textarea name='description' rows='5' id='description' class='form-control input-sm ' required >{{ $row['description'] }}</textarea> 
							</div> 
							<div class="col-md-2">

							</div>
						</div>
						<div class="form-group  " >
							<label for="Client" class=" control-label col-md-4 text-left"> Assign To <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<select name='assign_to' rows='5' id='assign_to' class='select2 ' required  ></select> 
							</div> 
							<div class="col-md-2">

							</div>
						</div>			
						<div class="form-group  " >
							<label for="Client" class=" control-label col-md-4 text-left"> Client <span class="asterix"> * </span></label>
							<div class="col-md-4">
								<select name='client' rows='5' id='client' class='select2 ' required  ></select> 
							</div>
							<div class="col-md-4">
								<button type="button" class="btn btn-default" id="new_client"><i class="fa fa-plus"></i> &nbsp; Add</button>
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Service" class=" control-label col-md-4 text-left"> Service <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<select name='service' rows='5' id='service' class='select2 '  required ></select> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Budget" class=" control-label col-md-4 text-left"> Budget <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='budget' id='budget' value='{{ $row['budget'] }}' 
								class='form-control input-sm ' required /> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " style="display: none;">
							<label for="Final Budget" class=" control-label col-md-4 text-left"> Final Budget <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='final_budget' id='final_budget' value='{{ $row['final_budget'] }}' 
								class='form-control input-sm ' /> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Status" class=" control-label col-md-4 text-left"> Status <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input type='radio' name='status' value ='pending' @if($row['id'] == '') checked="checked" @endif   @if($row['status'] == 'pending') checked="checked" @endif class='minimal-red' > Pending 
								<input type='radio' name='status' value ='ongoing'  @if($row['status'] == 'ongoing') checked="checked" @endif class='minimal-red' > On going 
								<input type='radio' name='status' value ='approved'  @if($row['status'] == 'approved') checked="checked" @endif class='minimal-red' > Approved  
								<input type='radio' name='status' value ='delivered'  @if($row['status'] == 'delivered') checked="checked" @endif class='minimal-red' > Delivered 
								<input type='radio' name='status' value ='invoiceable'  @if($row['status'] == 'invoiceable') checked="checked" @endif class='minimal-red' > Invoice able 
							</div> 
							<div class="col-md-2">
							 	
							</div>
						</div> 					 					
							<div class="form-group  " >
								<label for="Start Date" class=" control-label col-md-4 text-left"> Start Date <span class="asterix"> * </span></label>
								<div class="col-md-6">

									<div class="input-group m-b" style="width:150px !important;">
										{!! Form::text('start_date', $row['start_date'],array('class'=>'form-control input-sm date')) !!}
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div> 
								</div> 
								<div class="col-md-2">

								</div>
							</div> 					
							<div class="form-group  " >
								<label for="End Date" class=" control-label col-md-4 text-left"> End Date <span class="asterix"> * </span></label>
								<div class="col-md-6">

									<div class="input-group m-b" style="width:150px !important;">
										{!! Form::text('end_date', $row['end_date'],array('class'=>'form-control input-sm date')) !!}
										<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
									</div> 
								</div> 
								<div class="col-md-2">

								</div>
							</div> {!! Form::hidden('created_at', $row['created_at']) !!}
							<input  type='hidden' name='entry_by' value='{{ Session::get("uid") }}' />
						</fieldset>
						</div>



					</div>
				</div>
				<input type="hidden" name="action_task" value="save" />
				{!! Form::close() !!}
			</div>
		</div>
<script type="text/javascript">
	$(document).ready(function() { 

		$("#assign_to").jCombo("{!! url('projectsbudget/comboselect?filter=tb_users:id:first_name&parent=group_id:3') !!}",
			{  selected_value : '{{ $row["assign_to"] }}' });

		$("#client").jCombo("{!! url('projectsbudget/comboselect?filter=tb_clients:id:name') !!}",
			{  selected_value : '{{ $row["client"] }}' });

		$("#service").jCombo("{!! url('projectsbudget/comboselect?filter=tb_service:id:service') !!}",
			{  selected_value : '{{ $row["service"] }}' });

		$('.date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});

		$("#new_client").click(function(){
		  	window.location.href = "{{ url('/clients/create?return=') }}";
		});

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("projectsbudget/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		

	});
</script>		 
@stop