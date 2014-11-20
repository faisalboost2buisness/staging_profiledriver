<?php
	Class Dashboard_model extends CI_Model
	{
        public function __construct()
    	{
    		$this->load->database();
    	}
        function get_count_of_users(){
            $this -> db -> select('registration_id');
            $this -> db ->from('registration');
            $total_user = $this->db->count_all_results();
            if ($total_user > 0)
            {
                return $total_user;
            }else{
               return NULL; 
            }
        }
        function get_dealer_users(){
            $this -> db -> select('registration_id');
            $this -> db ->from('registration');
            $this -> db -> where("usertype = 'dealership'");
            $total_dealers = $this->db->count_all_results();
            if ($total_dealers > 0)
            {
                return $total_dealers;
            }else{
               return NULL; 
            }
        }
        function get_accountmanager(){
            $this -> db -> select('registration_id');
            $this -> db ->from('registration');
            $this -> db -> where('usertype', 'account_managers');
            $total_accountmanagers = $this->db->count_all_results();
            if ($total_accountmanagers > 0)
            {
                return $total_accountmanagers;
            }else{
               return NULL; 
            } 
        }
        //function to get the count of auto brand users
      function get_autobrand(){
        $this -> db -> select('registration_id');
        $this -> db ->from('registration');
        $this -> db -> where('usertype', 'auto_brand');
        $total_auto_brand = $this->db->count_all_results();
        if ($total_auto_brand > 0)
        {
            return $total_auto_brand;
        }else{
           return NULL; 
        } 
      }
      //function to get last 10 user details
      function get_new_user_details(){
        $this -> db -> select('registration.*,autobrand.*,dealership.*,sales_person.*,trainer.*');
        $this -> db ->from('registration');
        $this->db->join('dealership', 'dealership.registration_id= registration.registration_id',"LEFT");
        $this->db->join('autobrand', 'autobrand.registration_id= registration.registration_id',"LEFT");
        $this->db->join('sales_person', 'sales_person.registration_id= registration.registration_id',"LEFT");
        $this->db->join('trainer', 'trainer.registration_id= registration.registration_id',"LEFT");
        $this -> db -> order_by('registration.registration_id', 'DESC');
        $this-> db -> limit('10');
        $result=$this->db->get();
        if($result -> num_rows() >0){
        $returnvalue = $result -> result_array();
        return $returnvalue;
        }
      }
    //function to get month
    function get_dealer_months_count($user_type){
        $current_month='';
        $current_month=date("M");
        $current_year=date('Y');
        $result='';
        $insert='';
        $comacheck=0;
        $current_month_digit='';
            if($current_month=='Jan'){
                $current_month_digit=1;
            }
            elseif($current_month=='Feb'){
                $current_month_digit=2;
            }
            elseif($current_month=='Mar'){
                $current_month_digit=3;
            }
            elseif($current_month=='Apr'){
                $current_month_digit=4;
            }
            elseif($current_month=='May'){
                $current_month_digit=5;
            }
            elseif($current_month=='Jun'){
                $current_month_digit=6;
            }
            elseif($current_month=='Jul'){
                $current_month_digit=7;
            }
            elseif($current_month=='Aug'){
                $current_month_digit=8;
            }
            elseif($current_month=='Sep'){
                $current_month_digit=9;
            }
            elseif($current_month=='Oct'){
                $current_month_digit=10;
            }
             elseif($current_month=='Nov'){
                $current_month_digit=11;
            }
             elseif($current_month=='Dec'){
                $current_month_digit=12;
            }
            for($i=$current_month_digit;$i>0;$i--){
                if($user_type=='all'){
                    $condition='';
                }else{
                    $condition=$this-> db -> where('usertype',$user_type);
                }
                $this ->db ->select('registration_id');
                $this -> db ->from('registration');
                $this -> db -> where('month',$i);
                $this -> db -> where('year',$current_year);
                $condition;
                $result= $this->db->count_all_results();
                    if($comacheck>0)
                    {
                        $insert.=', ' ;
                    }
                $insert.=$result;
                $comacheck++;
            }
    return $insert;
    } 
}