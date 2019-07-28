
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Roles List </h5>
            </div>
            <div class="ibox-content">
                <a data-toggle="modal" class="btn btn-primary btn-lg pull-right mb-2" href="#modal-form">Add Role</a>
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
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Add Role</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form role="form">
                            <div class="form-group">
                                <label>Role Name</label> 
                                <input type="text" placeholder="Enter Name" class="form-control" id="role_name" required="">
                                
                            </div>
                            <div class="form-group">
                                <label>Status</label> 
                                <select class="form-control m-b" name="role_status" id="role_status" required="">
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
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Edit Role</h3>
                        <div class="hide alert alert-danger alert-dismissable" id="edit_error_msg">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">&times;</button>
                            <b>Alert! </b><span></span>
                        </div>
                        <form role="form">
                            <div class="form-group">
                                 <label>Role Name</label> 
                                <input type="text" placeholder="Enter Name" class="form-control" id="edit_role_name" required="">
                            </div>
                            <div class="form-group">
                                <label>Status</label> 
                                <select class="form-control m-b" name="role_status" id="edit_role_status" required="">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <input type="hidden" id="edit_role_id" value="0">
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
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Delete Role</h3>
                        <h4 class="m-t-none m-b">Are you sure you want to delete role?</h4>
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
    var path = "<?php echo base_url(); ?>admin/roles/get_data"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'role_id'},
                {name: 'role_name'},
                {name: 'role_status'},
                {name: 'actions'}
            ],
            sortcolumn: 'role_id',
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
                {text: 'ID', datafield: 'role_id', filtertype: 'textbox', filtercondition: 'contains', cellsalign: 'center', width: 60},
                {text: 'Role Name', datafield: 'role_name', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Status', datafield: 'role_status', filtertype: 'textbox', cellsalign: 'center',filtercondition: 'contains',width: 100},
                {text: 'Actions', datafield: 'actions', cellsalign: 'center',filterable:false,width: 100}
            ]
        });
    });

    function saveForm() {

        var role_name = $('#role_name').val();
        var status = $('#role_status').val();
        if (isRequired('role_name', 'Role name is required', true)) {
            return false;
        } else {
            $("#loader").show();
            $.post("<?php echo base_url(); ?>admin/roles/save",
                    {
                        role_name: role_name,
                        role_status: status
                    }
            )
                    .done(function (data) {
                        $("#error_msg").hide();
                        if (data == 'saved') {
                            successtoster('Role Saved!','Role saved successfully');
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
        $('#edit_role_id').val(id);
        $.post("<?php echo base_url(); ?>admin/roles/getRecord",
                    {
                        id:id
                    }
            )
                    .done(function (data) {
                        if (data !='not_found') {
                            $('#edit_role_name').val(data.role_name);
                            $('#edit_role_status').val(data.role_status);
                        } else {
                            errortoster('Error!','Data not found for this role.');
                            $('#modal-form').modal('toggle');
                        }
                    });
    }
    /////////////////////////// Edit User ///////////////////////
    function updateForm() {
        var role_name       = $('#edit_role_name').val();
        var status      = $('#edit_role_status').val();
        var id          = $('#edit_role_id').val();
        if (isRequired('edit_role_name', 'Role name is required', true)) {
            return false;
        } else {
           $("#edit_loader").show();
            $.post("<?php echo base_url(); ?>admin/roles/update",
                    {
                        id:id,
                        role_name: role_name,
                        role_status: status
                    }
            )
                    .done(function (data) {
                        $("#edit_error_msg").hide();
                        if (data == 'saved') {
                            successtoster('Role Updated!','Role updated successfully');
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
            $.post("<?php echo base_url(); ?>admin/roles/delete",{id:id})
                    .done(function (data) {
                        if (data == 'deleted') {
                            errortoster('Role Deleted!','Role deleted successfully!');
                            $('#delete-modal-form').modal('toggle');
                               $("#" + gridID).jqxGrid({source: getAdapter()});
                        } else if(data == 'used'){
                            errortoster('Can`t Delete!','Role in use!');
                            $('#delete-modal-form').modal('toggle');
                        } else {
                            errortoster('Error!','Error deleting role!');
                            $('#delete-modal-form').modal('toggle');
                            return false;
                        }
                    });
    }
</script>