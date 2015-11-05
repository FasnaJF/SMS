<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


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

//mam . irfan

//public function hashIt(){
//
//    $amount = $_POST['amount'];
//    $balance  = $_POST['balance'];
//    $this->load->view('dash/dash_header');
//    echo $amount;
//    echo "<br>";
//    echo $balance;
//    echo "<br>";
//    $this->load->library('encrypt');
//
//    $randomKey = 'awser432weds';
//
//    $string = $balance . $randomKey;
//
//    for($x= 1; $x <= $amount; $x++ ){
//    $string =  $this->encrypt->hash($string);
//
//    echo $x + "::";
//    echo $string;
//
//    echo "<br>";
//    }
//
//
//   // $this->load->view('dash/hashit',$data);
//    $this->load->view('dash/dash_footer');
//
//}

public function getBankDetails(){


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


    foreach($_POST as $key => $value){
     $data[$key] = $this->input->post($key);
    // echo $key ."===>".$data[$key];
}
    $this->load->view('dash/dash_header');
    $this->load->view('dash/bankDetail',$data);
    $this->load->view('dash/dash_footer');

}

public function pay(){
    foreach($_POST as $key => $value){
     $data[$key] = $this->input->post($key);
    //echo $key ."===>".$data[$key];
}
    $uid = $this->session->userdata('user_id');
    $this->load->model('accountDetail');
    $this->accountDetail->save($data['cardnumber'],$data['balance'],$data['pay'],$data['expdate_month'],$data['expdate_year'],$data['CVN'],$uid);

    $this->accountForm();

}




// mam. irfan


    public function introForm(){

//		$person_id = isset($this->session->user_data('person_id'))?$this->session->user_data('person_id'):0;


        if(  $this->session->userdata('user_id') ){
            $person_id =  $this->session->userdata('user_id');
        }else{

            $person_id = 1;
        }


        $this->load->model('post');



        $data['data'] = $this->post->getIntro($person_id);
        //$length = count($data,1);
        //echo $length;

        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }



            $this->load->view('dash/dash_header');
            $this->load->view('dash/introform', $data);
            $this->load->view('dash/dash_footer');



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


            if (isset($email) && isset($password) && isset($conf_password) ) {

                if ($password == $conf_password) {

                    $password = sha1($password);
                    $verifyCode = $this->generateRandomString();
                    $data = array(
                        'Email' => $email,
                        'Password' => $password,
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



    public function bankDetails(){

        $user_id = $this->session->userdata('user_id');

        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }



        $amount = isset($_POST['Amount'])? $_POST['Amount']:'' ;
        $balance = isset($_POST['Balance'])? $_POST['Balance']:'';

//        echo $amount;
//        echo $balance;

        if($balance > 0){
            $this->load->model('post');
            $data['data'] = $this->post->getAccount($user_id);
            $randomString = $data['data'][0]['Token'];
            $initialRandom = $data['data'][0]['RandomKey'];


        }
        else{
            $randomString = $this->generateRandomString();
            $initialRandom = $randomString;

        }

        $this->load->model('transaction');
        $token = $this->transaction->hashString($randomString,$amount);


        if((is_numeric($amount)) && ($amount > 0)){

            $data['Amount'] = $amount;
            $data['Balance'] = $balance;
            $data['Token'] = $token;
            $data['RandomKey'] = $initialRandom;

            $this->load->view('dash/dash_header');
            $this->load->view('dash/bankDetail', $data);
            $this->load->view('dash/dash_footer');
        }
        else{
            $this->phpAlert("Please Enter a Positive Numeric Value!");
            $this->accountForm();
        }


    }

    public function updateAccount(){

        if(  $this->session->userdata('user_id') ){
            $personID =  $this->session->userdata('user_id');
        }else{

            $personID = 1;
        }


        $Amount = isset($_POST['Amount'])? $_POST['Amount']:'' ;
        $Balance = isset($_POST['Balance'])? $_POST['Balance']:'' ;
        $Token = isset($_POST['Token'])? $_POST['Token']:'' ;
        $RandomKey = isset($_POST['Random'])? $_POST['Random']:'' ;
        $CreditCardType = isset($_POST['CreditCardType'])? $_POST['CreditCardType']:'' ;
        $CardNumber = isset($_POST['CardNumber'])? $_POST['CardNumber']:'' ;
        $ExpMonth = isset($_POST['ExpMonth'])? $_POST['ExpMonth']:'' ;
        $ExpYear = isset($_POST['ExpYear'])? $_POST['ExpYear']: '';
        $CVN = isset($_POST['CVN'])? $_POST['CVN']: '';

        //echo $Token;

        $currentMonth = date('m');
        $currentYear = date('Y');

        if ((($ExpYear - $currentYear) <= 0) && (($ExpMonth - $currentMonth) <= 0)){
                $this->phpAlert("You entered a Expired Card");
               $this->accountForm();
        }
        else{
            $data = array(

                'Balance' => (int)$Balance + (int)$Amount,
                'CreditCardType' => $CreditCardType,
                'CardNumber' => $CardNumber,
                'ExpMonth' => (int)$ExpMonth,
                'ExpYear' => (int)$ExpYear,
                'CVN' => $CVN,
                'Token' => $Token,
                'RandomKey' =>$RandomKey
            );

            $this->load->model('user');

            if(isset($personID)){
                $this->user->updateBalance($personID, $data);
                $this->accountForm();
            }
        }






    }

    public function accountForm(){

//		$person_id = isset($this->session->user_data('person_id'))?$this->session->user_data('person_id'):0;


        if(  $this->session->userdata('user_id') ){
            $person_id =  $this->session->userdata('user_id');
        }else{

            $person_id = 1;
        }


        $this->load->model('post');



        $data['data'] = $this->post->getAccount($person_id);


        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }


            $this->load->view('dash/dash_header');
            $this->load->view('dash/accountform', $data);
            $this->load->view('dash/dash_footer');



    }

    public function openTest(){



        $this->load->view('dash/dash_header');
        $this->load->view('dash/test');
        $this->load->view('dash/dash_footer');



    }

    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }



    public function readPaper(){

        if(  $this->session->userdata('user_id') ){
            $person_id =  $this->session->userdata('user_id');
        }else{

            $person_id = 1;
        }
        $this->load->model('post');

        $data['values'] = $this->post->getArticleValues();
        $data['data'] = $this->post->getAccount($person_id);


        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }


        $this->load->view('dash/dash_header');
        $this->load->view('dash/newspaper', $data);
        $this->load->view('dash/dash_footer');

    }

    public function readArticle(){


        $id = isset($_POST['article'])? $_POST['article']:'' ;
        $value = isset($_POST['value'])? $_POST['value']:'' ;

        if(  $this->session->userdata('user_id') ){
            $person_id =  $this->session->userdata('user_id');
        }else{

            $person_id = 1;
        }



        $data = array($id,$value,$person_id);

        if($this->session->userdata('userName'))
        {
            $data['userName'] =$this->session->userdata('userName');}
        else{
            $data['userName'] = 'USECASE';
        }

        $this->load->model('transaction');
        $encrypted = $this->transaction->transferAccountDetails($data);

        if(!$encrypted){

            $data['values'] = $this->post->getArticleValues();
            $this->load->view('dash/dash_header');
            $this->load->view('dash/newspaper', $data);
            $this->load->view('dash/dash_footer');
        }
        else{

            $encrypted[2] = $value;

            $readerData = $this->transaction->processReadRequest($encrypted);

            $articleValue = $readerData[0];
            $randomKey = $readerData[1];
            $balance = $readerData[2];

            $newBalance = ($balance-$articleValue);
            $this->load->model('transaction');
            $updatedToken = $this->transaction->hashString($randomKey,$newBalance);

            $updatedData = array($updatedToken,$newBalance,$articleValue,$person_id);
            $this->load->model('transaction');
            $transactionSuccess = $this->transaction->updateData($updatedData);

            if(!$transactionSuccess){
                $data['values'] = $this->post->getArticleValues();
                $this->load->view('dash/dash_header');
                $this->load->view('dash/newspaper', $data);
                $this->load->view('dash/dash_footer');
            }
            else{
                switch($id){
                    case "1":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article1', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    case "2":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article2', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    case "3":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article3', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    case "4":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article4', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    case "5":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article5', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    case "6":
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/article6', $data);
                        $this->load->view('dash/dash_footer');
                        break;
                    default:
                        $this->load->view('dash/dash_header');
                        $this->load->view('dash/notexist', $data);
                        $this->load->view('dash/dash_footer');

                }


            }

        }


    }



}
