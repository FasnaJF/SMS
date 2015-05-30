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

        $sql = $this->db->insert_string('tempuser', $data);
        $this->db->query($sql);

        $userId =  $this->db->insert_id();

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


        $sql = $this->db->insert_string('user', $data);
        $this->db->query($sql);

        $userId =  $this->db->insert_id();

        $flag = $data['Flag'];


        if($flag==1){

            array_pop($data);
            $data['UserID'] = $userId;
            $sql = $this->db->insert_string('reader', $data);
            $this->db->query($sql);
        }
        else{

            array_pop($data);
            $data['UserID'] = $userId;
            $sql = $this->db->insert_string('industries', $data);
            $this->db->query($sql);
        }


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


    public function updateIntro($UserID, $data)
    {

        $where = "ReaderID = " . $UserID;
        $sql = $this->db->update_string('reader', $data, $where);

        $query = $this->db->query($sql);


    }

    public function updateIntroIndustry($UserID, $data)
    {
        echo $UserID;
        $where = "IndustryID = " . $UserID;
        $sql = $this->db->update_string('industries', $data, $where);

        $query = $this->db->query($sql);


    }


    public function getAllUsers()
    {
        $this->db->select('UserID, PersonName');
        $this->db->from('user');
       // $this->db->where(array('CatID'=>$catID));
        $query = $this->db->get();

        return $query->result_array();

    }

}