<?php
class Users extends CI_Model {
	public function __construct()
    {
            $this->load->database();
    }

    public function getUser($id='', $username='', $password=''){
    	$sql = "SELECT A.*, B.TITLE as userType, B.RANK FROM users A 
                LEFT JOIN user_type B ON A.userTypeId = B.ID ";
    	$cond = '';

    	if($id!=''){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.id = ".$id;
        }

        if($username!=''){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.username = '".$username."'";
        }

        if($password!=''){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.password = '".$password."'";
        }
		
        $query = $this->db->query($sql.$cond);
        return $query->result_array();
    }

    public function getUserType($id=''){
        $sql = "SELECT * FROM user_type";
        $cond = '';

        if($id!=''){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " ID = ".$id;
        }
        
        $query = $this->db->query($sql.$cond);
        return $query->result_array();
    }
	
	public function insertUpdateUser($params){
        $sql = "INSERT INTO users 
                (id, username, password, fullname) 
                VALUES (
                    '".$params['id']."',
                    '".$params['username']."',
                    '".$params['password']."',
                    '".$params['fullname']."'
                )
                ON DUPLICATE KEY UPDATE 
                id = values(id),
                username = values(username),
                password = values(password),
                fullname = values(fullname)
        ";
        $query = $this->db->query($sql);
        return $query;
    }
}

?>