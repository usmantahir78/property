<style>
	table {
		border-collapse: collapse;
		width: 100%;
		font-size: 11px;
	}

	th, td {
		text-align: left;
		padding: 8px;
                border-bottom: solid 1px black;
	}

	tr:nth-child(even){background-color: #f2f2f2}

	th {
		/*background-color: #1cc09f;*/
		color: black;
	}
        title{
            text-align: left;
        }
</style>
<title style="text-align: left;">Transaction Report</title>
<h3><div style="text-align: left;">Vender Transactions </div></h3>
<hr>
<h5>Details</h5>
<table style="border: solid 1px black;">
	<tbody>
            <tr>
                <td ><?php echo $report[0]->vender_first_name.' '.$report[0]->vender_last_name; ?></td>
                <td><?php  if($from_date=="") { echo '01-06-'.date('Y'); } else { echo  date('d-m-Y',strtotime($from_date)); } ?></td>
                <td><?php  if($to_date=="") { echo date('d-m-Y'); } else { echo  date('d-m-Y',strtotime($to_date)); } ?></td>
            </tr>

	</tbody>
</table>
<h5>Transactions</h5>
<table>
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
                $total = 0;
		foreach($report as $v) {?>
			<tr>
				<td ><?php echo $v->vocher_number; ?></td>
                                <td ><?php echo $v->slip_number; ?></td>
				<td ><?php echo$v->vender_first_name.' '.$v->vender_last_name; ?></td>
				
				<td ><?php echo date('d-m-Y',strtotime($v->date_created)); ?></td>
				<td><?php echo $v->description; ?></td>
                                <td >-</td>
				<td ><?php echo number_format($v->amount,2); ?></td>

			</tr>
		<?php $total +=$v->amount;} ?>
		<tr>
			<td colspan="6"></td>
			<td><b><?php echo number_format($total,2); ?></b></td>
		</tr>
	</tbody>
</table>
