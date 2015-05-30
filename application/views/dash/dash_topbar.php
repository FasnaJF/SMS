<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
<!-- topbar starts -->
<div class="navbar navbar-default" role="navigation">

    <div class="navbar-inner">

        <a class="navbar-brand" href="#"> <img alt="Charisma Logo" src="../dash_img/logoo.png" class="hidden-xs"/>MicroPayment</a>

        <!-- user dropdown starts -->
        <div class="btn-group pull-right">
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs">
                    <?php

                    if(isset($userName)){
                        echo $userName;
                    }else{
                        echo "user";
                    }

                    ?>
                    </span>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="#">Profile</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo(base_url('Admin/logout'));?>">Logout</a></li>
            </ul>
        </div>
        <!-- user dropdown ends -->


    </div>
</div>
<!-- topbar ends -->