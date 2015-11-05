<?php


class Post extends CI_Model{
	

	
	

	public function addIntroDetails($data){
		
		$sql =  $this->db->insert_string('user', $data);
		
		$this->db->query($sql);
		
		return $this->db->insert_id();
		
		
	}
	



	public function getIntro($UserID){

//		$this->db->select('Flag');
//		$this->db->from('user');
//		$this->db->where(array('UserID'=>$UserID));
//		$query = $this->db->get();
//		//$flag = $query->row()->Flag;



			$this->db->select('ReaderID,PersonName,AddressOne,AddressTwo,City,Province,PostalCode,Phone,Email,DateOfBirth,Nationality');
			$this->db->from('reader');
			$this->db->where(array('UserID'=>$UserID));
			$query = $this->db->get();

			return $query->result_array();


	}



	public function getAccount($UserID){

			$this->db->select('Balance,Token,RandomKey');
			$this->db->from('readeraccount');
			$this->db->where(array('UserID'=>$UserID));
			$query = $this->db->get();

			return $query->result_array();


	}

	public function getArticleValues(){

		$this->db->select('ArticleID,Value');
		$this->db->from('article');
		$query = $this->db->get();

		return $query->result_array();


	}

	public function getMenus($personID){

        /**
        return ]s a 2D array if MenuNames, MenuIDs
         **/
        $this->db->select('MenuID, MenuName');
        $this->db->from('menu');
        $this->db->where(array('UserID'=>$personID));
        $query = $this->db->get();

        return $query->result_array();


    }





    public function getMenuId($UserID,$MenuName){

        $this->db->select('MenuID');
        $this->db->from('menu');
        $this->db->where(array('UserID'=>$UserID,'MenuName'=>$MenuName));
        $query = $this->db->get();

        return array_shift($query->result_array());


    }


	
}


?>