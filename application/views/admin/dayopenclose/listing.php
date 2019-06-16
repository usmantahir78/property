
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Day List </h5>
            </div>
            <div class="ibox-content">
                <?php if($this->session->userdata('day_id')=="") { ?>
                <a class="btn btn-primary btn-lg pull-right mb-2" href="<?php echo base_url().'admin/day/open'; ?>">Open Day</a>
                <?php } ?>
                <br />
                <div class="table-responsive">
                    <div id="jqxgrid"></div>
                </div>

            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    var gridID = "jqxgrid"; //set the grid div
    var path = "<?php echo base_url(); ?>admin/day/get_data"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'day_id'},
                {name: 'cashier_name'},
                {name: 'day_open_amount'},
                {name: 'day_close_amount'},
                {name: 'day_opendate'},
                {name: 'day_closedate'},
                {name: 'day_status'},
                {name: 'actions'}
            ],
            sortcolumn: 'day_id',
            sortdirection: 'desc',
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
                {text: 'ID', datafield: 'day_id', filtertype: 'textbox', filtercondition: 'contains', cellsalign: 'center', width: 60},
                {text: 'Cashier Name', datafield: 'cashier_name', filterable:false},
                {text: 'Open Date', datafield: 'day_opendate', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Close Date', datafield: 'day_closedate', filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Open Amount', datafield: 'day_open_amount',  filtertype: 'textbox',cellsalign: 'right', filtercondition: 'contains'},
                
                {text: 'Close Amount', datafield: 'day_close_amount', filtertype: 'textbox',cellsalign: 'right', filtercondition: 'contains',width:'20%'},
                {text: 'Status', datafield: 'day_status', filtertype: 'textbox', cellsalign: 'center',filtercondition: 'contains',width: 100},
                {text: 'Actions', datafield: 'actions', cellsalign: 'center',filterable:false,width: 100}
            ]
        });
    });

</script>