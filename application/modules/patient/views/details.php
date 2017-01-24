<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <section class="panel">
            <!-- page start-->
            <div class="row">
                <aside class="profile-nav col-lg-3">
                    <section class="panel">
                        <div class="user-heading round">
                            <a>
                                <img src="<?php echo $patient->img_url ?>" alt="">
                            </a>
                            <h1><?php echo $patient->name ?></h1>
                         <!--   <p><?php echo $patient->email ?></p> -->
                        </div>
                    </section>
                </aside>
                <aside class="profile-info col-lg-9">
                    <section class="panel">
                        <div class="bio-graph-heading">
                            <?php echo lang('doctor'); ?> : <?php echo $patient->doctor; ?>
                        </div>
                        <div class="panel-body bio-graph-info">
                            <h1><?php echo lang('bio_graph'); ?></h1>
                            <div class="row">
                                <div class="bio-row">
                                    <p><span><?php echo lang('name'); ?> </span>: <?php echo $patient->name; ?></p>
                                </div>
                                <!--
                                <div class="bio-row">
                                    <p><span>Email </span>: <?php echo $patient->email; ?></p>
                                </div>
                                -->
                                <div class="bio-row">
                                    <p><span><?php echo lang('address'); ?></span>: <?php echo $patient->address; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('phone'); ?> </span>: <?php echo $patient->phone; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('sex'); ?> </span>: <?php echo $patient->sex; ?></p>
                                </div>
                                <!--
                                <div class="bio-row">
                                    <p><span>Birth Date </span>: <?php echo $patient->birthdate; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span>Blood Group </span>: <?php echo $patient->bloodgroup; ?></p>
                                </div>
                                -->
                                <div class="bio-row">
                                    <p><span><?php echo lang('doctor'); ?> </span>: <?php echo $patient->doctor; ?></p>
                                </div>
                                <div class="bio-row">
                                    <p><span><?php echo lang('patient_id'); ?> </span>: <?php echo $patient->patient_id; ?></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
