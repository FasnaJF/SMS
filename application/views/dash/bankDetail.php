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
            <div class="box-header well" id='myDiv' data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Bank Details</h2>

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
                <form method="post" id="form2" name="form2" role="form" action="<?php echo(base_url('Admin/updateAccount'));?>" >


                    <input type="hidden" id="amount" name="Amount" class="form-control" value="<?php echo $Amount; ?>">
                    <input type="hidden" id="balance" name="Balance" class="form-control" value="<?php echo $Balance; ?>">
                    <input type="hidden" id="token" name="Token" class="form-control" value="<?php echo $Token; ?>">
                    <input type="hidden" id="token" name="Random" class="form-control" value="<?php echo $RandomKey; ?>">

                    <div class="form-group">
                        <label for="card">Card Type</label>
                        <select id="credit_card_type" class="form-control" name="CreditCardType" onchange="">
                            <option value="" disabled selected> -- select an option -- </option>
                            <option value="V">Visa</option>
                            <option value="M">MasterCard</option>
                            <option value="A">American Express</option>
                            <option value="D">Discover</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="card">Card Number</label>
                        <input type="text" id="cardnumber" name="CardNumber" class="form-control" placeholder="Enter Card Number" maxlength="19" size='30'>
                    </div>

                    <div class="form-group">
                        <label for="buy">Expiry Date</label>


                        <select id="expdate_month" name="ExpMonth">

                            <?php
                                for($i=1;$i<=12;$i++){
                                    echo "<option value=".$i.">".(($i<10) ? "0":"").$i."</option>";
                                }
                             ?>
                         </select>

                          <select id="expdate_year" name="ExpYear">

                            <?php
                                for($i=2015;$i<=2035;$i++){
                                    echo "<option value=".$i.">".$i."</option>";
                                }
                             ?>
                         </select>
                    </div>

                    <div class="form-group">
                        <label for="card">Card Verification Number</label>
                        <input type="text" id="CVN" name="CVN" class="form-control" placeholder="Enter Verification Number" maxlength=4>
                    </div>
                     
                    <button type="submit" class="btn btn-default" id='proceed' >Pay</button>
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


