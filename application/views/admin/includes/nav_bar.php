<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
<!--                            <img alt="image" class="rounded-circle" src="img/profile_small.jpg"/>-->
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);">
                                <span class="block m-t-xs font-bold"><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name'); ?></span>
<!--                                <span class="text-muted text-xs block">Art Director <b class="caret"></b></span>-->
                            </a>
<!--                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                                <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="login.html">Logout</a></li>
                            </ul>-->
                        </div>
                        <div class="logo-element">
                            GS
                        </div>
                    </li>
                    <?php if(get_role_access($this->session->userdata('role_id'),1)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/dashboard' ?>"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span></a>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),2)) { ?>
                    <li class="landing_link">
                        <a href="<?php echo base_url().'admin/booking' ?>"><i class="fa fa-star"></i> <span class="nav-label">Booking</span></a>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),3)) { ?>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-money"></i> <span class="nav-label">Transactions</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url().'admin/day/listing' ?>">Daily</a></li>
                        <li><a href="<?php echo base_url().'admin/day/daydetails' ?>">Today</a></li>
                    </ul>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),11)) { ?>
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-money"></i> <span class="nav-label">Reports</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="<?php echo base_url().'admin/customer/report' ?>">Customer Report</a></li>
                        <li><a href="<?php echo base_url().'admin/vender/report' ?>">Vendor Report</a></li>
                    </ul>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),6)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/instalments/reveivepayment' ?>"><i class="fa fa-dollar"></i> <span class="nav-label">Payment</span> </a>
                        
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),7)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/property' ?>"><i class="fa fa-home"></i> <span class="nav-label">Property</span> </a>
                        
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),8)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/user' ?>"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),9)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/customer' ?>"><i class="fa fa-users"></i> <span class="nav-label">Customers </span></a>
                    </li>
                    <?php } ?>
                    <?php if(get_role_access($this->session->userdata('role_id'),10)) { ?>
                    <li>
                        <a href="<?php echo base_url().'admin/vender' ?>"><i class="fa fa-users"></i> <span class="nav-label">Vendors </span></a>
                    </li>
                    <?php } ?>
                    
                </ul>

            </div>
        </nav>

        