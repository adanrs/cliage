
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- invoice start-->
        <section>
            <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body col-md-6">
                    <div class="row invoice-list">     
                        <div class="text-center corporate-id">
                            <h1>
                                <?php echo $settings->title ?>
                            </h1>
                            <h4>
                                <?php echo $settings->address ?>
                            </h4>
                            <h4>
                                Tel: <?php echo $settings->phone ?>
                            </h4>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4> <?php  echo lang('payment_to'); ?> :</h4>
                            <p>
                                <?php echo $settings->title; ?> <br>
                                <?php echo $settings->address; ?><br>
                                Tel:  <?php echo $settings->phone; ?>
                            </p>
                        </div>
                        <div class="col-lg-4 col-sm-4">
                            <h4> <?php  echo lang('bill_to'); ?> :</h4>
                            <p>
                                <?php
                                $patient_info = $this->db->get_where('patient', array('id' => $patient_id))->row();
                                echo $patient_info->name . ' <br>';
                                echo $patient_info->address . '  <br/>';
                                P: echo $patient_info->phone
                                ?>
                            </p>
                        </div>



                        <?php
                        $gross_total = array();
                        foreach ($payments as $payment) {
                            $gross_total[] = $payment->gross_total;
                            $amount[] = $payment->amount;
                            $flat_vat[] = $payment->flat_vat;
                            $discount[] = $payment->flat_discount;
                            $amount_received[] = $payment->amount_received;
                        }
                        ?>

                        <div class="col-lg-4 col-sm-4">
                            <h4> <?php  echo lang('invoice_info'); ?> </h4> 
                            <ul class="unstyled">
                                <li> <?php  echo lang('invoice_status'); ?> 		: 
                                    <strong style="color: maroon">
                                        <?php
                                        if (array_sum($gross_total) != array_sum($amount_received)) {
                                            if (array_sum($amount_received) == 0) {
                                                echo '<strong>'.lang('unpaid').'</strong>';
                                            } else {
                                                echo '<strong>'.lang('paid_partially').'</strong>';
                                            }
                                        } else {
                                            echo '<strong>'.lang('paid').'</strong>';
                                        }
                                        ?> 
                                    </strong> 
                                </li>
                            </ul>
                        </div>

                    </div>




                    <?php
                    if (!empty($payments)) {
                        ?>

                        <header class="h4"> <?php  echo lang('general_invoice'); ?> </header>
                        <table class="table table-striped table-hover">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> <?php  echo lang('category'); ?> </th>
                                    <th> <?php  echo lang('date'); ?> </th>
                                    <th> <?php  echo lang('amount'); ?> </th>
                                </tr>
                            </thead>

                            <tbody>






    <?php
    foreach ($payments as $payment) {
        if (!empty($payment->category_name)) {
            $category_name = $payment->category_name;
            $category_name1 = explode(',', $category_name);
            $i = 0;
            foreach ($category_name1 as $category_name2) {
                $category_name3 = explode('*', $category_name2);
                if ($category_name3[1] > 0) {
                    ?>                
                                                <tr>
                                                    <td><?php echo $i = $i + 1; ?></td>
                                                    <td><?php echo $category_name3[0]; ?> </td>
                                                    <td><?php echo date('m/d/y', $payment->date); ?> </td>
                                                    <td class=""><?php echo $settings->currency; ?> <?php echo $category_name3[1]; ?> </td>
                                                </tr> 
                    <?php
                }
            }
        }
    }
    ?>

                            </tbody>

                        </table>


                        <div class="row">
                            <div class="col-lg-4 invoice-block pull-right">
                                <ul class="unstyled amounts">
                                    <li><strong> <?php  echo lang('sub_total'); ?>   <?php  echo lang('amount'); ?>  : </strong><?php echo $settings->currency; ?> <?php
                            if (!empty($amount)) {
                                echo array_sum($amount);
                            }
    ?></li>
                                        <?php if (!empty($discount)) { ?>
                                        <li><strong><?php  echo lang('discount'); ?></strong> <?php ?> <?php echo array_sum($discount); ?> </li>
                                        <?php } ?>
                                    <?php if (!empty($flat_vat)) { ?>
                                        <li><strong><?php  echo lang('vat'); ?> :</strong>   <?php ?> % = <?php echo $settings->currency . ' ' . array_sum($flat_vat); ?></li>
                                    <?php } ?>
                                    <li style="background: greenyellow"><strong><?php  echo lang('grand_total'); ?> : </strong><?php echo $settings->currency; ?> <?php
                                if (!empty($gross_total)) {
                                    echo array_sum($gross_total);
                                }
                                    ?></li>
                                    <li style="background: greenyellow"><strong><?php  echo lang('amount_received'); ?>: </strong><?php echo $settings->currency; ?> <?php
                                        if (!empty($amount_received)) {
                                            echo array_sum($amount_received);
                                        }
                                        ?></li>
                                </ul>
                            </div>
                        </div>




<?php } ?>





                    <div class="row">
                        <div class="col-lg-4 invoice-block pull-right">
                            <ul class="unstyled amounts">         
                                <li style="background: yellow;"><strong> <?php  echo lang('total'); ?>   <?php  echo lang('amount_to_be_paid'); ?>  : </strong><?php echo $settings->currency; ?> <?php
if (!empty($gross_total) || !empty($amount_received)) {
    echo array_sum($gross_total) - array_sum($amount_received);
}
?>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div class="text-center invoice-btn">

                        <a class="btn btn-info btn-lg invoice_button" onclick="javascript:window.print();"><i class="fa fa-print"></i>  <?php  echo lang('print'); ?>  </a>
                    </div>


                </div>

                <div class="panel-body col-md-6 add_deposit" style="font-size: 10px; float: right;">

                    <form role="form" action="finance/amountReceivedFromPT" method="post" enctype="multipart/form-data">
                        <div class="form-group"> 
                            <label for="exampleInputEmail1"></label>
                             <?php  echo lang('amount_to_be_paid'); ?> : <?php echo $settings->currency; ?>  <?php echo array_sum($gross_total) - array_sum($amount_received); ?> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php  echo lang('amount_received'); ?> </label>
                            <input type="text" class="form-control" name="amount_received" id="exampleInputEmail1" value='<?php
                                    if (!empty($category->description)) {
                                        echo $category->description;
                                    }
?>' placeholder="<?php echo $settings->currency; ?> ">
                        </div>
                        <input type="hidden" name="id" value="<?php echo $patient_id; ?>">

                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
                    </form>

                </div>
            </div>
        </section>
        <!-- invoice end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
