
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Customer Report </h5>
            </div>
            <div class="ibox-content">
                   <form method="post" name="advance" id="advance" enctype="multipart/form-data" action="<?php echo base_url();?>admin/customer/reportPDF">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Customers</label>
                            <div class="col-lg-9">
                                <select id="customer" value="" name="customer" class="form-control" required="">
                                    <option value="">Select Customer</option>
                                    <?php foreach($vendors as $v) { ?>
                                    <option value="<?php echo $v->customer_id; ?>"><?php echo $v->customer_first_name.' '.$v->customer_last_name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Plot No#</label>
                            <div class="col-lg-9">
                                <select id="plot_num" name="sale_id" class="form-control" required="">
                                    <option value="">Select Customer</option>
                                </select>
                            </div>
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
$("#customer").jqxDropDownList({filterable: true,height: '25px',width: '350px'});
$('#customer').on('change', function (event)
{     
    var args = event.args;
    if (args) {
    // index represents the item's index.                      
    var index = args.index;
    var item = args.item;
    // get item's label and value.
    var label = item.label;
    var value = item.value;
    var type = args.type; // keyboard, mouse or null depending on how the item was selected.
    $.post("<?php echo base_url(); ?>admin/customer/getPlots",{customer_id:value})
                    .done(function (data) {
                        if(data!='not_found'){
                            $('#plot_num').html(data);
                        }else{
                            $('#plot_num').html('<option value="">Plot not found</option>');
                             errortoster('Plot Not Found!','Plot not found for this customer!');
                        }
                    
                    });
} 
});
</script>