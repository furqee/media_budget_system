<div class="m-t" style="padding-top:25px;">	
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />       
    </div>
</div>
<div class="m-t">
	<div class="table-responsive" > 	

		<table class="table table-striped table-bordered" >
			<tbody>	
		
			
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Ad Name', (isset($fields['ad_name']['language'])? $fields['ad_name']['language'] : array())) }}</td>
						<td>{{ $row->ad_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Client', (isset($fields['client']['language'])? $fields['client']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->client,'client','1:tb_clients:id:name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Platform', (isset($fields['platform']['language'])? $fields['platform']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->platform,'platform','1:tb_platforms:id:platform') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Ad Type', (isset($fields['ad_type']['language'])? $fields['ad_type']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->ad_type,'ad_type','1:tb_ad_type:id:ad_type') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('From', (isset($fields['from']['language'])? $fields['from']['language'] : array())) }}</td>
						<td>{{ date('',strtotime($row->from)) }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('To', (isset($fields['to']['language'])? $fields['to']['language'] : array())) }}</td>
						<td>{{ date('',strtotime($row->to)) }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Strategy', (isset($fields['strategy']['language'])? $fields['strategy']['language'] : array())) }}</td>
						<td>{{ $row->strategy}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Budget', (isset($fields['budget']['language'])? $fields['budget']['language'] : array())) }}</td>
						<td>{{ $row->budget}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Budget Approved', (isset($fields['approved_budget']['language'])? $fields['approved_budget']['language'] : array())) }}</td>
						<td>{{ $row->approved_budget}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Utilized Budget', (isset($fields['utilized_budget']['language'])? $fields['utilized_budget']['language'] : array())) }}</td>
						<td>{{ $row->utilized_budget}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Utilized Budget Approved', (isset($fields['approved_utilized_budget']['language'])? $fields['approved_utilized_budget']['language'] : array())) }}</td>
						<td>{{ $row->approved_utilized_budget}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</td>
						<td>{{ $row->status}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Card Used', (isset($fields['card_used']['language'])? $fields['card_used']['language'] : array())) }}</td>
						<td>{{ $row->card_used}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Entry By', (isset($fields['entry_by']['language'])? $fields['entry_by']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->entry_by,'entry_by','1:tb_users:id:first_name|last_name') }} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	