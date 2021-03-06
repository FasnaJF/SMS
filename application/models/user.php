<?php


class User extends CI_Model
{

    public function authenticate($user, $pass)
    {

        $pass = sha1($pass);
        $this->db->select('UserID')->from('user')->where(array('Email' => $user, 'Password' => $pass));
        $query = $this->db->get();

        $result = $query->result_array();
        return array_shift($result);


    }

    public function addTempNewUser($data)
    {

        $email = $data['Email'];

        $querytemp = $this->db->get_where('tempuser',array('Email'=>$email));
        $existtemp = $querytemp->num_rows();

        $queryuser = $this->db->get_where('user',array('Email'=> $email));
        $existuser = $queryuser->num_rows();

        if($existtemp || $existuser){
            $this->phpAlert("An account with this Email already exists");
            $userId=0;
        }
        else {

            $sql = $this->db->insert_string('tempuser', $data);
            $this->db->query($sql);

            $userId = $this->db->insert_id();
        }
        return $userId;

    }

    public function getTempUser($verifyCode)
    {

        $query = $this->db->get_where('tempuser',array('VerifyCode' => $verifyCode),1);
        return ($query->result_array());
    }

    public function deleteTempUser($verifyCode)
    {

        $query = $this->db->delete('tempuser',array('VerifyCode' => $verifyCode),1);

    }

    public function addNewUser($data)
    {
        $email = $data['Email'];
        $password = $data['Password'];
        //print_r($data);

        $query = $this->db->get_where('user',array('Email'=>$email));

        $exist = $query->num_rows();

        if($exist){
            $this->phpAlert("The Email already exists");
        }
        else{



            $sql = $this->db->insert_string('user', $data);
            $this->db->query($sql);

            $userId =  $this->db->insert_id();


                array_pop($data);
                $data['UserID'] = $userId;
                $data['Password'] = $password;
                print_r($data);
                $sql = $this->db->insert_string('reader', $data);
                $this->db->query($sql);


                $data = array();
                $data['MenuName'] = "Personal_Info";
                $data['UserID'] = $userId;
                $sql = $this->db->insert_string('menu', $data);
                $this->db->query($sql);

                $data = array();
                $data['MenuName'] = "Account";
                $data['UserID'] = $userId;
                $sql = $this->db->insert_string('menu', $data);
                $this->db->query($sql);
        }

    }



    public function addPin($data){


        $address = substr($data['address'],4);
        $data['Address'] = $address;

        $query = $this->db->get_where('authuser',array('Address'=>$address));

        $exist = $query->num_rows();

        if(!$exist){
            $this->phpAlert("The number You tried to get the code is different from you entered");
        }
        else {
            $data['Flag'] = 0;
            $where = "Address = " . $address;
            $sql = $this->db->update_string('authuser', $data, $where);
            $this->db->query($sql);
        }

    }

    public function addMobileNo($UserID,$data){

        $data['UserID'] = $UserID;


        $sql = $this->db->insert_string('authuser', $data);
        $this->db->query($sql);


    }

    public function twoStepAdded($UserID){

        $query = $this->db->get_where('authuser',array('UserID'=>$UserID));

        $exist = $query->num_rows();

        if($exist) {
            return true;
        }
        else{
            return false;
        }

    }

    public function verifyMobileNo($UserID, $pin){

        $query = $this->db->get_where('authuser',array('UserID'=>$UserID,'Pin'=>$pin));

        $exist = $query->num_rows();

        if($exist){

            $where = "UserID = " . $UserID;
            $data['Flag'] = 1;
            $sql = $this->db->update_string('authuser', $data, $where);
            $this->db->query($sql);
            $this->phpAlert("Your Mobile number verified successfully");

        }
        else{
            $this->phpAlert("You entered a wrong pin. Please try again");

        }
    }

    public function verified($UserID){
        $query = $this->db->get_where('authuser',array('UserID'=>$UserID,'Flag'=>1));
        $exist = $query->num_rows();
        if($exist){
            return true;
        }
        else{
            return false;
        }

    }

    public function updateIntro($UserID, $data)
    {

        $where = "ReaderID = " . $UserID;
        $sql = $this->db->update_string('reader', $data, $where);

        $query = $this->db->query($sql);


    }


    public function updateBalance($UserID, $data)
    {

        $queryBalance = $this->db->get_where('readeraccount',array('USerID'=> $UserID));
        $existUser = $queryBalance->num_rows();

        if($existUser){
            $where = "UserID = " . $UserID;
            $sql = $this->db->update_string('readeraccount', $data, $where);

            $query = $this->db->query($sql);
        }
        else {
            $data['UserID'] = $UserID;
            $sql = $this->db->insert_string('readeraccount', $data);
            $this->db->query($sql);

        }




    }




    public function getAllUsers()
    {
        $this->db->select('UserID, PersonName');
        $this->db->from('user');
       // $this->db->where(array('CatID'=>$catID));
        $query = $this->db->get();

        return $query->result_array();

    }


    public function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

}