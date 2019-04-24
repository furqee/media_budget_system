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

		{!! Form::open(array('url'=>'services?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
					<fieldset><legend> Services</legend>
						{!! Form::hidden('id', $row['id']) !!}					
						<div class="form-group  " >
							<label for="Service" class=" control-label col-md-4 text-left"> Service <span class="asterix"> * </span></label>
							<div class="col-md-6">
								<input  type='text' name='service' id='service' value='{{ $row['service'] }}' 
								class='form-control input-sm ' required /> 
							</div> 
							<div class="col-md-2">
								
							</div>
						</div> {!! Form::hidden('created_at', $row['created_at']) !!}</fieldset>
					</div>
					
					

				</div>
			</div>
			<input type="hidden" name="action_task" value="save" />
			{!! Form::close() !!}
		</div>
	</div>		
	
	
	<script type="text/javascript">
		$(document).ready(function() { 
			
			$('.removeMultiFiles').on('click',function(){
				var removeUrl = '{{ url("services/removefiles?file=")}}'+$(this).attr('url');
				$(this).parent().remove();
				$.get(removeUrl,function(response){});
				$(this).parent('div').empty();	
				return false;
			});		
			
		});
	</script>		 
	@stop