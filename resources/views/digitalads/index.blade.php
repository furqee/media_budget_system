@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li class="active"> {{ $pageTitle }} </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin">

		<div class="sbox">
			<div class="sbox-title">
				<h1> All Records <small> </small></h1>
				<div class="sbox-tools">
					@if(Session::get('gid') ==1)
						<a href="{{ url($pageModule) }}" class="tips btn btn-sm  " title=" {{ __('core.btn_reload') }}" ><i class="fa  fa-refresh"></i></a>
						<a href="{{ url('sximo/module/config/'.$pageModule) }}" class="tips btn btn-sm  " title=" {{ __('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
					@endif 	
				</div>				
			</div>
			<div class="sbox-content">
			<!-- Toolbar Top -->
			<div class="row">
				<div class="col-md-4"> 	
					@if($access['is_add'] ==1)
					<a href="{{ url('digitalads/create?return='.$return) }}" class="btn btn-default btn-sm"  
						title="{{ __('core.btn_create') }}"><i class=" fa fa-plus "></i> Create New </a>
					@endif

					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-menu5"></i> Bulk Action </button>
				        <ul class="dropdown-menu">
				         @if($access['is_excel'] ==1)
							<li><a href="{{ url( $pageModule .'/export?do=excel&return='.$return) }}"><i class="fa fa-download"></i> Export CSV </a></li>	
						@endif
						@if($access['is_add'] ==1)
							<li><a href="{{ url($pageModule .'/import?return='.$return) }}" onclick="SximoModal(this.href, 'Import CSV'); return false;"><i class="fa fa-cloud-upload"></i> Import CSV</a></li>
							<li><a href="javascript://ajax" class=" copy " title="Copy" ><i class="fa fa-copy"></i> Copy selected</a></li>
						@endif	
							<li><a href="{{ url($pageModule) }}"  ><i class="fa fa-times"></i> Clear Search </a></li>
				          	<li role="separator" class="divider"></li>
				         @if($access['is_remove'] ==1)
							 <li><a href="javascript://ajax"  onclick="SximoDelete();" class="tips" title="{{ __('core.btn_remove') }}"><i class="fa fa-trash-o"></i>
							Remove Selected </a></li>
						@endif 
				          
				        </ul>
				    </div>    
				</div>
				<div class="col-md-4 pull-right">
					<div class="input-group">
					      <div class="input-group-btn">
					        <button type="button" class="btn btn-default btn-sm " 
					        onclick="SximoModal('{{ url($pageModule."/search") }}','Advance Search'); " ><i class="fa fa-filter"></i> Filter </button>
					      </div><!-- /btn-group -->
					      <input type="text" class="form-control input-sm onsearch" data-target="{{ url($pageModule) }}" aria-label="..." placeholder=" Type And Hit Enter ">
					    </div>
				</div>    
			</div>					
			<!-- End Toolbar Top -->

			<!-- Table Grid -->
			<div class="table-responsive" style="padding-bottom: 70px;">
 			{!! Form::open(array('url'=>'digitalads?'.$return, 'class'=>'form-horizontal m-t' ,'id' =>'SximoTable' )) !!}
			
		    <table class="table table-striped table-hover " id="{{ $pageModule }}Table">
		        <thead>
					<tr>
						<th style="width: 3% !important;" class="number"> No </th>
						<th  style="width: 3% !important;"> <input type="checkbox" class="checkall minimal-green" /></th>
						<th  style="width: 10% !important;">{{ __('core.btn_action') }}</th>
						
						@foreach ($tableGrid as $t)
							@if($t['view'] =='1')				
								<?php $limited = isset($t['limited']) ? $t['limited'] :''; 
								if(SiteHelpers::filterColumn($limited ))
								{
									$addClass='class="tbl-sorting" ';
									if($insort ==$t['field'])
									{
										$dir_order = ($inorder =='desc' ? 'sort-desc' : 'sort-asc'); 
										$addClass='class="tbl-sorting '.$dir_order.'" ';
									}
									echo '<th align="'.$t['align'].'" '.$addClass.' width="'.$t['width'].'">'.\SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())).'</th>';				
								} 
								?>
							@endif
						@endforeach
						
					  </tr>
		        </thead>

		        <tbody>        						
		            @foreach ($rowData as $row)
		                <tr>
							<td > {{ ++$i }} </td>
							<td ><input type="checkbox" class="ids minimal-green" name="ids[]" value="{{ $row->id }}" />  </td>
							<td>

							 	<div class="dropdown">
								  <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown"> Action </button>
								  <ul class="dropdown-menu">
								 	@if($access['is_detail'] ==1)
									<li><a href="{{ url('digitalads/'.$row->id.'?return='.$return)}}" class="tips" title="{{ __('core.btn_view') }}"> {{ __('core.btn_view') }} </a></li>
									@endif
									@if($access['is_edit'] ==1)
									<li><a  href="{{ url('digitalads/'.$row->id.'/edit?return='.$return) }}" class="tips" title="{{ __('core.btn_edit') }}"> {{ __('core.btn_edit') }} </a></li>
									@endif
									<li class="divider" role="separator"></li>
									@if($access['is_remove'] ==1)
										 <li><a href="javascript://ajax"  onclick="SximoDelete();" class="tips" title="{{ __('core.btn_remove') }}">
										Remove Selected </a></li>
									@endif 
								  </ul>
								</div>

							</td>														
						 @foreach ($tableGrid as $field)
							 @if($field['view'] =='1')
							 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
							 	@if(SiteHelpers::filterColumn($limited ))
							 	 <?php $addClass= ($insort ==$field['field'] ? 'class="tbl-sorting-active" ' : ''); ?>
								 <td align="{{ $field['align'] }}" width=" {{ $field['width'] }}"  {!! $addClass !!} >					 
								 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}						 
								 </td>
								@endif	
							 @endif					 
						 @endforeach			 
		                </tr>
						
		            @endforeach
		              
		        </tbody>
		      
		    </table>
			<input type="hidden" name="action_task" value="" />
			
			{!! Form::close() !!}
			@include('footer')
			</div>
			<!-- End Table Grid -->


			</div>
		</div>
	</div>
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Please Add Utilized Budget</h4>
        </div>
        <div class="modal-body">
        <form role="form">
          <div class="form-group  " >
             <label for="Amount" class=" control-label col-md-4 text-left"> Amount </label>
             <div class="col-md-8">
             	<input  type='hidden' name='da_id' id='da_id' value='' />
                <input  type='number' name='amount' id='amount' value='' required class='form-control input-sm ' /> 
             </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="submitForm" class="btn btn-primary submitBtn">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
$(document).ready(function(){
	$('.copy').click(function() {
		var total = $('input[class="ids"]:checkbox:checked').length;
		if(confirm('are u sure Copy selected rows ?'))
		{
			$('input[name="action_task"]').val('copy');
			$('#SximoTable').submit();// do the rest here	
		}
	})	
	
	$(".dt").click(function(){
		var da_id = $(this).data("da-id");
		$('#da_id').val(da_id);
	});

	$("#submitForm").click(function(){ 
		var da_id = $('#da_id').val();
	  	var amount = $('#amount').val();
	    if(amount.trim() == ''){
	        alert('Please enter amount.');
	        return false;
	    } else{
	    	$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ url('/utilized_amount') }}",
                method: 'post',
                data: {
                    amount: amount,
                    da_id: da_id
                },
                beforeSend: function () {
	                $('.submitBtn').attr("disabled","disabled");
	                $('.modal-body').css('opacity', '.5');
	            },
                success: function (result) {
                    if(result.success == true){
                    	$('#myModal').modal('hide');
                    	$('.submitBtn').removeAttr("disabled");
	                	$('.modal-body').css('opacity', '');
	                	$.toast({
					    heading: 'success',
					    text: 'message',
					    position: 'top-right',		           
					   	icon: 'success',
					    hideAfter: 1000,
					    stack: 6
					});
					setTimeout(function(){ location.reload(); }, 1000);
                    } else {
                    	alert('There must be some Error!')
                    }
                    
                }
            });
	    }
	});

	$(".approveBudget").click(function(){
		var da_id = $('#da_id').val();
		$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

        jQuery.ajax({
            url: "{{ url('/status_update') }}",
            method: 'post',
            data: {
                da_id: da_id
            },
            success: function (result) {
                if(result.success == true){
                	$.toast({
					    heading: 'success',
					    text: 'message',
					    position: 'top-right',		           
					   	icon: 'success',
					    hideAfter: 1000,
					    stack: 6
					});
					setTimeout(function(){ location.reload(); }, 1000);
                } else {
                	alert('There must be some Error!')
                }
                
            }
        });
	});

	$(".approveUtilizedBudget").click(function(){
		var da_id = $('#da_id').val();
		$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

        jQuery.ajax({
            url: "{{ url('/approved_utilized_budget') }}",
            method: 'post',
            data: {
                da_id: da_id
            },
            success: function (result) {
                if(result.success == true){
                	$.toast({
					    heading: 'success',
					    text: 'message',
					    position: 'top-right',		           
					   	icon: 'success',
					    hideAfter: 1000,
					    stack: 6
					});
					setTimeout(function(){ location.reload(); }, 1000);
                } else {
                	alert('There must be some Error!')
                }
                
            }
        });
	});

});	
</script>	
	
@stop
