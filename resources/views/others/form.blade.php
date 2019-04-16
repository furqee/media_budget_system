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

		{!! Form::open(array('url'=>'others?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
		<div class="sbox">
			<div class="sbox-title clearfix">
				<div class="sbox-tools " >
					<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
				</div>
				<div class="sbox-tools pull-left" >
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
					<fieldset><legend> Others</legend>
						{!! Form::hidden('id', $row['id']) !!}					
						<div class="form-group  " >
							<label for="Date" class=" control-label col-md-4 text-left"> Date <span class="asterix"> * </span></label>
							<div class="col-md-6">

								<div class="input-group m-b" style="width:150px !important;">
									{!! Form::text('date', $row['date'],array('class'=>'form-control input-sm date')) !!}
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Client" class=" control-label col-md-4 text-left"> Client <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<select name='client' rows='5' id='client' class='select2 '   ></select> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Platform" class=" control-label col-md-4 text-left"> Platform <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='platform' id='platform' value='{{ $row['platform'] }}' 
								class='form-control input-sm ' /> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Amount Spend" class=" control-label col-md-4 text-left"> Amount Spend <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='amount_spend' id='amount_spend' value='{{ $row['amount_spend'] }}' 
								class='form-control input-sm ' /> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Card" class=" control-label col-md-4 text-left"> Card <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='card' id='card' value='{{ $row['card'] }}' 
								class='form-control input-sm ' /> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> 					
						<div class="form-group  " >
							<label for="Description" class=" control-label col-md-4 text-left"> Description <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<textarea name='description' rows='5' id='description' class='form-control input-sm '  
								>{{ $row['description'] }}</textarea> 
							</div> 
							<div class="col-md-2">

							</div>
						</div> </fieldset>
					</div>



				</div>
			</div>
			<input type="hidden" name="action_task" value="save" />
			{!! Form::close() !!}
		</div>
	</div>		
	

	<script type="text/javascript">
		$(document).ready(function() { 

			$('.date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});

			$(".date").datepicker().datepicker("setDate", new Date());
			
			$("#client").jCombo("{!! url('others/comboselect?filter=tb_clients:id:name') !!}",
				{  selected_value : '{{ $row["client"] }}' });
			
			$('.removeMultiFiles').on('click',function(){
				var removeUrl = '{{ url("others/removefiles?file=")}}'+$(this).attr('url');
				$(this).parent().remove();
				$.get(removeUrl,function(response){});
				$(this).parent('div').empty();	
				return false;
			});		

		});
	</script>		 
	@stop