<!--/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 6/3/2015
 * Time: 4:46 PM
 */    -->

<body xmlns="http://www.w3.org/1999/html">
<div class="ch-container">
    <div class="row">

    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>More Security To Your Account </h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Create A Mobile Verification Method To Your Account
            </div>
            <form class="form-horizontal" action="<?php echo base_url('Admin/mobileVerifyRequest'); ?>" method="post">
                <fieldset>

                    <div class="form-group">
                        <label for="exampleCategory"> Do You Like To Create A Mobile Verification Method To Your Account Now?</label><br>
                        <input type="radio" name="twostep" value="1">Yes<br>
                        <input type="radio" name="twostep" value="0">No
                    </div>

                        <p class="center col-md-10">
                            <button type="submit" name = "proceed" class="btn btn-primary">Proceed</button>
                        </p>

                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->
