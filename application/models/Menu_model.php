<?php
class Menu_model extends CI_Model {
	public function __construct()
    {
        $this->load->database();
    }

    public function get_menu($id="")
    {
        $sql = "SELECT A.* FROM menu A  ";
        $cond = "";
        if($id != ""){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.ID = ".$id;
        }
        $cond .= " ORDER BY POSITION ASC";
        $query = $this->db->query($sql.$cond);

        if ($query->num_rows () > 0) {
            return $query->result_array ();
        } else {
            return false;
        }
    }

    public function get_menu_access($userId="")
    {
        $sql = "SELECT * FROM menu_access A  
                LEFT JOIN menu B ON B.ID = A.MENUID 
                LEFT JOIN users C ON C.id = A.USERID ";
        $cond = "";

        if($userId != ""){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.USERID = ".$userId;
        }
        $cond .= " ORDER BY B.POSITION ASC";
        $query = $this->db->query($sql.$cond);

        if ($query->num_rows () > 0) {
            return $query->result_array ();
        } else {
            return false;
        }
    }


}