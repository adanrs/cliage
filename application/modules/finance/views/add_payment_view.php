<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($payment->id))
                    echo '<i class="fa fa-edit"></i> '.lang('edit_payment');
                else
                    echo '<i class="fa fa-plus-circle"></i> '.lang('add_payment');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <div class="col-lg-8">
                            <section class="panel">
                                <div class="panel-body">
                                    <style> 
                                        .payment{
                                            padding-top: 20px;
                                            padding-bottom: 20px;
                                            border: none;

                                        }
                                        .pad_bot{
                                            padding-bottom: 10px;
                                        }  

                                        form{ border: 1px solid #ccc;}
                                    </style>
                                    <form role="form" id="editPaymentForm" action="finance/addPayment" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12 payment pad_bot">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php  echo lang('patient'); ?> </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="patient" value=''> 
                                                    <option value="">Select .....</option>
                                                    <?php foreach ($patients as $patient) { ?>
                                                        <option value="<?php echo $patient->id; ?>" <?php
                                                        if (!empty($payment->patient)) {
                                                            if ($payment->patient == $patient->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?> ><?php echo $patient->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 panel">
                                        </div>



                                        <div class="col-md-12 payment pad_bot">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1">  <?php  echo lang('referred_by_doctor'); ?> </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor" value=''>  
                                                    <option value="">Select .....</option>
                                                    <?php foreach ($doctors as $doctor) { ?>
                                                        <option value="<?php echo $doctor->id; ?>"<?php
                                                        if (!empty($payment->doctor)) {
                                                            if ($payment->doctor == $doctor->id) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo $doctor->name; ?> </option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 panel">
                                        </div>


                                        <div class="col-md-12 payment">
                                            <div class="form-group last">
                                                <div class="col-md-3 payment_label"> 
                                                    <label for="exampleInputEmail1">  <?php  echo lang('procedures'); ?> </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="category_name[]" id="" class="multi-select" multiple="" id="my_multi_select3" >
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option class="ooppttiioonn" data-id="<?php echo $category->c_price; ?>" value="<?php echo $category->category; ?>" <?php
                                                            if (!empty($payment->category_name)) {
                                                                $category_name = $payment->category_name;
                                                                $category_name1 = explode(',', $category_name);
                                                                foreach ($category_name1 as $category_name2) {
                                                                    $category_name3 = explode('*', $category_name2);
                                                                    if ($category_name3[0] == $category->category) {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                            }
                                                            ?>><?php echo $category->category; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="col-md-12 panel">
                                        </div>

                                        <!--
                                                                                <div class="col-md-6 payment">
                                                                                    <div class="col-md-3 payment_label">   
                                                                                        <label class="payment_label"><strong>PAYMENT CATEGORIES</strong></label>
                                                                                    </div>
                                                                                    <div class="col-md-3 payment_label">
                                        
                                                                                        <label class="payment_label"><strong>AMOUNT</strong></label>
                                                                                    </div>        
                                                                                </div>
                                        -->

                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php  echo lang('sub_total'); ?>  </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="subtotal" id="subtotal" value='<?php
                                                if (!empty($payment->amount)) {

                                                    echo $payment->amount;
                                                }
                                                ?>' placeholder=" ">
                                            </div>

                                        </div>


                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php  echo lang('discount'); ?>   <?php
                                                    if ($discount_type == 'percentage') {
                                                        echo ' (%)';
                                                    }
                                                    ?> </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="discount" id="dis_id" value='<?php
                                                if (!empty($payment->discount)) {
                                                    $discount = explode('*', $payment->discount);
                                                    echo $discount[0];
                                                }
                                                ?>' placeholder="Discount">
                                            </div>

                                        </div>

                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php  echo lang('gross_total'); ?>  </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="grsss" id="gross" value='<?php
                                                if (!empty($payment->gross_total)) {

                                                    echo $payment->gross_total;
                                                }
                                                ?>' placeholder=" ">
                                            </div>

                                        </div>
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php  echo lang('amount_received'); ?>  </label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <input type="text" class="form-control pay_in" name="amount_received" id="amount_received" value='<?php
                                                if (!empty($payment->amount_received)) {

                                                    echo $payment->amount_received;
                                                }
                                                ?>' placeholder=" ">
                                            </div>

                                        </div>
                                        <!--
                                        <div class="col-md-12 payment">
                                            <div class="col-md-3 payment_label"> 
                                              <label for="exampleInputEmail1">Vat (%)</label>
                                            </div>
                                            <div class="col-md-9"> 
                                              <input type="text" class="form-control pay_in" name="vat" id="exampleInputEmail1" value='<?php
                                        if (!empty($payment->vat)) {
                                            echo $payment->vat;
                                        }
                                        ?>' placeholder="%">
                                            </div>
                                        </div>
                                        -->

                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($payment->id)) {
                                            echo $payment->id;
                                        }
                                        ?>'>
                                        <div class="row">
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="col-md-3"> 
                                                </div>  
                                                <div class="col-md-6"> 
                                                    <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
                                                </div>
                                                <div class="col-md-3"> 
                                                </div> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
</section>
<!--main content end-->
<!--footer start-->

<!-- page end--><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>




<script>
    $(document).ready(function () {



        $('.multi-select').change(function () {


            var tot = 0;
            $.each($('select.multi-select option:selected'), function () {
                var curr_val = $(this).data('id');
                tot = tot + curr_val;
            }
            );
            var discount = $('#dis_id').val();
            var gross = tot - discount;
            $('#editPaymentForm').find('[name="subtotal"]').val(tot).end()
            $('#editPaymentForm').find('[name="grsss"]').val(gross)
        }

        );


    });


    $(document).ready(function () {
        $('#dis_id').keyup(function () {
            var val_dis = 0;
            var amount = 0;
            var ggggg = 0;
            amount = $('#subtotal').val();
            val_dis = this.value;
            ggggg = amount - val_dis;
            $('#editPaymentForm').find('[name="grsss"]').val(ggggg)
        });
    });

</script> 
