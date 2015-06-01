<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 5/26/2015
 * Time: 10:53 AM
 */



class Verify extends CI_Controller{


    public function index($verifyCode){

        $data = array();
        $this->load->model('user');
        $tempuser = $this->user->getTempUser($verifyCode);
        //print_r ($tempuser);

       $length = sizeof($tempuser);
        //$code =  ($tempuser[0]['VerifyCode']);
       // echo $code;

        if($length > 0){

            $this->phpAlert("Your email address verified successfully...");

            foreach ($tempuser as $row)
            {
                $data['Email'] = $row['Email'];
                $data['Password'] = $row['Password'];
                $data['Flag'] = $row['Flag'];
                $id=$this->user->addNewUser($data);

            }
            $this->user->deleteTempUser($verifyCode);


            $this->load->helper('url');
            redirect('https://localhost/MicroPayment/Admin','refresh');
        }
        else{
            $this->phpAlert("You entered a Expired or Invalid URL...");
            $this->load->helper('url');
            redirect('https://localhost/MicroPayment/Admin','refresh');
        }

    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }


}