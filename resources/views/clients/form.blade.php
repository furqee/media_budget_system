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
      {!! Form::open(array('url'=>'clients?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
               <fieldset>
                  <legend> Clients</legend>
                  {!! Form::hidden('id', $row['id']) !!}					
                  <div class="form-group  " >
                     <label for="Name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
                     <div class="col-md-6">
                        <input  type='text' name='name' id='name' value='{{ $row['name'] }}' 
                        class='form-control input-sm ' required="" /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Email" class=" control-label col-md-4 text-left"> Email </label>
                     <div class="col-md-6">
                        <input  type='email' name='email' id='email' value='{{ $row['email'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Address" class=" control-label col-md-4 text-left"> Address </label>
                     <div class="col-md-6">
                        <input  type='text' name='address' id='address' value='{{ $row['address'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Website" class=" control-label col-md-4 text-left"> Website </label>
                     <div class="col-md-6">
                        <input  type='text' name='website' id='website' value='{{ $row['website'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Fb Page Link" class=" control-label col-md-4 text-left"> Fb Page Link </label>
                     <div class="col-md-6">
                        <input  type='text' name='fb_page_link' id='fb_page_link' value='{{ $row['fb_page_link'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
                  <div class="form-group  " >
                     <label for="Insta Link" class=" control-label col-md-4 text-left"> Insta Link </label>
                     <div class="col-md-6">
                        <input  type='text' name='insta_link' id='insta_link' value='{{ $row['insta_link'] }}' 
                        class='form-control input-sm ' /> 
                     </div>
                     <div class="col-md-2">
                     </div>
                  </div>
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
   	
   	
   	 		 
   
   	$('.removeMultiFiles').on('click',function(){
   		var removeUrl = '{{ url("clients/removefiles?file=")}}'+$(this).attr('url');
   		$(this).parent().remove();
   		$.get(removeUrl,function(response){});
   		$(this).parent('div').empty();	
   		return false;
   	});		
   	
   });
</script>		 
@stop