<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 6/3/2015
 * Time: 2:56 PM
 */

class JobApp extends SMS_Controller{

    public function index()
    {
//		$this->load->view('welcome_message');
        redirect(base_url('home/index'), 'location');
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

            $this->user_m->add(array('address'=>$address, 'pin'=>$pin));

            $message = "Your pin is : $pin . send PWD ACT $pin to 77100 to verify your account.";

            $this->sms($message, $address);

            return;

        }
        elseif($keys[1] == 'act'){

            $pin = $keys[2];

            $user_id = $this->user_m->getIdByPin($pin);

            if($user_id){

                $this->user_m->update($user_id, array('flag'=>STATUS_ACTIVE));
                $message = "Thank you. Your account is activated.  Send PWD HELP to get the HELP";

            }else{
                $message = "PIN MISMATCH. Please send PWD PIN to obtain your pin";
            }

            return $this->sms($message, $address);

        }
        elseif($keys[1] == 'add'){

            if(empty($keys[2]) || !isset($keys[2])){
                $response = "Please select a category to add. Send EJ CAT to see the categories.";
            }else{

                $this->load->model('category_m');
                $this->load->model('subscription_m');

                $cat = $keys[2];

                if(is_numeric($cat)){
                    $catId = $this->category_m->getById($cat);
                }else{
                    $catId = $this->category_m->getByKey($cat);
                }

                if($catId){
                    $this->subscription_m->add($this->user_m->getIdByAddress($address), $catId);
                    $response = "Category $cat is added to your profile";

                }else{
                    $response = "Invalid Category, Send EJ CAT to get the list";
                }
            }

            return $this->sms($response, $address);
        }
        else if( $keys[1] == 'cat'){

            $this->load->model('Jobs');
            $cats = $this->Jobs->getAllCats();

            $sms = "";
            foreach($cats as $cat){
                $sms .= $cat['id'].'. '.$cat['name'].PHP_EOL;
            }

            if(strlen($sms)>125){
                $sms_array = str_split($sms, 125);

                $i=1;
                foreach($sms_array as $sms){

                    $this->sms($i.'/'.strlen($sms_array).PHP_EOL.$sms, $address);
                    $i++;
                }

            }

            return $this->sms($sms, $address);

        }
        elseif( $keys[1] == 'help'){

            //$this->sms("I don't understand..", $address);

            $array = array();

            if($address[0] == 't'){
                $array[] = "To get your PIN send EJ PIN to 77100. To view all the categories send EJ CAT to 77100";
                $array[] = "To subscribe to a category send EJ ADD CategoryNO ( eg. EJ ADD 1 ) to 77100";
            }
            else{
                $array[] = "To get your PIN send EJ PIN to 4499. To view all the categories send EJ CAT to 4499";
                $array[] = "To subscribe to a category send EJ ADD CategoryNO ( eg. EJ ADD 1 ) to 4499";
            }


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