<?php
class Report_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
    //Function to fetch report 
    public function display_report(){
        $this -> load -> helper('url');
        $this -> db -> select ('*');
        $this -> db -> from ('vehicle_data');
        $this -> db -> order_by('vehicle_id','desc');
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
        $retrieved=$result->result_array();
        return $retrieved;
        }
        else{
        return FALSE;
        }
}
    }