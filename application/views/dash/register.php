<body>
    <!-- topbar starts -->
   <?php include_once('dash_topbar.php');
   ?>
    <!-- topbar ends -->
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
                        <li><a class="ajax-link" href="<?php echo base_url('Admin/authenticate');?>"><i class="glyphicon glyphicon-home"></i><span> Personal Info</span></a>
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

</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> New User Information</h2>

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
                <form role="form" method="post" action="<?php echo(base_url('Admin/addUser')); ?> ">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="examplePass">Password</label>
                        <input name="password" type="password" class="form-control" id="examplePass" placeholder="Enter Password"  >

                    </div>
                     <div class="form-group">
                        <label for="exampleRePass">Re-type Password</label>
                        <input name="conf_password" type="password" class="form-control" id="exampleRePass" placeholder="Re type Password" onkeyup="checkPass(); return false;">
                         <span id="confirmMessage" class="confirmMessage"></span>
                    </div>

                    <div class="form-group">
                        <label for="exampleCategory">Please choose your account type:</label><br>
                        <input type="radio" name="category" value="1">Reader
                        <input type="radio" name="category" value="0">Industry
                    </div>

                    <div class="form-group">
                        <?php
                            $this->load->view('dash/recaptchalib.php');
                            $publickey = "6Ld0jAYTAAAAAA54T7fVuCNNxxZs9OhzdRNm9DGm";
                            echo recaptcha_get_html($publickey,NULL,true);
                        ?>
                    </div>

                    <button type="submit" name="user" class="btn btn-default">Register</button>

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