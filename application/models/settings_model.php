<?php
class Settings_model extends CI_Model {
public function __construct(){
	$this->load->database();
}
/*function to select dealers*/
public function select_dealers(){
    $this -> load ->helper('url');
    $this -> db ->select('*');
    $this -> db ->from('registration');
    $this -> db -> where('usertype = '. "'dealership'");
    $result = $this -> db ->get();
    if($result -> num_rows()>0){
        $retrieved = $result -> result_array();
		return $retrieved;
    }else{
      return FALSE;  
    }
}
/*function to check dealer*/
public function dealer_check($dealer_name){
    $this -> load ->helper('url');
    $this -> db -> select('*');
    $this -> db -> from('user_setting');
    $this -> db -> where('dealers_id = ' . "'" . $dealer_name . "'");
    $result= $this -> db ->get();
    if($result -> num_rows()>0){
        $retrieved = $result -> result_array();
        return FALSE;
    }
     return TRUE;  
}
/*Function to inser dealer settings*/
public function insert_dealerdetails($user_id,$dealer_name){
    $this -> load ->helper('url');
    $this -> dealer_check($dealer_name);
    if(isset($dealer_name)&& !empty($dealer_name)){
        foreach($dealer_name as $name){
            $timestamp=date('Y-m-d',time());
            $data=array('user_id'=>$user_id,
                        'dealers_id'=>$name,
                        'time_stamp'=>$timestamp
                        );
            $this->db->insert('user_setting',$data);
        }
    }
}
/*function to select lead mining presets*/
public function select_lead_mining_presets($event_id){
    $sql=("Select lead_mining_presets from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $value){
            $return=$value['lead_mining_presets'];  
        }
    }else{
        $return='';
    }
    return $return;
}
/*function to get assigned dealers*/
public function managers_assigned_dealers($manager_id){ 
    $this -> load ->helper('url');
    $sql=("Select dealers_id from user_setting where  user_id=$manager_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $dealer_id){
            $detaler_detaild[]=$dealer_id['dealers_id'];
        }
        return $detaler_detaild;
    }else{
        return $detaler_detaild='';
    } 
}
//getting all assigned dealer
public function alldealwithassigned($manager_id){ 
    $this -> load ->helper('url');
    $sql=("Select dealers_id from user_setting  where  user_id=$manager_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $dealer_id){
            $detaler_detaild[]=$dealer_id['dealers_id'];
        }
    }else{
        $detaler_detaild='';
    }
}
//getting assigned delalers for account manager
public function assigned_alldealers($mangers_id){
    $sql=("SELECT registration_id
    FROM  registration
    WHERE  	status='VERIFIED' AND usertype='dealership' 
    AND registration_id not in(select dealers_id FROM user_setting
    WHERE `user_id` =$mangers_id)");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        if(isset($returnvalue) && $returnvalue!=''){        
            foreach($returnvalue as $dealer_id){
                if($dealer_id!=''){
                    $detaler_detaild[]=$dealer_id['registration_id'];
                }
            }
        }else{
            $detaler_detaild='';
        }
    }else{
        $detaler_detaild='';
    }
    if(isset($detaler_detaild) && $detaler_detaild!=''){
        $ij=0;      
        $sql_query_details="SELECT *
        FROM  registration where 
        status='VERIFIED' and usertype='dealership' and (";
        foreach($detaler_detaild as $alldealersget){
            if($alldealersget!=''){
                if($ij>0){
                    $sql_query_details.="or ";
                } 
                $sql_query_details.="registration_id= $alldealersget ";
                $ij++;
            }
        }
        $sql_query_details.=")";
        $query_result=$this->db->query($sql_query_details);
        if($query_result-> num_rows() > 0){
            $delaer_result= $query_result->result_array();
            $dealer_full_dealer_details=$delaer_result;
            return $dealer_full_dealer_details;
        }else{
            return false;
        }
    } 
}
//get all the assigned dealers and remaining un assign ed dealers
public function assigned_dealer_with_alldealers($mangers_id){
    $sql=("SELECT registration_id
    FROM  registration
    where  	status='VERIFIED' and usertype='dealership' and registration_id not in(select dealers_id from user_setting)");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
   	    $returnvalue= $query->result_array();
       if(isset($returnvalue) && $returnvalue!=''){        
         foreach($returnvalue as $dealer_id){
            if($dealer_id!=''){
            $detaler_detaild[]=$dealer_id['registration_id'];
            }
         }
        }
       else{
            $detaler_detaild='';
        }
    }else{
      $detaler_detaild='';
    }
    //getting dealer id
    $sql_qurey=("SELECT dealers_id
    FROM  user_setting
    where  	user_id='$mangers_id'"); 
    $query_delaers=$this->db->query($sql_qurey);
    if($query_delaers-> num_rows() > 0){ 
    $dealers_id_get= $query_delaers->result_array();
        if(isset($dealers_id_get) && $dealers_id_get!=''){
            foreach($dealers_id_get as $assigned_dealer_id){
                $detaler_detaild[]=$assigned_dealer_id['dealers_id'];
            }
        sort($detaler_detaild);        
        }
    }
    if(isset($detaler_detaild) && $detaler_detaild!=''){
        $ij=0; 
        //getting id for dealers     
        $sql_query_details="SELECT *
        FROM  registration where 
        status='VERIFIED' and usertype='dealership' and (";
        foreach($detaler_detaild as $alldealersget){
            if($alldealersget!=''){
                if($ij>0){
                    $sql_query_details.="or ";
                } 
            $sql_query_details.="registration_id= $alldealersget ";
            $ij++;
            }
        }
        $sql_query_details.=")";
        $query_result=$this->db->query($sql_query_details);
        if($query_result-> num_rows() > 0){
            $delaer_result= $query_result->result_array();
            $dealer_full_dealer_details=$delaer_result;
            return $dealer_full_dealer_details;
        }else{
            return false;
        }
    }
}
/*function to delete all dealers*/
public function delete_dealers($user_id){
  $delete_query=("DELETE FROM user_setting where user_id='$user_id'");  
  $this->db->query($delete_query);
}
/*function to delete dealers seperately*/
public function delete_dealers_seperate($dealeruser_id,$newdealer_id){
    if(isset($newdealer_id)){
        foreach($newdealer_id as $dealers_id){
            $delete_query=("DELETE FROM user_setting where user_id='$dealeruser_id' and  dealers_id =$dealers_id");  
            $delete_assigneddealer=$this->db->query($delete_query);
        } 
    }
}
//add dealers to account managers
public function update_dealerdetails($user_id,$dealer_name){
if(isset($dealer_name)){
    foreach($dealer_name as $dealers_id){                
        $sql_dealers=("SELECT dealers_id from user_setting where dealers_id='$dealers_id' and user_id='$user_id'");
        $query_delaers=$this->db->query($sql_dealers);
            if($query_delaers-> num_rows() > 0){ 
            }else{        
                $timestamp=date('Y-m-d',time());
                $data=array('user_id'=>$user_id,
                'dealers_id'=>$dealers_id,
                'time_stamp'=>$timestamp
                );
                $insert=$this->db->insert('user_setting',$data);
            }
        }            
    }
}
//Show all the assigned dealers
public function new_removeddealers($mangers_id){
    $sql_qurey=("SELECT dealers_id
    FROM  user_setting
    where  	user_id='$mangers_id'"); 
    $query_delaers=$this->db->query($sql_qurey);
        if($query_delaers-> num_rows() > 0){ 
            $dealers_id_get= $query_delaers->result_array();
            if(isset($dealers_id_get) && $dealers_id_get!=''){
                foreach($dealers_id_get as $assigned_dealer_id){
                    $detaler_detaild[]=$assigned_dealer_id['dealers_id'];
                }
            sort($detaler_detaild);        
            }
        }
        if(isset($detaler_detaild) && $detaler_detaild!=''){
            $ij=0;
            //getting id and loopind the id      
            $sql_query_details="SELECT *
            FROM  registration where 
            status='VERIFIED' and usertype='dealership' and (";
                foreach($detaler_detaild as $alldealersget){
                    if($alldealersget!=''){
                        if($ij>0){
                            $sql_query_details.="or ";
                        } 
                    $sql_query_details.="registration_id= $alldealersget ";
                    $ij++;
                    }
                }
            $sql_query_details.=")";
            $query_result=$this->db->query($sql_query_details);
            if($query_result-> num_rows() > 0){
                $delaer_result= $query_result->result_array();
                $dealer_full_dealer_details=$delaer_result;
                return $dealer_full_dealer_details;
            }else{
                return false;
            }
        }    
}
//function to get accountmanager details by passing dealer id
function dealers_assigned_managers($dealer_id){
    $this -> load ->helper('url');
    $sql=("Select user_id from user_setting where dealers_id=$dealer_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }else{
        return 0;
    } 
}
/*function to get incomplete event details*/
function reopen_incomplete_event($dealer_id){
    $advetise_option=$this->input->post('advertising_option');
    $sql=("Select * from events where user_id=$dealer_id and creation_status='incomplete' and event_creation!='minedata'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        $return=$returnvalue;
    }else{
        $return='';
    }
    return $return;
}
//campaing edit
function get_campaign_editdetails($event_id){
     $sql=("Select * from events where event_id=$event_id");
     $query=$this->db->query($sql);
     if($query -> num_rows() > 0){
   	    $returnvalue= $query->result_array();
        $return=$returnvalue;
    }else{
        $return='';
    }
    return $return;
}
//insert event details 
function insert_event($id){        
    $event_start_date=strtotime($this->input->post('event_start_date'));
    $event_end_date=strtotime($this->input->post('event_end_date'));
    $date_formate=time();
    $advetise_option=$this->input->post('advertising_option');
    //checking event already exisist and update details
    $event_insert_id_set=$this->input->post('event_insert_edit');
    $sql=("Select * from events where user_id=$id and creation_status='incomplete' and event_creation!='minedata'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
   	    $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
            if($event_insert_id_set!=''){
            $select_event_id=$event_insert_id_set;
            }
            else{
              $select_event_id=$values['event_id'];  
            }
            $updatestatus_status="UPDATE events set 
            event_start_date='$event_start_date',
            event_end_date='$event_end_date',
           	advertising_option='$advetise_option',
            user_id='$id'
            where event_id=$select_event_id";
            $result = $this -> db -> query($updatestatus_status);
             return $select_event_id;
        }
    }else{
        //insert event
        $data=array(
        'event_start_date'=>$event_start_date,
        'event_end_date'=>$event_end_date,
        'advertising_option'=>$this->input->post('advertising_option'),
        'event_insert_date'=>$date_formate,
        'user_id'=>$id,
        'event_step'=>'1'
       );
        $this->db->insert("events", $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
}
//insert dummy event date for mine data
function insert_event_minedata1($id){        
    $event_start_date=time();
    $event_end_date=time();
    $date_formate=time();
            $data=array(
            'event_start_date'=>$event_start_date,
            'event_end_date'=>$event_end_date,
            'event_insert_date'=>$date_formate,
            'user_id'=>$id,
            'event_creation'=>'minedata',
            'event_step'=>'1'
       );
    $this->db->insert("events", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
}
//function to get event details
public function get_event_details($user_id){
   $this->load->helper('url'); 
   $this -> db -> select('*');
   $this -> db -> from('events');
   $this -> db -> where('user_id',$user_id);
   $this -> db -> order_by('event_id','desc');
   $this -> db -> limit(1);
   $result=$this -> db -> get();
    if($result -> num_rows() >0){
        $retrieved=$result->result_array(); 
        return $retrieved;
    }else{
        return 0;
    }
}
//sevent setep selection
function choose_advert_event_select($dealer_id,$event_id){
    $this -> load ->helper('url');
    $sql=("Select event_step from events where event_id=$event_id and  	user_id='$dealer_id'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
           $event_step_select= $values['event_step'];
        } 
    }else{
        $event_step_select=0;
    } 
    return $event_step_select;       
 }
//get dealer brand
function getdealerbrands($dealer_id){
    $sql=("Select dealership.masterbrand from dealership where registration_id=$dealer_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }else{
        return false;
    } 
}
//insert campine step1
function insert_campaign_step1($event_id){
    $configuredcamp=$this->input->post('configuredcamp');
    $daterange_from=$this->input->post('daterange_from');
    $daterange_to=$this->input->post('daterange_to');
    $max_invites=$this->input->post('max_invites');
    $event_insert_id=$this->input->post('event_insert_id');
    $sql=("Select * from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0)    {
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
            $campine_id_insert= $values['id'];
            //updates campain details
            $updatestatus_status="UPDATE epsadvantage_campaign set 
            lead_mining_presets='$configuredcamp',
            past_vehicle_purchase_date_from_range='$daterange_from',
            past_vehicle_purchase_date_to_range='$daterange_to',
            max_invites='$max_invites'
            where id=$campine_id_insert";
            $result = $this -> db -> query($updatestatus_status);
            return $campine_id_insert;  
        }
    }else{
        //insert campain details
        $data=array(
                'lead_mining_presets'=>$configuredcamp,
                'past_vehicle_purchase_date_from_range'=>$daterange_from,
                'past_vehicle_purchase_date_to_range'=>$daterange_to,
                'max_invites'=>$max_invites,
                'event_id'=>$event_id,
                'step1_select'=>'1'
        );
        $this->db->insert("epsadvantage_campaign", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }
}
//insert campine step1
function insert_campaign_step1_mine_data($event_id){
    $configuredcamp=$this->input->post('leadmining_type');
    $sql=("Select * from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
            $campine_id_insert= $values['id'];
            //update event details
            $updatestatus_status="UPDATE epsadvantage_campaign set 
            lead_mining_presets='$configuredcamp'
            where id=$campine_id_insert";
            $result = $this -> db -> query($updatestatus_status);
            return $campine_id_insert;  
        }
    }else{
        $data=array(
        'lead_mining_presets'=>$configuredcamp,
        'event_id'=>$event_id,
        'step1_select'=>'1'
        );
        $this->db->insert("epsadvantage_campaign", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }
}
//insert enent details
function get_campaine_insertvalue(){
    $event_id=$this->session->userdata('event_id_get');
    $sql=("Select * from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        $return=$returnvalue;  
    }else{
        $return='';
    }
    return $return;
}
function update_campaign_step1($campign_id){
    $report_type=$this->input->post('report_type');
    $report_fieldname=$this->input->post('report_fieldname');
    $report_fieldname1=$this->input->post('report_fieldname_value');
    $updatestatus_status="UPDATE epsadvantage_campaign set advancedoption_select='1',report_type='$report_type',report_fieldname='$report_fieldname',
    report_fieldname1='$report_fieldname1' where id=$campign_id";
    $result = $this -> db -> query($updatestatus_status);
    return true;
}
//inseert step 3 of campaine page
function update_campaign_step3($campine_insert_id){
    $configuredcamp_insert_id=$this->input->post('campaine_insert_id');
    $manufacurer_interesr_rate=$this->input->post('manufacurer_interesr_rate');
    $best_sub_prime_rate=$this->input->post('best_sub_prime_rate');
    $factory_rebate=$this->input->post('factory_rebate');
    $dealership_incentives=$this->input->post('dealership_incentives');
    $excess_vehicle=$this->input->post('excess_vehicle');
    $dealership_promos=$this->input->post('dealership_promos');
    $updatestatus_status="UPDATE epsadvantage_campaign set step3_select='1',
    manufacurer_interesr_rate='$manufacurer_interesr_rate',
    best_sub_prime_rate='$best_sub_prime_rate',
    factory_rebate='$factory_rebate',
    dealership_incentives='$dealership_incentives',
    excess_vehicle='$excess_vehicle',
    dealership_promos='$dealership_promos',
    step3_select='1'
    where id=$campine_insert_id";
    $result = $this -> db -> query($updatestatus_status);
    return $campine_insert_id;
}
//campaign details
function campaign_select($event_id){
    $sql=("Select *  from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
    }else{
        $returnvalue='';
    } 
    return $returnvalue;       
}
//insert lead list
function insertleadlistselction($event_id){
    $equity_scrap=$this->input->post('equity_scrap');
    $model_break_down=$this->input->post('model_break_down');
    $fuel_effciency=$this->input->post('fuel_effciency');
    $wrraenty_scrap=$this->input->post('wrranty_scrap');
    $custom_campain=$this->input->post('custom_campain');
    $fuel_report6=$this->input->post('fuel_report6');
    $lead_mining_presets_select=$this->input->post('lead_mining_presets_select');
    //select customer leadlist already exsist
    $sql=("Select *  from select_customer_leadlist where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){
            $lead_id=$values['customer_leadlist_id'];   
            $updatestatus_status="UPDATE select_customer_leadlist set equity_scrap='$equity_scrap',
            model_break_down='$model_break_down',
            fuel_effciency='$fuel_effciency',
            wrranty_scrap='$wrraenty_scrap',
            custom_campain='$custom_campain',
            fuel_efficiency_report6='$fuel_report6',
            lead_mining_presets='$lead_mining_presets_select'
            where event_id=$event_id";
            $result = $this -> db -> query($updatestatus_status); 
            return $lead_id;  
        }
    }else{
    $data=array(
        'equity_scrap'=>$equity_scrap,
        'model_break_down'=>$model_break_down,
        'fuel_effciency'=>$fuel_effciency,
        'wrranty_scrap'=>$wrraenty_scrap,
        'custom_campain'=>$custom_campain,
        'fuel_efficiency_report6'=>$fuel_report6,
        'lead_mining_presets'=>$lead_mining_presets_select,
        'event_id'=>$event_id
        );
    $this->db->insert("select_customer_leadlist", $data);
    $last_id = $this->db->insert_id();
    return $last_id; 
    }
}
//customer lead list
function leadsection_select($event_insert_id){
    $sql=("Select *  from  select_customer_leadlist where event_id=$event_insert_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
    }else{
        $returnvalue=0;
    } 
    return $returnvalue;  
}
//mailer setp1 insert
function insertmailetsetp1($event_id){
    $mailer_size=$this->input->post('mailer_size');
    $smallinvitecost=$this->input->post('smallinvitecost');
    $largeinvitecost=$this->input->post('largeinvitecost'); 
    $invitecost='';
    if($mailer_size=='smallinvites'){
        $invitecost=$smallinvitecost; 
    }else{
        $invitecost=$largeinvitecost;   
    }
    //select mailout options
    $sql=("Select id from select_mailer_options where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){ 
            $mailer_id=$values['id']; 
            //update mailout options if already exisit
            $updatestatus_status="UPDATE select_mailer_options set mailer_size='$mailer_size', invitecost='$invitecost'
            where id=$mailer_id and event_id=$event_id" ;
            $result = $this -> db -> query($updatestatus_status);
            return $mailer_id;
        }
    }else{
        $data=array(
        'mailer_size'=>$mailer_size,
        'step1_select'=>1,
        'invitecost'=>$invitecost,
        'event_id'=>$event_id
        );
        $this->db->insert("select_mailer_options", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }
}
function insertmailetsetp2($event_id){
    if($this->session->userdata('mailer_id')!=''){
        $data=array(
        'versioning'=>1,
        'step2_select'=>1
        );
        $this->db->insert("select_mailer_options", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    } 
}
//update mailer step 2
function updatemailetsetp2($mailer_id){
    $versioning=$this->input->post('versioning'); 
    $updatestatus_status="UPDATE select_mailer_options set versioning='$versioning',
    step2_select='1'
    where id=$mailer_id";
    $result = $this -> db -> query($updatestatus_status);
    return true; 
}
function updatemailetsetp3($mailer_id){
    $auto_pen=$this->input->post('auto_pen');
    $insert_cardstock=$this->input->post('insert_cardstock');
    $insert_paperstock=$this->input->post('insert_paperstock');
    $variable_image=$this->input->post('variable_image');
    $colored_envelop=$this->input->post('colored_envelop');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    $updatestatus_status="UPDATE select_mailer_options set autopen='$auto_pen',
    insert_cardstock='$insert_cardstock',
    insert_paperstock='$insert_paperstock',
    variable_imaging='$variable_image',
    colored_envelopes='$colored_envelop',
    step3_select='1'
    where id=$mailer_id";
    $result = $this -> db -> query($updatestatus_status);
    return true; 
}
function updatemailetsetp4($mailer_id){
    $upgrade_package=$this->input->post('upgrade_package');
    $data['event_insert_id']=$this->session->userdata('event_id_get');
    $updatestatus_status="UPDATE select_mailer_options set  upgrader_package='$upgrade_package',
    step4_select='1'
    where id=$mailer_id";
    $result = $this -> db -> query($updatestatus_status);
    return true; 
}
//select campaing details
function get_campign_details($event_id,$user_id){
    $sql=("Select * from epsadvantage_campaign where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
    }else{
        $returnvalue=0;
    } 
    return $returnvalue;   
}   
/*function to get mailout option details*/ 
function get_mailout_option_details($event_id){
    $sql=("Select * from select_mailer_options where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
    }else{
        $returnvalue=0;
    } 
    return $returnvalue;   
} 
//update event details when all the options completed
function update_event_complete($event_id){ 
    $updatestatus_status="UPDATE events set 
    creation_status='complete'
    where event_id=$event_id";
    $result = $this -> db -> query($updatestatus_status);
    return $event_id;
} 
//insert lead customer details
function lead_customer_data_insert($lead_id,$report_type,$customer_id){
    $sql=("Select * from leadlist_customer_data where customer_leadlist_id=$lead_id and lead_customer_id='$customer_id' and lead_type='$report_type'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
      return false;  
    }else{
        $data=array(
            'lead_customer_id'=>$customer_id,
            'customer_leadlist_id'=>$lead_id,
            'lead_type'=>$report_type
           );
        $this->db->insert("leadlist_customer_data", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }
} 
//delete leadlist
function leadlistdelete($lead_id){
   $sql_delete=("Delete from leadlist_customer_data where customer_leadlist_id=$lead_id");
   $query=$this->db->query($sql_delete);
   return true; 
}
//get dealers selected events
function get_dealer_events($dealer_id){
    $this -> load ->helper('url');
    $sql=("SELECT * FROM events, epsadvantage_campaign WHERE events.event_id=epsadvantage_campaign.event_id AND events.user_id=$dealer_id order by event_start_date desc");
     $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }else{
        return false; 
    } 
}
//event details
function get_dealer_events_details($dealer_id){
    $this -> load ->helper('url');
    //event details 
    $sql=("SELECT * FROM events where user_id=$dealer_id and event_creation!='minedata' order by event_start_date desc");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }
    else{
        return false; 
    } 
}
//get customer details
function get_customer_details($event_id,$lead_type){
    $this -> load ->helper('url');
    if($lead_type==1){
        $condition='AND leadlist_customer_data.lead_type=1';
    }else if($lead_type==2){
        $condition='AND  leadlist_customer_data.lead_type=2';
    }else if($lead_type==3){
        $condition='AND  leadlist_customer_data.lead_type=3';
    }else if($lead_type==4){
        $condition='AND  leadlist_customer_data.lead_type=4';
    }else if($lead_type==5){
        $condition='AND  leadlist_customer_data.lead_type=5';
    }else if($lead_type==6){
        $condition='AND  leadlist_customer_data.lead_type=6';
    }else{
        $condition='';
    }
    //getting customer leadlist details
    $sql=("SELECT * FROM  select_customer_leadlist, 
    leadlist_customer_data WHERE select_customer_leadlist.customer_leadlist_id=leadlist_customer_data.customer_leadlist_id AND 
    select_customer_leadlist.event_id=$event_id $condition");
     $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }else{
        return false; 
    } 
}
//function to get the description of the particular report type
function get_report_description($report_type){
$this -> load ->helper('url');
$sql=("Select description from  report_description where field_name='$report_type'");
$query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $row = $query->row_array();
        return $row['description'];
    }
    else{
        return false; 
    } 
}
//function to get the field values
function get_reportfieldvalues($report_type,$id){
    $this -> load ->helper('url');
    $sql=("Select * from  epsadvantage_campaign where report_type='$report_type' and id=$id");
    $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $row = $query->result_array();
            return $row;
        }
        else{
            return false; 
        } 
}
//selecting advertising options
function get_advertising_option($options){
    switch ($options){
        case "1":
        $return ='Conquest';
        break;
        case "2":
        $return ='Eps Advantage';
        break;
        case "3":
        $return ='Upgrader';
        break;
    }
    return $return;
} 
//report name get
function get_report_type_name($options=''){
    switch ($options){
        case "drive_type":
        $return ='Drive Type';
        break;
        case "2":
        $return ='Eps Advantage';
        break;
        case "3":
        $return ='Upgrader';
        break;
        default:
        $return ='Unknown';
        break;
    }
    return $return;
} 
//lead type name
function get_lead_type_name($options=''){
    switch ($options){
        case "custom_campaign":
        $return ='Advanced Options';
        break;
        case "equity_scrape":
        $return ='Equity Scrape';
        break;
        case "model_breakdown":
        $return ='Model Breakdown';
        break;
        case "efficiency":
        $return ='Fuel Efficiency';
        break;
        case "warranty_scrape":
        $return ='Warranty Scrape';
        break;
        default:
        case "drive_type":
        $return ='Drive Type';
        break;
        $return ='Unknown';
        break;
    }
    return $return;
}
//getting vehicle class fiels values
function get_vehicle_class_feild_values($options){
    switch ($options){
        case "full_size_cars":
        $return ='Full-size cars';
        break;
        case "mid_size_cars":
        $return ='mid-size cars';
        break;
        case "small_cars":
        $return ='small cars';
        break;
        case "suvs":
        $return ='SUV';
        break;
        case "crossovers":
        $return ='Crossovers';
        break;
        case "trucks":
        $return ='Truck';
        break;
        case "vans":
        $return ='Van';
        break;
        case "green_cars":
        $return ='Green Cars';
        break;
        default:
        $return ='';
        break;
    }
    return $return;
}
//vehicle class field values for demo dealer
function get_vehicle_class_feild_values_demo_dealer($options){
    switch ($options){
        case "full_size_cars":
        $return ='Full-size cars';
        break;
        case "mid_size_cars":
        $return ='mid-size cars';
        break;
        case "small_cars":
        $return ='small cars';
        break;
        case "suvs":
        $return ='SUVS';
        break;
        case "crossovers":
        $return ='Crossovers';
        break;
        case "trucks":
        $return ='Trucks';
        break;
        case "vans":
        $return ='Vans';
        break;
        case "green_cars":
        $return ='Green Cars';
        break;
        default:
        $return ='';
        break;
    }
    return $return;
}  
//function to get the lead count
function getleadcount($event_id,$lead_type){
    $this -> load ->helper('url');
    $query=("SELECT COUNT(*) AS `numrows` FROM  select_customer_leadlist, 
    leadlist_customer_data WHERE select_customer_leadlist.customer_leadlist_id=leadlist_customer_data.customer_leadlist_id 
    AND  select_customer_leadlist.event_id=$event_id AND leadlist_customer_data.lead_type='$lead_type'");
    $query_count=$this->db->query($query);
    $count= $query_count->row ()->numrows;
    return $count;
}
//function to get the count of customer lead
function get_customer_leadcount($event_id){
     $this -> load ->helper('url');
    $query=("SELECT COUNT(*) AS `numrows` FROM  select_customer_leadlist, 
    leadlist_customer_data WHERE select_customer_leadlist.customer_leadlist_id=leadlist_customer_data.customer_leadlist_id AND  
    select_customer_leadlist.event_id=$event_id ");
    $query_count=$this->db->query($query);
    $count_query= $query_count->row ()->numrows;
    return $count_query; 
}
//getting mailout options
function mailout_option_select($event_insert_id){
    $sql=("Select *  from  select_mailer_options where event_id=$event_insert_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
    }else{
        $returnvalue=0;
    } 
    return $returnvalue;  
}
  //getting report type field name
function getreporttype($report_type){
    switch ($report_type){
        case "vehicle_class":
        $return ='Vehicle Class';
        break;
        case "drive_type":
        $return ='Drive Type';
        break;
        case "fuel_economy":
        $return ='Fuel Economy';
        break;
        case "trade_in_value":
        $return ='Trade In Value';
        break;
        case "out_warranty":
        $return ='Vehicle Out of Warranty ';
        break;
        case "finance_rate":
        $return ='Finance Rate (APR)';
        break;
        case "monthly_payment":
        $return ='Monthly Payment Range';
        break;
        case "specific_model":
        $return ='Specific Model Pull  ';
        break;
        case "power_focus":
        $return ='Performance Vehicles';
        break;
        case "fuel_type":
        $return ='Fuel Type ';
        break;
        case "local_town":
        $return ='Local or Out of town ';
        break;
        case "used_new_purchaser":
        $return ='Used vs. New Vehicle Purchase ';
        break;
        case "dealership_brand":
        $return ='Competitors Vehicle Owners';
        break;
        default:
        $return ='Unknown';
        break;
    }
    return $return;
}
//report type field name realed to excel
function getreporttype_report_generation_type($report_type){
    switch ($report_type){
        case "vehicle_class":
        $return ='VehicleClass';
        break;
        case "drive_type":
        $return ='DriveType';
        break;
        case "fuel_economy":
        $return ='FuelEconomy';
        break;
        case "trade_in_value":
        $return ='TradeInValue';
        break;
        case "out_warranty":
        $return ='Vehicle-Warranty ';
        break;
        case "finance_rate":
        $return ='FinanceRate';
        break;
        case "monthly_payment":
        $return ='MonthlyPaymentRange';
        break;
        case "specific_model":
        $return ='SpecificModelPull  ';
        break;
        case "power_focus":
        $return ='PowerFocus ';
        break;
        case "fuel_type":
        $return ='FuelType ';
        break;
        case "local_town":
        $return ='Local-Outoftown ';
        break;
        case "used_new_purchaser":
        $return ='Used-New-VehiclePurchase ';
        break;
        case "dealership_brand":
        $return ='CompetitorsVehicleOwners';
        break;
        default:
        $return ='Unknown';
        break;
    }
    return $return;
}
/*function to get the campign id*/
function get_campign_id($event_id){
    $sql=("select id from  epsadvantage_campaign where event_id=$event_id");
    $result=$this->db->query($sql);
    if($result -> num_rows() > 0){
        $row = $result->row_array();
        return $row['id'];
    }else{
        return 0;
    }
}
/*functio to get report field values*/
public function get_report_field_values($event_id){
    $campine_event_get=$this->campaign_select($event_id);
    if(isset($campine_event_get) && $campine_event_get!=''){
        foreach($campine_event_get as $values){
            $report_name=$values['report_type'];
            if($report_name=='vehicle_class'){
                $field_name='Vehicle Class';
                if($values['report_fieldname']=='null'){
                  $value1='N/A';
                }else{
                    $get_value1=ucwords($values['report_fieldname']);
                    $value1 = str_replace("_"," ", $get_value1);
                }
                $field_name2='';
                $value2='';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='drive_type'){
                $field_one='yes';
                $field_name='Drive Type';
                $value1=ucfirst($values['report_fieldname']);
                $field_name2='';
                $value2='';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='fuel_economy'){
                $field_name='From';
                if($values['report_fieldname']=='' || $values['report_fieldname']=='undefined'){
                    $value1='N/A';
                }else{
                    $value1=$values['report_fieldname'];
                }
                $field_name2='To :';
                if($values['report_fieldname1']=='' || $values['report_fieldname1']=='undefined'){
                    $value2='N/A';
                }else{
                    $value2=$values['report_fieldname1'];
                }
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='trade_in_value'){
                $field_name='From';
                 if($values['report_fieldname']=='' || $values['report_fieldname']=='undefined'){
                    $value1='N/A';
                }else{
                    $value1=$values['report_fieldname'];
                }
                $field_name2='To :';
                if($values['report_fieldname1']=='' || $values['report_fieldname1']=='undefined'){
                    $value2='N/A';
                }else{
                    $value2=$values['report_fieldname1'];
                }
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='finance_rate'){
                $field_name='Max';
                 if($values['report_fieldname']=='' || $values['report_fieldname']=='undefined'){
                    $value1='N/A';
                }else{
                    $value1=$values['report_fieldname'];
                }
                if($values['report_fieldname1']=='' || $values['report_fieldname1']=='undefined'){
                    $value2='N/A';
                }else{
                    $value2=$values['report_fieldname1'];
                }
                $field_name2='Min :';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='power_focus'){
                $field_name='Power Focus';
                if($values['report_fieldname']=='null'){
                    $value1='N/A';
                }else{
                    $get_value1=ucwords($values['report_fieldname']);
                    $value1 = str_replace("_"," ", $get_value1);
                }
                $field_name2='';
                $value2='';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='fuel_type'){
                $field_name='Fuel Type';
                if($values['report_fieldname']=='undefined' || $values['report_fieldname']==''){
                    $value1='N/A';
                }else{
                    $value1=ucfirst($values['report_fieldname']);
                }
                if($values['report_fieldname1']=='null'){
                    $value2='N/A';
                }else{
                    $get_value2=ucwords($values['report_fieldname1']);
                    $value2 = str_replace("_"," ", $get_value2);
                }
                $field_name2='Field name :';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='local_town'){
                $field_name='Local vs Out of Town';
                $get_value=$values['report_fieldname'];
                if($get_value=='undefined'){
                    $value1='N/A';
                }else{
                    if($get_value=='out_of_town'){
                      $value1='Out of Town';
                    }
                    elseif($get_value=='local'){
                        $value1='Local';
                    }
                }
                $field_name2='Field name : ';
                if($values['report_fieldname1']=='null'){
                    $value2='N/A';
                }else{
                    $get_value2=ucwords($values['report_fieldname1']);
                    $value2 = str_replace("_"," ", $get_value2);
                }
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='used_new_purchaser'){
                $field_name='Used vs New Purchaser';
                $value1=ucfirst($values['report_fieldname']);
                $field_name2='Field name : ';
                if($values['report_fieldname1']=='null'){
                    $value2='N/A';
                }else{
                    $get_value2=ucwords($values['report_fieldname1']);
                    $value2 = str_replace("_"," ", $get_value2);
                }
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='monthly_payment'){
                $field_name='Min';
                if($values['report_fieldname']=='null' || $values['report_fieldname']=='undefined'){
                    $value1='N/A';
                }else{
                    $value1=$values['report_fieldname'];
                }
                 if($values['report_fieldname1']=='null' || $values['report_fieldname1']=='undefined'){
                    $value2='N/A';
                }else{
                $value2=$values['report_fieldname1'];
                }
                $field_name2='Max :';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }elseif($report_name=='dealership_brand'){
                $field_name='Competitors Vehicle Owners';
                $value1='';
                $value2='';
                $field_name2='Field name :';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
           }elseif($report_name=='specific_model'){
                $field_name='Specific Model Pull';
                $value1='';
                $value2='';
                $field_name2='Field name :';
                $result=$field_name .' : '. $value1 .'<br/>'. $field_name2 . $value2;
            }else{
                $result=0;  
            }
        }
        return $result;
    }else{
        return 0;
    }
}
//get customer id
function get_lead_customer_id($lead_id,$lead_type){
    $sql=("SELECT lead_customer_id FROM  leadlist_customer_data WHERE  customer_leadlist_id =$lead_id and lead_type=$lead_type");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        return $returnvalue;
    }else{
        return false; 
    } 
}
//get pbs customer data 
function get_pbs_details($customer_id){
    $sql=("select * from  eps_data where id=$customer_id");
    $result=$this->db->query($sql);
    if($result -> num_rows() > 0){
       $row = $result->result_array();
        return $row;
    }else{
        return 0;
    }
}
function get_leadlist_details_with_event_id($event_id){
    $sql_leadlist=("SELECT lead_customer_id FROM  select_customer_leadlist, leadlist_customer_data WHERE select_customer_leadlist.customer_leadlist_id=leadlist_customer_data.customer_leadlist_id AND  select_customer_leadlist.event_id=$event_id");
    $query_leadlist=$this->db->query($sql_leadlist);
    if($query_leadlist -> num_rows() > 0){
        $returnvalue= $query_leadlist->result_array();
        $ij=0; 
        $sql=("select * from  pbs_customer_data where(");
        foreach($returnvalue as $values){
            if($values!=''){
                if($ij>0){
                    $sql.="or ";
                } 
                    $sql.="id=$values[lead_customer_id] ";
                    $ij++;  
            }
        }
        $sql.=")";
        $quer = $this->db->query($sql);
        $returnvalue= $quer->result_array();
   } 
   else{
    $returnvalue='';
   }
   return $returnvalue;
}
function getleadgrouptitle($leadtype){
   switch ($leadtype){
       case "model_breakdown":
       $model_break_down=array("Report Group 1 (Vehicle Class: All cars (full, mid, economy, green/hybrid))","Report Group 2 (Vehicle Class: SUVs & Crossovers)","Report Group 3 (Vehicle Class: Trucks)","Report Group 4 (Vehicle Class: Vans (including minivans if it is separate))","All remaining leads");
       $return =$model_break_down;
       break;
       case "efficiency":
       $efficiency=array("Report Group 1 (High efficiency cars)","Report Group 2 (Low efficiency cars)","Report Group 3 (High Efficiency SUVs, Vans, Crossovers)","Report Group 4 (Low Efficiency SUVs, Vans, Crossovers)","Report Group 5 (High Efficiency Trucks)","Report Group 6");
       $return =$efficiency;
       break;
       case "warranty_scrape":
       $warranty_scrape=array("Report Group 1(Powertrain Warranty = Expired)","Report Group 2 (Powertrain warranty = <6 months remaining)","Report Group 3 (Basic vehicle warranty = Expired)","Report Group 4 (Basic Vehicle Warranty = <6 months remaining)","Report Group 5 (Basic vehicle warranty = >6 months remaining)");
       $return =$warranty_scrape;
       break;
       case "custom_campaign":
       $custom_campaign=array("Report Group 1","Report Group 2 ","Report Group 3 ","Report Group 4 ","Report Group 5 ");
       $return =$custom_campaign;
       break;
       case "equity_scrape":
       $equity_scrape=array("Report Group 1 (Positive Equity, No Payments Remaining)","Report Group 2 (Positive Equity, Sub-prime financing)","Report Group 3 (Negative Equity, Sub Prime Financing)","Report Group 4 (Positive Equity, Regular Interest Financing)","Group 5 (Negative Equity. Regular Interest Financing)");
       $return =$equity_scrape;
       break;
       case "drive_type":
       $equity_scrape=array("Report Group 1 (FWD Drive Type)","Report Group 2 (RWD Drive Type)","Report Group 3 (4x4 Drive Type)","Report Group 4 ( AWD Drive Type)","Report Group 5  (Unknown or Other Drive type)");
       $return =$equity_scrape;
       break;
       default:
       $return ='';
       break;
    }
    return $return;
}
function getleadgrouptitle_report($leadtype){
   switch ($leadtype){
       case "model_breakdown":
       $model_break_down=array("G1-VehicleClass-Allcars","G2-VehicleClass-SUVs&Crossovers)","G3-VehicleClass-Trucks","G4-VehicleClass-Vans)","G5-remainingleads");
       $return =$model_break_down;
       break;
       case "efficiency":
       $efficiency=array("G1-Highefficiencycars","G2-Lowefficiencycars","G3-HighEfficiency-SUVs-Vans-Crossovers","G4-LowEfficiency-SUVs-Vans-Crossovers","G5-HighEfficiency-Trucks","ReportGroup6");
       $return =$efficiency;
       break;
       case "warranty_scrape":
       $warranty_scrape=array("G1-Expired-PowertrainWarranty","G2-Powertrainwarranty-Lessthan-6months","G3-Expired-Basicvehiclewarranty","G4-BasicVehicleWarranty-Lessthan-6months","G5-Basicvehiclewarranty-Greaterthan-6months");
       $return =$warranty_scrape;
       break;
       case "custom_campaign":
       $custom_campaign=array("ReportGroup 1","ReportGroup 2 ","ReportGroup 3 ","Report Group 4 ","Report Group 5 ");
       $return =$custom_campaign;
       break;
       case "equity_scrape":
       $equity_scrape=array("G1-PositiveEquity)","G2-PositiveEquity-Sub-prime financing","G3-NegativeEquity-Sub Prime Financing","G4-PositiveEquity-RegularInterestFinancing","G5-NegativeEquity-RegularInterestFinancing");
       $return =$equity_scrape;
       break;
       case "drive_type":
       $equity_scrape=array("G1-FWDDriveType)","G2-RWDDriveType","G3-4x4DriveType","G4-AWDDriveType","G5-OtherDrivetype");
       $return =$equity_scrape;
       break;
       default:
       $return ='';
       break;
    }
    return $return;
}
function get_cost_of_smallinvites($lead_count){
    $price_array=array("100-199"=>"3.78","200-299"=>"2.50","300-399"=>"2.06","400-499"=>"2.06","500-599"=>"1.91","600-699"=>"1.84","700-799"=>"1.58","800-899"=>"1.58","900-999"=>"1.58","1000-1499"=>"1.34","1500-1999"=>"1.19","2000"=>"1.09");
    if($lead_count!=''){
        foreach ($price_array as $key=>$value){
            $price_range=explode('-',$key);
            if($price_range[0]!='' && $price_range[0]!='2000'){
                if($lead_count>=$price_range[0] && $lead_count<=$price_range[1]){
                $return =$value;
                return $return;
                }
            }else if($key=='2000' && $lead_count>='2000'){
                $return =$value;
                return $return;
            }else{
                $return =3.78;
                return $return;
            }
        }
    }
    else{
        $return ='';
        return $return;
     }
 }
function get_cost_of_largerinvites($lead_count){
    $price_array=array("100-199"=>"3.88","200-299"=>"2.62","300-399"=>"2.19","400-499"=>"2.19","500-599"=>"1.98","600-699"=>"1.92","700-799"=>"1.72","800-899"=>"1.72","900-999"=>"1.72","1000-1499"=>"1.48","1500-1999"=>"1.33","2000"=>"1.23");
    if($lead_count!=''){
        foreach ($price_array as $key=>$value){
            $price_range=explode('-',$key);
            if($price_range[0]!='' && $price_range[0]!='2000'){
                if(($lead_count>=$price_range[0]) && ($lead_count<=$price_range[1])){
                    $return =$value;
                    return $return;
                }
            }else if($key=='2000' && $lead_count>='2000'){
                $return =$value;
                return $return;
            }else{
                $return =3.88;
                return $return;
            }
        }
    }
    else{
        $return ='';
        return $return;
    }
 }
function get_cost_of_additional_options($options){
    $additional_options_array=array("colored_envelopes"=>"0.15","autopen"=>"0.36","insert_cardstock"=>"0.60","insert_paperstock"=>"0.55","variable_imaging"=>"0.20","versioning"=>"85.00");
    switch ($options){
       case "colored_envelopes":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       case "autopen":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       case "insert_cardstock":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       case "insert_paperstock":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       case "variable_imaging":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       case "versioning":
       $option_price=$additional_options_array[$options];
       $return =$option_price;
       break;
       default:
       $return ='';
       break;
    }
    return $return;
}
function report_field_settings($options){
    switch ($options){
       case "gas":
       $option_text='Gas';
       $return =$option_text;
       break;
       case "diesel":
       $option_text='Diesel';
       $return =$option_text;
       break;
       case "hybrid":
       $option_text='Other';
       $return =$option_text;
       break;
       case "local":
       $option_text='Local';
       $return =$option_text;
       break;
       case "out_of_town":
       $option_text=' Out Of Town';
       $return =$option_text;
       break;
       default:
       $return ='';
       break;
  }
  return $return;
}
public function get_lead_mining_presets_leadlist($event_id){
    $event_id=$this->session->userdata('event_id_get');
    $sql=("Select lead_mining_presets from select_customer_leadlist where event_id=$event_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $value){
            $return=$value['lead_mining_presets'];  
        }
    }else{
        $return='';
    }
return $return;
}
//insert advance option gropu selection
function insert_advance_option_group_selection(){
    $report_name=$this->input->post('report_name'); 
    $value_get_1=$this->input->post('value_get_1');
    $insert='';
    $commoncheck=0; 
    //insert comma to end of the field name
    if(is_array($value_get_1) && $value_get_1!=''){
        foreach($value_get_1 as $values){
            if($commoncheck>0){
                $insert.=',';
            }
                $insert.=$values;
                $commoncheck++;   
            }
            $field_value_insert=$insert;
     }else{
            $field_value_insert=$value_get_1;
     }   
    $value_get_2=$this->input->post('value_get_2');
    $value_get_3=$this->input->post('value_get_3');
    $field_name_1=$this->input->post('feild_name_1');
    $field_name_2=$this->input->post('feild_name_2');
    $event_id=$this->input->post('event_id');
    $group_select=$this->input->post('id');
    $sql=("Select id from  advance_options_group_selection where event_id=$event_id and group_name=$group_select");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        foreach($returnvalue as $values){ 
           $mailer_id=$values['id']; 
           $updatestatus_status="UPDATE advance_options_group_selection set report_type='$report_name',
           value1='$field_value_insert',
           value2='$value_get_2',
           value3='$value_get_3',
           field_name1='$field_name_1',
           field_name2='$field_name_2'
           where  group_name=$group_select and event_id=$event_id";
           $result = $this -> db -> query($updatestatus_status);
           return $mailer_id;
        }
    }else{
        $data=array(
                'report_type'=>$report_name,
                'value1'=>$field_value_insert,
                'value2'=>$value_get_2,
                'field_name1'=>$field_name_1,
                'field_name2'=>$field_name_2,
                'group_name'=>$group_select,
                'event_id'=>$event_id
        );
        $this->db->insert("advance_options_group_selection", $data);
        $last_id = $this->db->insert_id();
        return $last_id; 
    }
}
//getting advance option group name
public function getgroupname_advanced_option_with_event_id($event_id){
    $sql=("Select * from advance_options_group_selection where event_id=$event_id order by group_name asc");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
    }else{
        $return='';
    }
    return $return;
}
//getting advance option group tittle
public function getgroupname_title_advanced_option_with_event_id($event_id){
    $sql=("Select report_type from advance_options_group_selection where event_id=$event_id order by group_name asc");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
        foreach($return as $value){
            $report_type=$this->getreporttype($value['report_type']);
            $report_title[]=$report_type; 
        }
    }else{
        $report_title='';
    }
    return $report_title;
}
public function getgroupname_advanced_option($event_id,$group){
    $sql=("Select * from advance_options_group_selection where event_id=$event_id and group_name='$group'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
    }else{
        $return='';
    }
    return $return;
}
function get_campign_editdetails($event_id)
    {
         $sql=("Select * from events where event_id=$event_id");
         $query=$this->db->query($sql);
         if($query -> num_rows() > 0)
	   {
       	    $returnvalue= $query->result_array();
            
            $return=$returnvalue;
        }
        else
        {
            $return='';
        }
        return $return;
    }
    public function epsadvantage_info($event_id){
        $this->db->select('*');
        $this->db->from('epsadvantage_campaign');
        $this -> db -> where('event_id',$event_id);
        $query = $this->db->get();
        $result=$query->row();
        return $result;
    }
    function get_advance_option_report($report_type,$value1, $value2,$field_name1,$field_name2)
    {
        switch ($report_type){
            case "vehicle_class":
            $return['report_type'] ='Vehicle Class';
            $return['report_description'] ='This report contains all past customer leads based on the selected vehicle class(es).';
            $classes = explode(',', $value1);
            foreach ($classes as $class){
                $class = ucfirst(str_replace('_', ' ', $class));
                if($class == 'Suvs'){
                    $class = 'SUVS';
                }
                $class_upper[] = $class;
            }
            $return['report_settings'] = 'Vehicle Classes: '.implode(',', $class_upper);
            break;
        
            case "drive_type":
            $return['report_type'] ='Drive Type';
            $return['report_description'] ='This report contains all past customer leads based on the Drive Type of the vehicle last purchased.';
            
            $return['report_settings'] = 'Drive Type: '.  strtoupper($value1);
            break;
        
            case "fuel_economy":
            $return['report_type'] ='Fuel Economy';
            $return['report_description'] ='This report contains all past customer leads based on a fuel economy range.';
            
            $return['report_settings'] = 'Fuel Economy Range: '.  $value1 . ' - '.$value2;
            break;
        
            case "trade_in_value":
            $return['report_type'] ='Trade In Value';
            $return['report_description'] ='This report contains all past customer leads based on the range of Trade in Value selected.';
            
            $return['report_settings'] = 'Trade In Value Range: '.  $value1 . ' - '.$value2;
            break;
        
            case "out_warranty":
            $return['report_type'] ='Vehicle Out of Warranty';
            $return['report_description'] ='This report contains all past customers leads with the warranty option selected:';
            
            $return['report_settings'] = 'Out of Warrenty: '.  $value1;
            break;
        
            case "finance_rate":
            $return['report_type'] ='Finance Rate (APR)';
            $return['report_description'] ='This report contains all past customer leads based on the APR range selected.';
            
            $return['report_settings'] = 'Finance Rate Range: '.  $value1 . ' - '.$value2;
            break;
        
            case "monthly_payment":
            $return['report_type'] ='Monthly Payment Range';
            $return['report_description'] ='This report contains all past customer leads based on the range of monthly payment selected.';
            
            $return['report_settings'] = 'Monthly Payment Range: '.  $value1 . ' - '.$value2;
            break;
        
            case "specific_model":
            $return['report_type'] ='Specific Model Pull';
            $return['report_description'] ='This report contains all past customer leads based on the single vehicle model selected.';
            
            $return['report_settings'] = 'Vehicle Manufacturer: '.  $value1 . ' <br/> Vehicle Manufacturer:'.$value2;
            break;
        
            case "power_focus":
            $return['report_type'] ='Power Focus';
            $return['report_description'] ='This report contains all past customer leads who drive high power vehicles in the class selected. ';
            
            $classes = explode(',', $value1);
            foreach ($classes as $class){
                $class = ucfirst(str_replace('_', ' ', $class));
                if($class == 'Suvs'){
                    $class = 'SUVS';
                }
                $class_upper[] = $class;
            }
            $return['report_settings'] = 'Power Focus: '.implode(',', $class_upper);
            break;
        
            case "fuel_type":
            $return['report_type'] ='Fuel Type';
            $return['report_description'] ='This report contains all past customer leads based on the selected Fuel Type.';
            
            $classes = explode(',', $value1);
            foreach ($classes as $class){
                $class = ucfirst(str_replace('_', ' ', $class));
                if($class == 'Suvs'){
                    $class = 'SUVS';
                }
                $class_upper[] = $class;
            }
            $fuel_type = implode(',', $class_upper);
            
            $return['report_settings'] =  $field_name1 . ': '.$fuel_type;
            break;
        
            case "local_town":
            $return['report_type'] ='Local or Out of town';
            $return['report_description'] ='This report contains all past customer leads based whether they are/are not in the same city as your dealership.';
            
            $field_name1 = ucfirst(str_replace('_', ' ', $field_name1));
            
            $classes = explode(',', $value1);
            foreach ($classes as $class){
                $class = ucfirst(str_replace('_', ' ', $class));
                if($class == 'Suvs'){
                    $class = 'SUVS';
                }
                $class_upper[] = $class;
            }
            $local_town = implode(',', $class_upper);
            
            $return['report_settings'] =  $field_name1 . ': '.$local_town;
            break;
        
            case "used_new_purchaser":
                $return ='Used vs. New Vehicle Purchase ';
                $return['report_type'] ='Used vs. New Vehicle Purchase';
                $return['report_description'] ='This report contains all past customer leads based on whether they bought a new or used car (as selected)';


    //            $field_name1 = ucfirst(str_replace('_', ' ', $field_name1));
                if($field_name1 == 'new'){
                    $value2 = 'New';
                }else{
                    $value2 = 'Used';
                }
                $classes = explode(',', $value1);
                foreach ($classes as $class){
                    $class = ucfirst(str_replace('_', ' ', $class));
                    if($class == 'Suvs'){
                        $class = 'SUVS';
                    }
                    $class_upper[] = $class;
                }
                $used_new_purchaser = implode(',', $class_upper);

                $return['report_settings'] =  'Type of purchase: '. $field_name1 . '<br/>Vehicle Class: '.$used_new_purchaser;
            break;
            
            case "dealership_brand":
            $return ='Competitors Vehicle Owners';
            break;
            case "equity_scrapper":
            $return['report_type'] ='Equity Scrap';
            $return['report_description'] ='This report contains all past customer leads who purchased non-dealership OEM vehicles from you.';
            $classes = explode(',', $value1);
            foreach ($classes as $class){
                $class = ucfirst(str_replace('_', ' ', $class));
                if($class == 'Suvs'){
                    $class = 'SUVS';
                }
                $class_upper[] = $class;
            }
            $return['report_settings'] = 'Vehicle Classes: '.implode(',', $class_upper);
            break;
            default:
            $return ='Unknown';
            break;
        }
        return $return;
    }
    function camapign_select($event_id){
        $sql=("Select *  from epsadvantage_campaign where event_id=$event_id");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
        }else{
            $returnvalue='';
        } 
        return $returnvalue;       
    }
public function get_advance_option($event_insert_id,$group){
    $this->db->cache_delete_all();
    $this->db->trans_start();
    $this->db->select('*');
    $this->db->from('advance_options_group_selection');
    $this->db->where('event_id', $event_insert_id); 
    $this->db->where('group_name', $group); 
//    $sql=("Select * from advance_options_group_selection where event_id=$event_insert_id and group_name='$group'");
//    if($group == 2){
//        print_r($this->db);die;
//        }
    $query=$this->db->get();
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        
    }else{
        $returnvalue = '';
    }
    $this->db->trans_complete();
    return $returnvalue;
}
public function get_advanced_past_vehicle_purchase_date_range($event_id){
    $this->db->trans_start();
    $this->db->select('past_vehicle_purchase_date_from_range');
    $this->db->select('past_vehicle_purchase_date_to_range');
    $this->db->select('max_invites');
    $this->db->from('epsadvantage_campaign');
    $this->db->where('event_id', $event_id); 
    $this->db->trans_complete();


    $query_date_range = $this->db->get();
    return $query_date_range;
}
public function get_advanced_option_group_details($event_id,$group,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue){
    
    $return_result='';
    $purchase_date_range_from='';
    $purchase_date_range_to='';
    //getting purchase to and from range
    
//   $sql_date_range="Select past_vehicle_purchase_date_from_range,
//   past_vehicle_purchase_date_to_range from  
//   epsadvantage_campaign where event_id=".$event_id;
//      
//   $query_date_range=$this->db->query($sql_date_range);
   
   if($query_date_range -> num_rows() > 0){
    
   $returnvalue_get_date_range=$query_date_range->result_array();
   foreach($returnvalue_get_date_range as $purchase_date_range){
        $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];  
        $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];  
        $max_invites=$purchase_date_range['max_invites'];  
    }
    }
//    if($group == 2){
//    print_r($returnvalue_get_date_range);die;
//    }
    $date=strtotime(date('m/d/y'));
    //calculate purchase date range 
    $new_purchase_to_range = ($purchase_date_range_to)*12;
    $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date);   
    $new_purchase_from_range =($purchase_date_range_from)*12;
    $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date); 
    //echo date('d/m/y',$newdate_purchase_range_to_date_compare);
    //getting group name details  
//    $sql=("Select * from advance_options_group_selection where event_id=$event_id and group_name='$group'");
//    $query=$this->db->query($sql);
    $purchase_date_range_to = explode('.', $purchase_date_range_to);
    if (count($purchase_date_range_to) == 2) {
        $date=strtotime(date('m/d/y'));
        $new_purchase_to_range = ($purchase_date_range_to)*12;
        $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date ) ;   
        $new_purchase_from_range =$purchase_date_range_from;
        $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date  ) ; 
    } else {
        $newdate_purchase_range_to_date_compare = strtotime($purchase_date_range_from);
        $newdate_purchase_range_from_date_compare = strtotime($purchase_date_range_to[0]);
    }
        
    if(($returnvalue)){
    $condition='';
    
    if($max_invites > 0){
        $limit = 'Limit '.$max_invites;
    }else{
        $limit = '';
    }
    foreach($returnvalue as $values){
    //vehicle cass
    if($values['report_type']=='vehicle_class'){
       $field_value=$values['value1'];
       //explode the search options in vehicle class
       $field_values_explode=explode(',',$field_value);
       $commoncheck=0;
       if(is_array($field_values_explode) && $field_values_explode!=''){
        if($group_id!=''){
       $condition.="id NOT IN ($group_id) AND ";  
       }
       $condition.='(';
       foreach($field_values_explode as $value_select){
       if($commoncheck>0){
       $condition.=' OR ';
       }
       
       $condition_name=$this -> get_vehicle_class_feild_values($value_select);
       if($value_select=='full_size_cars' ){
       //if report group is full size cars
           $condition.="(vehicletype='Car' AND 
           market NOT LIKE 'crossover%' AND 
           (vehicleCategory = 'Large Cars' OR 
           vehicleCategory = 'LARGE_CARS' OR 
           vehicleCategory = 'LARGE_STATION_WAGONS'))";
       }else if($value_select=='mid_size_cars' ){
        //if report group is mid size cars
           $condition.="(vehicletype='Car' AND 
           market not LIKE 'crossover%' AND
           (vehiclecategory = 'Midsize Cars' OR 
           vehicleCategory = 'Midsize Station Wagons' OR 
           vehicleCategory = 'MIDSIZE_CARS' OR 
           vehicleCategory = 'MIDSIZE_STATION_WAGONS'))";    
       }else if($value_select=='small_cars'){
        //if report group is small cars
           $condition.="(vehicletype='Car' AND 
           market NOT LIKE 'crossover%' AND 
           (vehiclecategory ='Compact Cars' OR 
           vehicleCategory = 'Subcompact Cars' OR 
           vehicleCategory = 'Small Station Wagons' OR 
           vehicleCategory = 'Mini Compact Cars' OR 
           vehicleCategory = 'SUBCOMPACT_CARS' OR 
           vehicleCategory = 'COMPACT_CARS' OR 
           vehicleCategory = 'SMALL_STATION_WAGONS' OR 
           vehicleCategory = 'MINI_COMPACT_CARS'))";   
       }else if($value_select=='suvs' ){
        //if report group is SUVs
            $condition.="(vehicletype='SUV' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Sport Utility Vehicles' OR 
            vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
       }else if($value_select=='green_cars' ){
        //if report group is green cars
            $condition.="((enginefueltype = 'Electric' OR 
            enginefueltype = 'Natural Gas') OR
            (market = 'hybrid'))";   
       }else if($value_select=='vans' ){
        //if report group is van
            $condition.="(vehicletype='Minivan' OR vehicletype='Van' )";   
        }else if($value_select=='crossovers' ){
            //if report group is crossovers
            $condition.="(market LIKE 'crossover%')";   
        }else if($value_select=='two_seater_cars' ){
            //if report group is two seater cars
            $condition.="(vehicletype='Car' AND 
           market not LIKE 'crossover%' AND
           (vehicleCategory = 'Two Seaters' OR vehicleCategory='TWO_SEATERS'))";   
        }else if($value_select=='unknown' ){
            //if report group is unknown
            $condition.="(vehicletype='' OR  vehicletype='Not Available'
           )";   
        }else{
            $condition.='(vehicletype='."'".$condition_name."')";
       }
       $commoncheck++; 
        
       }
       $condition.=')'; 
       $condition.=' AND '; 
       }else{
            $condition='';   
       }
       $sql_get_query=("SELECT  * FROM eps_data  WHERE
       $condition  dealership_id='$dealer_id_upload_data' AND (
       first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
       $newdate_purchase_range_from_date_compare 
       OR 
       contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
       $newdate_purchase_range_from_date_compare)
       order by id ASC");
       //echo $sql_get_query;
       
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
       $result=$this->db->query($sql_get_query." ".$limit);
       if($result -> num_rows() >0){
            $return_result= $result->result_array();
       }else{
            $return_result='';
       }
}
//drive type
    else if($values['report_type']=='drive_type'){
        //getting the dealer's id which are exist in other group
        $field_value=$values['value1'];
        if($group_id!=''){
        $condition.="id  NOT IN ($group_id)  AND ";  
        }
        $condition.='(';
        if($field_value=='fwd'){
        //the drive type is  Front Wheel Drive 
         $condition.="drivenwheels='FWD' AND " ; 
        }else if($field_value=='rwd'){
            //the drive type is  Rear Wheel Drive
         $condition.="drivenwheels='RWD' AND " ; 
        }else if($field_value=='awd'){
        //the drive type is  All Wheel Drive
             $condition.="drivenwheels='AWD' AND " ; 
        }elseif($field_value=='4x4'){
        //the drive type is  Four Wheel Drive
            $condition.="drivenwheels='4x4' AND " ; 
        }else{
        //the drive type is  Unavailable
            $condition.="drivenwheels='Unavailable' AND " ;    
        }
        $condition.="dealership_id='$dealer_id_upload_data' AND " ;
        //generating query for drive type
        $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
        (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare 
        AND $newdate_purchase_range_from_date_compare
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare 
        AND $newdate_purchase_range_from_date_compare )) 
        order by id ASC ");
        
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }else{
            $limit = '';
        }
       	$result=$this->db->query($sql_get_query." ".$limit);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }   
    }
    //fuel ecconomy
    else if($values['report_type']=='fuel_economy'){
        $return_result='';
        if($values['value1']!=''){
        $field_value1=$values['value1'];
        }
        else{
        $field_value1=0;  
        }
        if($values['value2']!=''){
        $field_value2=$values['value2'];
        }
        else{
        $field_value2=0;  
        }
        if($group_id!=''){
        $condition.=" id  NOT IN ($group_id) AND ";  
        }
        $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
        (littercombined between  $field_value1  AND 
        $field_value2 AND dealership_id='$dealer_id_upload_data' AND 
        (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare )) 
        order by id ASC ");
        
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
       	$result=$this->db->query($sql_get_query." ".$limit);
        if($result -> num_rows() >0){
        $return_result=$result->result_array();
        } 
        else{
        $return_result='';
        } 
        //echo $sql_get_query;  
    }
    //trade in value
    else if($values['report_type']=='trade_in_value'){
        $return_result='';
        $field_value_option=$values['value3'];
        if($values['value1']!=''){
        $field_value1=$values['value1'];
        }
        else{
        $field_value1=0;  
        }
        if($values['value2']!=''){
        $field_value2=$values['value2'];
        }else{
            $field_value2=0;  
        }
        $field_value_option_conditions='';
        //if serach condition is high ,low  or average the generate conditions
        if($field_value_option=='high'){
            $field_value_option_conditions= "eps_master_vehicle.hkm_low_value>=$field_value1 AND 
            eps_master_vehicle.hkm_high_value
            <=$field_value2
            AND " ;  
        }elseif($field_value_option=='low'){
            $field_value_option_conditions= "eps_master_vehicle.lkm_low_value>=$field_value1 AND 
            eps_master_vehicle.lkm_high_value
            <=$field_value2
            AND " ;  
        }else{
         $field_value_option_conditions= $field_value_option_conditions= "eps_master_vehicle.lkm_low_value>=$field_value1 AND 
            eps_master_vehicle.lkm_high_value
            <=$field_value2
            AND " ; 
        }
        if($group_id!=''){
            $condition.=" AND eps_data.id  NOT IN ('$group_id')  ";  
        }
        //generate query
        $sql_get_query=("SELECT eps_data.* 
                FROM eps_data
                INNER JOIN eps_master_vehicle ON (eps_data.sold_vehicle_year = eps_master_vehicle.sold_vehicle_year
                AND eps_data.sold_vehicle_make = eps_master_vehicle.sold_vehicle_make
                AND eps_data.sold_vehicle_model = eps_master_vehicle.sold_vehicle_model
                AND eps_master_vehicle.vin = SUBSTRING( eps_data.sold_vehicle_VIN, 1, 8 )
                AND $field_value_option_conditions
                (
        eps_data.first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare 
        OR 
        eps_data.contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare)
        AND eps_data.dealership_id =$dealer_id_upload_data) $condition ");
        
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
       	$result=$this->db->query($sql_get_query." ".$limit);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        }else{
        $return_result='';
        }
    }
    //finance rate    
    else if($values['report_type']=='finance_rate'){
        $return_result=''; 
        if($values['value1']!=''){
        $field_value1=$values['value1'];
        }
        else{
        $field_value1=0;  
        }
        if($values['value2']!=''){
        $field_value2=$values['value2'];
        }else{
            $field_value2=0;  
        }if($group_id!=''){
            $condition.="id  NOT IN ($group_id) AND ";  
        }
        $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
   	    (apr between  $field_value1  and $field_value2 and dealership_id='$dealer_id_upload_data' AND 
        (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND
        $newdate_purchase_range_from_date_compare 
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare
        ))
        order by id ASC ");
        
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
      	$result=$this->db->query($sql_get_query." ".$limit);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }   
    }
    //monthly payment
    else if($values['report_type']=='monthly_payment'){
        $return_result='';
        if($values['value1']!=''){
        $field_value1=$values['value1'];
        }
        else{
        $field_value1=0;  
        }
        if($values['value2']!=''){
        $field_value2=$values['value2'];
        }else{
         $field_value2=0;  
        }if($group_id!=''){
            $condition.="id   NOT IN ($group_id) AND ";  
        }
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
        $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
        monthly_payment  between  $field_value1  AND $field_value2 AND 
        dealership_id='$dealer_id_upload_data' AND (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare 
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare)
        order by id ASC ");
       	$result=$this->db->query($sql_get_query." ".$limit);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }   
    }
    //fuel type
    else if($values['report_type']=='fuel_type'){
        $return_result='';
        $field_value=$values['value1'];
        $field_name=$values['field_name1'];
        $field_values_explode='';
        if($field_value!=''){
        $field_values_explode=explode(',',$field_value);
        }
        $commoncheck=0;
        if($group_id!=''){
        $condition.="id  NOT IN ($group_id) AND ";  
        }
        $condition.='(';
        //engine fuel type is gas
        if($field_name=='gas'){
            $condition.="(enginefueltype LIKE 'Flex Fuel%' OR  
            enginefueltype LIKE 'Premium Unleaded%' OR 
            enginefueltype LIKE 'Regular Unleaded%') AND ";
        }
        //engine fuel type is diesel
        else if($field_name=='diesel'){
            $condition.="enginefueltype LIKE 'Diesel%' AND ";
        }
        //engine fuel type is other
          else if($field_name=='hybrid'){
            $condition.="enginefueltype LIKE 'Natural Gas%' OR 
            enginefueltype LIKE 'Electric%' AND ";
            }
         //engine fuel type is unknown
          else if($field_name=='unknown'){
            $condition.="(enginefueltype = 'Not Available' OR 
            enginefueltype='') AND ";
        }if(is_array($field_values_explode) && $field_values_explode!=''){
        $condition.='(';
        foreach($field_values_explode as $value_select){
        if($commoncheck>0){
        $condition.='OR ';
        }
        //getting field name realted to the variable
        $condition_name=$this -> get_vehicle_class_feild_values($value_select);
            if($value_select=='full_size_cars' ){
            //if report group is full size cars
            $condition.="(vehicletype='Car' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Large Cars' OR 
            vehicleCategory = 'LARGE_CARS' OR 
            vehicleCategory = 'LARGE_STATION_WAGONS'))";
        }
        //if report group is mid size cars
        else if($value_select=='mid_size_cars' ){
            $condition.="(vehicletype='Car' AND 
            market not LIKE 'crossover%' AND
            (vehiclecategory = 'Midsize Cars' OR 
            vehicleCategory = 'Midsize Station Wagons' OR 
            vehicleCategory = 'MIDSIZE_CARS' OR 
            vehicleCategory = 'MIDSIZE_STATION_WAGONS'))";    
        }
        else if($value_select=='small_cars' ){
            $condition.="(vehicletype='Car' AND 
            market NOT LIKE 'crossover%' AND 
           (vehiclecategory ='Compact Cars' OR 
            vehicleCategory = 'Subcompact Cars' OR 
            vehicleCategory = 'Small Station Wagons' OR 
            vehicleCategory = 'Mini Compact Cars' OR 
            vehicleCategory = 'SUBCOMPACT_CARS' OR 
            vehicleCategory = 'COMPACT_CARS' OR 
            vehicleCategory = 'SMALL_STATION_WAGONS' OR 
            vehicleCategory = 'MINI_COMPACT_CARS'))";    
        }
        //if report group is SUVs
       else if($value_select=='suvs'){
            $condition.="(vehicletype='SUV' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Sport Utility Vehicles' OR 
            vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
       }
       //if report group is green cars
       else if($value_select=='green_cars' ){
            $condition.="((enginefueltype = 'Electric' OR 
            enginefueltype = 'Natural Gas') OR
            (market = 'hybrid'))"; 
       }
       else if($value_select=='vans' ){
            $condition.="(vehicletype='Minivan' OR vehicletype='Van' )";   
       }else if($value_select=='crossovers' ){
        //if report group is crossovers
            $condition.="(market LIKE 'crossover%')";   
        }else{
        $condition.='(vehicletype='."'".$condition_name."')";
        }
        $commoncheck++; 
        }
        $condition.=')';
        $condition.=" AND  ";
        }
        $condition.="dealership_id='$dealer_id_upload_data' AND (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare 
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare )";
        $condition.=')';
        $sql_get_query=("SELECT  * FROM eps_data  WHERE
        $condition  
         order by id ASC ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }  
    }
    //used and new purchase   
    else if($values['report_type']=='used_new_purchaser'){
        $return_result='';
        $field_values_display='';
        $field_value=$values['value1'];
        $field_name=$values['field_name1'];
        $field_values_explode='';
        //getting the report option value
        if($field_value!=''){
        $field_values_explode=explode(',',$field_value);
        }
        $commoncheck=0;
        if($group_id!=''){
        $condition.="id  NOT IN ($group_id) AND ";  
        }
        $condition.='(';
        //if new vehicle
        if($field_name=='new'){
        $condition.="(new_used='N' OR new_used='NEW') AND ";
        }
        else{
        //if it is used
        $condition.="(new_used='U' OR new_used='USED') AND ";
        }
        if(is_array($field_values_explode) && $field_values_explode!=''){
        $condition.='(';
        foreach($field_values_explode as $value_select){
        if($commoncheck>0){
        $condition.='OR ';
        }
        $condition_name=$this -> get_vehicle_class_feild_values($value_select);
        //if report group is full size cars
        if($value_select=='full_size_cars' ){
            $condition.="(vehicletype='Car' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Large Cars' OR 
            vehicleCategory = 'LARGE_CARS' OR 
            vehicleCategory = 'LARGE_STATION_WAGONS'))";
        }
        else if($value_select=='mid_size_cars' ){
        //if report group is mid size cars
           $condition.="(vehicletype='Car' AND 
           market not LIKE 'crossover%' AND
           (vehiclecategory = 'Midsize Cars' OR 
           vehicleCategory = 'Midsize Station Wagons' OR 
           vehicleCategory = 'MIDSIZE_CARS' OR 
           vehicleCategory = 'MIDSIZE_STATION_WAGONS'))";   
        }else if($value_select=='small_cars' ){
        //if report group is small cars
           $condition.="(vehicletype='Car' AND 
           market NOT LIKE 'crossover%' AND 
           (vehiclecategory ='Compact Cars' OR 
           vehicleCategory = 'Subcompact Cars' OR 
           vehicleCategory = 'Small Station Wagons' OR 
           vehicleCategory = 'Mini Compact Cars' OR 
           vehicleCategory = 'SUBCOMPACT_CARS' OR 
           vehicleCategory = 'COMPACT_CARS' OR 
           vehicleCategory = 'SMALL_STATION_WAGONS' OR 
           vehicleCategory = 'MINI_COMPACT_CARS'))"; 
        }else if($value_select=='suvs' ){
        //if report group is SUVs
            $condition.="(vehicletype='SUV' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Sport Utility Vehicles' OR 
            vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
       }else if($value_select=='green_cars' ){
        //if report group is green cars
            $condition.="((enginefueltype = 'Electric' OR 
            enginefueltype = 'Natural Gas') OR
            (market = 'hybrid'))";   
       }
        else if($value_select=='vans' ){
            $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
        }else if($value_select=='crossovers' ){
            //if report group is crossovers
            $condition.="(market LIKE 'crossover%')";   
        }else{
        $condition.='vehicletype='."'".$condition_name."'";
        }
        $commoncheck++; 
        
        }
        $condition.=')';
        $condition.=" AND "; 
        }
        $condition.="dealership_id='$dealer_id_upload_data' AND (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare 
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare
        )" ;
        $condition.=')';
        $sql_get_query=("SELECT  * FROM eps_data  WHERE
        $condition  
         order by id ASC ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }  
    }
    //local town
        else if($values['report_type']=='local_town'){
            $return_result='';
            $get_dealer_details=$this ->  main_model-> dealerfulldetails($dealer_id_upload_data);
            if(isset($get_dealer_details) && $get_dealer_details!=''){
                foreach($get_dealer_details as $values_dealer_details){
                    $dealer_city= $values_dealer_details['city']; 
                }  
            }
            $field_value=$values['value1'];
            $field_name=$values['field_name1'];
            //getting the report options
            $field_values_explode='';
            if($field_value!=''){
            $field_values_explode=explode(',',$field_value);
            }
            $commoncheck=0;
            $condition.='(';
            //ihe field selected is local
            if($field_name=='local'){
            $condition.='buyer_city='."'".$dealer_city."'";
            $condition.=' AND ';
            }else if($field_name=='out_of_town'){
            //field selected is out of town
            $condition.='buyer_city!='."'".$dealer_city."'";
            $condition.=' AND ';
            }
            else{
            $condition.='';
            }
            //report option not null
            if(is_array($field_values_explode) && $field_values_explode!=''){
            $condition.='(';
            foreach($field_values_explode as $value_select){
            if($commoncheck>0){
            $condition.=' OR ';
            }
            $condition_name=$this -> get_vehicle_class_feild_values($value_select);
            if($value_select=='full_size_cars' ){
                //if report group is full size cars
                $condition.="(vehicletype='Car' AND 
                market NOT LIKE 'crossover%' AND 
                (vehicleCategory = 'Large Cars' OR 
                vehicleCategory = 'LARGE_CARS' OR 
                vehicleCategory = 'LARGE_STATION_WAGONS'))";
            }else if($value_select=='mid_size_cars' ){
               //if report group is mid size cars   
                $condition.="(vehicletype='Car' AND 
                market not LIKE 'crossover%' AND
                (vehiclecategory = 'Midsize Cars' OR 
                vehicleCategory = 'Midsize Station Wagons' OR 
                vehicleCategory = 'MIDSIZE_CARS' OR 
                vehicleCategory = 'MIDSIZE_STATION_WAGONS'))"; 
            }else if($value_select=='small_carsfull_size_cars' ){
                //if report group is small cars
               $condition.="(vehicletype='Car' AND 
               market NOT LIKE 'crossover%' AND 
               (vehiclecategory ='Compact Cars' OR 
               vehicleCategory = 'Subcompact Cars' OR 
               vehicleCategory = 'Small Station Wagons' OR 
               vehicleCategory = 'Mini Compact Cars' OR 
               vehicleCategory = 'SUBCOMPACT_CARS' OR 
               vehicleCategory = 'COMPACT_CARS' OR 
               vehicleCategory = 'SMALL_STATION_WAGONS' OR 
               vehicleCategory = 'MINI_COMPACT_CARS'))";  
            }else if($value_select=='suvs' ){
            //if report group is SUVs
            $condition.="(vehicletype='SUV' AND 
            market NOT LIKE 'crossover%' AND 
            (vehicleCategory = 'Sport Utility Vehicles' OR 
            vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
            }else if($value_select=='green_cars' ){
            //if report group is green cars
            $condition.="((enginefueltype = 'Electric' OR 
            enginefueltype = 'Natural Gas') OR
            (market = 'hybrid'))";   
            }
            else if($value_select=='vans' ){
            $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
            }else if($value_select=='crossovers' ){
            //if report group is crossovers
            $condition.="(market LIKE 'crossover%')";   
            }else{
            $condition.='(vehicletype='."'".$condition_name."')";
            }
            $commoncheck++; 
            } 
            $condition.=')';
            $condition.=" AND ";
            }
            $condition.="dealership_id='$dealer_id_upload_data' AND (
            first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare
            )";
            $condition.=')';
            if($group_id!=''){
            $condition.=" AND id  NOT IN ($group_id) ";  
            }
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition  
             order by id ASC ");
              //echo $sql_get_query;
      	     $result=$this->db->query($sql_get_query);
            if($result -> num_rows() >0){
            $return_result= $result->result_array();
            } 
            else{
            $return_result='';
            }  
    }
       //dealership brand
       else if($values['report_type']=='dealership_brand'){
           $return_result='';
           $get_dealer_details=$this ->  main_model-> dealerfulldetails($dealer_id_upload_data);
           $dealer_manufacure_explode='';
           $commoncheck=0;
           if(isset($get_dealer_details) && $get_dealer_details!=''){
            if($group_id!=''){
           $condition.="id  NOT IN ($group_id) AND ";  
           }
            $condition.='(';
           foreach($get_dealer_details as $values_dealer_details){
           $dealer_manufacure= $values_dealer_details['masterbrand']; 
           $dealer_manufacure_explode=explode(',',$dealer_manufacure);
           if(is_array($dealer_manufacure_explode)){
            foreach($dealer_manufacure_explode as $dealer_master_brand){
            if($commoncheck>0){
            $condition.=' AND ';
            }
            $condition.='(sold_vehicle_make!='."'".$dealer_master_brand."') ";
            $commoncheck++;
            }
            }
            } 
            $condition.="AND dealership_id='$dealer_id_upload_data' AND (
            first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare
            )";
            $condition.=')'; 
            }
            if($max_invites > 0){
                $limit = 'Limit '.$max_invites;
            }
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition  
             order by id ASC ");
            $result=$this->db->query($sql_get_query." ".$limit);
           //echo $sql_get_query;
            if($result -> num_rows() >0){
            $return_result= $result->result_array();
            } 
            else{
            $return_result='';
            }  
       }
       //power focus
       else if($values['report_type']=='power_focus'){
           $return_result='';
           $field_value=$values['value1'];
           $field_name=$values['field_name1'];
           $field_values_explode=explode(',',$field_value);
           $commoncheck=0;
           if($group_id!=''){
           $condition.="id NOT IN ($group_id) AND ";  
           }
           $condition.='(';
           if(is_array($field_values_explode) && $field_values_explode!=''){
           $condition.='(';
           foreach($field_values_explode as $value_select){
            if($commoncheck>0){
            $condition.=' OR ';
            }
            //getting field value 
            $condition_name=$this -> get_vehicle_class_feild_values($value_select);
            if($value_select=='four_door_cars' ){
                //report group is four door cars
                $condition.="(vehicleType = 'Car' AND 
                market NOT LIKE 'crossover%' AND 
                vehicleCategory !='Two Seaters' AND 
                (market = 'Factory Tuner' OR 
                market='High-Performance' OR 
                market='Performance' OR 
                market='Exotic'))";
            }else if($value_select=='two_door_cars' ){
                //report group is two door cars
                $condition.="(vehicleType = 'Car' AND 
                market NOT LIKE 'crossover%' AND 
                vehicleCategory = 'Two Seaters' AND 
                (market LIKE  'Factory Tuner%' OR 
                market LIKE  'High-Performance%' OR 
                market LIKE  'Performance%' OR 
                market LIKE  'Exotic%'))";  
            }else if($value_select=='suvs' ){
                //report group is SUV
                $condition.="(vehicleType ='SUV' AND 
                market NOT LIKE 'crossover%' AND 
                (market LIKE  'Factory Tuner%' OR 
                market LIKE  'High-Performance%' OR 
                market LIKE  'Performance%' OR 
                market LIKE  'Exotic%'))";  
            }else if($value_select=='crossovers' ){
                //report group is crossovers
                $condition.="(market = 'crossover' AND 
                (market LIKE 'Factory Tuner%' OR 
                market LIKE 'High-Performance%' OR 
                market LIKE 'Performance%' OR 
                market LIKE 'Exotic%'))";  
            }else if($value_select=='trucks' ){
                //report group is trucks
                $condition.="(vehicleType = 'Truck' AND 
                (market LIKE 'Factory Tuner%' OR 
                market LIKE 'High-Performance%' OR 
                market LIKE 'Performance%' OR 
                market LIKE 'Exotic%'))";  
            }else if($value_select=='other' ){
                //report group is other
                $condition.="(vehicleType = '' AND 
                (market LIKE 'Factory Tuner%' OR 
                market LIKE 'High-Performance%' OR 
                market LIKE 'Performance%' OR 
                market LIKE 'Exotic%'))";  
            }else{
                $condition.='(vehicletype='."'".$condition_name."')";
            }
            $commoncheck++;
            }
            $condition.=')';
            $condition.=' AND ';
            }
            $condition.= " dealership_id='$dealer_id_upload_data' AND (
            first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare
            )";
            $condition.=')';
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition 
            order by id ASC");
            $result=$this->db->query($sql_get_query);
            if($result -> num_rows() >0){
            $return_result= $result->result_array();
            } 
            else{
            $return_result='';
            }  
    }
    //specific model
    else if($values['report_type']=='specific_model'){
        $return_result='';
        if($values['value1']!=''){
        $field_value1=$values['value1'];
        }
        else{
        $field_value1='';  
        }
        if($values['value2']!=''){
        $field_value2=$values['value2'];
        }
        else{
        $field_value2='';  
        }
        if($group_id!=''){
        $condition.="id  NOT IN ($group_id) AND ";  
        }
        $condition.='(';
        if($field_value1!=''){
        $condition.='sold_vehicle_make='."'".$field_value1."'";
        }
        else{
         $condition.="sold_vehicle_make=''";  
        }
        if($field_value2!=''){
        $condition.=' AND sold_vehicle_model='."'".$field_value2."' AND "; 
        }
        else{
         $condition.="AND sold_vehicle_model='' AND ";  
        }
         $condition.="dealership_id='$dealer_id_upload_data' AND (
         first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
         $newdate_purchase_range_from_date_compare 
         OR 
         contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
         $newdate_purchase_range_from_date_compare
         )";
         $condition.=')';
        $sql_get_query=("SELECT  * FROM eps_data  WHERE
        $condition  
         order by id ASC ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
        $return_result= $result->result_array();
        } 
        else{
        $return_result='';
        }  
    }
    else if($values['report_type']=='out_warranty'){
        if($dealer_id_upload_data!='198'){
        $powertrain_months='';
        if($group_id!=''){
        $condition.="id NOT IN ($group_id) AND ";  
        }
        $return_result='';
        $id_get='';
        //getting selected report option type
        if($values['value1']!=''){
            $field_value1=$values['value1'];
        }
        else{
            $field_value1='';  
        }
        //get event details
        $sql=("Select event_start_date from events where event_id=$event_id");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
        $returnvalue_get=$query->result_array();
        foreach($returnvalue_get as $event_date){
        $event_date_select=$event_date['event_start_date'];   
        }
        //get customer make,purchase date for calculate the month difference
        $query_financial=("SELECT id,first_payment_date,sold_vehicle_make,contract_date from  eps_data where $condition 
        (dealership_id='$dealer_id_upload_data' AND (
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare 
        OR 
        contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
        $newdate_purchase_range_from_date_compare
        )) 
        ");
        //echo $query_financial;
        $sql_get_query=$this->db->query($query_financial);
        if($sql_get_query -> num_rows() > 0)
        {
        $returnvalue_customer_data=$sql_get_query->result_array();
        foreach($returnvalue_customer_data as $customerdata) {
        //getting warranty manufacturedetails
        $sql_warranty_query=("SELECT  * FROM warranty_manufacture  WHERE
        manufacturer='$customerdata[sold_vehicle_make]'
        ");
        $sql_warranty_manufacture=$this->db->query($sql_warranty_query);
        if($sql_warranty_manufacture -> num_rows() > 0)
        {
        $returnvalue_warranty_manufacture=$sql_warranty_manufacture->result_array();
        foreach($returnvalue_warranty_manufacture as $value_warranty){
        $powertrain_months=$value_warranty['powertrain_months'];
        $basic_months=$value_warranty['basic_months'];    
        }
        }
        else{
        $powertrain_months='';
        $basic_months='';     
        }
        //first payment is empty  take the contract date
        if($customerdata['first_payment_date']!=0){
            $purchase_date_seltct=$customerdata['first_payment_date'];
        }
        else{
           $purchase_date_seltct=$customerdata['contract_date']; 
        }
        $purcahse_date=$purchase_date_seltct;
        //calculate month difference and get the customer id and save it in array for looping to get the detaiils of edch customer
        $difference = $event_date_select - $purcahse_date;
        $months = floor($difference / 86400 / 30 );
        if($months>0){
                    if($field_value1=='more_than_6months_basic_powertrain'){
                         //More than 6 months remaining on basic and powertrain
                        if($powertrain_months!='' && $basic_months!=''){
                            if($months<($powertrain_months-6) && $months<($basic_months-6)){
                                $id_get[]= $customerdata['id'];  
                        }
                    }
                    }if($field_value1=='less_than_6months_basicwarranty'){
                       //less than 6 months remaining on basic warranty
                        if($basic_months!=''){
                            if($months>($basic_months-6)){
                                $id_get[]= $customerdata['id'];
                            }    
                        }
                   }if($field_value1=='no_basicwarranty_6months_powertrain'){
                    //No basic warranty remaining but more than 6 months on powertrain remaining
                        if($basic_months!='' && $powertrain_months!=''){
                            if($months>$basic_months && $months<($powertrain_months-6)){   
                                $id_get[]= $customerdata['id'];
                            } 
                       }   
                    }if($field_value1=='less_than_6months_powertrain_warranty'){
                        //Less than 6 months remaining on powertrain warranty
                        if($powertrain_months!=''){
                            if($months<($powertrain_months-6)){
                                $id_get[]= $customerdata['id'];    
                            }
                        }
                    }if($field_value1=='no_warranty_vehicle'){
                        //no warranty on vehicle
                        if($basic_months!='' && $powertrain_months!=''){
                            //echo $months.'-'.$basic_months.'-'.$powertrain_months.'<br />';
                            if($months>$basic_months && $months>$powertrain_months){   
                                $id_get[]= $customerdata['id'];    
                            }
                        }
                    }
                }
        }
        $ij=0;
        $sql_warranty='';
        if(!empty($id_get)){
        $sql_warranty=("select * from  eps_data where dealership_id='$dealer_id_upload_data' ");
        $sql_warranty.=" AND ";
        $sql_warranty.="(";
        foreach($id_get as $values_id){
        if($values_id!=''){
        if($ij>0){
        $sql_warranty.=" or ";
        }
        $sql_warranty.="(id=$values_id)";
        $ij++;
        }
        }
        $sql_warranty.=")";
        $query_warranty = $this->db->query($sql_warranty);
        $return_result= $query_warranty->result_array();
        }
        else{
        $return_result='';     
        }
        }
        }
    }
    }
    else{
      $return_result='';  
    }
}
}
else{
$return_result='';
}
return $return_result;
}
public function get_advanced_option_group_details_mine_data($event_id,$group,$dealer_id_upload_data,$group_id){
    $return_result='';
    $sql=("Select * from advance_options_group_selection where event_id=$event_id and group_name='$group'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $returnvalue= $query->result_array();
        $condition='';
        foreach($returnvalue as $values){
            //vehicle cass
            if($values['report_type']=='vehicle_class'){
                $field_value=$values['value1'];
                $field_values_explode=explode(',',$field_value);
                $commoncheck=0;
                //getting selected report group
                if(is_array($field_values_explode) && $field_values_explode!=''){
                    if($group_id!=''){
                        $condition.="id NOT IN ($group_id) AND ";  
                    }
                    $condition.='(';
                    foreach($field_values_explode as $value_select){
                        if($commoncheck>0){
                            $condition.=' OR ';
                        }
                            //if report group is full size cars
                            $condition_name=$this -> get_vehicle_class_feild_values($value_select);
                            if($value_select=='full_size_cars' ){
                                $condition.="(vehicletype='Car' AND market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Large Cars' OR vehicleCategory = 'LARGE_CARS' OR 
                                vehicleCategory = 'LARGE_STATION_WAGONS'))";
                            }else if($value_select=='mid_size_cars' ){
                                //if report group is mid size cars
                                $condition.="(vehicletype='Car' AND 
                                market not LIKE 'crossover%' AND
                                (vehiclecategory = 'Midsize Cars' OR 
                                vehicleCategory = 'Midsize Station Wagons' OR 
                                vehicleCategory = 'MIDSIZE_CARS' OR 
                                vehicleCategory = 'MIDSIZE_STATION_WAGONS'))";   
                            }else if($value_select=='small_cars'){
                                //if report group is small cars
                                $condition.="(vehicletype='Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehiclecategory ='Compact Cars' OR 
                                vehicleCategory = 'Subcompact Cars' OR 
                                vehicleCategory = 'Small Station Wagons' OR 
                                vehicleCategory = 'Mini Compact Cars' OR 
                                vehicleCategory = 'SUBCOMPACT_CARS' OR 
                                vehicleCategory = 'COMPACT_CARS' OR 
                                vehicleCategory = 'SMALL_STATION_WAGONS' OR 
                                vehicleCategory = 'MINI_COMPACT_CARS'))";   
                            }else if($value_select=='suvs' ){
                                //if report group is SUVs
                                $condition.="(vehicletype='SUV' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Sport Utility Vehicles' OR 
                                vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
                                }else if($value_select=='green_cars' ){
                                //if report group is green cars
                                $condition.="((enginefueltype = 'Electric' OR 
                                enginefueltype = 'Natural Gas') OR
                                (market = 'hybrid'))";  
                            }else if($value_select=='vans' ){
                                //if report group is van
                                $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
                            }else if($value_select=='crossovers' ){
                                //if report group is crossovers
                                $condition.="(market LIKE 'crossover%')";   
                            }else if($value_select=='two_seater_cars' ){
                                //if report group is two seater cars
                                $condition.="(vehicletype='Car' AND 
                                market not LIKE 'crossover%' AND
                               (vehicleCategory = 'Two Seaters' OR vehicleCategory='TWO_SEATERS'))";   
                            }else if($value_select=='unknown' ){
                                //if report group is unknown
                                $condition.="(vehicletype='' OR  vehicletype='Not Available'
                               )";   
                            }else{
                                $condition.='(vehicletype='."'".$condition_name."')";
                            }
                            $commoncheck++; 
                         
                    }
                    $condition.=')'; 
                    $condition.=' AND '; 
                }
                else{
                    $condition='';   
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition   dealership_id='$dealer_id_upload_data' 
                order by id ASC");
                //echo$sql_get_query;
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                } 
                else{
                    $return_result='';
                }
            }
            //drive type
            else if($values['report_type']=='drive_type'){
                $field_value=$values['value1'];
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id)  AND ";  
                }
                $condition.='(';
                if($field_value=='fwd'){
                    //the drive type is  Front Wheel Drive 
                    $condition.="drivenwheels='Front Wheel Drive' AND " ; 
                }else if($field_value=='rwd'){
                    //the drive type is  Rear Wheel Drive
                    $condition.="drivenwheels='Rear Wheel Drive' AND " ; 
                }else if($field_value=='awd'){
                    //the drive type is  All Wheel Drive
                    $condition.="drivenwheels='All Wheel Drive' AND " ; 
                }elseif($field_value=='4x4'){
                    //the drive type is  Four Wheel Drive
                    $condition.="drivenwheels='Four Wheel Drive' AND " ; 
                }else{
                    //the drive type is  Unavailable
                    $condition.="drivenwheels='Unavailable' AND " ;    
                }
                $condition.="dealership_id='$dealer_id_upload_data')" ;
                //generating query for drive type
                $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }   
            }
            //fuel ecconomy
            else if($values['report_type']=='fuel_economy'){
                $return_result='';
                if($values['value1']!=''){
                    $field_value1=$values['value1'];
                }else{
                    $field_value1=0;  
                }
                if($values['value2']!=''){
                    $field_value2=$values['value2'];
                }else{
                    $field_value2=0;  
                }
                if($group_id!=''){
                    $condition.=" id  NOT IN ($group_id) AND ";  
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
                (littercombined between  $field_value1  and $field_value2 and dealership_id='$dealer_id_upload_data') 
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result=$result->result_array();
                }else{
                    $return_result='';
                } 
                //echo $sql_get_query;  
            }
            //trade in value
            else if($values['report_type']=='trade_in_value'){
                $return_result='';
                if($values['value1']!=''){
                    $field_value1=$values['value1'];
                }else{
                    $field_value1=0;  
                }
                if($values['value2']!=''){
                    $field_value2=$values['value2'];
                }else{
                    $field_value2=0;  
                }
                 if($values['value3']!=''){
                    $field_value3=$values['value3'];
                }else{
                    $field_value3=0;  
                }
                
                if($group_id!=''){
                    $condition.="id  NOT IN ('$group_id') AND ";  
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
                (tradeinvalue between  '$field_value1'  and '$field_value2' and dealership_id='$dealer_id_upload_data') 
                order by id ASC ");
                
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }
            }
            //finance rate    
            else if($values['report_type']=='finance_rate'){
                $return_result=''; 
                if($values['value1']!=''){
                    $field_value1=$values['value1'];
                }else{
                    $field_value1=0;  
                }
                if($values['value2']!=''){
                    $field_value2=$values['value2'];
                }else{
                    $field_value2=0;  
                }
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";  
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
                (apr between  $field_value1  and $field_value2 and dealership_id='$dealer_id_upload_data')
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                } 
                else{
                    $return_result='';
                }   
            }
            //monthly payment
            else if($values['report_type']=='monthly_payment'){
                $return_result='';
                if($values['value1']!=''){
                    $field_value1=$values['value1'];
                }else{
                    $field_value1=0;  
                }
                if($values['value2']!=''){
                    $field_value2=$values['value2'];
                }else{
                    $field_value2=0;  
                }
                if($group_id!=''){
                    $condition.="id   NOT IN ($group_id) AND ";  
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition
                monthly_payment  between  $field_value1  and $field_value2 and dealership_id='$dealer_id_upload_data' 
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }   
            }
            //fuel type
            else if($values['report_type']=='fuel_type'){
                $return_result='';
                $field_value=$values['value1'];
                $field_name=$values['field_name1'];
                //getting the field values
                $field_values_explode='';
                if($field_value!=''){
                    $field_values_explode=explode(',',$field_value);
                }
                $commoncheck=0;
                //check if the cutomer id is already exsist
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";  
                }
                $condition.='(';
                    //engine fuel type is gas
                    if($field_name=='gas'){
                        $condition.="(enginefueltype LIKE 'Flex Fuel%' OR  
                        enginefueltype LIKE 'Premium Unleaded%' OR 
                        enginefueltype LIKE 'Regular Unleaded%') AND ";
                    }else if($field_name=='diesel'){
                        //engine fuel type is diesel
                        $condition.="enginefueltype LIKE 'Diesel%' AND ";
                    }else if($field_name=='hybrid'){
                        //engine fuel type is other
                        $condition.="enginefueltype LIKE 'Natural Gas%' OR enginefueltype LIKE 'Electric%' AND ";
                    }else if($field_name=='unknown'){
                    //engine fuel type is unknown
                    $condition.="(enginefueltype = 'Not Available' OR 
                    enginefueltype = '') AND ";
                    }
                
                //check the array is not empty
                if(is_array($field_values_explode) && $field_values_explode!=''){
                    $condition.='(';
                    foreach($field_values_explode as $value_select){
                        if($commoncheck>0){
                        $condition.='OR ';
                        }
                        $condition_name=$this -> get_vehicle_class_feild_values($value_select);
                            if($value_select=='full_size_cars' ){
                                //if report group is full size cars
                                $condition.="(vehicletype='Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Large Cars' OR 
                                vehicleCategory = 'LARGE_CARS' OR 
                                vehicleCategory = 'LARGE_STATION_WAGONS'))";
                            }else if($value_select=='mid_size_cars' ){
                                //if report group is mid size cars
                                $condition.="(vehicletype='Car' AND 
                                market not LIKE 'crossover%' AND
                                (vehiclecategory = 'Midsize Cars' OR 
                                vehicleCategory = 'Midsize Station Wagons' OR 
                                vehicleCategory = 'MIDSIZE_CARS' OR 
                                vehicleCategory = 'MIDSIZE_STATION_WAGONS'))"; 
                            }else if($value_select=='small_cars' ){
                                //if report group is small cars
                                $condition.="(vehicletype='Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehiclecategory ='Compact Cars' OR 
                                vehicleCategory = 'Subcompact Cars' OR 
                                vehicleCategory = 'Small Station Wagons' OR 
                                vehicleCategory = 'Mini Compact Cars' OR 
                                vehicleCategory = 'SUBCOMPACT_CARS' OR 
                                vehicleCategory = 'COMPACT_CARS' OR 
                                vehicleCategory = 'SMALL_STATION_WAGONS' OR 
                                vehicleCategory = 'MINI_COMPACT_CARS'))";   
                            }else if($value_select=='suvs' ){
                                //if report group is SUVs
                                $condition.="(vehicletype='SUV' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Sport Utility Vehicles' OR 
                                vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
                            }else if($value_select=='green_cars' ){
                                //if report group is green cars
                                $condition.="((enginefueltype = 'Electric' OR 
                                enginefueltype = 'Natural Gas') OR
                                (market = 'hybrid'))"; 
                            }else if($value_select=='vans' ){
                                $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
                            }else{
                                $condition.='(vehicletype='."'".$condition_name."')";
                            }
                        $commoncheck++; 
                        
                    }
                    $condition.=')';
                    $condition.=" AND  ";
                }
                $condition.="dealership_id='$dealer_id_upload_data'" ;
                $condition.=')';
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition  
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }  
            }
            //used and new purchase   
            else if($values['report_type']=='used_new_purchaser'){
                $return_result='';
                $field_values_display='';
                $field_value=$values['value1'];
                $field_name=$values['field_name1'];
                $field_values_explode='';
                //getting the report options
                if($field_value!=''){
                    $field_values_explode=explode(',',$field_value);
                }
                $commoncheck=0;
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";  
                }
                $condition.='(';
                if($field_name=='new'){
                    //if the search option is new
                    $condition.="(new_used='N' OR new_used='NEW') AND ";
                }else{
                    //if the search option is used
                    $condition.="(new_used='U' OR new_used='USED') AND ";
                }
                //if array is not empty
                if(is_array($field_values_explode) && $field_values_explode!=''){
                $condition.='(';
                    foreach($field_values_explode as $value_select){
                        if($commoncheck>0){
                            $condition.='OR ';
                        }
                            $condition_name=$this -> get_vehicle_class_feild_values($value_select);
                            if($value_select=='full_size_cars' ){
                                //if report group is full size cars
                                $condition.="(vehicletype='Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Large Cars' OR 
                                vehicleCategory = 'LARGE_CARS' OR 
                                vehicleCategory = 'LARGE_STATION_WAGONS'))";
                            }else if($value_select=='mid_size_cars' ){
                                //if report group is mid size cars 
                                $condition.="(vehicletype='Car' AND 
                                market not LIKE 'crossover%' AND
                                (vehiclecategory = 'Midsize Cars' OR 
                                vehicleCategory = 'Midsize Station Wagons' OR 
                                vehicleCategory = 'MIDSIZE_CARS' OR 
                                vehicleCategory = 'MIDSIZE_STATION_WAGONS'))";  
                            }else if($value_select=='small_cars' ){
                                //if report group is small cars
                                $condition.="(vehicletype='Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehiclecategory ='Compact Cars' OR 
                                vehicleCategory = 'Subcompact Cars' OR 
                                vehicleCategory = 'Small Station Wagons' OR 
                                vehicleCategory = 'Mini Compact Cars' OR 
                                vehicleCategory = 'SUBCOMPACT_CARS' OR 
                                vehicleCategory = 'COMPACT_CARS' OR 
                                vehicleCategory = 'SMALL_STATION_WAGONS' OR 
                                vehicleCategory = 'MINI_COMPACT_CARS'))";    
                            }else if($value_select=='suvs' ){
                                //if report group is SUVs
                                $condition.="(vehicletype='SUV' AND 
                                market NOT LIKE 'crossover%' AND 
                                (vehicleCategory = 'Sport Utility Vehicles' OR 
                                vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
                            }else if($value_select=='green_cars' ){
                                //if report group is green cars
                                $condition.="((enginefueltype = 'Electric' OR 
                                enginefueltype = 'Natural Gas') OR
                                (market = 'hybrid'))"; 
                            }else if($value_select=='vans' ){
                                $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
                            }else if($value_select=='crossovers' ){
                                //if report group is crossovers
                                $condition.="(market LIKE 'crossover%')";   
                            }else{
                                $condition.='vehicletype='."'".$condition_name."'";
                            }
                            $commoncheck++; 
                        
                    }
                    $condition.=')';
                    $condition.=" AND "; 
                }
                $condition.="dealership_id='$dealer_id_upload_data'" ;
                $condition.=')';
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition  
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }  
            }
            //local town
            else if($values['report_type']=='local_town'){
                $return_result='';
                $get_dealer_details=$this ->  main_model-> dealerfulldetails($dealer_id_upload_data);
                if(isset($get_dealer_details) && $get_dealer_details!=''){
                    foreach($get_dealer_details as $values_dealer_details){
                        $dealer_city= $values_dealer_details['city']; 
                    }  
                }
                $field_value=$values['value1'];
                $field_name=$values['field_name1'];
                //get the report options
                $field_values_explode='';
                if($field_value!=''){
                    $field_values_explode=explode(',',$field_value);
                }
                $commoncheck=0;
                $condition.='(';
                if($field_name=='local'){
                    $condition.='buyer_city='."'".$dealer_city."'";
                    $condition.=' AND ';
                }else if($field_name=='out_of_town'){
                    $condition.='buyer_city!='."'".$dealer_city."'";
                    $condition.=' AND ';
                }else{
                    $condition.='';
                }
                if(is_array($field_values_explode) && $field_values_explode!=''){
                    $condition.='(';
                    foreach($field_values_explode as $value_select){
                        if($commoncheck>0){
                            $condition.=' OR ';
                        }
                        $condition_name=$this -> get_vehicle_class_feild_values($value_select);
                        if($value_select=='full_size_cars' ){
                            //if report group is full size cars   
                            $condition.="(vehicletype='Car' AND 
                            market NOT LIKE 'crossover%' AND 
                            (vehicleCategory = 'Large Cars' OR 
                            vehicleCategory = 'LARGE_CARS' OR 
                            vehicleCategory = 'LARGE_STATION_WAGONS'))";            
                            }else if($value_select=='mid_size_cars' ){
                            //if report group is mid size cars
                            $condition.="(vehicletype='Car' AND 
                            market not LIKE 'crossover%' AND
                            (vehiclecategory = 'Midsize Cars' OR 
                            vehicleCategory = 'Midsize Station Wagons' OR 
                            vehicleCategory = 'MIDSIZE_CARS' OR 
                            vehicleCategory = 'MIDSIZE_STATION_WAGONS'))"; 
                        }else if($value_select=='small_cars' ){
                            //if report group is small cars  
                            $condition.="(vehicletype='Car' AND 
                            market NOT LIKE 'crossover%' AND 
                            (vehiclecategory ='Compact Cars' OR 
                            vehicleCategory = 'Subcompact Cars' OR 
                            vehicleCategory = 'Small Station Wagons' OR 
                            vehicleCategory = 'Mini Compact Cars' OR 
                            vehicleCategory = 'SUBCOMPACT_CARS' OR 
                            vehicleCategory = 'COMPACT_CARS' OR 
                            vehicleCategory = 'SMALL_STATION_WAGONS' OR 
                            vehicleCategory = 'MINI_COMPACT_CARS'))";  
                        }else if($value_select=='suvs' ){
                            //if report group is SUVs
                            $condition.="(vehicletype='SUV' AND 
                            market NOT LIKE 'crossover%' AND 
                            (vehicleCategory = 'Sport Utility Vehicles' OR 
                            vehicleCategory = 'SPORT_UTILITY_VEHICLES'))";   
                            }else if($value_select=='green_cars' ){
                            //if report group is green cars
                            $condition.="((enginefueltype = 'Electric' OR 
                            enginefueltype = 'Natural Gas') OR
                            (market = 'hybrid'))"; 
                        }else if($value_select=='crossovers' ){
                            //if report group is crossovers
                            $condition.="(market LIKE 'crossover%')";   
                        }else if($value_select=='vans' ){
                            $condition.="(vehicletype='Minivan' OR vehicletype='Van')";   
                        }else{
                            $condition.='(vehicletype='."'".$condition_name."')";
                        }
                    $commoncheck++; 
                    } 
                    $condition.=')';
                    $condition.=" AND ";
                }
                $condition.="dealership_id='$dealer_id_upload_data'";
                $condition.=')';
                if($group_id!=''){
                    $condition.=" AND id  NOT IN ($group_id) ";  
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition  
                order by id ASC ");
                //echo $sql_get_query;
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }  
            }
            //dealership brand
            else if($values['report_type']=='dealership_brand'){
                $return_result='';
                $get_dealer_details=$this ->  main_model-> dealerfulldetails($dealer_id_upload_data);
                $dealer_manufacure_explode='';
                $commoncheck=0;
                if(isset($get_dealer_details) && $get_dealer_details!=''){
                    if($group_id!=''){
                        $condition.="id  NOT IN ($group_id) AND ";  
                    }
                    $condition.='(';
                    foreach($get_dealer_details as $values_dealer_details){
                        $dealer_manufacure= $values_dealer_details['masterbrand']; 
                        $dealer_manufacure_explode=explode(',',$dealer_manufacure);
                        if(is_array($dealer_manufacure_explode)){
                            foreach($dealer_manufacure_explode as $dealer_master_brand){
                                if($commoncheck>0){
                                    $condition.=' AND ';
                                }
                                $condition.='(sold_vehicle_make!='."'".$dealer_master_brand."') ";
                                $commoncheck++;
                            }
                        }
                    } 
                    $condition.="AND dealership_id='$dealer_id_upload_data' ";
                    $condition.=')'; 
                }
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition  
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                //echo $sql_get_query;
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                } 
                else{
                    $return_result='';
                }  
            }
            //power focus
            else if($values['report_type']=='power_focus'){
                $return_result='';
                $field_value=$values['value1'];
                $field_name=$values['field_name1'];
                $field_values_explode=explode(',',$field_value);
                $commoncheck=0;
                if($group_id!=''){
                    $condition.="id NOT IN ($group_id) AND ";  
                }
                $condition.='(';
                if(is_array($field_values_explode) && $field_values_explode!=''){
                    $condition.='(';
                    
                    foreach($field_values_explode as $value_select){
                        if($commoncheck>0){
                            $condition.=' OR ';
                        }
                        $condition_name=$this -> get_vehicle_class_feild_values($value_select);
                            if($value_select=='four_door_cars' ){
                                //report group is four door cars
                                $condition.="(vehicleType = 'Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                vehicleCategory !='Two Seaters' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";
                            }else if($value_select=='two_door_cars' ){
                                //report group is two door cars
                                $condition.="(vehicleType = 'Car' AND 
                                market NOT LIKE 'crossover%' AND 
                                vehicleCategory = 'Two Seaters' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";  
                            }else if($value_select=='suvs' ){
                                //report group is SUV
                                $condition.="(vehicleType ='SUV' AND 
                                market NOT LIKE 'crossover%' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";  
                            }else if($value_select=='crossovers' ){
                                //report group is crossovers
                                $condition.="(market = 'crossover' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";  
                            }else if($value_select=='trucks' ){
                                //report group is trucks
                                $condition.="(vehicleType = 'Truck' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";  
                            }else if($value_select=='other' ){
                                //report group is other
                                $condition.="(vehicleType = '' AND 
                                (market LIKE 'Factory Tuner%' OR 
                                market LIKE 'High-Performance%' OR 
                                market LIKE 'Performance%' OR 
                                market LIKE 'Exotic%'))";  
                        }else{
                            $condition.='(vehicletype='."'".$condition_name."')";
                        }
                        $commoncheck++; 
                
                    }
                    $condition.=')';
                    $condition.=' AND ';
                }
                $condition.= " dealership_id='$dealer_id_upload_data'";
                $condition.=')';
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition 
                order by id ASC");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }  
            }
            //specific model
            else if($values['report_type']=='specific_model'){
                $return_result='';
                if($values['value1']!=''){
                    $field_value1=$values['value1'];
                }else{
                    $field_value1='';  
                }
                if($values['value2']!=''){
                    $field_value2=$values['value2'];
                }else{
                    $field_value2='';  
                }
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";  
                }
                $condition.='(';
                if($field_value1!=''){
                    $condition.='sold_vehicle_make='."'".$field_value1."'";
                }else{
                    $condition.="sold_vehicle_make=''";  
                }
                if($field_value2!=''){
                    $condition.=' AND sold_vehicle_model='."'".$field_value2."' AND "; 
                }else{
                    $condition.="AND sold_vehicle_model='' AND ";  
                }
                $condition.="dealership_id='$dealer_id_upload_data'";
                $condition.=')';
                $sql_get_query=("SELECT  * FROM eps_data  WHERE
                $condition  
                order by id ASC ");
                $result=$this->db->query($sql_get_query);
                if($result -> num_rows() >0){
                    $return_result= $result->result_array();
                }else{
                    $return_result='';
                }  
            }else if($values['report_type']=='out_warranty'){
                if($dealer_id_upload_data!='198'){
                    $powertrain_months='';
                    if($group_id!=''){
                        $condition.="id NOT IN ($group_id) AND ";  
                    }
                    $return_result='';
                    $id_get='';
                    if($values['value1']!=''){
                    $field_value1=$values['value1'];
                    }else{
                    $field_value1='';  
                    }
                    //get event details
                    $sql=("Select event_start_date from events where event_id=$event_id");
                    $query=$this->db->query($sql);
                        if($query -> num_rows() > 0){
                            $returnvalue_get=$query->result_array();
                            foreach($returnvalue_get as $event_date){
                                $event_date_select=$event_date['event_start_date'];   
                            }
                        //get customer make,purchase date for calculate the month difference
                        $query_financial=("SELECT id,contract_date,sold_vehicle_make,first_payment_date from  eps_data where $condition (dealership_id='$dealer_id_upload_data') 
                        ");
                        //echo $query_financial;
                        $sql_get_query=$this->db->query($query_financial);
                        if($sql_get_query -> num_rows() > 0){
                            $returnvalue_customer_data=$sql_get_query->result_array();
                            foreach($returnvalue_customer_data as $customerdata) {
                                //getting warranty manufacture details
                                $sql_warranty_query=("SELECT  * FROM warranty_manufacture  WHERE
                                manufacturer='$customerdata[sold_vehicle_make]'
                                ");
                                $sql_warranty_manufacture=$this->db->query($sql_warranty_query);
                                if($sql_warranty_manufacture -> num_rows() > 0){
                                    $returnvalue_warranty_manufacture=$sql_warranty_manufacture->result_array();
                                    foreach($returnvalue_warranty_manufacture as $value_warranty){
                                        $powertrain_months=$value_warranty['powertrain_months'];
                                        $basic_months=$value_warranty['basic_months'];    
                                    }
                                }else{
                                    $powertrain_months='';
                                    $basic_months='';     
                                }
                                //first payment is empty  take the contract date
                                if($customerdata['first_payment_date']!=0){
                                    $purchase_date_seltct=$customerdata['first_payment_date'];
                                }else{
                                   $purchase_date_seltct=$customerdata['contract_date']; 
                                }
                                $purcahse_date=$purchase_date_seltct;
                                //calculate month difference and get the customer id and save it in array for looping to get the detaiils of each customer
                                $difference = $event_date_select - $purcahse_date;
                                $months = floor($difference / 86400 / 30 );
                                    if($months>0){
                                        if($field_value1=='more_than_6months_basic_powertrain'){
                                             //More than 6 months remaining on basic and powertrain
                                            if($powertrain_months!='' && $basic_months!=''){
                                                if($months<($powertrain_months-6) && $months<($basic_months-6)){
                                                    $id_get[]= $customerdata['id'];  
                                            }
                                        }
                                        }if($field_value1=='less_than_6months_basicwarranty'){
                                           //less than 6 months remaining on basic warranty
                                            if($basic_months!=''){
                                                if($months>($basic_months-6)){
                                                    $id_get[]= $customerdata['id'];
                                                }    
                                            }
                                       }if($field_value1=='no_basicwarranty_6months_powertrain'){
                                        //No basic warranty remaining but more than 6 months on powertrain remaining
                                            if($basic_months!='' && $powertrain_months!=''){
                                                if($months>$basic_months && $months<($powertrain_months-6)){   
                                                    $id_get[]= $customerdata['id'];
                                                } 
                                           }   
                                        }if($field_value1=='less_than_6months_powertrain_warranty'){
                                            //Less than 6 months remaining on powertrain warranty
                                            if($powertrain_months!=''){
                                                if($months<($powertrain_months-6)){
                                                    $id_get[]= $customerdata['id'];    
                                                }
                                            }
                                        }if($field_value1=='no_warranty_vehicle'){
                                            //no warranty on vehicle
                                            if($basic_months!='' && $powertrain_months!=''){
                                                if($months>$basic_months && $months>$powertrain_months){   
                                                    $id_get[]= $customerdata['id'];    
                                                }
                                            }
                                        }
                                    }
                                }
                            $ij=0;
                            $sql_warranty='';
                            if(!empty($id_get)){
                                //array of customer id not empty loop the id for getting details
                                $sql_warranty=("select * from  eps_data where dealership_id='$dealer_id_upload_data' ");
                                $sql_warranty.=" AND ";
                                $sql_warranty.="(";
                                foreach($id_get as $values_id){
                                    if($values_id!=''){
                                        if($ij>0){
                                            $sql_warranty.=" or ";
                                        }
                                        $sql_warranty.="(id=$values_id)";
                                        $ij++;
                                    }
                                }
                                $sql_warranty.=")";
                                $query_warranty = $this->db->query($sql_warranty);
                                $return_result= $query_warranty->result_array();
                            }else{
                                $return_result='';     
                            }
                        }
                    }
                }
            }
            else{
                $return_result='';  
            }
        }
    }
    else{
        $return_result='';
    }
    return $return_result;
}
//function getting csv file count
function getting_csv_fieldname_count($dealer_id){
    $query = $this->db->query("SELECT buyer_first_name,buyer_last_name,buyer_address,buyer_appartment,buyer_city,buyer_province,buyer_postalcode,buyer_homephone,buyer_businessphone,sold_vehicle_year,sold_vehicle_make,sold_vehicle_model FROM eps_data where dealership_id=$dealer_id");
    $num = $query->num_fields();
    if($num!=''){
     $return =$num;   
    }
    else {
     $return='';   
    }
    return $return;
}
//function getting csv field query
function getting_csv_field_query($report_id,$event_id){
    $sql_leadlist=("SELECT cd.dealership_id,
    cd.buyer_first_name,
    cd.buyer_last_name,
    cd.buyer_address, 
    cd.buyer_appartment, 
    cd.buyer_city, 
    cd.buyer_province, 
    cd.buyer_postalcode,
    cd.buyer_homephone, 
    cd.buyer_businessphone,
    cd.sold_vehicle_year,
    cd.sold_vehicle_make, 
    cd.sold_vehicle_model,
    cd.sold_vehicle_stock
    FROM eps_data cd, leadlist_customer_data lc, 
    select_customer_leadlist sl
    WHERE lc.lead_customer_id = cd.id AND 
    lc.lead_type = $report_id AND 
    sl.customer_leadlist_id=lc.customer_leadlist_id 	
    AND sl.event_id =$event_id order by lc.lead_customer_id asc");
    $quer=$this->db->query($sql_leadlist);
    return $quer;
}
//getting first payment date
function getting_firstpayment_date($vehicle_stock,$dealer_id){
    $sql=("SELECT  first_payment_date ,contract_date	
    FROM eps_data
    WHERE sold_vehicle_stock = '$vehicle_stock' and dealership_id=$dealer_id order by id limit 1
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
    $returnvalue= $query->result_array();
    foreach($returnvalue as $values){
     if($values['first_payment_date']!=''){
      $purchase_date=date('m/d/Y',trim($values['first_payment_date']));  
     }else{
      $purchase_date=date('m/d/Y',trim($values['contract_date']));   
     }
    }
    }else
    {
    $purchase_date='N/A';
    }  
    return $purchase_date;
}
//getting company details
function getting_company_name($dealer_id){
    $sql=("SELECT  company_name 	
    FROM  registration
    WHERE registration_id = '$dealer_id' 
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
    $returnvalue= $query->result_array();
    foreach($returnvalue as $values){
    $dealership_name=trim(ucfirst($values['company_name'])).' (#'.$dealer_id.')';    
    }
    }
    else{
    $dealership_name='N/A';
    } 
    return  $dealership_name;
}
//getting company details
function getting_make_model($make){
     
    $sql_make=("select model from Vehicle where make='$make'
    GROUP BY model ASC");
    $result=$this->db->query($sql_make);
    if($result -> num_rows() >0){
        $retrieved=$result->result_array();
        $return =$retrieved;
    }else{
        $return='';
    }
    return $return;
}

/*function to get the group name*/
public function getgroupname_advanced_option_report_type($event_id,$group){
    $sql=("Select report_type from advance_options_group_selection where event_id=$event_id and group_name='$group'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
        foreach($return as $report_type){
           $report_type_get= $report_type['report_type'];
        }
        $return=$report_type_get;
    }
    else{
        $return='';
    }
    return $return;
}
/*function to get the count 0f the vehicle make model*/
public function getcountofmakemodel($year,$make,$model){
    $sql=("Select count(*) as count from pbs_customer_data where sold_vehicle_year=$year and sold_vehicle_make='$make' and sold_vehicle_model='$model'");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
        foreach($return as $report_type){
           $count= $report_type['count'];
        }
        $return=$count;
    }
    else{
        $return='';
    }
    return $return;
}
/*function to get the latest event details*/
public function get_latest_eventdetails(){
    $sql=("select * from events where creation_status='complete' order by event_id desc limit 1");
    $query=$this->db->query($sql);
    if($query -> num_rows() >0){
        $return= $query->result_array();        
        $return=$return;
    }else{
        $return='';
    }
    return $return;
}
/*function to get the latest event details*/
public function get_latest_eventdetails_reports($dealer_id){
    $sql=("select * from events where creation_status='complete' and  user_id=$dealer_id order by event_id desc limit 1");
    $query=$this->db->query($sql);
    if($query -> num_rows() >0){
        $return= $query->result_array();        
        $return=$return;
    }else{
        $return='';
    }
    return $return;
}
/*function to get the campign event details*/
public function get_campignevent_details($event_id){
    $sql=("select * from epsadvantage_campaign where event_id='$event_id'");
    $query=$this->db->query($sql);
    if($query -> num_rows() >0){
        $return= $query->result_array();        
        $return=$return;
    }else{
        $return='';
    }
    return $return;
}

/*function to get the master vehicle details*/
public function getmaster_details(){
    $date=strtotime(date('m/d/Y'));
    $from_year = date('Y',strtotime ( '-1 year' , $date));  
    $to_year = date('Y',strtotime ( '-10 year' , $date)); 
    $sql=("SELECT *
    FROM eps_master_vehicle where 
   	quantity>=4 AND  
    sold_vehicle_year between $to_year AND $from_year");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $return= $query->result_array();
    }else{
        $return='';
    }
    return $return;
}

public function getCount_Vehical($make, $model, $year,$vin){
    $sql = "SELECT count(*) AS total_vin,`sold_vehicle_year`,`sold_vehicle_make`,`sold_vehicle_model`,`sold_vehicle_VIN`,
            SUBSTRING(`sold_vehicle_VIN`,10,1) AS Year,
            CONCAT('".$vin."',SUBSTRING(`sold_vehicle_VIN`,10,1)) AS unique_vin
            FROM eps_data
            WHERE `sold_vehicle_year` = '".$year."'
            AND `sold_vehicle_make` = '".$make."'
            AND `sold_vehicle_model` LIKE '%".mysql_real_escape_string($model)."%'
            GROUP BY unique_vin
            ORDER BY total_vin DESC";
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $row = $query->row(); 
        return $row->total_vin;
    }else{
        $row='';
        return $row;
    }    
}
public function countMessages(){
        return 2;
    }
    /*function to update generating report name*/
public function getEventDate($event_id){
    $this->db->select('event_insert_date');
    $this->db->from('events');
    $this->db->where('event_id', $event_id); 
    $query = $this->db->get();
    $event = $query->row();
    return $event->event_insert_date;
}
/*function to update generating report name*/
public function update_event_report_name($event_id,$report_name){
    $sql=("update events set  report_name='$report_name' where event_id=$event_id");
    $query=$this->db->query($sql);
    return true;
}
}