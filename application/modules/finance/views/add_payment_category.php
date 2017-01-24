<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($category->id))
                    echo '<i class="fa fa-edit"></i> '.lang('edit_payment_procedure');
                else
                    echo '<i class="fa fa-plus-circle"></i> '.lang('add_payment_procedure');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <?php echo validation_errors(); ?>
                                    <form role="form" action="finance/addPaymentCategory" method="post" enctype="multipart/form-data">

                                        <div class="form-group"> 
                                            <label for="exampleInputEmail1"> <?php  echo lang('procedure'); ?> </label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->category)) {
                                                echo $category->category;
                                            }
                                            ?>' placeholder="">    
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('description'); ?> </label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->description)) {
                                                echo $category->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"> <?php  echo lang('procedure_price'); ?> </label>
                                            <input type="text" class="form-control" name="c_price" id="exampleInputEmail1" value='<?php
                                            if (!empty($category->c_price)) {
                                                echo $category->c_price;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <!--
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Doctor's Commission</label>
                                            <input type="text" class="form-control" name="d_commission" id="exampleInputEmail1" value='<?php
                                        if (!empty($category->d_commission)) {
                                            echo $category->d_commission;
                                        }
                                        ?>' placeholder="">
                                        </div>
                                        -->
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($category->id)) {
                                            echo $category->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info"> <?php  echo lang('submit'); ?> </button>
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
