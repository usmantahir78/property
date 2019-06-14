
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Instalments </h5>
            </div>
            <div class="ibox-content">
                <a class="btn btn-primary btn-lg pull-right mb-2" href="<?php echo base_url(); ?>admin/instalments/create">Receive Instalment</a>
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
    var path = "<?php echo base_url(); ?>admin/instalments/get_data"; //set the path to send request
    function getAdapter() {
        var source = {
            datatype: "json",
            datafields: [
                {name: 'instalment_number'},
                {name: 'property_number'},
                {name: 'customer_name'},
                {name: 'instalment_date'},
                {name: 'amount_type'},
                {name: 'total_amount'},
                {name: 'actions'}
            ],
            sortcolumn: 'instalment_id',
            emptyrecords: "No records to display",
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
                {text: 'Instalment Number', datafield: 'instalment_number', filtertype: 'textbox', filtercondition: 'contains', cellsalign: 'center', width: 150},
                {text: 'Property Number', datafield: 'property_number', filtertype: 'textbox', filtercondition: 'contains'},    
                {text: 'Customer Name', datafield: 'customer_name', filtertype: 'textbox', filtercondition: 'contains'},
                
                {text: 'Instalment Date', datafield: 'instalment_date',  filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Amount Type', datafield: 'amount_type',  filtertype: 'textbox', filtercondition: 'contains'},
                {text: 'Total Amount', datafield: 'total_amount', filtertype: 'textbox', cellsalign: 'center',filtercondition: 'contains',width: 100},
                {text: 'Actions', datafield: 'actions', cellsalign: 'center',filterable:false,width: 100}
            ]
        });
    });


</script>