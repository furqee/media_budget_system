@extends('layouts.app')
@section('content')
<style type="text/css">
   .control-label {
      text-align: left !important;
   }
</style>
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
      {!! Form::open(array('url'=>'digitalads?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
            <div class="col-md-4">
               <fieldset>
                  <legend> Basic Info</legend>
                  {!! Form::hidden('id', $row['id']) !!}					
                  <div class="form-group  " >
                     <label for="Ad Name" class=" control-label col-md-4 text-left"> Campaign Name <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <input  type='text' name='ad_name' id='ad_name' value='{{ $row['ad_name'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Client" class=" control-label col-md-4 text-left"> Client <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <select name='client' rows='5' id='client' class='select2 '  ></select> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Platform" class=" control-label col-md-4 text-left"> Platform <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <select name='platform' rows='5' id='platform' class='select2 '  ></select> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  </fieldset>
            </div>
            <div class="col-md-8">
               <fieldset>
                  <legend> Add Details</legend>
                  <div class="form-group  " >
                     <label for="Ad Type" class=" control-label col-md-4 text-left"> Ad Type <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <select name='ad_type' rows='5' id='ad_type' class='select2 '  ></select> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="From" class=" control-label col-md-4 text-left"> From <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <div class="input-group m-b" style="width:150px !important;">
                           {!! Form::text('from', $row['from'],array('class'=>'form-control input-sm date', 'id'=>'from')) !!}
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
                           {!! Form::text('to', $row['to'],array('class'=>'form-control input-sm date', 'id'=>'to')) !!}
                           <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Strategy" class=" control-label col-md-4 text-left"> Strategy </label>
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
                        <input  type='number' name='budget' id='budget' value='{{ $row['budget'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  {!! Form::hidden('approved_budget', $row['approved_budget']) !!}{!! Form::hidden('utilized_budget', $row['utilized_budget']) !!}{!! Form::hidden('approved_utilized_budget', $row['approved_utilized_budget']) !!}
                  <input  type='hidden' name='status' value='running' /> 
                  <div class="form-group  " >
                     <label for="Card Used" class=" control-label col-md-4 text-left"> Card Used <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <select name='card_used' rows='5' id='card_used' class='select2 '  >
                        	<option value="">-- Please Select --</option>
                           <option value="own">Own</option>
                        	<option value="client">Client's</option>
                        </select> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  	<div class="form-group  " >
                  		<label for="Card Used" class=" control-label col-md-4 text-left"> Click to Add More </label>
                     <div class="col-md-6">
                        <button type="button" id="add_more" class="btn btn-primary">ADD</button>
                     </div>
                     <div class="col-md-2">
                     </div>
                	</div>
                  {!! Form::hidden('created_at', $row['created_at']) !!}
                  <input  type='hidden' name='entry_by' value='{{ Session::get("uid") }}' /> 
               </fieldset>
            </div>
            <div class="col-md-12">
               <fieldset>
                  <legend> Entries</legend>
            	<table class="table table-hover" id="tbl_options" style="display: none;">
				  <thead style="background: #673ab7; color: white;">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Ad Type</th>
				      <th scope="col">From</th>
				      <th scope="col">To</th>
				      <th scope="col">Strategy</th>
				      <th scope="col">Budget</th>
				      <th scope="col">Card Used</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <tbody>
				  </tbody>
				</table>
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
   	
   	$("#client").jCombo("{!! url('digitalads/comboselect?filter=tb_clients:id:name') !!}",
   	{  selected_value : '{{ $row["client"] }}' });
   	
   	$("#platform").jCombo("{!! url('digitalads/comboselect?filter=tb_platforms:id:platform') !!}",
   	{  selected_value : '{{ $row["platform"] }}' });
   	
   	$("#ad_type").jCombo("{!! url('digitalads/comboselect?filter=tb_ad_type:id:ad_type') !!}",
   	{  selected_value : '{{ $row["ad_type"] }}' });
   	 		 
   	$('.removeMultiFiles').on('click',function(){
   		var removeUrl = '{{ url("digitalads/removefiles?file=")}}'+$(this).attr('url');
   		$(this).parent().remove();
   		$.get(removeUrl,function(response){});
   		$(this).parent('div').empty();	
   		return false;
   	});

      $('#from').on('changeDate', function(ev){
          $(this).datepicker('hide');
      });		

      $('#to').on('changeDate', function(ev){
          $(this).datepicker('hide');
      });

   	var i = 1;
   	$("#add_more").click(function() {
   		var ad_name =  $("#ad_name").val();
   		var client = $("#client").val();
   		var platform = $("#platform").val();
   		var ad_type = $("#ad_type option:selected").text();
   		var ad_type_id = $("#ad_type").val();
   		var from = $("#from").val();
   		var to = $("#to").val();
   		var strategy = $("#strategy").val();
   		var budget = $("#budget").val();
   		var card_used = $("#card_used option:selected").text();
   		var card_used_id = $("#card_used").val();
   		if(ad_name != '' && client != '' && platform != '' && ad_type != '' && from != '' && budget != '' && card_used != '') {
   			$("#tbl_options").show();
   			var html = '<tr><td>'+ i +'</td>';
   			html += '<td>'+ ad_type +'</td>';
   			html += '<td>'+ from +'</td>';
   			html += '<td>'+ to +'</td>';
   			html += '<td>'+ strategy +'</td>';
   			html += '<td>'+ budget +'</td>';
   			html += '<td>'+ card_used +'</td>'
   			html += '<td><a onClick="$(this).closest('+ "'tr'" +').remove();"><span class="label label-danger">Remove</span></a></td>';
   			html += '<input type="hidden" name="adt[]" value="'+ ad_type_id +'" />';
   			html += '<input type="hidden" name="frd[]" value="'+ from +'" />';
   			html += '<input type="hidden" name="tod[]" value="'+ to +'" />';
   			html += '<input type="hidden" name="strg[]" value="'+ strategy +'" />';
   			html += '<input type="hidden" name="bdg[]" value="'+ budget +'" />';
   			html += '<input type="hidden" name="crd[]" value="'+ card_used_id +'" /></tr>';
	  		$('#tbl_options tbody').append(html);
	  		i++;
	  		$("#ad_name").prop('readonly', true);
	  		$("#client").prop("disabled", true);
	  		$("#platform").prop("disabled", true);

         $("#ad_type").val('').trigger('change.select2');
         $("#card_used").val('').trigger('change.select2');
	  		$("#from").val('');
   		$("#to").val('');
   		$("#strategy").val('');
   		$("#budget").val('');
	  	} else {
	  		alert('Please Fill All the required Fields.');
	  	}
	});

   });
</script>		 
@stop