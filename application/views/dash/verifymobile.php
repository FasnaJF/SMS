<!--/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 6/3/2015
 * Time: 5:10 PM
 */    -->

<body xmlns="http://www.w3.org/1999/html">
<div class="ch-container">
    <div class="row">

        <div class="row">
            <div class="col-md-12 center login-header">
                <h2>Two Step Authentication Page</h2>
            </div>
            <!--/span-->
        </div><!--/row-->

        <div class="row">
            <div class="well col-md-5 center login-box">
                <div class="alert alert-info">
                    <p>How To Create A Mobile Verification Method To Your Account</p>

                    <p>* Type PWD PIN and SEND to 77100 to get your PIN</p>
                    <p>* Now type the PIN here to authenticate your mobile number</p>

                </div>
                <form class="form-horizontal" action="<?php echo base_url('Admin/mobileVerify'); ?>" method="post">
                    <fieldset>

                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                            <input type="text" class="form-control" placeholder="Your Pin" name="pin">
                        </div>
                        <div class="clearfix"></div><br>

                        <p class="center col-md-10">
                            <button type="submit" name = "authenticate" class="btn btn-primary">Authenticate</button>
                        </p>

                    </fieldset>
                </form>
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div><!--/.fluid-container-->
