<?php

/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 4/21/2015
 * Time: 8:21 AM
 */

class Admin extends CI_Controller {



    public function index(){

        $this->login();

        //$this->addCategory();

    }



    public function introForm(){

//		$person_id = isset($this->session->user_data('person_id'))?$this->session->user_data('person_id'):0;


        if(  $this->session->userdata('user_id') ){
            $person_id =  $this->session->userdata('user_id');
        }else{

            $person_id = 1;
        }


        $this->load->model('post');



        $data['data'] = $this->post->getIntro($person_id);
        $length = count($data,1);
        //echo $length;

        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }


        if($length==8){
            $this->load->view('dash/dash_header');
            $this->load->view('dash/introformind', $data);
            $this->load->view('dash/dash_footer');
        }
        else{
            $this->load->view('dash/dash_header');
            $this->load->view('dash/introform', $data);
            $this->load->view('dash/dash_footer');
        }


    }


    /*MAM. Irfan*/

    public function generateRandomString() {
        $length = 20;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }








    public function login(){

        if($this->session->userdata('user_id')){
            $this->introForm();
        }else{


            $this->load->view('dash/dash_header');
            $this->load->view('dash/login');
            $this->load->view('dash/dash_footer');
        }
    }

    public function logout(){

        $this->session->unset_userdata('user_id');

        $this->login();


    }


    public function authenticate(){

        if(!$this->session->userdata('user_id')){

            $user = isset($_POST['username'])?$_POST['username']:null;
            $pass = isset($_POST['password'])?$_POST['password']:null;

            $this->load->model('user');


            $user_id = $this->user->authenticate($user,$pass);
//            print_r($user_id['id']);
            if($user_id){

                $this->session->set_userdata('user_id',$user_id['UserID'] );
                $this->session->set_userdata('userName', $user);

                $added = $this->user->twoStepAdded($user_id['UserID']);
                if(!$added){
                    $this->twoStep();
                }
                else{
                    $this->verifyMobile();
                }



            }else{
                $this->phpAlert("Username or Password is wrong.. Verify your Email if you haven't did that :)");
                $this->login();
            }

        }else{

            $this->introForm();

        }


    }


    public function mobileVerify(){
        $user_id = $this->session->userdata('user_id');

        $pin = isset($_POST['pin']) ? $_POST['pin'] : '';

        $this->load->model('user');
        $this->user->verifyMobileNo($user_id,$pin);

        $verified = $this->user->verified($user_id);
        if($verified){
            $this->introForm();
        }
        else{

            $this->verifyMobile();

/*            $this->phpAlert("You exceeded the tries..");
            $this->logout();*/

        }

    }


    public function mobileVerifyRequest(){

        $flag = isset($_POST['twostep']) ? $_POST['twostep'] : '';
        //echo $flag;

        if(!$flag){
            $this->introForm();
        }
        else{
            $this->addMobileRequest();

        }

    }


    public function addMobile(){

        $phone = isset($_POST['mobile']) ? $_POST['mobile'] : '';

        $user_id = $this->session->userdata('user_id');

        $data = array(
            'Address' => $phone
        );

        $this->load->model('user');
        $this->user->addMobileNo($user_id,$data);

        $this->verifyMobile();
    }



    public function addMobileRequest(){
        $this->load->view('dash/dash_header');
        $this->load->view('dash/addmobile.php');
        $this->load->view('dash/dash_footer');
    }

    public function verifyMobile(){



        $this->load->view('dash/dash_header');
        $this->load->view('dash/verifymobile.php');
        $this->load->view('dash/dash_footer');
    }


    public function twoStep(){
        $this->load->view('dash/dash_header');
        $this->load->view('dash/twostep.php');
        $this->load->view('dash/dash_footer');
    }

    public function register(){
        $this->load->view('dash/dash_header');
        $this->load->view('dash/register.php');
        $this->load->view('dash/dash_footer');
    }

    public function addUser(){

        $this->load->view('dash/recaptchalib.php');

        $privatekey = "6Ld0jAYTAAAAAFWKBdAsDt6VZHuh3NEoEHehMAuN";
        $resp = recaptcha_check_answer ($privatekey,
            $_SERVER["REMOTE_ADDR"],
            $_POST["recaptcha_challenge_field"],
            $_POST["recaptcha_response_field"]);

        // if CAPTCHA is incorrectly entered!
        if (!$resp->is_valid) {
            $this->phpAlert("Re-captcha typed incorrectly...");
            $this->login();
        } else {
            // CAPTCHA entries are correct

            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';
            $conf_password = isset($_POST['conf_password']) ? $_POST['conf_password'] : '';
            $flag = isset($_POST['category']) ? $_POST['category'] : '';

            if (isset($email) && isset($password) && isset($conf_password) && isset($flag)) {

                if ($password == $conf_password) {

                    $password = sha1($password);
                    $verifyCode = $this->generateRandomString();
                    $data = array(
                        'Email' => $email,
                        'Password' => $password,
                        'Flag' => $flag,
                        'VerifyCode' => $verifyCode
                    );

                    $this->load->model('user');

                    $id = $this->user->addTempNewUser($data);

                    if($id){

                        $this->sendVerificationEmail($email,$verifyCode);
                        $this->index();
                    }
                    else{
                        $this->index();
                    }


                }

            } else {
                echo "Required Files Not Recieved...";
            }
        }

    }


    public function sendVerificationEmail($email,$verifyCode)
    {


        /*Set your email information*/
        $from = array('email' => 'micropaysystem@gmail.com', 'name' => 'Micro Payment');
        $to = array($email);
        $subject = 'Verification Email';
        $message = "Hi! \r\n Welcome to Secure Micropayment Scheme. \r\n
        Confirmation link: \r\n
        Click this link to activate your Account \r\n https://localhost/MicroPayment/Verify/" . $verifyCode . "\r\n Thank You";

        /*Load CodeIgniter Email library*/
        $this->load->library('Email');

        /*Sometimes you have to set the new line character for better result*/
        $this->email->set_newline("\r\n");

        /*Set email preferences*/
        $this->email->from($from['email'], $from['name']);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        /*Ready to send email and check whether the email was successfully sent*/

        if (!$this->email->send()) {
            /*Raise error message*/
            show_error($this->email->print_debugger());
        } else {
            /*Show success notification or other things here
            echo 'Success to send email';*/
            $this->phpAlert("Please Check your inbox and verify your account to continue...");
        }
    }




    public function updateUser(){


        $personID = isset($_POST['ReaderID'])? $_POST['ReaderID']:'' ;
        $PersonName = isset($_POST['PersonName'])? $_POST['PersonName']:'' ;
        $AddressOne = isset($_POST['AddressOne'])? $_POST['AddressOne']:'' ;
        $AddressTwo = isset($_POST['AddressTwo'])? $_POST['AddressTwo']:'' ;
        $City = isset($_POST['City'])? $_POST['City']: '';
        $Province = isset($_POST['Province'])? $_POST['Province']: '';
        $PostalCode = isset($_POST['PostalCode'])? $_POST['PostalCode']: '';
        $Phone = isset($_POST['Phone'])? $_POST['Phone']: '';
        $Email = isset($_POST['Email'])? $_POST['Email']:'';
        $DateOfBirth = isset($_POST['DateOfBirth'])? $_POST['DateOfBirth']: '';
        $Nationality = isset($_POST['Nationality'])? $_POST['Nationality']: '';

        $data = array(

            'PersonName' => $PersonName,
            'AddressOne' => $AddressOne,
            'AddressTwo' => $AddressTwo,
            'City' => $City,
            'Province' => $Province,
            'PostalCode' => $PostalCode,
            'Phone' => $Phone,
            'Email' => $Email,
            'DateOfBirth' => $DateOfBirth,
            'Nationality' => $Nationality
        );

        $this->load->model('user');

        if(isset($personID)){

            $this->user->updateIntro($personID, $data);
            /*$ref = $this->input->server('HTTP_REFERER', TRUE);
            redirect($ref, 'location');*/
            $this->load->helper('url');
            redirect('https://localhost/MicroPayment/Admin/introForm','refresh');
        }



    }

    public function updateIndustry(){

        echo "update";
    $personID = isset($_POST['IndustryID'])? $_POST['IndustryID']:'' ;
    $Name = isset($_POST['Name'])? $_POST['Name']:'' ;
    $Email = isset($_POST['Email'])? $_POST['Email']:'';
    $Phone = isset($_POST['Phone'])? $_POST['Phone']: '';
    $Address = isset($_POST['Address'])? $_POST['Address']:'' ;
    $RegistrationNo = isset($_POST['RegistrationNo'])? $_POST['RegistrationNo']:'' ;


    $data = array(

        'Name' => $Name,
        'Email' => $Email,
        'Phone' => $Phone,
        'Address' => $Address,
        'RegistrationNo' => $RegistrationNo
    );

    $this->load->model('user');


        if(isset($personID)){

            $this->user->updateIntroIndustry($personID, $data);
           /* $ref = $this->input->server('HTTP_REFERER', TRUE);
            redirect($ref, 'location');*/
            $this->load->helper('url');
            redirect('https://localhost/MicroPayment/Admin/introForm','refresh');
        }



}


    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }


}
