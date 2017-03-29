<!--sidebar end-->
<!--main content start-->
<section id="main-content"> 
    <section class="wrapper site-min-height">
        <!--state overview start-->

        <?php if (!$this->ion_auth->in_group('Patient')) { ?>
            <div class="row state-overview">
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="doctor">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol terques">
                                <i class="fa fa-stethoscope"></i>
                            </div>
                            <div class="value"> 
                                <h1 class="">
                                    <?php echo $this->db->count_all('doctor'); ?>
                                </h1> 
                                <p> <?php  echo lang('doctor'); ?> </p>
                            </div>
                        </section>
                        <?php if (!$this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="patient">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol blue">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('patient'); ?>
                                </h1>
                                <p> <?php  echo lang('patient'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="nurse">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol yellow">
                                <i class="fa fa-female"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('nurse'); ?>
                                </h1>
                                <p> <?php  echo lang('nurse'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="pharmacist">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol terques">
                                <i class="fa  fa-medkit"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('pharmacist'); ?>
                                </h1>
                                <p> <?php  echo lang('pharmacist'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="laboratorist">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol blue">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('laboratorist'); ?>
                                </h1>
                                <p> <?php  echo lang('laboratorist'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="accountant">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol yellow">
                                <i class="fa fa-money"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('accountant'); ?>
                                </h1>
                                <p> <?php  echo lang('accountant'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="finance/payment">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol blue">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('payment'); ?>
                                </h1>
                                <p> <?php  echo lang('payment'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>


                <div class="col-lg-3 col-sm-6">
                    <?php if ($this->ion_auth->in_group('admin')) { ?>
                        <a href="medicine">
                        <?php } ?>
                        <section class="panel">
                            <div class="symbol blue">
                                <i class="fa fa-medkit"></i>
                            </div>
                            <div class="value">
                                <h1 class="">
                                    <?php echo $this->db->count_all('medicine'); ?>
                                </h1>
                                <p> <?php  echo lang('medicine'); ?> </p>
                            </div>
                        </section>
                        <?php if ($this->ion_auth->in_group('admin')) { ?>
                        </a>
                    <?php } ?>
                </div>
                <?php if ($this->ion_auth->in_group('admin')) { ?>
                   <div class="col-lg-6 col-sm-6">    
                        <a href="finance/payment">
                            <section class="panel">
                                <div class="symbol terques">
                                    <i class="fa fa-bar-chart-o"></i>
                                </div>
                                <div class="value">
                                    <h1 class=" count14">
                                        <?php echo $settings->currency; ?> <?php 
                                        
                                          
                                        $query = $this->db->get_where('payment')->result();

                                        $balance = array();

                                        foreach ($query as $gross) {

                                            $balance[] = $gross->gross_total - $gross->amount_received;
                                        }
                                        $balance = array_sum($balance);

                                        $due_balance = $balance;
                            
                                        echo number_format($due_balance, 2); ?>
                                    </h1>
                                    <p> <?php  echo lang('all_total_due'); ?> </p>
                                </div>
                            </section>         
                        </a>     
                    </div>  -->
                <?php } ?>

            </div>



        <?php } ?>


        <aside class="col-lg-12">
            <section class="panel">
                <div class="panel-body">
                    <div id="calendar" class="has-toolbar calendar_view"></div>
                </div>
            </section>
        </aside>









        <!--state overview end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->


</body>
</html>
