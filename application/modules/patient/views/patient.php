<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>   <?php echo lang('patient'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i> <?php echo lang('register_new_patient'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('patient_id'); ?></th>                        
                                <th><?php echo lang('image'); ?></th>
                                <th><?php echo lang('name'); ?></th>
                                <th><?php echo lang('phone'); ?></th>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <th><?php echo lang('due_balance'); ?></th>
                                <?php } ?>
                                <th><?php echo lang('options'); ?></th>
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
                        </style>
                        <?php foreach ($patients as $patient) { ?>
                            <tr class="">
                                <td> <?php echo $patient->patient_id; ?></td>
                                <td style="width:10%;"><img style="width:95%;" src="<?php echo $patient->img_url; ?>"></td>
                                <td> <?php echo $patient->name; ?></td>
                                <td><?php echo $patient->phone; ?></td>


                                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                    <td> <?php echo $settings->currency; ?>
                                        <?php
                                        $query = $this->db->get_where('payment', array('patient' => $patient->id))->result();

                                        $balance = array();

                                        foreach ($query as $gross) {

                                            $balance[] = $gross->gross_total - $gross->amount_received;
                                        }
                                        $balance = array_sum($balance);

                                        $due_balance = $balance;

                                        echo $due_balance;

                                        $due_balance = NULL;
                                        ?>
                                    </td>
                                <?php } ?>






                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" style="width: 100px;" data-toggle="modal" data-id="<?php echo $patient->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>   
                                    <a class="" href="patient/patientDetails?id=<?php echo $patient->id; ?>"><button type="button" class="btn btn-info btn-xs btn_width detailsbutton" style="width: 60px;"><i class="fa fa-info"> <?php echo lang('info'); ?></i></button></a>   
                                    <?php if ($this->ion_auth->in_group(array('admin', 'Accountant'))) { ?>
                                        <a class="btn btn-info btn-xs btn_width invoicebutton" style="width: 100px;" href="finance/invoicePatientTotal?id=<?php echo $patient->id; ?>"><i class="fa fa-file-text"></i> <?php echo lang('invoice'); ?></a>


                                        <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="finance/addPaymentByPatientView?id=<?php echo $patient->id; ?>&type=gen"><i class="fa fa-money"></i> <?php echo lang('payment'); ?></a>
                                    <?php } ?>
                                    <a class="btn btn-info btn-xs btn_width add_payment_button" style="width: 100px;" href="patient/medicalHistory?id=<?php echo $patient->id; ?>"><i class="fa fa-files-o"></i> <?php echo lang('history'); ?></a>
                                    <a class="btn btn-info btn-xs btn_width delete_button" style="width: 100px;" href="patient/delete?id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php echo lang('delete'); ?></a>
                                </td>
                            </tr>
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






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('patient_registration'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control m-bot15" name="doctor" value=''> 
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->name; ?>" <?php
                                            if (!empty($patient->doctor)) {
                                                if ($patient->doctor == $doctor->name) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?> ><?php echo $doctor->name; ?> </option>
                                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="" required>

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder=""  required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value='' required>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('male'); ?> </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('female'); ?> </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('others'); ?> </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" required>      
                    </div>
<!--

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value='' required>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>
-->
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value='<?php
                    if (!empty($patient->patient_id)) {
                        echo $patient->patient_id;
                    }
                    ?>'>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit_patient'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-md-12">     
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-3 payment_label"> 
                                    <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                                </div>
                                <div class="col-md-9"> 
                                    <select class="form-control m-bot15" name="doctor" value=''> 
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->name; ?>" <?php
                                            if (!empty($patient->doctor)) {
                                                if ($patient->doctor == $doctor->name) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?> ><?php echo $doctor->name; ?> </option>
                                                <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">

                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                        <select class="form-control m-bot15" name="sex" value=''>

                            <option value="Male" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Male') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('male'); ?> </option>
                            <option value="Female" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Female') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('female'); ?> </option>
                            <option value="Others" <?php
                            if (!empty($patient->sex)) {
                                if ($patient->sex == 'Others') {
                                    echo 'selected';
                                }
                            }
                            ?> > <?php echo lang('others'); ?> </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo lang('birth_date'); ?></label>
                        <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="<?php
                        if (!empty($patient->birthdate)) {
                            echo $patient->birthdate;
                        }
                        ?>" placeholder="">      
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                        <select class="form-control m-bot15" name="bloodgroup" value=''>
                            <?php foreach ($groups as $group) { ?>
                                <option value="<?php echo $group->group; ?>" <?php
                                if (!empty($patient->bloodgroup)) {
                                    if ($group->group == $patient->bloodgroup) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $group->group; ?> </option>
                                    <?php } ?> 
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="id" value=''>
                    <input type="hidden" name="p_id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Patient Modal-->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editPatientForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'patient/editPatientByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server

                                                    $('#editPatientForm').find('[name="id"]').val(response.patient.id).end()
                                                    $('#editPatientForm').find('[name="doctor"]').val(response.patient.doctor).end()
                                                    $('#editPatientForm').find('[name="name"]').val(response.patient.name).end()
                                                    $('#editPatientForm').find('[name="password"]').val(response.patient.password).end()
                                                    $('#editPatientForm').find('[name="email"]').val(response.patient.email).end()
                                                    $('#editPatientForm').find('[name="address"]').val(response.patient.address).end()
                                                    $('#editPatientForm').find('[name="phone"]').val(response.patient.phone).end()
                                                    $('#editPatientForm').find('[name="sex"]').val(response.patient.sex).end()
                                                    $('#editPatientForm').find('[name="birthdate"]').val(response.patient.birthdate).end()
                                                    $('#editPatientForm').find('[name="bloodgroup"]').val(response.patient.bloodgroup).end()
                                                    $('#editPatientForm').find('[name="p_id"]').val(response.patient.patient_id).end()
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

