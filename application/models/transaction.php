<?php
/**
 * Created by IntelliJ IDEA.
 * User: Fasna
 * Date: 29-Sep-15
 * Time: 11:16 AM
 */

class transaction extends CI_Model
{

    public function x_Encrypt($string, $key)
    {
        for($i=0; $i<strlen($string); $i++)
        {
            for($j=0; $j<strlen($key); $j++)
            {
                $string[$i] = $string[$i]^$key[$j];
            }
        }

        return $string;
    }

    public function x_Decrypt($string, $key)
    {
        for($i=0; $i<strlen($string); $i++)
        {
            for($j=0; $j<strlen($key); $j++)
            {
                $string[$i] = $key[$j]^$string[$i];
            }
        }

        return $string;
    }

    public function transferAccountDetails($data){

        $articleValue = $data[1];
        $userID = $data[2];

        $this->load->model('post');
        $data['data'] = $this->post->getAccount($userID);
        //print_r($data);

        $initialRandom = $data['data'][0]['RandomKey'];
        $balance = $data['data'][0]['Balance'];

        if($balance < $articleValue){
            $this->load->model('user');
            $this->user->phpAlert("You don't have enough balance to read the article. Please Reload!");
            return 0;
        }
        else{
            $encryptedRandom = $this->x_Encrypt($initialRandom,$articleValue);
            $encryptedBalance = $this->x_Encrypt($balance,$articleValue);

            $encryptedArray = array($encryptedRandom,$encryptedBalance);

            return $encryptedArray;
        }



    }

    public function processReadRequest($encrypted){

        $articleValue = $encrypted[2];
        $randomKey = $this->x_Decrypt($encrypted[0], $articleValue);
        $balance = $this->x_Decrypt($encrypted[1], $articleValue);


        $dataForReader = array($articleValue,$randomKey,$balance);
        return $dataForReader;

    }

    public function hashString($str,$amount){
        $i = 0;
        //$hashedString="";
        while($i < $amount){

            $str= md5($str);
            $i++;
            //echo $i;
        }

        return $str;

    }

    public function updateData($updatedData){

        $newToken = $updatedData[0];
        $newBalance = $updatedData[1];
        $articleValue = $updatedData[2];
        $userID = $updatedData[3];

        $this->load->model('post');
        $data['data'] = $this->post->getAccount($userID);
        $randomString = $data['data'][0]['Token'];

        $randomForAuthenticate = $this -> hashString($newToken,$articleValue);

        $diffInString = strcmp($randomString, $randomForAuthenticate);

        $newData = array('Balance' => $newBalance, 'Token' => $newToken);

        $this->load->model('user');
        if(!($diffInString)){
            $this->user->updateBalance($userID,$newData);
            return 1;
        }
        else{

            $this->user->phpAlert("The transaction didn't completed successfully!");
            return 0;
        }





    }

}
