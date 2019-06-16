
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Venders List </h5>
            </div>
            <div class="ibox-content">
                <a data-toggle="modal" class="btn btn-primary btn-lg pull-right mb-2" href="#modal-form">Add Vender</a>
                <br />
                <div class="table-responsive">
                    <div id="jqxgrid"></div>
                </div>

            </div>
        </div>
    </div>

</div>
<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Add Vender</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form role="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label> 
                                        <input type="text" placeholder="Enter First Name" class="form-control" id="fname" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label> 
                                        <input type="text" placeholder="Enter Last Name" class="form-control" id="lname" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label> 
                                        <input type="text" placeholder="Enter Phone" class="form-control" id="phone" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label> 
                                        <input type="text" placeholder="Enter Email" class="form-control" id="email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ID</label> 
                                <input type="text" placeholder="Enter ID" class="form-control" name="vender_identity" id="vender_identity">
                            </div>
                            <div class="form-group">
                                <label>Address</label> 
                                <input type="text" placeholder="Enter Address" class="form-control" name="address" id="address">
                            </div>
                            <div class="form-group">
                                <label>Status</label> 
                                <select class="form-control m-b" name="status" id="status" required="">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="button" onclick="return saveForm();">
                                    <strong>Save</strong>
                                </button>
                                <img id="loader" align="center" class="hide pull-right" src="<?php echo base_url() . LOADER; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="edit-modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Edit User</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="edit_error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form role="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label> 
                                        <input type="text" placeholder="Enter First Name" class="form-control" id="edit_fname" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label> 
                                        <input type="text" placeholder="Enter Last Name" class="form-control" id="edit_lname" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label> 
                                        <input type="text" placeholder="Enter Phone" class="form-control" id="edit_phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label> 
                                        <input type="text" placeholder="Enter Email" class="form-control" id="edit_email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>ID</label> 
                                <input type="text" placeholder="Enter ID" class="form-control" name="vender_identity" id="edit_vender_identity">
                            </div>
                            <div class="form-group">
                                <label>Address</label> 
                                <input type="text" placeholder="Enter Address" class="form-control" name="address" id="edit_address">
                            </div>
                            <div class="form-group">
                                <label>Status</label> 
                                <select class="form-control m-b" name="status" id="edit_status" required="">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" id="edit_vender_id" value="0">
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="button" onclick="updateForm();">
                                    <strong>Update</strong>
                                </button>
                                <img id="edit_loader" align="center" class="hide pull-right" src="<?php echo base_url() . LOADER; ?>">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete-modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Vender</h3>
                        <h4 class="m-t-none m-b">Are you sure you want to delete vender?</h4>
                        <form role="form">
                            <div class="pull-right">
                                <button class="btn btn-info m-t-n-xs" type="button" data-dismiss="modal">
                                    <strong>Cancel</strong>
                                </button>
                                <button class="btn btn-danger m-t-n-xs" type="button" onclick="deleteVender();">
                                    <strong>Delete</strong>
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="record_id" name="record_id" value="0">
<script type="text/javascript">

    var gridID = "jqxgrid"; //set the grid div
    var path = "<?php echo base_url(); ?>admin/vender/get_data"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'vender_id'},
                {name: 'vender_name'},
                {name: 'vender_email'},
                {name: 'vender_identity'},
                {name: 'vender_phone'},
                {name: 'vender_address'},
                {name: 'vender_status'},
                {name: 'actions'}
            ],
            sortcolumn: 'vender_id',
            sortdirection: 'asc',
            cache: false,
            url: path,
            filter: function () {
                $("#" + gridID).jqxGrid('updatebounddata', 'filter');
            },
            sort: function () {
                $("#" + gridID).jqxGrid('updatebounddata', 'sort');
            },
            root: 'Rows',
            beforeprocessing: function (data) {
                if (data != null) {
                    source.totalrecords = data[0].TotalRows;
                }
            }
        };
        var dataAdapter = new $.jqx.dataAdapter(source, {
            loadError: function (xhr, status, error) {
                alert(error);
            }
        });
        return dataAdapter;
    }

    $(document).ready(function () {
        //refresh grid after 5 minuts
        setInterval(function () {
            $("#" + gridID).jqxGrid({source: getAdapter()});
        }, 300000);
        $("#" + gridID).jqxGrid({
            width: '98%',
            autoheight: true,
            source: getAdapter(),
            theme: 'office',
            pageable: true,
            pagesize: 10,
            pagesizeoptions: ['10','20', '60', '90', '120'],
            sortable: true,
            altrows: true,
            enabletooltips: true,
            filterable: true,
            showfilterrow: true,
            virtualmode: true,
            enablehover: true,
            showstatusbar: false,
            rendergridrows: function (obj) {
                return obj.data;
            },
            columns: [
                {text: 'ID', datafield: 'vender_id', filtertype: 'textbox', filtercondition: 'contains', cellsalign: 'center', width: 60},
                {text: 'Vender Name', datafield: 'vender_name', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Vender ID', datafield: 'vender_identity', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Phone', datafield: 'vender_phone',  filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Email', datafield: 'vender_email', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Address', datafield: 'vender_address', filtertype: 'textbox', filtercondition: 'contains',width:'20%'},
                {text: 'Status', datafield: 'vender_status', filtertype: 'textbox', cellsalign: 'center',filtercondition: 'contains',width: 100},
                {text: 'Actions', datafield: 'actions', cellsalign: 'center',filterable:false,width: 100}
            ]
        });
    });

    function saveForm() {

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var vender_identity = $('#vender_identity').val();
        var address = $('#address').val();
        var status = $('#status').val();
        if (isRequired('fname', 'First name is required', true)) {
            return false;
        } else if (isRequired('lname', 'Last name is required', true)) {
            return false;
        } else if (isRequired('address', 'Address is required', true)) {
            return false;
        } else if (isRequired('vender_identity', 'ID is required', true)) {
            return false;
        }else {
            $("#loader").show();
            $.post("<?php echo base_url(); ?>admin/vender/save",
                    {
                        vender_first_name: fname,
                        vender_last_name: lname,
                        vender_email: email,
                        vender_phone: phone,
                        vender_identity: vender_identity,
                        vender_address: address,
                        vender_status: status
                    }
            )
                    .done(function (data) {
                        $("#error_msg").hide();
                        if (data == 'saved') {
                            successtoster('Vender Saved!','Vender saved successfully');
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
    
    function getRecord(id){
        $('#edit_vender_id').val(id);
        $.post("<?php echo base_url(); ?>admin/vender/getRecord",
                    {
                        id:id
                    }
            )
                    .done(function (data) {
                        if (data !='not_found') {
                            $('#edit_fname').val(data.vender_first_name);
                            $('#edit_lname').val(data.vender_last_name);
                            $('#edit_email').val(data.vender_email);
                            $('#edit_phone').val(data.vender_phone);
                            $('#edit_vender_identity').val(data.vender_identity);
                            $('#edit_address').val(data.vender_address);
                            $('#edit_status').val(data.vender_status);
                        } else {
                            errortoster('Error!','Data not found for this vender.');
                            $('#modal-form').modal('toggle');
                        }
                    });
    }
    /////////////////////////// Edit User ///////////////////////
    function updateForm() {
        var fname       = $('#edit_fname').val();
        var lname       = $('#edit_lname').val();
        var email       = $('#edit_email').val();
        var phone       = $('#edit_phone').val();
        var vender_identity      = $('#edit_vender_identity').val();
        var address     = $('#edit_address').val();
        var status      = $('#edit_status').val();
        var id          = $('#edit_vender_id').val();
        if (isRequired('edit_fname', 'First name is required', true)) {
            return false;
        } else if (isRequired('edit_lname', 'Last name is required', true)) {
            return false;
        } else if (isRequired('edit_address', 'Address is required', true)) {
            return false;
        } else if (isRequired('edit_vender_identity', 'ID is required', true)) {
            return false;
        }else {
           $("#edit_loader").show();
            $.post("<?php echo base_url(); ?>admin/vender/update",
                    {
                        id:id,
                        vender_first_name: fname,
                        vender_last_name: lname,
                        vender_email: email,
                        vender_phone: phone,
                        vender_identity: vender_identity,
                        vender_address: address,
                        vender_status: status
                    }
            )
                    .done(function (data) {
                        $("#edit_error_msg").hide();
                        if (data == 'saved') {
                            successtoster('User Updated!','User updated successfully');
                            $("#" + gridID).jqxGrid({source: getAdapter()});
                            $("#edit_loader").hide();
                            $('#edit-modal-form').modal('toggle');
                        } else {
                            $("#edit_error_msg span").text('Error Updating data try again later!');
                            $("#edit_loader").hide();
                            return false;
                        }
                    }); 
        }
           
    }
    function setId(id){
        $('#record_id').val(id);
    }
    
    function deleteVender(){
        var id       = $('#record_id').val();
            $(".loader").show();
            $.post("<?php echo base_url(); ?>admin/vender/delete",{id:id})
                    .done(function (data) {
                        if (data == 'deleted') {
                            errortoster('Vender Deleted!','Vender deleted successfully!');
                            $('#delete-modal-form').modal('toggle');
                               $("#" + gridID).jqxGrid({source: getAdapter()});
                        } else if(data == 'used'){
                            errortoster('Can`t Delete!','Vender in use!');
                            $('#delete-modal-form').modal('toggle');
                        } else {
                            errortoster('Error!','Error deleting vender!');
                            $('#delete-modal-form').modal('toggle');
                            return false;
                        }
                    });
    }
</script>