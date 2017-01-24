Payment<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <i class="fa fa-money"></i>   <?php  echo lang('payment_procedures'); ?> 
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table "> 
                    <div class="clearfix">
                        <a href="finance/addPaymentCategoryView">
                            <div class="btn-group">
                                <button id="" class="btn green">
                                    <i class="fa fa-plus-circle"></i>  <?php  echo lang('create_payment_procedure'); ?> 
                                </button>
                            </div>
                        </a>
                        <button class="export" onclick="javascript:window.print();"> <?php  echo lang('print'); ?> </button>  
                    </div>
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> <?php  echo lang('procedures'); ?> </th>
                                <th> <?php  echo lang('description'); ?> </th>
                                <th> <?php  echo lang('amount'); ?> </th>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <th> <?php  echo lang('options'); ?> </th>
                                <?php } ?>
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

                        <?php foreach ($categories as $category) { ?>
                            <tr class="">
                                <td><?php echo $category->category; ?></td>
                                <td> <?php echo $category->description; ?></td>
                                <td><?php echo $category->c_price; ?></td>
                                <?php if ($this->ion_auth->in_group('admin')) { ?>
                                    <td>
                                        <a class="btn btn-info btn-xs editbutton width_auto" href="finance/editPaymentCategory?id=<?php echo $category->id; ?>"><i class="fa fa-edit">  <?php  echo lang('edit'); ?></i></a>
                                        <a class="btn btn-info btn-xs delete_button width_auto" href="finance/deletePaymentCategory?id=<?php echo $category->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash-o"></i>  <?php  echo lang('delete'); ?></a>
                                    </td>
                                <?php } ?>
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
