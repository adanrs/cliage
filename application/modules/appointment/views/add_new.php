
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($appointment->id))
                    echo '<i class="fa fa-edit"></i> Edit Appointment';
                else
                    echo '<i class="fa fa-plus-circle"></i> Add New Appointment';
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="appointment/addNew" method="post" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="patient" value=''> 
                                                    <option value=""><?php echo lang('select'); ?>.....</option>
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
                                        <div class="col-md-12">
                                            <div class="col-md-3 payment_label"> 
                                                <label for="exampleInputEmail1">  <?php echo lang('doctor'); ?></label>
                                            </div>
                                            <div class="col-md-9"> 
                                                <select class="form-control m-bot15" name="doctor" value='' required>  
                                                    <option value=""><?php echo lang('select'); ?>.....</option>
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
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>

                                            <input type="text" class="form-control default-date-picker" required readonly="" name="date" id="exampleInputEmail1" value='' placeholder="" >

                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                                            <div class="col-md-4">
                                                <div class="input-group bootstrap-timepicker">
                                                    <input type="text" class="form-control timepicker-default" name="s_time" id="exampleInputEmail1" value="" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                                            <div class="col-md-4">
                                                <div class="input-group bootstrap-timepicker">
                                                    <input type="text" class="form-control timepicker-default" name="e_time" id="exampleInputEmail1" value="" required>
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                                            <input type="text" class="form-control" name="remarks" id="exampleInputEmail1" value='<?php
                                            if (!empty($appointment->address)) {
                                                echo $appointment->address;
                                            }
                                            ?>' placeholder=""> 
                                        </div>



                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($appointment->id)) {
                                            echo $appointment->id;
                                        }
                                        ?>'>


                                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                                    </form>

                                </div>
                            </section>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
