<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-user"></i>   <?php  echo lang('doctors'); ?>    
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php  echo lang('add_doctor'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php  echo lang('print'); ?></button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('doctor_id'); ?></th>
                                <th> <?php  echo lang('name'); ?></th>
                                <th> <?php  echo lang('email'); ?></th>
                                <th> <?php  echo lang('address'); ?></th>
                                <th> <?php  echo lang('phone'); ?></th>
                                <!--
                                <th>Departmnt</th>
                                -->
                                <th> <?php  echo lang('profile'); ?></th>
                                <th> <?php  echo lang('options'); ?></th>
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

                            .m_t{
                                margin-top: 2px !important;
                            }

                        </style>

                        <?php foreach ($doctors as $doctor) { ?>
                            <tr class="">
                                <td><?php echo $doctor->id; ?></td>
                                <td> <?php echo $doctor->name; ?></td>
                                <td><?php echo $doctor->email; ?></td>
                                <td class="center"><?php echo $doctor->address; ?></td>
                                <td><?php echo $doctor->phone; ?></td>
                                <!--
                                <td class="center"><?php echo $doctor->department; ?></td>
                                -->
                                <td><?php echo $doctor->profile; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $doctor->id; ?>"><i class="fa fa-edit"> <?php  echo lang('edit'); ?></i></button>   
                                    <a class="btn btn-info btn-xs btn_width add_payment_button m_t" style="width: 100px;" href="appointment/getAppointmentByDoctorId?id=<?php echo $doctor->id; ?>"> <?php  echo lang('appointments'); ?></a>
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="doctor/delete?id=<?php echo $doctor->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> <?php  echo lang('delete'); ?></i></a>
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






<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_doctor'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="exampleInputEmail1">Department</label>
                        <select class="form-control m-bot15" name="department" value=''>
                    <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->name; ?>" <?php
                        if (!empty($doctor->department)) {
                            if ($department->name == $doctor->department) {
                                echo 'selected';
                            }
                        }
                        ?> > <?php echo $department->name; ?> </option>
                    <?php } ?> 
                        </select>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('profile'); ?></label>
                        <input type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php  echo lang('edit_doctor'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('password'); ?></label>
                        <input type="password" class="form-control" name="password" id="exampleInputEmail1" placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('email'); ?></label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('address'); ?></label>
                        <input type="text" class="form-control" name="address" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('phone'); ?></label>
                        <input type="text" class="form-control" name="phone" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="exampleInputEmail1">Department</label>
                        <select class="form-control m-bot15" name="department" value=''>
                    <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->name; ?>" <?php
                        if (!empty($doctor->department)) {
                            if ($department->name == $doctor->department) {
                                echo 'selected';
                            }
                        }
                        ?> > <?php echo $department->name; ?> </option>
                    <?php } ?> 
                        </select>
                    </div>
                    -->
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('profile'); ?></label>
                        <input type="text" class="form-control" name="profile" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('image'); ?></label>
                        <input type="file" name="img_url">
                    </div>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                        $(document).ready(function () {
                                            $(".editbutton").click(function (e) {
                                                e.preventDefault(e);
                                                // Get the record's ID via attribute  
                                                var iid = $(this).attr('data-id');
                                                $('#editDoctorForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'doctor/editDoctorByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editDoctorForm').find('[name="id"]').val(response.doctor.id).end()
                                                    $('#editDoctorForm').find('[name="name"]').val(response.doctor.name).end()
                                                    $('#editDoctorForm').find('[name="password"]').val(response.doctor.password).end()
                                                    $('#editDoctorForm').find('[name="email"]').val(response.doctor.email).end()
                                                    $('#editDoctorForm').find('[name="address"]').val(response.doctor.address).end()
                                                    $('#editDoctorForm').find('[name="phone"]').val(response.doctor.phone).end()
                                                    //       $('#editDoctorForm').find('[name="department"]').val(response.doctor.department).end()
                                                    $('#editDoctorForm').find('[name="profile"]').val(response.doctor.profile).end()
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

