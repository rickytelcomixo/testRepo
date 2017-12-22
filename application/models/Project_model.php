<?php
class Project_model extends CI_Model {
	public function __construct()
    {
        $this->load->database();
    }

    public function get_project($id="")
    {
        $sql = "SELECT A.* FROM project A  ";
        $cond = "";
        if($id != ""){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.ID = ".$id;
        }
        $cond .= " ORDER BY ID ASC";
        $query = $this->db->query($sql.$cond);

        if ($query->num_rows () > 0) {
            return $query->result_array ();
        } else {
            return false;
        }
    }


}