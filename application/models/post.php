<?php


class Post extends CI_Model{
	

	
	

	public function addIntroDetails($data){
		
		$sql =  $this->db->insert_string('user', $data);
		
		$this->db->query($sql);
		
		return $this->db->insert_id();
		
		
	}
	



	public function getIntro($UserID){

		$this->db->select('Flag');
		$this->db->from('user');
		$this->db->where(array('UserID'=>$UserID));
		$query = $this->db->get();
		$flag = $query->row()->Flag;




		if ($flag==1){
			$this->db->select('ReaderID,PersonName,AddressOne,AddressTwo,City,Province,PostalCode,Phone,Email,DateOfBirth,Nationality');
			$this->db->from('reader');
			$this->db->where(array('UserID'=>$UserID));
			$query = $this->db->get();

			return $query->result_array();
		}
		else if($flag==0){

			$this->db->select('IndustryID,Name,Address,Phone,Email,RegistrationNo');
			$this->db->from('industries');
			$this->db->where(array('UserID'=>$UserID));
			$query = $this->db->get();

			return $query->result_array();
		}
		else{
			return -1;
		}




		
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