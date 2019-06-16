
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>System Users </h5>
            </div>
            <div class="ibox-content">
                <a data-toggle="modal" class="btn btn-primary btn-lg pull-right mb-2" href="#modal-form">Add User</a>
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
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Add User</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
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

                            <div class="form-group">
                                <label>Email</label> 
                                <input type="email" placeholder="Enter Email" class="form-control" name="email" id="email" required="">
                            </div>
                            <div class="form-group">
                                <label>Password</label> 
                                <input type="password" placeholder="Enter Password" class="form-control" name="password" id="password" required="">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label> 
                                <input type="password" placeholder="Enter Confirm Password" class="form-control" name="cpassword" id="cpassword" required="">
                            </div>
                            <div class="form-group">
                                <label>Role</label> 
                                <select class="form-control m-b" name="role" id="role" required="">
                                    <?php
                                    if ($roles) {
                                        foreach ($roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
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
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
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

                            <div class="form-group">
                                <label>Email</label> 
                                <input type="email" placeholder="Enter Email" class="form-control" name="email" id="edit_email" required="">
                            </div>
                            <div class="form-group">
                                <label>Role</label> 
                                <select class="form-control m-b" name="role" id="edit_role" required="">
                                    <?php
                                    if ($roles) {
                                        foreach ($roles as $role) {
                                            ?>
                                            <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
    <?php
    }
}
?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Status</label> 
                                <select class="form-control m-b" name="status" id="edit_status" required="">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" id="edit_user_id" value="0">
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
<div id="password-modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Update Password</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="p_error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form role="form">
                            <div class="form-group">
                                <label>Password</label> 
                                <input type="password" placeholder="Enter Password" class="form-control" name="password" id="edit_password" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label> 
                                <input type="password" placeholder="Enter Confirm Password" class="form-control" name="cpassword" id="edit_cpassword" required>
                            </div>

                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="button" onclick="updatePassword();">
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
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Delete User</h3>
                        <h4 class="m-t-none m-b">Are you sure you want to delete user?</h4>
                        <form role="form">
                            <div class="pull-right">
                                <button class="btn btn-info m-t-n-xs" type="button" data-dismiss="modal">
                                    <strong>Cancel</strong>
                                </button>
                                <button class="btn btn-danger m-t-n-xs" type="button" onclick="deleteUser();">
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
    var path = "<?php echo base_url(); ?>admin/user/get_data"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'user_id'},
                {name: 'first_name'},
                {name: 'last_name'},
                {name: 'user_email'},
                {name: 'status'},
                {name: 'actions'}
            ],
            sortcolumn: 'user_id',
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
            pagesize: 20,
            pagesizeoptions: ['20', '60', '90', '120'],
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
                {text: 'User ID', datafield: 'user_id', filtertype: 'textbox', filtercondition: 'contains', cellsalign: 'center', width: 60},
                {text: 'First Name', datafield: 'first_name', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Last Name', datafield: 'last_name', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Email', datafield: 'user_email', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Status', datafield: 'status', filtertype: 'textbox', cellsalign: 'center', filtercondition: 'contains', width: 100},
                {text: 'Actions', datafield: 'actions', cellsalign: 'center', filterable: false, width: 100}
            ]
        });
    });

    function saveForm() {

        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var cpassword = $('#cpassword').val();
        var role = $('#role').val();
        var status = $('#status').val();
        if (isRequired('fname', 'First name is required', true)) {
            return false;
        } else if (isRequired('lname', 'Last name is required', true)) {
            return false;
        } else if (isRequired('email', 'Email is required', true)) {
            return false;
        } else if (isRequired('password', 'Password is required', true)) {
            return false;
        } else if (isRequired('cpassword', 'Confirm is required', true)) {
            return false;
        } else if (password != cpassword) {
            $("#error_msg span").text('Confirm Password not matched');
            $("#error_msg").fadeIn(2000);
            return false;
        } else {
            if (email) {
                $.post("<?php echo base_url(); ?>admin/user/checkEmail",
                        {
                            user_email: email
                        }
                )
                        .done(function (data) {
                            $("#error_msg").hide();
                            if (data == 'found') {
                                $("#error_msg span").text('Email already exist!');
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
                        });
            }


        }
    }

    function getRecord(id) {
        $('#edit_user_id').val(id);
        $.post("<?php echo base_url(); ?>admin/user/getRecord",
                {
                    id: id
                }
        )
                .done(function (data) {
                    if (data != 'not_found') {
                        $('#edit_fname').val(data.first_name);
                        $('#edit_lname').val(data.last_name);
                        $('#edit_email').val(data.user_email);
                        $('#edit_role').val(data.role_id);
                        $('#edit_status').val(data.status);
                    } else {
                        errortoster('Error!', 'Data not found for this user.');
                        $('#modal-form').modal('toggle');
                    }
                });
    }
    /////////////////////////// Edit User ///////////////////////
    function updateForm() {
        var fname = $('#edit_fname').val();
        var lname = $('#edit_lname').val();
        var email = $('#edit_email').val();
        var role = $('#edit_role').val();
        var status = $('#edit_status').val();
        var id = $('#edit_user_id').val();
        if (isRequired('edit_fname', 'First name is required', true)) {
            return false;
        } else if (isRequired('edit_lname', 'Last name is required', true)) {
            return false;
        } else if (isRequired('edit_email', 'Email is required', true)) {
            return false;
        } else {
            $.post("<?php echo base_url(); ?>admin/user/checkEditEmail",
                        {
                            user_email: email,
                            id:id
                        }
                )
                        .done(function (data) {
                            $("#error_msg").hide();
                            if (data == 'found') {
                                $("#edit_error_msg span").text('Email already exist!');
                                $("#edit_error_msg").fadeIn(2000);
                                return false;
                            } else {
                                $("#edit_loader").show();
                $.post("<?php echo base_url(); ?>admin/user/update",
                        {
                            id: id,
                            first_name: fname,
                            last_name: lname,
                            user_email: email,
                            role_id: role,
                            status: status
                        }
                )
                        .done(function (data) {
                            $("#edit_error_msg").hide();
                            if (data == 'saved') {
                                successtoster('User Updated!', 'User updated successfully');
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
                            });
                

            }
    }
    function setId(id) {
        $('#record_id').val(id);
    }
    function updatePassword() {
        var password = $('#edit_password').val();
        var cpassword = $('#edit_cpassword').val();
        var id = $('#edit_user_id').val();
        if (isRequired('edit_password', 'Password is required', true)) {
            return false;
        } else if (isRequired('edit_cpassword', 'Confirm password is required', true)) {
            return false;
        } else if (password != cpassword) {
            $("#p_error_msg span").text('Confirm Password not matched');
            $("#p_error_msg").fadeIn(2000);
            return false;
        } else {
            $(".loader").show();
            $.post("<?php echo base_url(); ?>admin/user/updatePassword",
                    {
                        id: id,
                        password: password
                    }
            )
                    .done(function (data) {
                        $("#p_error_msg").hide();
                        if (data == 'saved') {
                            successtoster('Password Updated!', 'Password updated successfully');
                            $(".loader").hide();
                            $('#password-modal-form').modal('toggle');
                        } else {
                            errortoster('Error!', 'Error updating password try later!');
                            $(".loader").hide();
                            $('#password-modal-form').modal('toggle');
                            $(".loader").hide();
                            return false;
                        }
                    });
        }

    }
    function deleteUser() {
        var id = $('#record_id').val();
        $(".loader").show();
        $.post("<?php echo base_url(); ?>admin/user/delete", {id: id})
                .done(function (data) {
                    if (data == 'deleted') {
                        errortoster('User Deleted!', 'User deleted successfully!');
                        $('#delete-modal-form').modal('toggle');
                        $("#" + gridID).jqxGrid({source: getAdapter()});
                    } else {
                        errortoster('Error!', 'Error deleting user!');
                        $('#delete-modal-form').modal('toggle');
                        return false;
                    }
                });
    }
</script>