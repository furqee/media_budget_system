

		 {!! Form::open(array('url'=>'digitalads', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Digital Ads</legend>
				{!! Form::hidden('id', $row['id']) !!}					
									  <div class="form-group  " >
										<label for="Ad Name" class=" control-label col-md-4 text-left"> Ad Name <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='ad_name' id='ad_name' value='{{ $row['ad_name'] }}' 
						required     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Client" class=" control-label col-md-4 text-left"> Client <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='client' rows='5' id='client' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Platform" class=" control-label col-md-4 text-left"> Platform <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='platform' rows='5' id='platform' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Ad Type" class=" control-label col-md-4 text-left"> Ad Type <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='ad_type' rows='5' id='ad_type' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="From" class=" control-label col-md-4 text-left"> From <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('from', $row['from'],array('class'=>'form-control input-sm date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="To" class=" control-label col-md-4 text-left"> To <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('to', $row['to'],array('class'=>'form-control input-sm date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Strategy" class=" control-label col-md-4 text-left"> Strategy <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <textarea name='strategy' rows='5' id='strategy' class='form-control input-sm '  
				           >{{ $row['strategy'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group  " >
										<label for="Budget" class=" control-label col-md-4 text-left"> Budget <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <input  type='text' name='budget' id='budget' value='{{ $row['budget'] }}' 
						required     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('approved_budget', $row['approved_budget']) !!}{!! Form::hidden('utilized_budget', $row['utilized_budget']) !!}{!! Form::hidden('approved_utilized_budget', $row['approved_utilized_budget']) !!}{!! Form::hidden('status', $row['status']) !!}					
									  <div class="form-group  " >
										<label for="Card Used" class=" control-label col-md-4 text-left"> Card Used <span class="asterix"> * </span></label>
										<div class="col-md-6">
										  <select name='card_used' rows='5' id='card_used' class='select2 ' required  ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('created_at', $row['created_at']) !!}</fieldset>
			</div>
			
			

			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-default btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-default btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				  </div>	  
			
		</div> 
		 <input type="hidden" name="action_task" value="public" />
		 {!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#client").jCombo("{!! url('digitalads/comboselect?filter=tb_clients:id:name') !!}",
		{  selected_value : '{{ $row["client"] }}' });
		
		$("#platform").jCombo("{!! url('digitalads/comboselect?filter=tb_platforms:id:platform') !!}",
		{  selected_value : '{{ $row["platform"] }}' });
		
		$("#ad_type").jCombo("{!! url('digitalads/comboselect?filter=tb_ad_type:id:ad_type') !!}",
		{  selected_value : '{{ $row["ad_type"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
