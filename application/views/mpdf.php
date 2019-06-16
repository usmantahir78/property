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
<h3 align="center">Customer Booking Details</h3>
<hr>
<h5>Personal Details</h5>
<table>
	<thead>
	<tr>
		<th>Name</th>
		<th>Customer ID</th>
		<th>Phone</th>
		<th>Address</th>
	</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $sale->customer_first_name . ' ' . $sale->customer_last_name; ?></td>
			<td><?php echo $sale->customer_identity; ?></td>
			<td><?php echo $sale->customer_phone; ?></td>
			<td><?php echo $sale->customer_address; ?></td>
		</tr>
	</tbody>
</table>
<h5>Property Details</h5>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Area</th>
		<th>Rate/Marla</th>
		<th>Date Sold</th>
		<th>Advance</th>
		<th>Total Price</th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><b><?php echo $sale->property_in_marla; ?> Marla - <?php echo $sale->property_in_sarsahi; ?> Sarsahi</b></td>
		<td><b><?php echo $sale->property_per_marla; ?></b></td>
		<td><?php echo date('d-m-Y', strtotime($sale->sale_date_created)); ?></td>
		<td><b><?php echo $sale->advance_percent; ?>%</b></td>
		<td><b><?php echo $sale->property_total_price; ?></b></td>
	</tr>
	</tbody>
</table>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Advance Total</th>
		<th>Advance Remaining</th>
		<th>Amount Total</th>
		<th>Amount Remaining</th>
	</tr>
	</thead>
	<tbody>
	<tr>

		<td><?php echo number_format($sale->advance_amount,2); ?></td>
		<td><?php echo number_format($sale->advance_amount-$total_adv_paid->total_adv_paid,2); ?></td>
		<td><?php echo number_format($sale->total_price-$sale->advance_amount,2); ?></td>
		<td><?php echo number_format($sale->total_price-$sale->advance_amount-$total_paid->total_paid,2); ?></td>
	</tr>
	</tbody>

</table>
<h5>Advance</h5>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Date</th>
		<th>Customer Name </th>
		<th>Property Number </th>
		<th>Amount Type</th>
		<th>Amount</th>
		<th>Status</th>
		<th>Receive Date</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($adv_installments as $adv) { ?>
		<tr>

			<td><?php echo date('d-m-Y',strtotime($adv->adv_date)); ?></td>
			<td><?php echo $sale->customer_first_name . ' ' . $sale->customer_last_name; ?></td>
			<td><?php echo $sale->property_number; ?></td>
			<td>Advance</td>
			<td><?php echo $adv->adv_amount; ?></td>
			<td><?php echo $adv->adv_status; ?></td>
			<td><?php if($adv->adv_receive_date){ echo date('d-m-Y',strtotime($adv->adv_receive_date)); } ?></td>
			<td><?php if($adv->adv_status=='Paid') { ?><span>Received</span><?php } else { ?><span>Not Received</span><?php } ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<h5>Installments</h5>
<table style="border:1px solid black ">
	<thead>
	<tr>
		<th>Date</th>
		<th>Customer Name </th>
		<th>Property Number </th>
		<th>Amount Type</th>
		<th>Total Amount</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($installmentsData as $adv) { ?>
		<tr>

			<td><?php echo date('d-m-Y',strtotime($adv->instalment_date)); ?></td>
			<td><?php echo $sale->customer_first_name . ' ' . $sale->customer_last_name; ?></td>
			<td><?php echo $sale->property_number; ?></td>
			<td>Installment</td>
			<td><?php echo $adv->total_amount; ?></td>
			<td><?php echo $adv->installment_status; ?></td>
			<td><?php if($adv->installment_status=='Paid') { ?><span>Received</span><?php } else { ?><span>Not Reveived</span><?php } ?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

