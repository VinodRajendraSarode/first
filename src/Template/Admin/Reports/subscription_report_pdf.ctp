<?php 


  
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A5-L', 'margin_top'=> 10, 'margin_bottom'=> 10]);
	$html = '
	<div style="border:1px solid;">
		<table width="100%">
			<tr>
				<td width="50%" valign="top" class="head" align="center">
					Subscription Report
				</td>
			</tr>					
		</table>
	</div>
	'; if(!empty($fDate) && !empty($tDate)){  $html.='
		<div>
			<table width="100%">
				<tr>
					<td width="50%" valign="top" class="head" align="left">
						From: '.$fDate.'
					</td>
				</tr>					
				<tr>
					<td width="50%" valign="top" class="head" align="left">
						To: '. $tDate  .'
					</td>
				</tr>					
			</table>
		</div>
	'; } $html.='
	<style>
	<style>
			body {
				font-family: sans-serif;
			}
			td 	{ 
				vertical-align: top; 
			}
			.head {
				font-weight:bold;
				font-size: 12px;
			}

			.type {
				font-weight:bold;
				font-style: italic;
				font-size: 10px;
			}

			.totals {
				font-weight:bold;
			}
			.items td {
				border: 0.1mm solid #000000;
			}
			table thead td {
				background-color: #EEEEEE;
				text-align: center;
				font-weight:bold;
			}
			.items td.blanktotal {
				background-color: #FFFFFF;
				border: 0mm none #000000;
				border-top: 0.1mm solid #000000;
				border-right: 0.1mm solid #000000;
			}
			.items td.totals {
				text-align: right;
				border: 0.1mm solid #000000;
			}

			tr.cancelled td {
				text-decoration: line-through;
				font-weight: bold;
				font-style: italic;
			}
		</style><br/>
		<table class="items" width="100%" style="font-size: 9pt;" cellpadding="5">
			<thead>
				<tr>
					<td>Vendor Name</td>
					<td>Email</td>
					<td>Mobile</td>
					<td>Package</td>
					<td>Registration Date</td>
					<td>Expiry Date</td>
					<td>No of Listings</td>
					<td>Status</td>
				</tr>
			</thead>
			<tbody>
			';
		
			foreach($subscriptions as $subscription) {  //debug($subscription);exit;
			$html.='
				<tr>
					<td align="left">'. $subscription['user']['name'].'</td>
					<td align="left">'. $subscription['user']['email'].'</td>
					<td align="left">'. $subscription['user']['mobile'].'</td>
					<td align="left">'. $subscription['package']['package'].'</td>
					<td align="left">'. $subscription['registration_date'].'</td>
					<td align="left">'. $subscription['expiry_date'].'</td>
					<td align="left">'. $subscription['no_of_listings'].'</td>
					'; if($subscription->active == '1'){ $html.='
						<td align="left"><span class="text-success">Active</span></td>
					'; }else{ $html.='
						<td align="left"><span class="text-danger">InActive</span></td>
					'; } $html.='
				</tr>';
				if(!empty($subscription['user']['listings'])){ 
					foreach($subscription['user']['listings'] as $listing) {
				$html.='
				<tr>
					<td align="left"> </td>					
					<td align="center" colspan="8">'. $listing['listing_title'].'</td>			
				</tr>
			'; } } } $html.='
			</tbody>
		</table>
	';
	$mpdf->WriteHTML($html);
	$mpdf->Output();
exit;

