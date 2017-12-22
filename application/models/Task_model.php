<?php
class Task_model extends CI_Model {
	public function __construct()
    {
        $this->load->database();
    }

    public function get_task($id="", $startDate="", $endDate="")
    {
        $sql = "SELECT A.*,B.PNAME as PROJECT FROM task A  
                LEFT JOIN project B on A.PROJECTID = B.ID ";
        $cond = "";
        if($id != ""){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " A.ID = ".$id;
        }

        if($startDate!='' && $endDate !=''){
            $cond .= $cond == ''? " WHERE ":" AND ";
            $cond .= " DATE(A.TDATE) BETWEEN  DATE('".$startDate."') AND DATE('".$endDate."') ";
        }

        $cond .= " ORDER BY TDATE ASC";
        $query = $this->db->query($sql.$cond);

        if ($query->num_rows () > 0) {
            return $query->result_array ();
        } else {
            return false;
        }
    }


}