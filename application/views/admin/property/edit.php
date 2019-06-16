<form method="post" name="booking" id="booking" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/property/update" >
	<div class="row  border-bottom white-bg ">
		<div class="col-lg-12">
			<div class="ibox ">
				<div class="ibox-title">
					<h1>Edit Property </h1>
				</div>
				<div class="ibox-content">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Date</label>
								<input type="hidden" name="id" value="<?= $property->property_id ?>">
								<div class="col-lg-9"><input type="text" name="booking_date" readonly value="<?php echo date('d-m-Y'); ?>" placeholder="Date" class="form-control"></div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group row">
								<label class="col-lg-5 col-form-label">Token No#</label>
								<div class="col-lg-7">
									<input type="text" placeholder="Token No" readonly value="<?php echo date('YmdHis'); ?>" name="token_no" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group row" id="plot_no_div">
								<label class="col-lg-4 col-form-label">Plot No#</label>
								<div class="col-lg-8">
									<input type="text" placeholder="Plot No" name="plot_no" id="plot_no" onkeyup="return checkPlotNo();" value="<?= $property->property_number ?>" class="form-control">
									<input type="hidden" id="plot_availability" value="0">
									<span id="plot_span"></span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Status</label>
								<div class="col-lg-9">
									<select name="property_status" id="property_status" class="form-control">
										<option value="Available" <?= ($property->property_status == 'Available') ? 'selected' : '' ?>>Available</option>
										<option value="Sold" <?= ($property->property_status == 'Sold') ? 'selected' : '' ?>>Sold</option>
										<option value="Hold" <?= ($property->property_status == 'Hold') ? 'selected' : '' ?>>Hold</option>
										<option value="Instalment" <?= ($property->property_status == 'Instalment') ? 'selected' : '' ?>>Instalment</option>
										<option value="Transfered" <?= ($property->property_status == 'Transfered') ? 'selected' : '' ?>>Transfered</option>
										<option value="Booked" <?= ($property->property_status == 'Booked') ? 'selected' : '' ?>>Booked</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group row">
								<label class="col-lg-6 col-form-label">Plot Size</label>
								<div class="col-lg-3 pr-0">
									<input type="text" placeholder="M" value="<?= $property->property_in_marla ?>" name="property_in_marla" onkeyup="return makePlotPayment();" onkeypress="return onlyNumber(event);" id="property_in_marla" class="form-control">
								</div>
								<div class="col-lg-3 pl-0">
									<input type="text" placeholder="S" value="<?= $property->property_in_sarsahi ?>" name="property_in_sarsahi" onkeyup="return makePlotPayment();" onkeypress="return onlyNumber(event);" id="property_in_sarsahi" class="form-control">
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group row">
								<label class="col-lg-5 col-form-label">Per Marla</label>
								<div class="col-lg-7"><input type="text" value="<?= $property->property_per_marla ?>" placeholder="Per Marla" name="property_per_marla" id="property_per_marla" class="form-control" onkeyup="return makePlotPayment();"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<label class="col-lg-3 col-form-label">Total Payment</label>
								<div class="col-lg-9"><input type="text" value="<?= $property->property_total_price ?>" placeholder="Total Payment" name="property_total_price" id="property_total_price" class="form-control"></div>
							</div>
						</div>
					</div>
					<button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary pull-right">Save</button>

				</div>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">
	function makePlotPayment() {
		var property_per_marla = $('#property_per_marla').val();
		var marla = $('#property_in_marla').val();
		var sarsahi = $('#property_in_sarsahi').val();
		var marla_total = marla * property_per_marla;
		var sarsahi_price = property_per_marla / 9;
		var sarsahi_total = sarsahi_price * sarsahi;

		var property_total = marla_total + sarsahi_total;
		var total_price = parseFloat(property_total.toFixed(2));
		console.log(total_price);
		$('#property_total_price').val(total_price);
		getAdvanceTotal();


	}
	function getAdvanceTotal() {
		var advance_percent = $('#advance_percent').val();
		var total_price = $('#property_total_price').val();
		var total_advance = (total_price * advance_percent) / 100;
		$('#advance_amount').val(parseFloat(total_advance.toFixed(2)));
	}
	function onlyNumber(evt){
		evt = (evt) ? evt : window.event;
		var charCode = (evt.which) ? evt.which : evt.keyCode;
		if (charCode === 46) {
			return true;
		}
		else if (charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}
		return true;
	}
	function getTokenTotal() {
		var property_token = $('#property_token').val();
		var advance_amount = $('#advance_amount').val();
		var remaining_advance = advance_amount - property_token;
		$('#remaining_advance').val(parseFloat(remaining_advance.toFixed(2)));
	}
	function getInstallmentAmount() {
		var total_price = $('#property_total_price').val();
		var advance_amount = $('#advance_amount').val();
		var total_instalments = $('#total_instalments').val();
		var instalment_amount = (total_price - advance_amount) / total_instalments
		instalment_amount = parseFloat(instalment_amount.toFixed(2));
		$('#instalment_amount').val(instalment_amount);
	}
	function checkPlotNo() {
		var plot_no       = $('#plot_no').val();
		$.post("<?php echo base_url(); ?>admin/booking/checkPlotAvailabilty",{plot_no:plot_no})
			.done(function (data) {
				if (data == 'not_found') {
					$('#submit').attr('disabled',false);
					$('#plot_no_div').removeClass('has-error');
					$('#plot_span').remove();
					$('#plot_no').after("<span class='text-success' id='plot_span' >Plot is available!</span>");
					$('#plot_availability').val(1);
					return true;
				} else {
					$('#submit').attr('disabled',true);
					$('#plot_no_div').addClass('has-error');
					$('#plot_span').remove();
					$('#plot_no').after("<span class='text-danger' id='plot_span' >Plot is not available!</span>");
					$('#plot_availability').val(0);
					return false;
				}
			});

	}

	function getCustomerDetails(){
		var id = $('#customer_identity').val();
		if(id.length>12){
			$.post("<?php echo base_url(); ?>admin/booking/getCustomer",{id:id})
				.done(function (data) {
					if (data == 'not_found') {
						$('#customer_id').val(0);
						return true;
					} else {
						$('#customer_id').val(data.customer_id);
						$('#customer_phone').val(data.customer_phone);
						$('#customer_first_name').val(data.customer_first_name);
						$('#customer_last_name').val(data.customer_last_name);
						$('#customer_address').val(data.customer_address);
					}
				});
		}
	}
	$( "#booking" ).submit(function(e){
		var plot_availability   = $('#plot_availability').val();
		var plot_no             = $('#plot_no').val();
		if(isRequired('plot_no','Plot number is required',true)){
			e.preventDefault(e);
			return false;
		}else if(isRequired('property_in_marla','Property size is required',false)){
			return false;
		}else if(isRequired('property_in_sarsahi','Property size is required',false)){
			return false;
		}else if(isRequired('property_per_marla','Rate per marla is required',true)){
			return false;
		}else{
			$( "#booking" ).submit();
		}
	});

	function cloneAdvance(){

		$( "#advance_1" ).clone().appendTo( ".advance_installment" );
		var total = $( ".row .advance" ).length;
		$( ".row .advance" ).last().attr("id",'advance_'+total);
		$( "#advance_"+total+" .btn-danger" ).attr("rel",'advance_'+total)

	}
	function deleteAdvance(test){
		var listItemId = $(test).attr('rel');
		$('#'+listItemId).remove();

	}

</script>
