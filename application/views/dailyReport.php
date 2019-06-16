<style>
	table {
		border-collapse: collapse;
		width: 100%;
		font-size: 11px;
	}

	th, td {
		text-align: left;
		padding: 8px;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
		/*background-color: #1cc09f;*/
		color: black;
	}
</style>
<title>Daily Transaction Report</title>
<h3 align="center">Daily Transactions </h3>
<hr>
<h5>Day Details</h5>
<table>
	<thead>
	<tr>
		<th>Cashier Name</th>
		<th>Date</th>
		<th>Day Open Cash</th>
		<th>Day Close Cash</th>
		<th>Status</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo $day->first_name.' '.$day->last_name; ?></td>
		<td><?php echo date('d-m-Y',strtotime($day->day_opendate)); ?></td>
		<td><?php echo number_format($day->day_open_amount,2); ?></td>
		<td><?php echo number_format($day->day_close_amount,2); ?></td>
		<td><?php echo $day->day_status; ?></td>
	</tr>
	</tbody>
</table>
<h5>Transactions</h5>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Sr#</th>
		<th>Slip Number</th>
		<th>Name</th>
		<th>Date</th>
		<th>Description</th>
		<th>Debit</th>
		<th>Credit</th>
	</tr>
	</thead>
	<tbody>
		<?php
		$total_debit = $this->day_model->getDayAmount($day_id,'debit')->total_amount;
		$total_credit = $this->day_model->getDayAmount($day_id,'credit')->total_amount;
		foreach($daydetails as $d) {
			$inst_details = $this->day_model->getInstalmentDetails($d->vocher_type,$d->vocher_number);
			?>
			<tr>
				<td ><?php echo $d->vocher_number; ?></td>
				<td ><?php echo $inst_details->slip_number; ?></td>
				<td ><?php echo $inst_details->fname.' '.$inst_details->lname; ?></td>
				<td ><?php echo date('d-m-Y',strtotime($d->date_created)); ?></td>
				<td><?php echo $inst_details->des; ?></td>
				<td ><?php if($d->type=="debit"){ echo number_format($d->amount,2);} else{ echo "-";} ?></td>
				<td ><?php if($d->type=="credit"){ echo number_format($d->amount,2);} else{ echo "-";} ?></td>

			</tr>
		<?php } ?>
		<tr>
			<td colspan="5"></td>
			<td><b><?php echo number_format($total_debit,2); ?></b></td>
			<td><b><?php echo number_format($total_credit,2); ?></b></td>
		</tr>
	</tbody>
</table>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Total Sale</th>
		<th>Total Expense</th>
		<th>Day Open Cash</th>
		<th>Day Close Cash</th>
	</tr>
	</thead>
	<tbody>
	<tr>

		<td><?php echo number_format($total_debit,2); ?></td>
		<td><?php echo number_format($total_credit,2); ?></td>
		<td><?php echo number_format($day->day_open_amount,2); ?></td>
		<td><?php $dayclose = ($total_debit+$day->day_open_amount)-$total_credit;
			echo number_format($dayclose,2);?></td>
	</tr>
	</tbody>

</table>
