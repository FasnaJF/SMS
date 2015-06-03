<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 6/3/2015
 * Time: 2:56 PM
 */

class App extends SMS_Controller{

    public function index()
    {
//		$this->load->view('welcome_message');
        redirect(base_url('Admin/index'), 'location');
    }

    public function test(){


        $address = $this->address;
        $this->smssender->sms('hello', $this->address);

//       file_put_contents('filename.txt', print_r($array, true), FILE_APPEND);


    }

    public function receive(){

//        $this->load->model('User');



        $address = $this->address;
        $content = $this->content;

        $keys = explode(' ', strtolower(trim($content)));

        if($keys[1]== 'pin'){


            $pin = $this->generateRandKey(5);

            $this->user->addPin(array('address'=>$address, 'pin'=>$pin));

            $message = "Your pin is : $pin . Type this pin in the web page to verify your account.";

            $this->sms($message, $address);

            return;

        }
        elseif( $keys[1] == 'help'){

            //$this->sms("I don't understand..", $address);

            $array = array();

                $array[] = "To get your PIN send PWD PIN to 77100";
                $array[] = "When you get the pin type it in the web page to authenticate your number.";



            foreach($array as $sms){
                $this->sms($sms, $address);
            }
            return;
            //send help

        }else{

            $this->sms("I don't understand..", $address);

        }

    }



    public function generateRandKey($len=4){

        $alpha_numeric = '0123456789abcdefghijklmnpqrstuwxyz';
        return substr(str_shuffle($alpha_numeric), 0, $len);

    }

    public function acts(){
        $this->load->model('Users');


        var_dump($this->Users->approveUser(5));
    }

    private function sendSms($sms, $address)
    {

        $this->load->library('SmsSender');
        //$this->SmsSender();

        return $this->smssender->sms($sms, $address);
    }

}