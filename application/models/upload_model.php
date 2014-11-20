<?php
class Upload_model extends CI_Model {
    public function __construct(){
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('csv');
    }
    //Function to insert csv file name
    public function insert_field($fieldname){
        $insert_data=("INSERT INTO field_reference set  field_name='$fieldname'");
         $this->db->query($insert_data);
    }
    //function to insert all fields
     public function insert_filename($file_name,$user_id){
        $insert_sql=("Insert into filename_details set file_name='$file_name',user_id=$user_id");
        $this->db->query($insert_sql);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    /*Function to get db fields*/
    public function get_all_fields($fieldname,$position,$user_id,$file_nameid){
       $this->load->helper('url');
       $this -> insert_position_withfields($fieldname,$position,$user_id,$file_nameid);
        $this -> db -> select('*');
        $this -> db -> from('field_reference');
        $this -> db -> where('field_name = ' . "'" . $fieldname . "'");
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
        $retrieved=$result->result();
      	 return TRUE;
        }
        else{
           return 0; 
          //$this->load->view('fields_form');  
          //$this -> insert_field($fieldname);
        }
    }
    public function insert_position_withfields($fieldname,$position,$user_id,$file_nameid){
       $insert_data=("INSERT INTO user_formfield_details set file_name_position='$position',name='$fieldname',all_fields='$fieldname',user_id=$user_id, csv_filename='$file_nameid'");
         $this->db->query($insert_data);  
    }
    public function fields_details()
    {
        $this->load->helper('url');
        $this -> db -> select('field_name,reference_name');
        $this -> db -> from('field_reference');
        $this->db->order_by("field_reference_id", "desc");
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
        $retrieved=$result->result_array();
      	 return $retrieved;
        }
    }
    public function fields_details_name($field_name)
    {
        $this->load->helper('url');
        $this -> db -> select('field_name');
        $this -> db -> from('field_reference');
        $this -> db -> where('field_name', $field_name);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
      	 $retrieved='Error';
        }else{
             $retrieved='Valid';
        }
    }
    //function to retrive the fileid
    public function select_filename($file_name,$user_id){
       $this->load->helper('url');
       $this -> db -> select('file_id');
        $this -> db -> from('filename_details');
        $this -> db -> where('file_name = ' . "'" . $file_name . "'");
        $this -> db -> where('user_id', $user_id);
       $result=$this -> db -> get();
        if($result -> num_rows() >0){
        foreach ($result->result() as $row)
           {
              $retrieved=$row->file_id;
           }
      	 return $retrieved;
        }  
    }
    public function select_changeddetails($file_id,$user_id){
        $this->load->helper('url');
        $this -> db -> select('*');
        $this -> db -> from('user_formfield_details');
        $this -> db -> where('csv_filename = ' . "'" . $file_id . "'");
        $this -> db -> where('user_id', $user_id);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
        $retrieved=$result->result_array();  
        return $retrieved; 
        }
    }
    public function select_file_name($changed_name,$user_id,$file_id,$field_name){
        $this->load->helper('url');
        $this -> db -> select($field_name);
        $this -> db -> from('user_formfield_details');
        $this -> db -> where('user_id = ' . "'" . $user_id . "'");
        $this -> db -> where('csv_filename = ' . "'" . $file_id . "'");
        $this -> db -> where($field_name,$changed_name);
        $result=$this -> db -> get(); 
          if($result -> num_rows() >0){
         $retrieved='Error';
        }else{
            $retrieved='Valid';
        }
        return $retrieved;
    }
    public function insertcsv_filevalues($insert,$upload_dealer_id,$user_id){
      $insert_data="INSERT INTO vehicle_data set $insert ,dealership_id='$upload_dealer_id',upload_user_id='$user_id'";
      $this->db->query($insert_data);  
      $last_id = $this->db->insert_id();
      return $last_id;
    }
    //insert csv file with feild valus
    public function insert_csv_file_values($file_name,$user_id,$upload_dealer_id)
    {
        $posted_values=$this -> input -> post();   
        $this->load->library('csvreader');
        $this->load->helper('file');
        $base_path = $this -> config -> item('rootpath');
        $file_path=$base_path.'/uploadfile/'.$file_name;
        $file_handle = fopen("$file_path", "r");
        $count=1;
        $countselect=1;
        $file_names=$this->select_filename($file_name,$user_id);
        //select filename
        $select_changednames=$this->select_changeddetails($file_names,$user_id);
        $file_path=$base_path.'/uploadfile/'.$file_name;
        require_once $base_path.'uploadfile/parsecsv.lib.php';
        $csv_file_display = new parseCSV();
        $csv_file_display->auto($file_path);
        $csv_file_display->titles; 
        $comacheck=0; 
        foreach ($select_changednames as $line_of_text1)
        { 
            $feile_insert[]=$line_of_text1['all_fields'];
        }
        //resding csv felid values as row 
        $p=1;
          foreach ($csv_file_display->data as $key => $row)
          {
                //resding csv felid values as column 
                $i=0;
              
             $rowcountget=count($row);
              $count=0;
              $insertfeildvalues='';
                foreach ($row as $line_of_text1)
                {                      
                   $values=$feile_insert[$i];
                     if($line_of_text1!='')
                     {
                            if($comacheck>0)
                                {
                                     $insertfeildvalues.=', ' ;
                                }
                        //resding databese chsnge feild values and csv orginal feild values 
                            $position=$values['file_name_position'];
                            //ckeck feild change null
                     $insertfeildvalues.=$values.'='."'".$line_of_text1."'";
                         
                      //call insert function
                        $comacheck++;
                    
                    
                     $count++;
                    if($rowcountget==$count)
                    {
                        $last_insertid=$this -> insertcsv_filevalues($insertfeildvalues,$upload_dealer_id,$user_id); 
                        $insertfeildvalues='';
                        $comacheck=0; 
                       break;
                    }
                    $i++;
                   
                                       
                } 
                }
                
                //echo $insertfeildvalues;
                            
                
              $p++;    
            }
           // echo $p;
           
        return $last_insertid;
    }
    public function insert_xls_file_values($file_name,$user_id,$upload_dealer_id){
        $base_path = $this -> config -> item('rootpath');
        $file_path=$base_path.'/uploadfile/'.$file_name; 
        require_once 'uploadfile/reader.php';  
        $excel = new Spreadsheet_Excel_Reader();
        $excel->read($file_path); 
        $file_names=$this->select_filename($file_name,$user_id);
        $select_changednames=$this->select_changeddetails($file_names,$user_id);
        //print_r($select_changednames);
        $x=2;
            while($x<=$excel->sheets[0]['numRows']) { // reading row by row 
            $insert='';
            $comacheck=0;
                foreach($select_changednames as $values){
                $position=$values['file_name_position'];
               
                    if($values['changed_name']!='')
                    {
                        if($values['name']!=$values['changed_name'])
                        {
                            if(isset($excel->sheets[0]['cells'][$x][$position]) && ($excel->sheets[0]['cells'][$x][$position])!=''){
                               
                                if($comacheck>0){
                                    $insert.=', ' ;
                                } 
                                  
                            $insert.=$values['changed_name'].'='."'".$excel->sheets[0]['cells'][$x][$position]."'";
                           
                            	
                            }    
                                                 
                        }
                    }
                    else
                    {
                        if(isset($excel->sheets[0]['cells'][$x][$position]) && ($excel->sheets[0]['cells'][$x][$position])!=''){
                          
                            if($comacheck>0){
                                $insert.=', ' ;
                            }
                            
                        $insert.=$values['name'].'='."'".$excel->sheets[0]['cells'][$x][$position]."'";  
                          
                         
                        } 
                                          
                    }
                $comacheck++;
                }
            $last_insertid=$this -> insertcsv_filevalues($insert,$upload_dealer_id,$user_id);
            $x++;
            }
        return $last_insertid;
    }
    public function select_field_id($file_id,$user_id,$name){
       $this->load->helper('url');
        $this -> db -> select('id');
        $this -> db -> from('user_formfield_details');
        $this -> db -> where('csv_filename = ' . "'" . $file_id . "'");
        $this -> db -> where('user_id', $user_id);
        $this -> db -> where('name', $name);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            foreach ($result->result() as $row)
           {
              $retrieved=$row->id;
           }
        return $retrieved; 
        } 
    }
    //update user form field
public function update_changename($changed_name,$file_name,$user_id,$file_id,$id){
    $select_changednames1=$this->select_file_name($changed_name,$user_id,$file_id,'name');
    if($select_changednames1=='Valid'){
         $select_changednames2=$this->select_file_name($changed_name,$user_id,$file_id,'changed_name');
         if($select_changednames2=='Valid'){
             $update_data=("Update user_formfield_details set changed_name='$changed_name',all_fields='$changed_name' where name='$file_name' and user_id=$user_id and csv_filename=$file_id");
                $update_query=$this->db->query($update_data); 
                $result='Valid';
         }else{
          $result='Error';  
         }
    }else{
        $result='Error';
    }
     return $result;
}
public function find_fieldname($field_name){
    $this->load->helper('url');
    $this -> db -> select('field_name');
    $this -> db -> from('field_reference');
    $this -> db -> where('field_name = ' . "'" . $field_name . "'");
    $result=$this -> db -> get();  
    if($result -> num_rows() >0){
        $result='Error';  
        }else{
            $result='Valid';  
        }
        return $result;
}
//insert pbs customer data    
public function insert_pbs_customer_data($insert){
    $insert_data="INSERT INTO pbs_customer_data set $insert";
    $this->db->query($insert_data);  
    $last_id = $this->db->insert_id();
    return $last_id;
}
      
//insert pbs finacncial data        
public function insert_pbs_financial_data($insert){
    $insert_data="INSERT INTO  pbs_financial_data set $insert";
    $this->db->query($insert_data);  
    $last_id = $this->db->insert_id();
    return $last_id;
}
        
public function getpbscustomerdata(){
    $this -> db -> select('sold_vehicle_stock');
    $this -> db -> from(' pbs_customer_data');
    $result=$this -> db -> get();
    if($result -> num_rows() >0){
        $retrieved=$result->result();
        return $retrieved;
    }else{
        return false;
    }
}
public function getstyleidfromvindata($vin){
         if($vin!='')
         {
         $vin_number=substr($vin,0,10);
        
         $vin_number=trim($vin_number);
         
              $sql=("SELECT *
FROM VIN
WHERE vin = '$vin_number'");

        $query=$this->db->query($sql);
        if($query -> num_rows() > 0)
        
        {
            $returnvalue= $query->result_array();
            foreach ($returnvalue as $values)
            {
                            //take engine data from main table
                              $sql_engine_data=("SELECT styleId,horsepower,torque,cylinder,size
                                FROM Engine
                                WHERE styleId = '$values[styleId]'");
                                 $query_engine_data=$this->db->query($sql_engine_data);
                                if($query_engine_data -> num_rows() > 0)
                                 {
                                    $returnvalue_engine= $query_engine_data->result_array();
                                    foreach ($returnvalue_engine as $values_engine_data)
                                    {
                                        $insert_data="INSERT INTO pbs_engine_data set styleId='$values_engine_data[styleId]',horsepower='$values_engine_data[horsepower]',torque='$values_engine_data[torque]',cylinder='$values_engine_data[cylinder]',size='$values_engine_data[size]'";
                                          $this->db->query($insert_data);  
                                          $last_id = $this->db->insert_id();
                                          return $last_id;
                                        
                                    }
                                }
                                //take engine data from main table
                                
                               
            }
        }
      }
      }
      
public function getstyleidfromvindatainsetvehicledata($vin){
    if($vin!=''){
        $vin_number=substr($vin,0,10);
        $vin_number=trim($vin_number);
        $sql=("SELECT *
        FROM VIN
        WHERE vin = '$vin_number'");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
                foreach ($returnvalue as $values){
                //take vehicle  data from main table 
                $sql_vehicle_data=("SELECT *
                FROM  Vehicle
                WHERE styleId = '$values[styleId]'");
                $query_vehicle_data=$this->db->query($sql_vehicle_data);
                if($query_vehicle_data -> num_rows() > 0){
                $returnvalue_vehicle= $query_vehicle_data->result_array();
                    foreach ($returnvalue_vehicle as $values_vehicle_data){
                        $insert_vehicle_data="INSERT INTO pbs_vehicledata_data set styleId='$values_vehicle_data[styleId]', vehicletype='$values_vehicle_data[vehicleType]',vehiclesize='$values_vehicle_data[vehicleSize]',vehiclestyle='$values_vehicle_data[vehicleStyle]',vehiclecategory='$values_vehicle_data[vehicleCategory]',
                        enginefueltype='$values_vehicle_data[engineFuelType]',drivenwheels='$values_vehicle_data[drivenWheels]',transmissiontype='$values_vehicle_data[transmissionType]',numberofdoors='$values_vehicle_data[numberOfDoors]',
                        mpgcity='$values_vehicle_data[mpgCity]',mpghighway='$values_vehicle_data[mpgHighway]', mpgcombined='$values_vehicle_data[mpgCombined]',curbweight='$values_vehicle_data[curbWeight]'";
                        // $this->db->query($insert_vehicle_data);  
                        // $last_id = $this->db->insert_id();
                        //return $last_id;
                    }
                }
            }
        }
    }
}
      
public function insert_pbs_customer_csv_files($insert,$dealer_id,$updatefeildvalues){
    $sql=("SELECT *
    FROM pbs_customer_data
    WHERE $updatefeildvalues");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $update="update pbs_customer_data set $insert where $updatefeildvalues AND dealership_id=$dealer_id";
        $this->db->query($update);  
        $last_id = '';
        return $last_id;
        
    }else{
        $insert_data="INSERT INTO pbs_customer_data set $insert ,dealership_id=$dealer_id,type='historical_data'";
        $this->db->query($insert_data);  
        $last_id = $this->db->insert_id();
        return $last_id;
    
    }
}
public function insert_customer_csv_files_authenticom($insert,$dealer_id,$updatefieldvalues){
    //check if the value is already present in database
    
    $sql=("SELECT *
    FROM pbs_customer_data
    WHERE $updatefieldvalues");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        //update customer database
        $update="update pbs_customer_data set $insert where $updatefieldvalues";
        $this->db->query($update);  
        $last_id = '';
        return $last_id;
        
    }else{
        //insert in to database
        $insert_data="INSERT INTO pbs_customer_data set $insert ,dealership_id=$dealer_id";
        $this->db->query($insert_data);  
        $last_id = $this->db->insert_id();
        return $last_id;
    }


}

public function insert_pbs_finacial_csv_files($insert){
    $insert_data="INSERT INTO  pbs_financial_data set $insert";
    $this->db->query($insert_data);  
    $last_id = $this->db->insert_id();
    return $last_id;
}
public function insert_manufacure($insert){
    $insert_data="INSERT INTO warranty_manufacture set $insert";
    $this->db->query($insert_data);  
    $last_id = $this->db->insert_id();
    return $last_id;
}

}
?>