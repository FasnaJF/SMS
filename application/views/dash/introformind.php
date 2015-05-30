<body>

<?php include_once("dash_topbar.php"); ?>


<div class="ch-container">
    <div class="row">

        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="<?php echo base_url('Admin/authenticateIndustry');?>"><i class="glyphicon glyphicon-home"></i><span> Personal Info</span></a>
                        </li>
                        <li><a class="ajax-link" href="<?php echo base_url('Admin/account/?cat=Account');?>"><i class="glyphicon glyphicon-eye-open"></i><span> Account</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
                <!--    <ul class="breadcrumb">-->
                <!--        <li>-->
                <!--            <a href="#">Home</a>-->
                <!--        </li>-->
                <!--        <li>-->
                <!--            <a href="#">Forms</a>-->
                <!--        </li>-->
                <!--    </ul>-->
            </div>

            <div class="row">
                <div class="box col-md-12">
                    <div class="box-inner">
                        <div class="box-header well" data-original-title="">
                            <h2><i class="glyphicon glyphicon-edit"></i> Personal Information</h2>

                            <div class="box-icon">
                                <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content">
                            <form method="post" role="form" action="<?php echo(base_url('Admin/updateIndustry')); ?>">

                                <!--                    --><?php //var_dump($data[0]); ?>

                                <input type="hidden" name="IndustryID" value="<?php echo(isset($data[0]['IndustryID'])? $data[0]['IndustryID']:'');?>">
                                <div class="form-group">
                                    <label for="exampleName">Name</label>
                                    <input type="text" name="Name" value = "<?php echo(isset($data[0]['Name'])? $data[0]['Name']:'');?>" class="form-control" id="exampleName" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="Email" value = "<?php echo(isset($data[0]['Email'])? $data[0]['Email']:'');?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="examplePhone">Phone</label>
                                    <input type="text" name="Phone" value = "<?php echo(isset($data[0]['Phone'])? $data[0]['Phone']:'');?>" class="form-control" id="examplePhone" placeholder="Enter Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleAddress">Address</label>
                                    <input typeof="text" name="Address" value = "<?php echo(isset($data[0]['Address'])? $data[0]['Address']:'');?>" type="text" class="form-control" id="exampleAddress" placeholder="Enter Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleBlog">Registration Number</label>
                                    <input type="text" name="RegistrationNo" value = "<?php echo(isset($data[0]['RegistrationNo'])? $data[0]['RegistrationNo']:'');?>" class="form-control" id="exampleBlog" placeholder="Enter Registration No">
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Check me out
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
                <!--/span-->

            </div><!--/row-->

            <!-- content ends -->
        </div><!--/#content.col-md-0-->
    </div><!--/fluid-row-->

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="#" target="_blank">SMS CMS</a>2014</p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: SMS </p>
    </footer>

</div><!--/.fluid-container-->