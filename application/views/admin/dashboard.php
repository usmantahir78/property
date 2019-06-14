
<div class="row  border-bottom white-bg dashboard-header">

    <div class="col-md-3">
        <h2>Welcome <?php echo $this->session->userdata('first_name').'!'; ?></h2>
       
    </div>
    

</div>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sale VS Revenue
                                <small>Total installments.</small>
                            </h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="lineChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sales</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Sale Vs Revenue</h5>

                        </div>
                        <div class="ibox-content">
                            <div class="text-center">
                                <canvas id="polarChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Property Status </h5>

                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="doughnutChart" height="140"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- ChartJS-->
    <script src="<?php echo base_url(); ?>assets/admin/js/plugins/chartJs/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/demo/chartjs-demo.js"></script>
