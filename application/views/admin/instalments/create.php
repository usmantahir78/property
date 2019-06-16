
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Recovery Receipt </h1>
            </div>
            <div class="ibox-content">
                <form method="post" name="booking" enctype="multipart/form-data" action="<?php echo base_url();?>admin/instalments/save" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Slip No</label>
                            <div class="col-lg-9">
                                <input type="text" placeholder="Slip Number" value="" name="slip_number" class="form-control" required>
                                <input type="hidden" name="sale_id" value="<?php echo $installment->sale_id; ?>">
                                <input type="hidden" name="instalment_id" value="<?php echo $installment->instalment_id; ?>">
                                <input type="hidden" name="customer_id" value="<?php echo $installment->customer_id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">R.V No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="R.V No" readonly value="<?php echo $settings->slip_prefix.'-'.$settings->slip_number; ?>" name="receiving_number" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Plot No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="Plot No" readonly value="<?php echo $installment->property_number; ?>" name="plot_no" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Plot Size</label>
                            <div class="col-lg-8"><input type="text" placeholder="Plot Size" readonly value="<?php echo $installment->property_in_marla.'/'.$installment->property_in_sarsahi; ?>" name="plot_size" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Name</label>
                            <div class="col-lg-10"><input type="text" name="customer_first_name" readonly value="<?php echo $installment->customer_first_name; ?>" placeholder="Name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Father Name</label>
                            <div class="col-lg-9"><input type="text" placeholder="Father Name" readonly value="<?php echo $installment->customer_last_name; ?>" name="customer_last_name" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Account</label>
                            <div class="col-lg-10">
                            <select class="form-control m-b" name="in_account_of" readonly id="in_account_of" required="">
                                <option value="installment">Installment</option>
                                <option value="advance">Advance</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Amount</label>
                            <div class="col-lg-9"><input type="text" placeholder="Amount" readonly value="<?php echo number_format($installment->instalment_amount,2); ?>" name="amount" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Total Payment</label>
                            <div class="col-lg-10"><input type="text" name="total_payment" readonly value="<?php echo number_format($installment->instalment_amount,2); ?>" placeholder="Total Payment" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">In Words</label>
                            <div class="col-lg-9"><input type="text" placeholder="In Words" name="in_words" class="form-control"></div>
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
