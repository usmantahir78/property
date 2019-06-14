
<div class="row  border-bottom white-bg ibox">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-md-3">
                <div class="ibox-content text-center">
                    <h1><?php echo $sale->customer_first_name . ' ' . $sale->customer_last_name; ?></h1>
                    <div class="m-b-sm">
                        <img alt="image" class="rounded-circle" width="80" height="80" src="<?php echo base_url(); ?>assets/admin/uploads/<?php echo $sale->customer_image; ?>">
                    </div>
                    <div>
                        <b>ID:</b> <?php echo $sale->customer_identity; ?><br />
                        <b>Phone:</b> <?php echo $sale->customer_phone; ?><br />
                        <b>Address:</b> <?php echo $sale->customer_address; ?>
                    </div>
                    <!--                                <div class="text-center">
                                                        <a href="" class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                                        <a href="" class="btn btn-xs btn-primary"><i class="fa fa-heart"></i> Love</a>
                                                    </div>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox-content mb-0">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th colspan="2">Property Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Area</b></td>
                                <td><?php echo $sale->property_in_marla; ?> Marla - <?php echo $sale->property_in_sarsahi; ?> Sarsahi</td>
                            </tr>
                            <tr>
                                <td><b>Rate Per Marla</b></td>
                                <td><?php echo $sale->property_per_marla; ?></td>
                            </tr>
                            <tr>
                                <td><b>Date Sold</b></td>
                                <td><?php echo date('d-m-Y', strtotime($sale->sale_date_created)); ?></td>
                            </tr>
                            <tr>
                                <td><b>Advance</b></td>
                                <td><?php echo $sale->advance_percent; ?>%</td>
                            </tr>
                            <tr>
                                <td><b>Total Price</b></td>
                                <td><?php echo $sale->property_total_price; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <div class="ibox-content mb-0">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th colspan="2">Nominee Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Name</b></td>
                                <td><?php echo $sale->nominee_first_name . ' ' . $sale->nominee_last_name; ?></td>
                            </tr>
                            <tr>
                                <td><b>ID</b></td>
                                <td><?php echo $sale->nominee_identity; ?></td>
                            </tr>
                            <tr>
                                <td><b>Phone</b></td>
                                <td><?php echo$sale->nominee_phone; ?></td>
                            </tr>
                            <tr>
                                <td><b>Relation</b></td>
                                <td><?php echo $sale->nominee_relation; ?></td>
                            </tr>
                            <tr>
                                <td><b>Address</b></td>
                                <td><?php echo $sale->nominee_address; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row white-bg ibox">
    <div class="col-lg-12">

        <div class="row">
    
            <div class="col-md-12">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-9">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Date</td>
                                <td>Customer Name </td>
                                <td>Property Number </td>
                                <td>Amount Type</td>
                                <td>Amount</td>
                                <td>Status</td>
                                <td>Receive Date</td>
                                <td>Action</td>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($adv_installments as $adv) { ?>
                            <tr>
                               
                                <td><?php echo date('d-m-Y',strtotime($adv->adv_date)); ?></td>
                                <td><?php echo $sale->customer_first_name . ' ' . $sale->customer_last_name; ?></td>
                                <td><?php echo $sale->property_number; ?></td>
                                <td>Advance</td>
                                <td><?php echo $adv->adv_amount; ?></td>
                                <td><?php echo $adv->adv_status; ?></td>
                                <td><?php if($adv->adv_receive_date){ echo date('d-m-Y',strtotime($adv->adv_receive_date)); } ?></td>
                                <td><?php if($adv->adv_status=='Paid') { ?><a href="javascript:void(0);">Received</a><?php } else { ?><a href="<?php echo base_url(); ?>admin/instalments/reveiveadv/<?php echo $adv->adv_id; ?>">Receive</a><?php } ?></td>
                            </tr>
                                <?php } ?>
                       </tbody>
                    </table>
                        </div>
                        <div class="col-md-3">
                            <table class="table table-bordered">
                                 <thead>
                                    <tr>
                                        <td colspan="2">Details</td>
                                    </tr>
                                    <tr>
                                        <td>Advance Total</td>
                                        <td>Advance Remaining</td>
                                    </tr>
                                </thead>
                            <tbody>
                            <tr>
                               
                                <td><?php echo number_format($sale->advance_amount,2); ?></td>
                                <td><?php echo number_format($sale->advance_amount-$total_adv_paid->total_adv_paid,2); ?></td>
                            </tr>
                            </tbody>
                            <thead>
                                    <tr>
                                        <td>Amount Total</td>
                                        <td>Amount Remaining</td>
                                    </tr>
                                </thead>
                                <tbody>
                            <tr>
                               
                                <td><?php echo number_format($sale->total_price-$sale->advance_amount,2); ?></td>
                                <td><?php echo number_format($sale->total_price-$sale->advance_amount-$total_paid->total_paid,2); ?></td>
                            </tr>
                            </tbody>
                       
                    </table>
                        </div>
                    </div>
                    <div id="jqxgrid"></div>
                </div>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">

    var gridID = "jqxgrid"; //set the grid div
    var path = "<?php echo base_url(); ?>admin/booking/get_installment_data/<?php echo $this->uri->segment(4) ?>/"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'instalment_date'},
                {name: 'customer_name'},
                {name: 'property_number'},
                {name: 'amount_type'},
                {name: 'total_amount'},
                {name: 'installment_status'},
                {name: 'actions'}
            ],
            sortcolumn: 'instalment_id',
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
                {text: 'Date', datafield: 'instalment_date', filtertype: 'range', cellsalign: 'center', width: 160},
                {text: 'Customer Name', datafield: 'customer_name', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Property Number', datafield: 'property_number', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Amount Type', datafield: 'amount_type',  filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Total Amount', datafield: 'total_amount',  filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Status', datafield: 'installment_status', filtertype: 'textbox', cellsalign: 'center',filtercondition: 'contains'},
                
                {text: 'Actions', datafield: 'actions', cellsalign: 'center',filterable:false,width: 100}
            ]
        });
    });
    </script>