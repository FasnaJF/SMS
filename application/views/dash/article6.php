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
                        <li><a class="ajax-link" href="<?php echo base_url('Admin/authenticate');?>"><i class="glyphicon glyphicon-home"></i><span> Personal Info</span></a>
                        </li>
                        <li><a class="ajax-link" href="<?php echo base_url('Admin/accountForm');?>"><i class="glyphicon glyphicon-eye-open"></i><span> Account</span></a>
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
                            <h2><i class="glyphicon glyphicon-edit"></i> Newspaper</h2>

                            <div class="box-icon">
                                <a href="#" class="btn btn-setting btn-round btn-default"><i
                                        class="glyphicon glyphicon-cog"></i></a>
                                <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                        class="glyphicon glyphicon-chevron-up"></i></a>
                                <a href="#" class="btn btn-close btn-round btn-default"><i
                                        class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div>
                        <div class="box-content news" >


                            <div class="box-inner col-md-12" >

                                <h1 style="text-align: center">News Today</h1>
                                <p style="float: right"><?php echo date("l,d.m.Y");?></p>

                            </div>

                            <div id="6" class="box-inner col-md-126" >

                                <h3>Lorem Ipsum</h3>
<!--                                <form method="post" id="form1" name="form1" role="form" action="--><?php //echo(base_url('Admin/readArticle')); ?><!--" >-->
<!--                                    <button class="btn btn-3 btn-3b icon-star-2">-->
<!--                                        <input type="hidden" id="six" name="article" class="form-control" value="--><?php //echo($values[5]['ArticleID']);?><!--">-->
<!--                                        <input type="hidden" name="value" class="form-control" value="--><?php //echo($values[5]['Value']);?><!--">-->
<!--                                        <h2 style=" color: #ffffff;">Read for Rs.--><?php //echo($values[5]['Value']);?><!--</h2>-->
<!--                                    </button>-->
<!--                                </form>-->
                                <img alt="image 6" src="../dash_img/6.jpg" style="width: 400px; height: 300px;"/>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                                </p>


                            </div>



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