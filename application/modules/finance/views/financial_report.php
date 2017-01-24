<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <header class="panel-heading">
            <i class="fa fa-money"></i>   <?php  echo lang('financial_report'); ?> 
        </header>
        <div class="col-md-12">
            <div class="col-md-7">  
                <section>

                    <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!--     <label class="control-label col-md-3">Date Range</label> -->
                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                    if (!empty($from)) {
                                        echo $from;
                                    }
                                    ?>" placeholder=" <?php  echo lang('from'); ?> ">
                                    <span class="input-group-addon"> <?php  echo lang(''); ?> </span>
                                    <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                    if (!empty($to)) {
                                        echo $to;
                                    }
                                    ?>" placeholder=" <?php  echo lang('to'); ?> ">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span> 
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-info range_submit"> <?php  echo lang('submit'); ?> </button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <div class="col-md-5">
            </div>
        </div>

        <?php
        if (!empty($payments)) {
            $paid_number = 0;
            foreach ($payments as $payment) {
                $paid_number = $paid_number + 1;
            }
        }
        ?>
        <div class="row">
            <div class="col-lg-7">

                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i>  <?php  echo lang('payment_report'); ?>   <?php
                        if (!empty($from) && !empty($to)) {
                            echo lang('from').' '. $from .' '.lang('to').' '. $to ;
                        }
                        ?> 
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i>  <?php  echo lang('category'); ?> </th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i>  <?php  echo lang('amount'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                           
                            <?php foreach ($payment_categories as $category) { ?>
                                <tr class="">
                                    <td><?php echo $category->category ?></td>
                                    <td><?php echo $settings->currency; ?> <?php
                                        foreach ($payments as $payment) {
                                            $category_names_and_amounts = $payment->category_name;
                                            $category_names_and_amounts = explode(',', $category_names_and_amounts);
                                            foreach ($category_names_and_amounts as $category_name_and_amount) {
                                                $category_name = explode('*', $category_name_and_amount);
                                                if (($category->category == $category_name[0])) {
                                                    $amount_per_category[] = $category_name[1];
                                                }
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            echo array_sum($amount_per_category);
                                            $total_payment_by_category[] = array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                        <tbody>
                            <tr>
                                <td><h3> <?php  echo lang('sub_total'); ?>  </h3></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($total_payment_by_category)) {
                                        echo array_sum($total_payment_by_category);
                                    } else {
                                        echo '0';
                                    }
                                    ?> 
                                </td>
                            </tr>

                            <tr>
                                <td><h5> <?php  echo lang('total'); ?>   <?php  echo lang('discount'); ?> </h5></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $discount[] = $payment->flat_discount;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($discount);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5> <?php  echo lang('total'); ?>   <?php  echo lang('vat'); ?> </h5></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $vat[] = $payment->flat_vat;
                                        }
                                        if ($paid_number > 0) {
                                            echo array_sum($vat);
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5><i class="fa fa-money"></i>  <?php  echo lang('gross_payment'); ?> </h5></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        if ($paid_number > 0) {
                                            $gross = array_sum($total_payment_by_category) - array_sum($discount) + array_sum($vat);
                                            echo $gross;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>

                            <!--
                            
                            <tr>
                                <td><h5>Total Hospital Amount</h5></td>
                                <td>
                            <?php echo $settings->currency; ?>
                            <?php
                            if (!empty($payments)) {
                                foreach ($payments as $payment) {
                                    $hospital_amount[] = $payment->hospital_amount;
                                }
                                if ($paid_number > 0) {
                                    $hospital_amount = array_sum($hospital_amount);
                                    echo $hospital_amount;
                                } else {
                                    echo '0';
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                                </td>
                            </tr>
                            <tr>
                                <td><h5>Total Doctors Amount</h5></td>
                                <td>
                            <?php echo $settings->currency; ?>
                            <?php
                            if (!empty($payments)) {
                                foreach ($payments as $payment) {
                                    $doctor_amount[] = $payment->doctor_amount;
                                }
                                if ($paid_number > 0) {
                                    $doctor_amount = array_sum($doctor_amount);
                                    echo $doctor_amount;
                                } else {
                                    echo '0';
                                }
                            } else {
                                echo '0';
                            }
                            ?>
                                </td>
                            </tr>
                            
                            -->
                            <tr>
                                <td><h5> <?php  echo lang('due_amount'); ?>  </h5></td>
                                <td>
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($payments)) {
                                        foreach ($payments as $payment) {
                                            $amount_received[] = $payment->amount_received;
                                        }
                                        if ($paid_number > 0) {
                                            $amount_received = array_sum($amount_received);
                                            echo $gross - $amount_received;
                                        } else {
                                            echo '0';
                                        }
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>










































                <section></section>


                <section class="panel">
                    <header class="panel-heading">
                        <i class="fa fa-money"></i>   <?php  echo lang('expense_report'); ?>
                    </header>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i>  <?php  echo lang('category'); ?> </th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i>  <?php  echo lang('amount'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expense_categories as $category) { ?>
                                <tr class="">
                                    <td><?php echo $category->category ?></td>
                                    <td>
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        foreach ($expenses as $expense) {
                                            $category_name = $expense->category;


                                            if (($category->category == $category_name)) {
                                                $amount_per_category[] = $expense->amount;
                                            }
                                        }
                                        if (!empty($amount_per_category)) {
                                            $total_expense_by_category[] = array_sum($amount_per_category);
                                            echo array_sum($amount_per_category);
                                        } else {
                                            echo '0';
                                        }

                                        $amount_per_category = NULL;
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </section>





            </div>
            <div class="col-lg-5">






                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                     <?php  echo lang('gross_payment'); ?> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($payments)) {
                                            if (($paid_number > 0)) {
                                                $gross = $gross;
                                                echo $gross;
                                            }
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>

                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                     <?php  echo lang('gross_expense'); ?> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($total_expense_by_category)) {
                                            echo array_sum($total_expense_by_category);
                                        } else {
                                            echo '0';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </section>
                <section class="panel">
                    <div class="weather-bg">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-money"></i>
                                     <?php  echo lang('profit'); ?> 
                                </div>
                                <div class="col-xs-8">
                                    <div class="degree">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (empty($total_payment_by_category)) {
                                            if (empty($total_expense_by_category)) {
                                                echo '0';
                                            } else {
                                                $profit = 0 - array_sum($total_expense_by_category);
                                                echo $profit;
                                            }
                                        }
                                        if (empty($total_expense_by_category)) {
                                            if (empty($total_payment_by_category)) {
                                                echo '0';
                                            } else {
                                                $profit = $gross - 0;
                                                echo $profit;
                                            }
                                        } else {
                                            if (!empty($gross)) {
                                                $profit = $gross - array_sum($total_expense_by_category);
                                                echo $profit;
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </section>












            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
