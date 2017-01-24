<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-sitemap"></i>  <?php echo lang('medical_history'); ?> 
            </header> 
            <div class="panel-body col-md-8">
                <div class="adv-table editable-table ">
                    <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                        <div class="clearfix">
                            <a data-toggle="modal" href="#myModal">
                                <div class="btn-group">
                                    <button id="" class="btn green">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_history'); ?> 
                                    </button>
                                </div>
                            </a>
                            <button class="export" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>  
                        </div>
                    <?php } ?>
                    <div class="space15"></div>




                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('options'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medical_histories as $medical_history) { ?>
                                <tr class="">
                                    <td>1</td>
                                    <td><?php echo $medical_history->date; ?></td>
                                    <td><?php echo $medical_history->description; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-xs btn_width detail" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-edit"></i> <?php  echo lang('details'); ?></button> 
                                        <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>               
                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medical_history->id; ?>"><i class="fa fa-edit"></i> <?php  echo lang('edit'); ?></button>     
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="patient/delete_medical_history?id=<?php echo $medical_history->id; ?>&p_id=<?php echo $patient->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i> <?php  echo lang('delete'); ?></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <style>

                .panel{background: #f1f1f1;}
                .profile{
                    background: #f9f9f9;
                }

                .m_t{
                    margin-top: 10%;
                }

            </style>


            <section class="panel col-md-4 m_t">
                <div class="panel-body profile">

                    <div class="task-thumb-details">
                        Patient Name: <h1><a href="#"><?php echo $patient->name; ?></a></h1> <br>
                        Address: <p><?php echo $patient->address; ?></p>
                    </div>
                </div>
                <table class="table table-hover personal-task">
                    <tbody>
                        <tr>
                            <td>
                                <i class=" fa fa-envelope"></i>
                            </td>
                            <td><?php echo $patient->email; ?></td>

                        </tr>
                        <tr>
                            <td>
                                <i class="fa fa-phone"></i>
                            </td>
                            <td><?php echo $patient->phone; ?></td>

                        </tr>

                    </tbody>
                </table>
            </section>

        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Department Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i> <?php echo lang('add_history'); ?></h4>
            </div> 
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" multiple="" name="img_url[]">
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Department Modal-->

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?> </h4>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?></label>
                        <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('image'); ?></label>
                        <input type="file" multiple="" name="img_url[]">
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button">Submit</button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<style>
    .modal img{
        width: 70px;
        height: 70px;
    }
</style>

<!-- See Details Modal-->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> <?php echo lang('details'); ?></h4>

            </div>
            <div class="modal-body">



                <div class="panel-body profile">

                    <div class="task-thumb-details">
                        <?php echo lang('created'); ?>: <h1 id="date"></h1> <br>
                        <?php echo lang('description'); ?>: <p id="description">dasdas</p>
                    </div>
                </div>
                <div class="panel-body profile">

                    <div class="task-thumb-details">
                        <a href="" id="img_url_a"><img id="img_url" src=""></a>
                    </div>
                    <div class="task-thumb-details">
                        <a href="" id="img_url_a1"><img id="img_url1" src=""></a>
                    </div>
                    <div class="task-thumb-details">
                        <a href="" id="img_url_a2"><img id="img_url2" src=""></a>
                    </div>
                    <div class="task-thumb-details">
                        <a href="" id="img_url_a3"><img id="img_url3" src=""></a>
                    </div>
                    <div class="task-thumb-details">
                        <a href="" id="img_url_a4"><img id="img_url4" src=""></a>
                    </div>
                    <div class="task-thumb-details">
                        <a href="" id="img_url_a5"><img id="img_url5" src=""></a>
                    </div>
                </div>







            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>












<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
                                                $(document).ready(function () {
                                                    $(".editbutton").click(function (e) {
                                                        e.preventDefault(e);
                                                        // Get the record's ID via attribute  
                                                        var iid = $(this).attr('data-id');
                                                        $('#myModal2').modal('show');
                                                        $.ajax({
                                                            url: 'patient/editMedicalHistoryByJason?id=' + iid,
                                                            method: 'GET',
                                                            data: '',
                                                            dataType: 'json',
                                                        }).success(function (response) {
                                                            // Populate the form fields with the data returned from server
                                                            $('#medical_historyEditForm').find('[name="id"]').val(response.medical_history.id).end()
                                                            $('#medical_historyEditForm').find('[name="date"]').val(response.medical_history.date).end()
                                                            CKEDITOR.instances['editor'].setData(response.medical_history.description)
                                                        });
                                                    });
                                                });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".detail").click(function (e) {
            e.preventDefault(e);
            // Get the record's ID via attribute  
            var iid = $(this).attr('data-id');
            $('#myModal3').modal('show');
            $.ajax({
                url: 'patient/getMedicalHistoryByPatientByJason?id=' + iid,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).success(function (response) {
                // Populate the form fields with the data returned from server
                $('#patient').empty()
                $('#patient').append(response.medical_history.patient).end()
                $('#date').empty()
                $('#date').append(response.medical_history.date).end()
                $('#description').empty()
                $('#description').append(response.medical_history.description).end()
                var url = response.medical_history.img_url;
                var arr = url.split(',');

                $('#img_url').attr("src", arr[0]);
                $('#img_url_a').attr("href", arr[0]);
                $('#img_url1').attr("src", arr[1]);
                $('#img_url_a1').attr("href", arr[1]);
                $('#img_url2').attr("src", arr[2]);
                $('#img_url_a2').attr("href", arr[2]);
                $('#img_url3').attr("src", arr[3]);
                $('#img_url_a3').attr("href", arr[3]);
                $('#img_url4').attr("src", arr[4]);
                $('#img_url_a4').attr("href", arr[4]);
                $('#img_url5').attr("src", arr[5]);
                $('#img_url_a5').attr("href", arr[5]);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
