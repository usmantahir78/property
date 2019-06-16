<form method="post" name="dayopen" action="<?php echo base_url(); ?>admin/day/close" >
<div class="row  border-bottom white-bg ">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h1>Daily Transactions </h1>
            </div>
            <div class="ibox-content">
                
                    
                    <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th colspan="10">Day Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Cashier Name</b></td>
                                    <td><?php echo $day->first_name.' '.$day->last_name; ?></td>
                                    <td><b>Date</b></td>
                                    <td><?php echo date('d-m-Y',strtotime($day->day_opendate)); ?></td>
                                    <td><b>Day Open Cash</b></td>
                                    <td style="text-align: right;"><?php echo number_format($day->day_open_amount,2); ?></td>
                                    <td><b>Day Close Cash</b></td>
                                    <td style="text-align: right;"><?php echo number_format($day->day_close_amount,2); ?></td>
                                    <td><b>Status</b></td>
                                    <td><?php echo $day->day_status; ?></td>
                                </tr>

                            </tbody>
                        </table>
                        </div>
                    </div>
                <br />
                <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th colspan="10">Transactions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Sr#</b></td>
                                    <td><b>Slip Number</b></td>
                                    <td><b>Name</b></td>
                                    <td><b>Date</b></td>
                                    <td><b>Description</b></td>
                                    <td><b>Debit</b></td>
                                    <td><b>Credit</b></td>
                                </tr>
                                <?php 
                                $total_debit = $this->day_model->getDayAmount($day_id,'debit')->total_amount;
                                $total_credit = $this->day_model->getDayAmount($day_id,'credit')->total_amount;
                                foreach($daydetails as $d) {
                                   $inst_details = $this->day_model->getInstalmentDetails($d->vocher_type,$d->vocher_number);
                                   ?>
                                <tr>
                                    <td style="width: 10%;"><?php echo $d->vocher_number; ?></td>
                                    <td style="width: 10%;"><?php echo $inst_details->slip_number; ?></td>
                                    <td style="width: 15%;"><?php echo $inst_details->fname.' '.$inst_details->lname; ?></td>
                                    <td  style="width: 10%;"><?php echo date('d-m-Y',strtotime($d->date_created)); ?></td>
                                    <td><?php echo $inst_details->des; ?></td>
                                    <td style="text-align: right;width: 10%;"><?php if($d->type=="debit"){ echo number_format($d->amount,2);} else{ echo "-";} ?></td>
                                    <td style="text-align: right;width: 10%;"><?php if($d->type=="credit"){ echo number_format($d->amount,2);} else{ echo "-";} ?></td>
                                    
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5"></td>
                                    <td><b><?php echo number_format($total_debit,2); ?></b></td>
                                    <td><b><?php echo number_format($total_credit,2); ?></b></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <br />
                <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td><b>Total Sale</b></td>
                                    <td style="text-align: right;"><?php echo number_format($total_debit,2); ?></td>
                                    <td><b>Total Expense</b></td>
                                    <td style="text-align: right;"><?php echo number_format($total_credit,2); ?></td>
                                    <td><b>Day Open Cash</b></td>
                                    <td style="text-align: right;"><?php echo number_format($day->day_open_amount,2); ?></td>
                                    <td><b>Day Close Cash</b></td>
                                    <td style="text-align: right;"><?php $dayclose = ($total_debit+$day->day_open_amount)-$total_credit;
                                    echo number_format($dayclose,2);?></td>
                                </tr>

                            </tbody>
                        </table>
                        </div>
                    </div>
                <br />
                <input type="hidden" value="<?php echo $dayclose; ?>" name="closing_cash">
                <button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary pull-right">Close</button>
                    
                
            </div>  
        </div>
    </div>
</div>

</form>