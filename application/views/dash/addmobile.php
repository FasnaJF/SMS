<!--/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 6/3/2015
 * Time: 8:26 PM
 */   -->

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
                    <p>Type The Mobile Number You Want To Add</p>

                </div>
                <form class="form-horizontal" action="<?php echo base_url('Admin/addMobile'); ?>" method="post">
                    <fieldset>

                        <div class="input-group input-group-lg">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                            <input type="text" class="form-control" placeholder="Your Phone Number" name="mobile">
                        </div>
                        <div class="clearfix"></div><br>

                        <p class="center col-md-10">
                            <button type="submit" name = "addmobile" class="btn btn-primary">Add Mobile</button>
                        </p>

                    </fieldset>
                </form>
            </div>
            <!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->

</div><!--/.fluid-container-->
