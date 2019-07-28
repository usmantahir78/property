<form method="post" name="dayopen" id="booking" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/day/openday" >
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Open Day </h1>
            </div>
            <div class="ibox-content">
                
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Amount</label>
                                <div class="col-lg-10"><input type="text" <?php if($close_cash!=0.00) { ?>readonly<?php } ?> placeholder="0.00" value="<?php echo number_format($close_cash,2); ?>" name="day_open_amount" id="day_open_amount" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary pull-right">Create</button>
                
            </div>  
        </div>
    </div>
</div>

</form>