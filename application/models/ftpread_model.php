<?php
class Ftpread_model extends CI_Model {
	public function __construct(){
		$this->load->database();
	}
    //Function to fetch report 
    public function pbs_csv_file_read_qurey($start,$alreadyProcessed,$dealer_id,$filename,$folder_name){
    $base_path = $this -> config -> item('rootpath');
    $start = 0;
    $alreadyProcessed = $start+1000;
    $folder_name = 'WillowbrookChrysler-256-2014-10-13';
    $filename = 'WillowbrookMotorsFandI3212.csv';
    $file_path=$base_path.'clients/'.$folder_name.'/'.$filename;
    $file_handle = fopen($file_path, "r");
        $i =0;
        //$alreadyProcessed=1000;
        $count=0;
       $readfilehandle=fgetcsv($file_handle);
        //print_r($line_of_text1);
        $fp = file($file_path);
        $rowcount=count($fp);
        //check if the file is readable 
        if($readfilehandle){
            //read csv file in to two section by specify the start and end limit because some time this file is large or number of colum to be read is large
            while($line_of_text = fgetcsv($file_handle)){
                if($count>$alreadyProcessed){
                    exit;
                }
                if($line_of_text!=''){
                    //get field value of fields in the csv
                        $dealid=trim(addslashes($line_of_text[1]));
                        $first_name = ucfirst(strtolower(trim(addslashes($line_of_text[68]))));
                        $buyer_first_name=$first_name; // trim(addslashes($line_of_text[68]));
                        $addresss = '';
                        $address = ucfirst(strtolower(trim(addslashes($line_of_text[73]))));
                        $addresses = explode(' ',$address);
                        foreach($addresses as $a){
                            if(strlen($a) < 4){
                                $addresss .= strtoupper($a)." ";
                            }else{
                                $addresss .= ucfirst($a)." ";
                            }
                        }
                        $buyer_address=$addresss; //trim(addslashes($line_of_text[73]));
                        $buyer_city=trim(addslashes($line_of_text[74]));
                        $buyer_province=trim(addslashes($line_of_text[75]));
                        $buyer_postalcode=trim(addslashes($line_of_text[76]));
                        $home_phone = trim(addslashes($line_of_text[71]));
                        if($home_phone != ''){
                            $first_three = substr($home_phone, 0, 3);
                            $second_three = substr($home_phone, 3, 3);
                            $third_three = substr($home_phone, 6, 4);
                            $home_phone = "(".$first_three.") ".$second_three."-".$third_three;
                        }
                        $buyer_homephone=$home_phone;//trim(addslashes($line_of_text[71]));
                        
                        $business_phone=trim(addslashes($line_of_text[72]));
                        if($business_phone != ''){
                            $first_three = substr($business_phone, 0, 3);
                            $second_three = substr($business_phone, 3, 3);
                            $third_three = substr($business_phone, 6, 4);
                            $business_phone = "(".$first_three.") ".$second_three."-".$third_three;
                        }
                        $buyer_businessphone=$business_phone; //trim(addslashes($line_of_text[72]));
                        //$buyer_cellphone=addslashes($line_of_text[19]);
                        $buyer_email=strtolower(trim(addslashes($line_of_text[81])));
                        $new_used = strtolower(trim(addslashes($line_of_text[66])));
                        if($new_used == 'new'){
                            $new_used = 'N';
                        }elseif($new_used == 'used'){
                            $new_used = 'U';
                        }elseif($new_used == 'n'){
                            $new_used = 'N';
                        }elseif($new_used == 'u'){
                            $new_used = 'U';
                        }else{
                            $new_used = '';
                        }
                        $new_used=$new_used; //trim(addslashes($line_of_text[66]));
                        $sold_vehicle_stock=trim(addslashes($line_of_text[65]));
                        $sold_vehicle_VIN=trim(addslashes($line_of_text[107]));
                        $vin = trim(addslashes($line_of_text[107]));
                        $first_vin = substr($vin,0, 8);
                        $second_vin = substr($vin,9, 1);
                        $shortened_VIN = $first_vin."".$second_vin;
                        $sold_vehicle_year_get=trim($line_of_text[110]);
                        $sold_vehicle_make=trim(addslashes($line_of_text[108]));
                        $sold_vehicle_model=trim(addslashes($line_of_text[109]));
                        $salesman=trim(addslashes($line_of_text[100]));
                        $vehicle_stock=trim(addslashes($line_of_text[65]));
                        $bodydescription=trim(addslashes($line_of_text[115]));
                        $contract_date=trim(addslashes($line_of_text[4]));
                        $first_payment_date=trim(addslashes($line_of_text[44]));
                        $vehicle_payoff_date=trim(addslashes($line_of_text[47]));
                        $vehiclesale_price=trim(addslashes($line_of_text[11]));
                        $totalsale_credits=trim(addslashes($line_of_text[12]));
                        $total_cash_down_amount=trim(addslashes($line_of_text[30]));
                        $total_tax=trim(addslashes($line_of_text[34]));
                        $total_finance_amount=trim(addslashes($line_of_text[38]));
                        $total_of_payments=trim(addslashes($line_of_text[45]));
                        $monthly_payment=trim(addslashes($line_of_text[43]));
                        $contract_term=trim(addslashes($line_of_text[39]));
                        $apr=trim(addslashes($line_of_text[40]));
                        $payment_frequency=trim(addslashes($line_of_text[46]));
                        $delivery_date=trim(addslashes($line_of_text[5]));
                        $tradeinvalue='';
                        $contract_date=strtotime($contract_date);
                        $first_payment_date=strtotime($first_payment_date);
                        $delivery_date=strtotime($delivery_date);
                        if($sold_vehicle_year_get!=''){
                            $soldvehicleyear_gettting=explode('.',$sold_vehicle_year_get);
                          // print_r($soldvehicleyear_gettting);
                            if(isset($soldvehicleyear_gettting)) {
                            $sold_vehicle_year=$soldvehicleyear_gettting[0]; 
                            } 
                            else{
                            $sold_vehicle_year=$sold_vehicle_year_get; 
                            }
                        }else{
                          $sold_vehicle_year='';  
                        }
                    //if the staring record is zero  all the field in the csv file read untill the limit 
                    
                    if ($i <$alreadyProcessed){
                    //exclude first row insert to the table 
                    if($buyer_address=='BuyerAddress' || $buyer_city=='BuyerCity' || $vehicle_stock=='VehicleStock' || $bodydescription=='BodyDescription' ||  $contract_date=='ContractDate' ||  $first_payment_date=='FirstPaymentDate' ||  $vehicle_payoff_date=='VehiclePayoffDate' ||  $vehiclesale_price=='VehicleSalePrice' ||  $totalsale_credits=='TotalSaleCredit' || $total_cash_down_amount=='TotalCashDownAmount' ||  $total_tax=='TotalTax' || $total_finance_amount=='TotalFinanceAmount' || $total_of_payments=='TotalofPayments' || $monthly_payment=='MonthlyPayment' || $contract_term=='MonthlyPayment' || $contract_term=='ContractTerm' || $apr=='APR' || $payment_frequency=='PaymentFrequency' || $delivery_date=='DeliveryDate'){
                    }else{
                    if($i<$start){
                    //echo "test";
                    }
                    else{ 
                        $sql=("SELECT *
                        FROM  eps_data
                        WHERE dealership_id='$dealer_id' AND
                            LOWER(buyer_first_name)=LOWER('$buyer_first_name') AND
                            LOWER(buyer_address)=LOWER('$buyer_address') AND
                            buyer_city='$buyer_city' AND
                            sold_vehicle_year='$sold_vehicle_year' AND
                            sold_vehicle_make='$sold_vehicle_make' AND
                            sold_vehicle_model='$sold_vehicle_model' AND
                            dealid='$dealid' 
                            ");
                        $query=$this->db->query($sql);
                        if($query -> num_rows() > 0){
                            $retrieved=$query->result_array();
                            foreach ($retrieved as $row){
                                $id=$row['id'];
                            }
                            //echo "$i";
                            $updatecustomerdata_table=("update eps_data set dealership_id=$dealer_id,
                            buyer_first_name='$buyer_first_name',
                            buyer_address='$buyer_address',
                            buyer_city='$buyer_city',
                            buyer_province='$buyer_province',
                            buyer_postalcode='$buyer_postalcode',
                            buyer_homephone='$buyer_homephone',
                            buyer_businessphone='$buyer_businessphone',
                            buyer_email='$buyer_email',
                            sold_vehicle_stock='$sold_vehicle_stock',
                            sold_vehicle_VIN='$sold_vehicle_VIN',
                            new_used='$new_used',
                            sold_vehicle_year='$sold_vehicle_year',
                            sold_vehicle_make='$sold_vehicle_make',
                            sold_vehicle_model='$sold_vehicle_model',
                            salesman='$salesman',
                            shortened_VIN='$shortened_VIN',
                            bodydescription='$bodydescription',
                            contract_date='$contract_date',
                            first_payment_date='$first_payment_date',
                            vehicle_payoff_date='$vehicle_payoff_date',
                            vehiclesale_price='$vehiclesale_price',
                            totalsale_credits='$totalsale_credits',
                            total_cash_down_amount='$total_cash_down_amount',
                            total_tax='$total_tax',
                            total_finance_amount='$total_finance_amount',
                            total_of_payments='$total_of_payments',
                            monthly_payment='$monthly_payment',
                            contract_term='$contract_term',
                            customer_id='$count',
                            apr='$apr',
                            payment_frequency='$payment_frequency',
                            delivery_date='$delivery_date',
                            dealid='$dealid'
                            WHERE buyer_first_name='$buyer_first_name' AND
                            buyer_address='$buyer_address' AND
                            buyer_city='$buyer_city' AND
                            sold_vehicle_year='$sold_vehicle_year' AND
                            sold_vehicle_make='$sold_vehicle_make' AND
                            sold_vehicle_model='$sold_vehicle_model' AND 
                            dealership_id=$dealer_id
                            ");
                            $updatecustomerdata=$this->db->query($updatecustomerdata_table);
                            //insert vehicle data in to final eps table
                            $insert_vehicle_data=$this->insert_vehicle_data_into_final_eps_query_result($dealer_id,$id);
                            //insert engine data in to final eps table
                            $insert_engine_data=$this->insert_engine_data_query_result($dealer_id,$id);
                           }else{
                           //insert in to customer data base
                          // echo "2";
                            $insert_customerdata_table=("insert into eps_data set dealership_id=$dealer_id,
                            buyer_first_name='$buyer_first_name',
                            buyer_address='$buyer_address',
                            buyer_city='$buyer_city',
                            buyer_province='$buyer_province',
                            buyer_postalcode='$buyer_postalcode',
                            buyer_homephone='$buyer_homephone',
                            buyer_businessphone='$buyer_businessphone',
                            buyer_email='$buyer_email',
                            sold_vehicle_stock='$sold_vehicle_stock',
                            sold_vehicle_VIN='$sold_vehicle_VIN',
                            new_used='$new_used',
                            sold_vehicle_year='$sold_vehicle_year',
                            sold_vehicle_make='$sold_vehicle_make',
                            sold_vehicle_model='$sold_vehicle_model',
                            salesman='$salesman',
                            bodydescription='$bodydescription',
                            contract_date='$contract_date',
                            customer_id='$count',
                            shortened_VIN='$shortened_VIN',
                            first_payment_date='$first_payment_date',
                            vehicle_payoff_date='$vehicle_payoff_date',
                            vehiclesale_price='$vehiclesale_price',
                            totalsale_credits='$totalsale_credits',
                            total_cash_down_amount='$total_cash_down_amount',
                            total_tax='$total_tax',
                            total_finance_amount='$total_finance_amount',
                            total_of_payments='$total_of_payments',
                            monthly_payment='$monthly_payment',
                            contract_term='$contract_term',
                            apr='$apr',
                            payment_frequency='$payment_frequency',
                            delivery_date='$delivery_date',
                            dealid='$dealid'
                            ");
                            $insert_customerdata_table_query=$this->db->query($insert_customerdata_table);
                            $insert_id= $this->db->insert_id();
                            //echo $insert_id."<br />";
                            //insert vehicle data in to final eps table
                            $insert_vehicle_data=$this->insert_vehicle_data_into_final_eps_query_result($dealer_id,$insert_id);
                            //insert engine data in to final eps table
                            $insert_engine_data=$this->insert_engine_data_query_result($dealer_id,$insert_id);
                            } 
                            if($i==$alreadyProcessed-1){
                                $start_limit=$start+1000;
                               
                                //updates ftp feed offset updates
                                $update_offset=$this->ftp_details_offset_updates($start_limit,$filename,$dealer_id);
                            } 
                        }
                    }
                  $i++;
                }
                $count++;
            }
           //call the function for update master table function 
          $update_offset=$this->updatemastertable($sold_vehicle_VIN,$sold_vehicle_year,$sold_vehicle_make,$sold_vehicle_model,$bodydescription);     
        }
          //echo $count; 
            $update_status=$rowcount-1;
            //get count of customer uploaded
                if($update_status==$count){
                //set staus complete if file read till last record
                 $update_status=$this->ftp_details_status_updates($count,$filename,$dealer_id);   
                } 
            
            $return =1;
        } 
        else{
         $return =0;   
        }
        return $return;
    }
 //insert in to insert customer csv files authenticom into final eps
public function insert_customer_csv_files_authenticom_into_final_eps($insert,$dealer_id,$updatefieldvalues){
   
    //check if the value is already present in database
    $sql=("SELECT *
    FROM eps_data
    WHERE $updatefieldvalues AND dealership_id=$dealer_id");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        foreach ($retrieved as $row){
            $id=$row['id'];
        }
        //update customer database
        $update="update eps_data set $insert where $updatefieldvalues AND dealership_id=$dealer_id";
         $this->db->query($update);  
        $last_id = '';
        //insert vehicle data in to final eps table
        $insert_vehicle_data=$this->insert_vehicle_data_into_final_eps_query_result($dealer_id,$id);
        //insert engine data in to final eps table
        $insert_engine_data=$this->insert_engine_data_query_result($dealer_id,$id);
        return $last_id;
        
    }else{
        //insert in to database
        $insert_data="INSERT INTO eps_data set $insert ,dealership_id=$dealer_id ";
        $this->db->query($insert_data);  
        $last_id = $this->db->insert_id();
        $insert_id= $this->db->insert_id();
        //insert vehicle data in to final eps table
        $insert_vehicle_data=$this->insert_vehicle_data_into_final_eps_query_result($dealer_id,$insert_id);
        //insert engine data in to final eps table
        $insert_engine_data=$this->insert_engine_data_query_result($dealer_id,$insert_id);
        return $last_id;
    }


}

    /*function to insert vehicle details to eps data from Vehicle table*/
    function insert_vehicle_data_into_final_eps_query_result($dealer_id,$id){
    $query1=("SELECT sold_vehicle_year,sold_vehicle_make, sold_vehicle_model,id FROM eps_data  WHERE
    dealership_id =$dealer_id  and id='$id' order by id ASC");
    $result1=$this->db->query($query1);
    if($result1 -> num_rows() > 0){
        $returnvalue1= $result1->result_array();
        foreach($returnvalue1 as $value1){
            $id=$value1['id'];
            $lper100kmcity='';
            $lper100kmhighway='';
            $lper100kmcombined='';
            $year=trim($value1['sold_vehicle_year']);
            $sold_vehicle_make=trim($value1['sold_vehicle_make']);
            $sold_vehicle_model=trim(addslashes($value1['sold_vehicle_model']));
            if($sold_vehicle_make!=''){
                //get information realed to make,year,model
                $query2=("SELECT * FROM Vehicle  WHERE
                year =$year  and make='$sold_vehicle_make' and model='$sold_vehicle_model' order by id asc limit 1");
                $result2 = $this -> db -> query($query2);  
                if($result2 -> num_rows() > 0){
                    $price='253.214584327527';
                    $returnvalue2= $result2->result_array();
                    foreach($returnvalue2 as $value2){
                        //read all field values
                        $styleId=$value2['styleId'];  
                        $vehicletype=addslashes($value2['vehicleType']); 
                        $vehiclestyle=addslashes($value2['vehicleStyle']);
                        $vehiclesize=addslashes($value2['vehicleSize']); 
                        $vehiclecategory=addslashes($value2['vehicleCategory']); 
                        if($value2['engineFuelType'] == 'Premium Unleaded (Required)'){
                            $value2['engineFuelType'] = 'Gas (Premium)';
                        }elseif($value2['engineFuelType'] == 'Flex-Fuel (Premium Unleaded Recommended/E85)'){
                            $value2['engineFuelType'] = 'Gas (Flex-Fuel)';
                        }
                        $enginefueltype=addslashes($value2['engineFuelType']) ;
                        if($value2['drivenWheels'] == 'Four Wheel Drive'){
                            $value2['drivenWheels'] = '4x4';
                        }elseif($value2['drivenWheels'] == 'Rear Wheel Drive'){
                            $value2['drivenWheels'] = 'RWD';
                        }elseif($value2['drivenWheels'] == 'Front Wheel Drive'){
                            $value2['drivenWheels'] = 'FWD';
                        }elseif($value2['drivenWheels'] == 'All Wheel Drive'){
                            $value2['drivenWheels'] = 'AWD';
                        }
                        $drivenwheels=addslashes($value2['drivenWheels']);
                        $transmissiontype=addslashes($value2['transmissionType']);
                        $numberofdoors=addslashes($value2['numberOfDoors']); 
                        $mpgcity=addslashes($value2['mpgCity']); 
                        $mpghighway=addslashes($value2['mpgHighway']);
                        $mpgcombined=addslashes($value2['mpgCombined']);
                        $curbweight=addslashes($value2['curbWeight']);
                        $fuel_efficiency=addslashes($value2['fuelCapacity']);
                        $trim=addslashes($value2['trimShort']);
                        $engineCylinder = addslashes($value2['engineCylinder']);
                        $engineSize = addslashes($value2['engineSize']);
                        $engineForcedInduction = addslashes($value2['engineForcedInduction']);
                        $priceBaseMSRP = addslashes($value2['price_baseMSRP']);
                        $market=$value2['market'];
                        $lper100kmcombined='';
                        $lper100kmhighway='';
                        //calclualting litter combined values 
                        if($mpgcombined>0 && $mpgcombined!=''){
                            //calculate litter comined
                            $vehicle_combined=$price/$mpgcombined;
                            $vehicle_combined=number_format($vehicle_combined, 2, '.', '');
                        }else{
                            $vehicle_combined=''; 
                        }
                        //calculate lper100kmcity
                        if($mpgcity!='' && $mpgcity!='Not Available'){
                            //calculate lper100kmcity
                            $lper100kmcity=235.21/$mpgcity;
                            $lper100kmcity=number_format($lper100kmcity, 2, '.', '');
                        }
                        if($mpghighway!='' && $mpghighway!='Not Available'){
                            //calculate lper100kmhighway
                            $lper100kmhighway=235.21/$mpghighway;
                            $lper100kmhighway=number_format($lper100kmhighway, 2, '.', '');	
                        }
                        if($mpgcombined!='' && $mpgcombined!='Not Available'){
                            //calculate lper100kmcombined
                            $lper100kmcombined=235.21/$mpgcombined;
                            $lper100kmcombined=number_format($lper100kmcombined, 2, '.', '');
                        }
                        $littercombined=$vehicle_combined;
                        //update vehicle information
                        $update_eps_table=("update eps_data set 
                            styleid='$styleId',
                            vehicletype='$vehicletype',
                            vehiclestyle='$vehiclestyle',
                            vehiclesize='$vehiclesize',
                            vehiclecategory='$vehiclecategory', 
                            enginefueltype='$enginefueltype', 
                            drivenwheels='$drivenwheels', 
                            transmissiontype='$transmissiontype',
                            fuel_efficiency='$fuel_efficiency',
                            littercombined='$littercombined',
                            customer_id='$id',
                            market='$market',
                            lper100kmcity='$lper100kmcity',
                            lper100kmhighway='$lper100kmhighway',
                            trim='$trim',
                            engineCylinder='$engineCylinder',
                            engineSize='$engineSize',
                            engineForcedInduction='$engineForcedInduction',
                            priceBaseMSRP='$priceBaseMSRP',
                            lper100kmhighway='$lper100kmhighway',
                            lper100kmcombined='$lper100kmcombined'
                            where id =$id
                            ");
                            $update_eps= $this -> db -> query($update_eps_table);
                        }   
                    }
                    else{
                      //echo 'Id-'.$id.'-Year-'.$year.'-Make-'.$sold_vehicle_make.'-Model-'.$sold_vehicle_model.'<br />';
                      //update table with staus no info if make ,model,year mach does not found
                      $update_eps_table=("update eps_data set 
                            status='no_info'
                            where id =$id
                            ");
                            $update_eps= $this -> db -> query($update_eps_table);
                    }
                }
            }
        }
    }
   
    /*function to insert engine data*/
    function insert_engine_data_query_result($dealer_id,$id){
        $sql=("SELECT styleid from eps_data where dealership_id=$dealer_id and id=$id
        order by id ASC
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            foreach($returnvalue as $value){
                //getting field values of engine data
                $sql1=("SELECT  Engine.torque,Engine.horsepower,Vehicle.curbWeight
                FROM Engine,Vehicle
                WHERE Engine.styleId=Vehicle.styleId and Vehicle.styleId = $value[styleid] order by Engine.id asc limit 1");
                $query1=$this->db->query($sql1);
                if($query1 -> num_rows() > 0){
                 $returnvalue1= $query1->result_array();
                    foreach($returnvalue1 as $value1){
                        $curbweight= $value1['curbWeight'];
                        $horsepower=$value1['horsepower'];
                        $torque=$value1['torque'];
                        //calculating power ratio
                        if($horsepower!='' && $horsepower>0){
                            $powerratio_value=$curbweight/$horsepower;   
                        }else{
                            $powerratio_value='';   
                        }
                        $powerratio=$powerratio_value;
                        //update power ratio in to the table
                        $updatestatus_status="UPDATE eps_data set 
                            powerratio='$powerratio_value',
                            torque='$torque'
                            where styleid=$value[styleid]
                            ";
                            $result = $this -> db -> query($updatestatus_status); 
                            if($result){
                                //echo "update";
                            }
                    }
                }
            }
        }
    }
 /*function to read authenticom file from dealers folder*/
    function read_ftp_file_details($type){
        $sql=("SELECT *
        FROM ftp_feed_details
        WHERE status = 'incomplete' and source='$type' order by ftp_feed_details_id asc limit 1");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            $return =$returnvalue;
            }
            else{
               $return='' ;
            }
            return $return;
    }
    function get_ftpdetailswithfiles($filename){
         $sql=("SELECT *
            FROM  ftp_feed_details
            WHERE filename ='$file'
            ");
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0){
            //getting the ftp file details
            $returnvalue= $query->result_array();
            $return =$returnvalue;
            }else{
             $return ='';  
            }
            return $return;
    }
    //update ftpdetails with offst update
    function ftp_details_offset_updates($start_limit,$filename,$dealership_id){
        $updatestatus_status="UPDATE ftp_feed_details set 
        offset =$start_limit,
        status='incomplete'
        where filename='$filename' and dealership_id=$dealership_id";
        $result = $this -> db -> query($updatestatus_status); 
    }
    //update ftpdetails ststus complete
    function ftp_details_status_updates($start_limit,$filename,$dealership_id){
        $updatestatus_status="UPDATE ftp_feed_details set
        offset =$start_limit, 
        status='complete'
        where filename='$filename' and dealership_id=$dealership_id";
        $result = $this -> db -> query($updatestatus_status); 
        //remove read status from eps main table
     }
    function ftp_feed_details_query($file){
        $sql=("SELECT *
        FROM  ftp_feed_details
        WHERE filename ='$file'
        ");
        $query=$this->db->query($sql);
        return $query;
    }
    function update_ftp_feed($file_creation_date,$dealer_id,$file){
        $updatestatus_status="UPDATE ftp_feed_details set 
        creation_date='$file_creation_date',
        offset='0',
        dealership_id=$dealer_id,
        status='incomplete'
        where filename='$file'";
        $result = $this -> db -> query($updatestatus_status);   
    }
    function insert_ftp_feed($file_creation_date,$dealer_id,$file,$source,$read_status){
        $data=array(    
        'creation_date'=>$file_creation_date,
        'offset'=>'0',
        'status'=>'incomplete',
        'dealership_id'=>$dealer_id,
        'source'=>$source,
        'read_status'=>$read_status,
        'filename'=>$file
        );
        $this->db->insert("ftp_feed_details", $data);
    }
    function getcountofcustomerrecord($dealerid){
     	$this->load->helper('url');
    	$this->db->select('*');
    	$this->db->from('eps_data');
    	$this->db->where('dealership_id  = ' . "'" . $dealerid . "'");
    	$result=$this->db->get();
    	if ($result->num_rows()>0){
			$retrieved = $result->num_rows();
			$return =$retrieved;
		}else{
			$return =0;
		}
        return $return;   
    }
     //getting master vehicl details
    function getting_master_vehicle_details(){
    $date=strtotime(date('m/d/y'));
    //calculate year range
    $from_year = date('Y',strtotime ( '-1 year' , $date));  
    $to_year = date('Y',strtotime ( '-10 year' , $date)); 
    $sql=("SELECT *
    FROM eps_master_vehicle where 
   	quantity>=4 AND  
    sold_vehicle_year between $to_year AND $from_year
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        $return =$retrieved;
     }else{
      $return ='';  
     }
    return $return;
    }
 
      //getting master vehicl details with make ,model,year
    function getting_master_vehicle_details_with_make_model_year($year,$make,$model){
    $sql=("SELECT *
    FROM eps_master_vehicle where 
    sold_vehicle_year='$year' AND
    sold_vehicle_make='$make' AND 
    sold_vehicle_model='$model'
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        $return =$retrieved;
     }else{
      $return ='';  
     }
    return $return;
    }
    //update vin,mode,make into master table
    function updatemastertable($vin,$sold_vehicle_year,$sold_vehicle_make,$sold_vehicle_model,$bodydescription){
    
          $vin=substr($vin,0,8); 
          $sold_vehicle_year=$sold_vehicle_year; 
          $sold_vehicle_make=addslashes($sold_vehicle_make); 
          $sold_vehicle_model=addslashes($sold_vehicle_model); 
          $bodydescription=addslashes($bodydescription); 
          $current_year=date('Y');
          $low_km=(($current_year-$sold_vehicle_year)*12 +12)* 1000;
          $high_km=(($current_year-$sold_vehicle_year)*12 +12)* 1500;
          $vehicle_trim=$this->get_trim_value($sold_vehicle_year,$sold_vehicle_make,$sold_vehicle_model); 
          $sql=("SELECT *
          FROM  eps_master_vehicle
          WHERE vin='$vin' AND 
          sold_vehicle_year='$sold_vehicle_year' AND  	
          sold_vehicle_make='$sold_vehicle_make' AND  
          sold_vehicle_model='$sold_vehicle_model'
          ");
            $query_eps_master_vehicle=$this->db->query($sql); 
            if($query_eps_master_vehicle -> num_rows() > 0){ 
            $retrieved_eps_master_vehicle=$query_eps_master_vehicle->result_array();
            foreach ($retrieved_eps_master_vehicle as $row_eps_master_vehicle){ 
            $quantity=$row_eps_master_vehicle['quantity']; 
            $quantity_count=$quantity+1;
            $updates_customerdata_table=("update eps_master_vehicle set 
                quantity='$quantity_count'
                where vin='$vin' AND 
                sold_vehicle_year='$sold_vehicle_year' AND  	
                sold_vehicle_make='$sold_vehicle_make' AND  
                sold_vehicle_model='$sold_vehicle_model'"); 
            $update_customerdata_table_query=$this->db->query($updates_customerdata_table);    
            }
            }else{
                $insert_customerdata_table=("insert into eps_master_vehicle set 
                quantity=1,
                vin='$vin',
                sold_vehicle_year='$sold_vehicle_year',
                sold_vehicle_make='$sold_vehicle_make',
                sold_vehicle_model='$sold_vehicle_model',
                bodydescription='$bodydescription',
                vehicle_trim='$vehicle_trim',
                low_km='$low_km',
                high_km='$high_km'
               	");
                $insert_customerdata_table_query=$this->db->query($insert_customerdata_table);
                $insert_id= $this->db->insert_id();    
            }
              
        
    
}
    
    //updates trade in values of master vehicle 
    function updates_master_vehicle_details($year,$make,$model,$vin){
    $sql=("SELECT *
    FROM eps_master_vehicle where sold_vehicle_year='$year' AND
    sold_vehicle_make='$make' AND 
    sold_vehicle_model='$model' AND 
    vin='$vin'
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        foreach($retrieved as $values_details){
            $vin=$values_details['vin'];
            $year=$values_details['sold_vehicle_year'];
            $sold_vehicle_make=$values_details['sold_vehicle_make'];
            $sold_vehicle_model=$values_details['sold_vehicle_model'];
            $bodydescription=$values_details['bodydescription'];
            $vehicle_trim=$values_details['vehicle_trim'];
            $low_km=$values_details['low_km'];
            $high_km=$values_details['high_km'];
            //updates master vehicle table with trade in values 
            $account='eps_advantage_xml';
            $key='KLAD3njdf8fh3hgf8';
            //getting vid from cbb
            $get_vid ='http://xml.canadianblackbook.com/XMLWebServices/service?command=vehicles&year='.$year.'&vin='.$vin.'&account='.$account.'&key='.$key.'&schemaVersion=3.0';
            $xml=simplexml_load_file("$get_vid");
            $eml1=$xml->response->children();
            $eml2=$eml1->vehicles->children();
            if(isset($eml2)){
            $eml3=$eml2->vehicle->children();
            $vid_cbb=$eml3->vid;
            $hkm_high_value='';
            $hkm_low_value='';
            $lkm_high_value='';
            $lkm_low_value='';
            $tradevalue_array_high_km='';
            $tradevalue_array_low_km='';
            if($vid_cbb!=''){
                //getting tradeinvalue from cbb
                $get_tradein_high_values='http://xml.canadianblackbook.com/XMLWebServices/service?command=priceVehicle&vid='.$vid_cbb.'&selectedOptions=&kilometers='.$high_km.'&annualKilometers=&account='.$account.'&key='.$key.'&schemaVersion=3.0';
                //read xml file for hkm_high_value and hkm_low_value
                $xml_high=simplexml_load_file("$get_tradein_high_values");
                if($xml_high!=''){
                    $eml1_price_value_high=$xml_high->response->children();
                    $eml2_price_value_high=$eml1_price_value_high->vehicles->children();
                    $eml3_price_value_high=$eml2_price_value_high->vehicle->children();
                    $eml4_price_value_high=$eml3_price_value_high->values->children();
                    
                    foreach($eml4_price_value_high as $values_high){
                        
                        $tradevalue_array_high_km[]=$values_high;
                        
                    }
                    }
                    if(!empty($tradevalue_array_high_km)){
                    $hkm_high_value=$tradevalue_array_high_km[1];
                    $hkm_low_value=$tradevalue_array_high_km[2];
                    }
                     $get_tradein_low_values='http://xml.canadianblackbook.com/XMLWebServices/service?command=priceVehicle&vid='.$vid_cbb.'&selectedOptions=&kilometers='.$low_km.'&annualKilometers=&account='.$account.'&key='.$key.'&schemaVersion=3.0';
                    //read xml file lkm_low_value and lkm_low_value
                    $xml=simplexml_load_file("$get_tradein_low_values");
                    if($xml!=''){
                        $eml1_price_value_low=$xml->response->children();
                        $eml2_price_value_low=$eml1_price_value_low->vehicles->children();
                        $eml3_price_value_low=$eml2_price_value_low->vehicle->children();
                        $eml4_price_value_low=$eml3_price_value_low->values->children();
                        foreach($eml4_price_value_low as $values){
                            
                            $tradevalue_array_low_km[]=$values;
                            
                        }
                        }
                        if(!empty($tradevalue_array_low_km)){
                        $lkm_high_value=$tradevalue_array_low_km[1];
                        $lkm_low_value=$tradevalue_array_low_km[2];
                        }
                        //update master table
                        $updates_master_table=("update 
                        eps_master_vehicle set vid='$vid_cbb',
                        lkm_high_value='$lkm_high_value',
                        lkm_low_value='$lkm_low_value',
                        hkm_high_value='$hkm_high_value',
                        hkm_low_value ='$hkm_low_value'                
                        where sold_vehicle_year='$year' AND
                        sold_vehicle_make='$make' AND 
                        sold_vehicle_model='$model' AND
                        vin='$vin'
                        ");  
                        $updates=$this->db->query($updates_master_table);
                        $vehicle_trim=$values_details['vehicle_trim'];
                        $data=array(    
                        'sold_vehicle_year'=>$year,
                        'sold_vehicle_make'=>$make,
                        'sold_vehicle_model'=>$model,
                        'bodydescription'=>$bodydescription,
                        'vehicle_trim'=>$vehicle_trim,
                        'low_km'=>$low_km,
                        'lkm_high_value'=>$lkm_high_value,
                        'lkm_low_value'=>$lkm_low_value,
                        'high_km'=>$high_km,
                        'hkm_high_value'=>$hkm_high_value,
                        'hkm_low_value'=>$hkm_low_value,
                        'vid'=>$vid_cbb
                        );
                       // $this->db->insert("eps_black_book_tradeinvalue", $data);
               
         
     }
    }
    }
   }
 }
 function getting_master_vehicle_details_updates()
	{
	
    $date=strtotime(date('m/d/y'));
    $return='';
    //calculate year range
    $from_year = date('Y',strtotime ( '-1 year' , $date));  
    $to_year = date('Y',strtotime ( '-10 year' , $date)); 
    $response_array='';
    $sql=("SELECT count(*) AS  `total_vin`,`sold_vehicle_year`,`sold_vehicle_make`,`sold_vehicle_model`,`sold_vehicle_VIN`,SUBSTRING(`sold_vehicle_VIN`,1,8) AS Make_Model_Description,SUBSTRING(`sold_vehicle_VIN`,10,1) AS Year,SUBSTRING(`sold_vehicle_VIN`,1,8) AS unique_vin FROM eps_data WHERE `sold_vehicle_year` = '2012' AND `sold_vehicle_make` = 'CHRYSLER' AND `sold_vehicle_model` LIKE '300' GROUP BY unique_vin ORDER BY total_vin DESC");

    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
            foreach($retrieved as $values_details){
		    $total_vin =$values_details['total_vin'];
            $sold_vehicle_year=$values_details['sold_vehicle_year'];
            $sold_vehicle_make = $values_details['sold_vehicle_make'];
			$sold_vehicle_model = $values_details['sold_vehicle_model'];
			$sold_vehicle_VIN = $values_details['sold_vehicle_VIN'];
			$Make_Model_Description = $values_details['Make_Model_Description'];
			$year = $values_details['Year'];
			// FIRST 8 DIGITS, not 9
			$unique_vin = $values_details['unique_vin'];
            //updates master vehicle table with trade in values 
			//echo $sold_vehicle_year. "\xA";
			//echo $sold_vehicle_make. "\xA";
            $account='eps_advantage_xml';
            $key='KLAD3njdf8fh3hgf8';
			
			//VIN - NEED first 8 digits for the unique_vid
			$get_vid ='http://xml.canadianblackbook.com/XMLWebServices/service?command=vehicles&year='.$sold_vehicle_year.'&vin='.$unique_vin.'&account='.$account.'&key='.$key.'&schemaVersion=3.0';
		    echo "VIN CALL". "\r\n";
			echo $get_vid. "\r\n";
			
            $xml=simplexml_load_file($get_vid);
			
			// Get the VID ( But not sure how to loop trough, if there are multiple vehicles returned
			// IF the XML is not an empty OBJECT like we have in the example ( Ithink Try , should be replaced with IF statement)
			Try
			{
			$vid_cbb = $xml->response->vehicles->vehicle->vid;
			echo "VID NUMBER". "\r\n";
			echo $vid_cbb. "\r\n";
			
			$get_vehicle_info ='http://xml.canadianblackbook.com/XMLWebServices/service?command=vehicles&vid='.$vid_cbb.'&account='.$account.'&key='.$key.'&schemaVersion=3.0';
            
			echo "VID CALL". "\r\n";
            echo $get_vehicle_info. "\r\n";
			}
			Catch(Exception $e) {
			    // Write Down in Log, for which VIN Vehilce the call failed
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                         }
			
			//ONCE WE GET THE VID
			$last_id_sql = ("SELECT LAST_INSERT_ID('eps_master_vehicle')");
			
			// AUTOINCREMENT VALUE for eps_master_vehicle_id
			$last_id=$this->db->query($last_id_sql);
			echo $last_id;
			
			//insert new vehicle in master table    
			Try
			{
			   // $insert_master_table=("INSERT INTO eps_master_vehicle (eps_master_vehicle_id, quantity, vin, sold_vehicle_year, sold_vehicle_make, sold_vehicle_model,bodydescription, vehicle_trim, low_km, lkm_high_value, lkm_low_value, high_km, hkm_high_value, hkm_low_value, vid) VALUES ('1', 20, 123456, 2005, 'ford', 'taurus','very nice', 'trim description', 120, 2532,2,3,1,123,15)");    
			   
			  // $new_row=$this->db->query($insert_master_table);
			}
			Catch(Exception $e) {
               echo 'Caught exception: ',  $e->getMessage(), "\n";
                         }
			
			
           } // foreach 
    }
	}
    /*function getting_master_vehicle_details_updates(){
    $date=strtotime(date('m/d/y'));
    $return='';
    //calculate year range
    $from_year = date('Y',strtotime ( '-1 year' , $date));  
    $to_year = date('Y',strtotime ( '-10 year' , $date)); 
    $response_array='';
    $sql=("SELECT *
    FROM eps_master_vehicle where 
   	quantity>=4 AND  
    sold_vehicle_year between $to_year AND $from_year and vid=0");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        foreach($retrieved as $values_details){
            $vin=$values_details['vin'];
            $year=$values_details['sold_vehicle_year'];
            $make=$values_details['sold_vehicle_make'];
            $model=$values_details['sold_vehicle_model'];
            $bodydescription=$values_details['bodydescription'];
            $vehicle_trim=$values_details['vehicle_trim'];
            $low_km=$values_details['low_km'];
            $high_km=$values_details['high_km'];
            //updates master vehicle table with trade in values 
            $account='eps_advantage_xml';
            $key='KLAD3njdf8fh3hgf8';
            //getting vid from cbb
            $get_vid ='http://xml.canadianblackbook.com/XMLWebServices/service?command=vehicles&year='.$year.'&vin='.$vin.'&account='.$account.'&key='.$key.'&schemaVersion=3.0';
            $xml=simplexml_load_file("$get_vid");
            foreach($xml->response->children() as $child) {
            $response_array[]=$child->getName();
            } 
            if(isset($response_array[0]) && $response_array[0]!='error'){
                $eml1=$xml->response->children();
                if($eml1!='' && $eml1){
                $eml2=$eml1->vehicles->children();
                if(isset($eml2) && $eml2!=''){
                  $eml3=$eml2->vehicle->children();  
                }else{
                  $eml3='';  
                }
                $vid_cbb=$eml3->vid;
                $hkm_high_value='';
                $hkm_low_value='';
                $lkm_high_value='';
                $lkm_low_value='';
                $tradevalue_array_high_km='';
                $tradevalue_array_low_km='';
                if($vid_cbb!=''){
                    //getting tradeinvalue from cbb
                    $get_tradein_high_values='http://xml.canadianblackbook.com/XMLWebServices/service?command=priceVehicle&vid='.$vid_cbb.'&selectedOptions=&kilometers='.$high_km.'&annualKilometers=&account='.$account.'&key='.$key.'&schemaVersion=3.0';
                    //read xml file for hkm_high_value and hkm_low_value
                    $xml_high=simplexml_load_file("$get_tradein_high_values");
                    if($xml_high!=''){
                        $eml1_price_value_high=$xml_high->response->children();
                        $eml2_price_value_high=$eml1_price_value_high->vehicles->children();
                        $eml3_price_value_high=$eml2_price_value_high->vehicle->children();
                        $eml4_price_value_high=$eml3_price_value_high->values->children();
                        
                        foreach($eml4_price_value_high as $values_high){
                            
                            $tradevalue_array_high_km[]=$values_high;
                            
                        }
                        }
                        if(!empty($tradevalue_array_high_km)){
                            $hkm_high_value=$tradevalue_array_high_km[1];
                            $hkm_low_value=$tradevalue_array_high_km[2];
                        }
                         $get_tradein_low_values='http://xml.canadianblackbook.com/XMLWebServices/service?command=priceVehicle&vid='.$vid_cbb.'&selectedOptions=&kilometers='.$low_km.'&annualKilometers=&account='.$account.'&key='.$key.'&schemaVersion=3.0';
                        //read xml file lkm_low_value and lkm_low_value
                        $xml=simplexml_load_file("$get_tradein_low_values");
                        if($xml!=''){
                            $eml1_price_value_low=$xml->response->children();
                            $eml2_price_value_low=$eml1_price_value_low->vehicles->children();
                            $eml3_price_value_low=$eml2_price_value_low->vehicle->children();
                            $eml4_price_value_low=$eml3_price_value_low->values->children();
                            foreach($eml4_price_value_low as $values){
                                
                                $tradevalue_array_low_km[]=$values;
                                
                            }
                            }
                            if(!empty($tradevalue_array_low_km)){
                            $lkm_high_value=$tradevalue_array_low_km[1];
                            $lkm_low_value=$tradevalue_array_low_km[2];
                            }
                            //update master table
                            $updates_master_table=("update 
                            eps_master_vehicle set vid='$vid_cbb',
                            lkm_high_value='$lkm_high_value',
                            lkm_low_value='$lkm_low_value',
                            hkm_high_value='$hkm_high_value',
                            hkm_low_value ='$hkm_low_value'                
                            where sold_vehicle_year='$year' AND
                            sold_vehicle_make='$make' AND 
                            sold_vehicle_model='$model' AND
                            vin='$vin'
                            ");  
                            $updates=$this->db->query($updates_master_table);
                            $vehicle_trim=$values_details['vehicle_trim'];
                            $data=array(    
                            'sold_vehicle_year'=>$year,
                            'sold_vehicle_make'=>$make,
                            'sold_vehicle_model'=>$model,
                            'bodydescription'=>$bodydescription,
                            'vehicle_trim'=>$vehicle_trim,
                            'low_km'=>$low_km,
                            'lkm_high_value'=>$lkm_high_value,
                            'lkm_low_value'=>$lkm_low_value,
                            'high_km'=>$high_km,
                            'hkm_high_value'=>$hkm_high_value,
                            'hkm_low_value'=>$hkm_low_value,
                            'vid'=>$vid_cbb
                            );
                           // $this->db->insert("eps_black_book_tradeinvalue", $data);
                   
             
            }
            }
            $return='updated';
        }
        }
     }
    return $return;
    }*/
    function get_trim_value($year,$make,$model){
     $sql=("SELECT trimShort
     FROM  Vehicle where year='$year' AND
     make='$make' AND 
     model='$model' order by id limit 1
    ");
    $query=$this->db->query($sql);
    if($query -> num_rows() > 0){
        $retrieved=$query->result_array();
        foreach($retrieved as $values){ 
         $trimShort= $values['trimShort'];          
        }
            $return =$trimShort;
        }
        else{
            $return ='';    
        }
        return $return;
    }

}