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

        foreach ($tempuser as $row)
        {
            $data['Email'] = $row['Email'];
            $data['Password'] = $row['Password'];
            $data['Flag'] = $row['Flag'];
            $id=$this->user->addNewUser($data);

        }
        $this->user->deleteTempUser($verifyCode);

        $this->phpAlert("Your email address verified successfully...");
        $this->load->helper('url');
        redirect('https://localhost/MicroPayment/Admin');
       // redirect('https://www.google.com');

    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }


}