<form method="post" name="booking" id="booking" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/booking/save" >
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>New Booking </h1>
            </div>
            <div class="ibox-content">
                
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Date</label>
                                <div class="col-lg-9"><input type="text" name="booking_date" readonly value="<?php echo date('d-m-Y'); ?>" placeholder="Date" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label class="col-lg-5 col-form-label">Token No#</label>
                                <div class="col-lg-7">
                                    <input type="text" placeholder="Token No" readonly value="<?php echo $settings->booking_number; ?>" name="token_no" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row" id="plot_no_div">
                                <label class="col-lg-4 col-form-label">Plot No#</label>
                                <div class="col-lg-8">
                                    <input type="text" placeholder="Plot No" name="plot_no" id="plot_no" onkeyup="return checkPlotNo();" class="form-control">
                                    <input type="hidden" id="plot_availability" value="0">
                                    <span id="plot_span"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">

                            <div class="form-group row">
                                <div class="col-md-8" >
                                        <input type="file" accept="image/*" name="file" id="inputImage">
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">I.D No#</label>
                                <div class="col-lg-9">
                                    <input type="text" placeholder="I.D No" name="customer_identity" id="customer_identity" class="form-control" onkeypress="return onlyNumber(event);" onkeyup="return getCustomerDetails();">
                                    <input type="hidden" id="customer_id" name="customer_id" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Mobile No#</label>
                                <div class="col-lg-9"><input type="text" placeholder="Mobile No" name="customer_phone" id="customer_phone" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Name</label>
                                <div class="col-lg-9"><input type="text" placeholder="Name" name="customer_first_name" id="customer_first_name" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Father Name</label>
                                <div class="col-lg-9"><input type="text" placeholder="Father Name" name="customer_last_name" id="customer_last_name" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Address</label>
                                <div class="col-lg-10"><input type="text" placeholder="Address" name="customer_address" id="customer_address" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">Plot Size</label>
                                <div class="col-lg-3 pr-0">
                                    <input type="text" placeholder="M" name="property_in_marla" onkeyup="return makePlotPayment();" onkeypress="return onlyNumber(event);" id="property_in_marla" class="form-control">
                                </div>
                                <div class="col-lg-3 pl-0">
                                    <input type="text" placeholder="S" name="property_in_sarsahi" onkeyup="return makePlotPayment();" onkeypress="return onlyNumber(event);" id="property_in_sarsahi" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-5 col-form-label">Per Marla</label>
                                <div class="col-lg-7"><input type="text" placeholder="Per Marla" name="property_per_marla" id="property_per_marla" class="form-control" onkeyup="return makePlotPayment();"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Total Payment</label>
                                <div class="col-lg-10"><input type="text" placeholder="Total Payment" name="property_total_price" id="property_total_price" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-6 col-form-label">Advance %</label>
                                <div class="col-lg-6"><input type="text" placeholder="Advance %" name="advance_percent" id="advance_percent" class="form-control" onkeypress="return onlyNumber(event);" onkeyup="return getAdvanceTotal(event);"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group row">
                                <label class="col-lg-5 col-form-label">Amount</label>
                                <div class="col-lg-7"><input type="text" placeholder="Amount" name="advance_amount" id="advance_amount" class="form-control"></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Token Amount</label>
                                <input type="text" placeholder="Token" name="property_token" id="property_token" class="form-control" onkeyup="return getTokenTotal();">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Remaining Advance</label>
                                <input type="text" placeholder="Remaining Advance" name="remaining_advance" id="remaining_advance" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <input type="date" placeholder="Plot No" name="remaning_advance_payment_date" id="remaning_advance_payment_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label><br/>
                                <a data-toggle="modal" class="btn btn-primary btn-lg pull-right mb-2" href="#modal-form"><i class="fa fa-plus"></i> Create Advance Installments</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Instalment Type</label>
                                <select name="instalment_type" id="instalment_type" class="form-control">
                                    <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="biyearly">Biyearly</option>
                                    <option value="yearly">Yearly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Instalment</label>
                                <input type="text" placeholder="Instalments" name="total_instalments" id="total_instalments" class="form-control" onkeypress="return onlyNumber(event);" onkeyup="return getInstallmentAmount(event);">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Instalment Date</label>
                                <input type="date" placeholder="Instalment Schedule" name="instalment_payment_date" id="instalment_payment_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Instalment Amount</label>
                                <input type="text" placeholder="Amount" name="instalment_amount" id="instalment_amount" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label">Description</label>
                                <div class="col-lg-11"><input type="text" placeholder="Description" name="description" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <h1>Nominate</h1>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Name</label>
                                <div class="col-lg-10"><input type="text" placeholder="Name" name="nominee_first_name" id="nominee_first_name" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Father Name</label>
                                <div class="col-lg-9"><input type="text" placeholder="Father Name" name="nominee_last_name" id="nominee_last_name" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">I.D No#</label>
                                <div class="col-lg-10"><input type="text" placeholder="I.D No"  name="nominee_identity" id="nominee_identity" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Mobile Number</label>
                                <div class="col-lg-9"><input type="text" placeholder="Mobile Number" name="nominee_phone" id="nominee_phone" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Cast</label>
                                <div class="col-lg-10"><input type="text" placeholder="Cast" name="nominee_cast" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Relation</label>
                                <div class="col-lg-9"><input type="text" placeholder="Relation" name="nominee_relation" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label">Address</label>
                                <div class="col-lg-11"><input type="text" placeholder="Address" name="nominee_address" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label">&nbsp;</label>
                                    <input type="file" accept="image/*" name="file2">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary pull-right" onclick="return validateForm();">Create</button>
                
            </div>  
        </div>
    </div>
</div>
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Create Installments</h3>
                            <div class="row advance" id="advance_1">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Amount</label> 
                                        <input type="text" placeholder="Enter Amount" class="form-control" name="adv_amount[]">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Date</label> 
                                        <input type="date" placeholder="Enter Date" class="form-control" name="adv_date[]">
                                    </div>
                                </div>
                                <div class="col-md-2 p-0 m-0">
                                    <div class="form-group">
                                        <label>&nbsp;</label> <br />
                                        <button class="btn btn-primary btn-xs mb-2" type="button" onclick="return cloneAdvance();"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-danger btn-xs mb-2 mr-1" rel="advance_1" type="button" onclick="return deleteAdvance(this);"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <span class="advance_installment">
                                
                            </span>
                    </div>
                </div>
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
    var customer_identity   = $('#customer_identity').val();
    var plot_availability   = $('#plot_availability').val();
    var plot_no             = $('#plot_no').val();
    
    if(isRequired('plot_no','Plot number is required',true)){
        e.preventDefault(e);
        return false;
    }else if(plot_availability==0){
        e.preventDefault(e);
        $('#plot_span').remove();
        rrorSpan('plot_no','Plot is not available!');
        return false;
    }else if(isRequired('customer_identity','ID number is required',true)){
        return false;
    }else if(customer_identity.length<13){
        errorSpan('customer_identity','ID number should be greater then 12 digit');
        return false;
    }else if(isRequired('customer_first_name','Customer name is required',true)){
        return false;
    }else if(isRequired('property_in_marla','Property size is required',false)){
        return false;
    }else if(isRequired('property_in_sarsahi','Property size is required',false)){
        return false;
    }else if(isRequired('property_per_marla','Rate per marla is required',true)){
        return false;
    }else if(isRequired('advance_percent','Advance percentage is required',true)){
        return false;
    }else if(isRequired('property_token','Property token is required',true)){
        return false;
    }else if(isRequired('remaning_advance_payment_date','Remaining advance date is required',true)){
        return false;
    }else if(isRequired('total_instalments','Total instalments is required',true)){
        return false;
    }else if(isRequired('instalment_payment_date','Instalments date is required',true)){
        return false;
    }else if(isRequired('instalment_amount','Instalment amout is required',true)){
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
