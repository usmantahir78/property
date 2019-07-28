
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Permissions </h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Section </th>
                            <th>Permission </th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php foreach($permissions as $p) { ?>
                        <tr>
                            <td><b><?php echo $p->permission_section; ?></b></td>
                            <td><input type="checkbox" class="permission" <?php if($p->permission_status=='Allow'){ echo 'checked';} ?> name="permission[]" value="<?php echo $p->permission_id; ?>">
                                <img id="loader_<?php echo $p->permission_id; ?>" align="center" class="hide" src="<?php echo base_url() . LOADER; ?>"></td>
                        </tr>
                         <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>
<script>
$(".permission").change(function() {
    var role_id = '<?php echo $this->uri->segment(4); ?>';
    var permission_id = this.value;
    var permission = 'Allow';
    if(this.checked) {
       permission = 'Allow';
    }else{
       permission = 'Denied';
    }
    $("#loader_"+permission_id).show();
        $.post("<?php echo base_url(); ?>admin/permissions/update", {role_id: role_id,permission_id:permission_id,permission:permission})
                .done(function (data) {
                    if (data == 'saved') {
                        successtoster('Permission Updated!', 'Permission Updated successfully!');
                        $("#loader_"+permission_id).hide();
                    } else {
                        errortoster('Error!', 'Error Permission Updateding!');
                       $("#loader_"+permission_id).hide();
                        return false;
                    }
                });
});
</script>