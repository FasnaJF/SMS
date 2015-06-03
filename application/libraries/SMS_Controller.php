<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 2/9/2015
 * Time: 5:34 AM
 */

class SMS_Controller extends MY_Controller{

    protected $address;
    protected $content;


    public function __construct(){

        parent::__construct();

        $this->load->library('SmsReceiver');
        $this->load->library('SmsSender');
        $this->load->model('user_m');

        $this->address = $this->smsreceiver->getAddress();
        $this->content = $this->smsreceiver->getMessage();

    }

    public function sms($sms, $address){
        return $this->smssender->sms($sms, $address);
    }

}