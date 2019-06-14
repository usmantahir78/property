<?php if(!isset($_SESSION['user_id'])){redirect(base_url().'admin/login');} ?>
<!DOCTYPE html>
<html>

<?php $this->load->view('admin/includes/header'); ?>
<body>
    <div id="wrapper">
        <?php $this->load->view('admin/includes/nav_bar'); ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <?php $this->load->view('admin/includes/menu'); ?>
            <?php $this->load->view($content); ?>
            <?php $this->load->view('admin/includes/footer'); ?>
        </div>
    </div>
    
   
    
</body>
</html>
