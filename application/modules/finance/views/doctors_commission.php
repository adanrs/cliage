
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   Doctors Commission
            </header>
            <div class="space15"></div>
            <div class="col-md-12">
                <div class="col-md-7">
                    <section>
                        <form role="form" action="finance/doctorsCommission" method="post" enctype="multipart/form-data">
                            <div class="form-group">

                                <!--     <label class="control-label col-md-3">Date Range</label> -->
                                <div class="col-md-6">
                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                        if (!empty($from)) {
                                            echo $from;
                                        }
                                        ?>" placeholder="Date From">
                                        <span class="input-group-addon">To</span>
                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                        if (!empty($to)) {
                                            echo $to;
                                        }
                                        ?>" placeholder="Date To">
                                    </div>
                                    <div class="row"></div>
                                    <span class="help-block"></span> 
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="submit" class="btn btn-info range_submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
                <div class="col-md-5">
                </div>
            </div>



            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <button class="export" onclick="javascript:window.print();">Print</button>     
                    </div>
                    <div class="space15">
                        <?php
                        if (!empty($from) && !empty($to)) {
                            echo "From $from To $to";
                        }
                        ?> 
                    </div>

                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>Doctor ID</th>
                                <th>Doctor</th>
                                <th>Commission</th>
                                <th>Surgon Fee</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                        <style>

                            .img_url{
                                height:20px;
                                width:20px;
                                background-size: contain; 
                                max-height:20px;
                                border-radius: 100px;
                            }
                            .option_th{
                                width:18%;
                            }

                        </style>

                        <?php foreach ($doctors as $doctor) { ?>

                            <tr class="">
                                <td><?php echo $doctor->id; ?></td>
                                <td><?php echo $doctor->name; ?></td>
                                <td><?php echo $settings->currency; ?>
                                    <?php
                                    foreach ($payments as $payment) {
                                        if ($payment->doctor == $doctor->id) {
                                            if ($payment->status == 'paid' || $payment->status == 'paid-last') {
                                                $doctor_amount[] = $payment->doctor_amount;
                                            }
                                        }
                                    }
                                    if (!empty($doctor_amount)) {
                                        $doctor_total = array_sum($doctor_amount);
                                        echo $doctor_total;
                                    } else {
                                        $doctor_total = 0;
                                        echo $doctor_total;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?>
                                    <?php
                                    foreach ($ot_payments as $ot_payment) {
                                        if ($ot_payment->status == 'paid' || $ot_payment->status == 'paid-last') {
                                            if ($ot_payment->doctor_c_s == $doctor->id) {
                                                $doctor_ot_amount[] = $ot_payment->c_s_f;
                                            }
                                            if ($ot_payment->doctor_a_s_1 == $doctor->id) {
                                                $doctor_ot_amount[] = $ot_payment->a_s_f_1;
                                            }
                                            if ($ot_payment->doctor_a_s_2 == $doctor->id) {
                                                $doctor_ot_amount[] = $ot_payment->a_s_f_2;
                                            }
                                            if ($ot_payment->doctor_anaes == $doctor->id) {
                                                $doctor_ot_amount[] = $ot_payment->anaes_f;
                                            }
                                        }
                                    }
                                    if (!empty($doctor_ot_amount)) {
                                        $doctor_ot_total = array_sum($doctor_ot_amount);
                                        echo $doctor_ot_total;
                                    } else {
                                        $doctor_ot_total = 0;
                                        echo $doctor_ot_total;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $settings->currency; ?>
                                    <?php
                                    // if(empty($doctor_total)){$doctor_total='0';}
                                    // if(empty($doctor_ot_total)){$doctor_ot_total='0';}

                                    $doctor_gross = $doctor_total + $doctor_ot_total;
                                    if (!empty($doctor_gross)) {
                                        echo $doctor_gross;
                                    } else {
                                        echo'0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php $doctor_amount = NULL; ?>
                            <?php $doctor_ot_amount = NULL; ?>
                            <?php $doctor_gross = NULL; ?>
                        <?php } ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
