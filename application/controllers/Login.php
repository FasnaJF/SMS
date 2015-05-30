<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 4/21/2015
 * Time: 8:25 AM
 */

require 'Admin.php';

class Login extends CI_Controller{



    public function index(){

//		 $this->admin = new Admin();

        if(!$this->session->userdata('user_id')){

            $this->admin->introForm($this->session->userdata('user_id'));

        }else{
            $this->admin->login();
        }

    }


    public function authenticate(){

        if(!$this->session->userdata('user_id')){

            $user = isset($_POST['username'])?$_POST['username']:null;
            $pass = isset($_POST['password'])?$_POST['password']:null;

            $this->load->model('user');


            if($this->user->authenticate($user,$pass)){

                $this->admin->introForm();

            }else{
                $this->admin->login();
            }

        }else{

            $this->admin->login();

        }


    }

    public function default_page(){

    }


}

?>