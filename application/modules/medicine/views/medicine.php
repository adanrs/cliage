<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-medkit"></i>    <?php  echo lang('medicine'); ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">
                        <a data-toggle="modal" href="#myModal">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php  echo lang('add_medicine'); ?>
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();">Print</button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('name'); ?></th>
                                <th> <?php  echo lang('category'); ?></th>
                                <th> <?php  echo lang('price'); ?></th>
                                <th> <?php  echo lang('quantity'); ?></th>
                                <th> <?php  echo lang('generic_name'); ?></th>
                                <th> <?php  echo lang('company'); ?></th>
                                <th> <?php  echo lang('effects'); ?></th>
                                <th> <?php  echo lang('expire_date'); ?></th>
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

                        </style>

                        <?php foreach ($medicines as $medicine) { ?>
                            <tr class="">
                                <td><?php echo $medicine->name; ?></td>
                                <td> <?php echo $medicine->category; ?></td>
                                <td><?php echo $settings->currency; ?> <?php echo $medicine->price; ?></td>
                                <td> <?php if ($medicine->quantity <= 0) {
                            echo 'Out of Stock';
                        } else {
                            echo $medicine->quantity;
                        } ?></td>
                                <td class="center"><?php echo $medicine->generic; ?></td>
                                <td><?php echo $medicine->company; ?></td>
                                <td><?php echo $medicine->effects; ?></td>
                                <td> <?php echo $medicine->e_date; ?></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $medicine->id; ?>"><i class="fa fa-edit"> <?php  echo lang('edit'); ?></i></button>   
                                    <a class="btn btn-info btn-xs btn_width delete_button" href="medicine/delete?id=<?php echo $medicine->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"> <?php  echo lang('delete'); ?></i></a>
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
                <h4 class="modal-title"><i class="fa fa-plus-circle"></i>  <?php  echo lang('add_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
<?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('expire_date'); ?></label>
                        <input type="text" class="form-control default-date-picker" name="e_date" id="exampleInputEmail1" value='' placeholder="">
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
                <h4 class="modal-title"><i class="fa fa-edit"></i>  <?php  echo lang('edit_medicine'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editMedicineForm" action="medicine/addNewMedicine" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('name'); ?></label>
                        <input type="text" class="form-control" name="name" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('category'); ?></label>
                        <select class="form-control m-bot15" name="category" value=''>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->category; ?>" <?php
                                if (!empty($medicine->category)) {
                                    if ($category->category == $medicine->category) {
                                        echo 'selected';
                                    }
                                }
                                ?> > <?php echo $category->category; ?> </option>
<?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('price'); ?></label>
                        <input type="text" class="form-control" name="price" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('quantity'); ?></label>
                        <input type="text" class="form-control" name="quantity" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('generic_name'); ?></label>
                        <input type="text" class="form-control" name="generic" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('company'); ?></label>
                        <input type="text" class="form-control" name="company" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('effects'); ?></label>
                        <input type="text" class="form-control" name="effects" id="exampleInputEmail1" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php  echo lang('expire_date'); ?></label>
                        <input type="text" class="form-control" name="e_date" id="exampleInputEmail1" value='' placeholder="">
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
                                                $('#editMedicineForm').trigger("reset");
                                                $('#myModal2').modal('show');
                                                $.ajax({
                                                    url: 'medicine/editMedicineByJason?id=' + iid,
                                                    method: 'GET',
                                                    data: '',
                                                    dataType: 'json',
                                                }).success(function (response) {
                                                    // Populate the form fields with the data returned from server
                                                    $('#editMedicineForm').find('[name="id"]').val(response.medicine.id).end()
                                                    $('#editMedicineForm').find('[name="name"]').val(response.medicine.name).end()
                                                    $('#editMedicineForm').find('[name="price"]').val(response.medicine.price).end()
                                                    $('#editMedicineForm').find('[name="quantity"]').val(response.medicine.quantity).end()
                                                    $('#editMedicineForm').find('[name="generic"]').val(response.medicine.generic).end()
                                                    $('#editMedicineForm').find('[name="company"]').val(response.medicine.company).end()
                                                    $('#editMedicineForm').find('[name="effects"]').val(response.medicine.effects).end()
                                                    $('#editMedicineForm').find('[name="e_date"]').val(response.medicine.e_date).end()
                                                });
                                            });
                                        });
</script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>

