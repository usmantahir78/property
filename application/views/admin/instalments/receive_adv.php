
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Recovery Receipt </h1>
            </div>
            <div class="ibox-content">
                <form method="post" name="advance" id="advance" enctype="multipart/form-data" action="<?php echo base_url();?>admin/instalments/saveAdvance" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Date</label>
                            <div class="col-lg-9">
                                <input type="text" readonly value="<?php echo date('d-m-Y'); ?>" name="receive_date" placeholder="Date" class="form-control">
                                <input type="hidden" name="sale_id" value="<?php echo $advance->sale_id; ?>">
                                <input type="hidden" name="customer_id" value="<?php echo $advance->customer_id; ?>">
                                <input type="hidden" name="property_id" value="<?php echo $advance->property_id; ?>">
                                <input type="hidden" name="total_adv" id="total_adv" value="<?php echo $advance->adv_amount; ?>">
                                <input type="hidden" name="adv_id" id="adv_id" value="<?php echo $advance->adv_id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">R.V No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="R.V No" readonly value="<?php echo date('YmdHis'); ?>" name="revcieving_number" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Plot No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="Plot No" readonly value="<?php echo $advance->property_number; ?>" name="plot_no" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Plot Size</label>
                            <div class="col-lg-8"><input type="text" placeholder="Plot Size" readonly value="<?php echo $advance->property_in_marla.'/'.$advance->property_in_sarsahi; ?>" name="plot_size" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Name</label>
                            <div class="col-lg-10"><input type="text" name="customer_first_name" readonly value="<?php echo $advance->customer_first_name; ?>" placeholder="Name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Father Name</label>
                            <div class="col-lg-9"><input type="text" placeholder="Father Name" readonly value="<?php echo $advance->customer_last_name; ?>" name="customer_last_name" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Account</label>
                            <div class="col-lg-10">
                            <select class="form-control m-b" name="in_account_of" readonly id="in_account_of" required="">
                                <option value="advance">Advance</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Amount</label>
                            <div class="col-lg-9"><input type="text" placeholder="Amount" value="<?php echo number_format($advance->adv_amount,2); ?>" name="amount" id="amount" class="form-control" onkeypress="return onlyNumber(event);" onkeyup="return remainingAdv();"></div>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Remaining</label>
                            <div class="col-lg-10"><input type="text" placeholder="Remaining" value="0" name="remaining" id="remaining_advance" class="form-control" onkeypress="return onlyNumber(event);"></div>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Due Date</label>
                            <div class="col-lg-9">
                                <input type="date" name="remaining_date" placeholder="Due Date" class="form-control" >
                            </div>
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
                
                <hr>
                <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">Receive</button>
                </form>
               </div>  
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

function onlyNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function remainingAdv() {
    var total_adv = $('#total_adv').val();
    var amount = $('#amount').val();
    var remaining_advance = total_adv - amount;
    $('#remaining_advance').val(parseFloat(remaining_advance.toFixed(2)));
}

$( "#advance" ).submit(function(e){
    var amount             = $('#amount').val();
    
    if(isRequired('amount','Advanace amount is required',true)){
        e.preventDefault(e);
        return false;
    }else{
        $( "#advance" ).submit();
        
    }
});

</script>