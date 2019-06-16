
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Payment Receipt </h1>
            </div>
            <div class="ibox-content">
                <form method="post" name="advance" id="advance" enctype="multipart/form-data" action="<?php echo base_url();?>admin/instalments/savePayments" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Date</label>
                            <div class="col-lg-9">
                                <input type="text" readonly value="<?php echo date('d-m-Y'); ?>" name="payment_date" placeholder="Date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">R.V No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="R.V No" readonly value="<?php echo $settings->vocher_prefix.'-'.$settings->vocher_number; ?>" name="vocher_number" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">R.P No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="R.P No" value="" name="r_p_number" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Slip No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="Slip No" value="" name="slip_number" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Vender</label>
                            <div class="col-lg-10">
                                <select name="vender_id" class="form-control">
                                    <?php foreach($venders as $vender) { ?>
                                    <option value="<?php echo $vender->vender_id; ?>">(<?php echo $vender->vender_id; ?>) <?php echo $vender->vender_first_name.''.$vender->vender_last_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Amount</label>
                            <div class="col-lg-9"><input type="text" placeholder="Amount" value="" name="amount" class="form-control"></div>
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