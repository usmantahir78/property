
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Gulshan-E-Sultan </h1>
                <h3>Housing Scheme Phase iii </h3>
                <h3>Pakpatan road Arifwala </h3>
            </div>
            <div class="ibox-content">
                <form method="post" name="booking" enctype="multipart/form-data" action="<?php echo base_url();?>admin/booking/save" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Date</label>
                            <div class="col-lg-9"><input type="date" name="booking_date" placeholder="Date" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label">Token No#</label>
                            <div class="col-lg-7"><input type="text" placeholder="Token No" name="token_no" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-4 col-form-label">Plot No#</label>
                            <div class="col-lg-8"><input type="text" placeholder="Plot No" name="plot_no" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        
                        <div class="form-group row">
                            <div class="col-md-8" >
                                <div class="image-crop hide">
                                    <img src="img/p3.jpg">
                                </div>
                                <div class="img-preview img-preview-sm" style="margin-top: -130px;width: 153px;height: 143px;border: 1px solid #ccc;"></div>
                            
                                    <label title="Upload image file" for="inputImage" class="btn btn-primary mt-1 mb-0">
                                        <input type="file" accept="image/*" name="file" id="inputImage" style="display:none">
                                        Upload image
                                    </label>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Name</label>
                            <div class="col-lg-9"><input type="text" placeholder="Name" name="customer_first_name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Father Name</label>
                            <div class="col-lg-9"><input type="text" placeholder="Father Name" name="customer_last_name" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">I.D No#</label>
                            <div class="col-lg-9"><input type="text" placeholder="I.D No" name="customer_identity" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mobile No#</label>
                            <div class="col-lg-9"><input type="text" placeholder="Mobile No" name="customer_phone" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Address</label>
                            <div class="col-lg-9"><input type="text" placeholder="Address" name="customer_address" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-6 col-form-label">Plot Size</label>
                            <div class="col-lg-6"><input type="text" placeholder="Plot Size" name="property_size" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label">Per Marla</label>
                            <div class="col-lg-7"><input type="text" placeholder="Per Marla" name="property_per_marla" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">Total Payment</label>
                            <div class="col-lg-10"><input type="text" placeholder="Total Payment" name="property_total_price" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-6 col-form-label">Advance %</label>
                            <div class="col-lg-6"><input type="text" placeholder="Advance %" name="advance_percent" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label">Amount</label>
                            <div class="col-lg-7"><input type="text" placeholder="Amount" name="advance_amount" class="form-control"></div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Token</label>
                            <div class="col-lg-9"><input type="text" placeholder="Token" name="property_token" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label">Remaining Advance</label>
                            <div class="col-lg-7"><input type="text" placeholder="Token No" name="remaining_advance" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-lg-12"><input type="date" placeholder="Plot No" name="remaning_advance_payment_date" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Total Instalment</label>
                            <div class="col-lg-9"><input type="text" placeholder="Total Instalment" name="total_instalments" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group row">
                            <div class="col-lg-12"><input type="date" placeholder="Instalment Schedule" name="instalment_payment_date" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label">Instalment Amount</label>
                            <div class="col-lg-7"><input type="text" placeholder="Instalment Amount" name="instalment_amount" class="form-control"></div>
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
                            <div class="col-lg-10"><input type="text" placeholder="Name" name="nominee_first_name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Father Name</label>
                            <div class="col-lg-9"><input type="text" placeholder="Father Name" name="nominee_last_name" class="form-control"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">I.D No#</label>
                            <div class="col-lg-10"><input type="text" placeholder="I.D No"  name="nominee_identity" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label">Mobile Number</label>
                            <div class="col-lg-9"><input type="text" placeholder="Mobile Number" name="nominee_phone" class="form-control"></div>
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
                           <label title="Upload image file" for="inputImage" class="btn btn-primary mt-1 mb-0">
                                <input type="file" name="file2" id="inputImage2" style="display:none">
                                Upload file
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right">Create</button>
                </form>
               </div>  
            </div>
        </div>
    </div>

</div>
<!-- Image cropper -->
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

            var $image = $(".image-crop > img")
            var $cropped = $($image).cropper({
                aspectRatio: 1,
                preview: ".img-preview",
                done: function(data) {
                    // Output the result data for cropping image.
                }
            });
            var $inputImage = $("#inputImage");
            if (window.FileReader) {
                $inputImage.change(function() {
                    var fileReader = new FileReader(),
                            files = this.files,
                            file;

                    if (!files.length) {
                        return;
                    }

                    file = files[0];

                    if (/^image\/\w+$/.test(file.type)) {
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $inputImage.val("");
                            $image.cropper("reset", true).cropper("replace", this.result);
                        };
                    } else {
                        showMessage("Please choose an image file.");
                    }
                });
            } else {
                $inputImage.addClass("hide");
            }


            
  });
    function saveForm() {

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        var role = $('#role').val();
        var status = $('#status').val();

        if (password != cpassword) {
            $("#error_msg span").text('Confirm Password not matched');
            $("#error_msg").fadeIn(2000);
            return false;
        } else {
            $("#loader").show();
            $.post("<?php echo base_url(); ?>admin/user/save",
                    {
                        first_name: fname,
                        last_name: lname,
                        user_email: email,
                        password: password,
                        role_id: role,
                        status: status
                    }
            )
                    .done(function (data) {
                        $("#error_msg").hide();
                        if (data == 'saved') {
                            successtoster('User Saved!', 'User saved successfully');
                            $("#" + gridID).jqxGrid({source: getAdapter()});
                            $("#loader").hide();
                            $('#modal-form').modal('toggle');
                        } else {
                            $("#error_msg span").text('Error Saving data try again later!');
                            $("#loader").hide();
                            return false;
                        }
                    });

        }
    }

</script>