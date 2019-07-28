
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Vendors Report </h5>
            </div>
            <div class="ibox-content">
                   <form method="post" name="advance" id="advance" enctype="multipart/form-data" action="<?php echo base_url();?>admin/vender/reportPDF">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Vendor</label>
                            <div class="col-lg-9">
                                <select id="vender" value="" name="vendor" class="form-control" required="">
                                    <?php foreach($vendors as $v) { ?>
                                    <option value="<?php echo $v->vender_id; ?>"><?php echo $v->vender_first_name.' '.$v->vender_last_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Date From</label>
                            <div class="col-lg-8"><input type="date" name="from_date" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Date To</label>
                            <div class="col-lg-8"><input type="date" name="to_date" class="form-control"></div>
                        </div>
                    </div>
                 </div>
                
                <hr>
                <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">Print</button>
                </form>

            </div>
        </div>
    </div>

</div>
<script>

// Create a jqxDropDownList
$("#vender").jqxDropDownList({filterable: true,height: '30px'});

</script>