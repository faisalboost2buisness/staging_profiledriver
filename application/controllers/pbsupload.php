<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
class Pbsupload extends CI_Controller{
    public function __construct() { 
        parent::__construct();
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library("pagination");
        $this -> load -> model("main_model");
        $this -> load -> model("upload_model");
        $this -> load -> model("settings_model");
        $this -> load -> model("ftpread_model");
    }
     function index(){
      $staus_get=$this->test();   
        }
    /*function to get customer data field name*/
    public function getcustomerfeildnames(){ 
        $customer_data_feild_name=array("Buyer Last Name","Buyer First Name","Buyer Address","Buyer Appartment #","Buyer Appartment","Buyer City","Buyer Province/State","Buyer Postal Code/Zip","Buyer Email","Buyer Home Phone","Buyer Business Phone","Buyer Cell Phone","Sold Vehicle Stock","Sold Vehicle VIN","Shortened VIN","New or Used","Sold Vehicle Year","Sold Vehicle Make","Sold Vehicle Model");
        return $customer_data_feild_name;
    }
    /*function to get financial field names*/
    public function getfiancialfeildnames(){ 
        $financial_data_feild_name=array("BodyDescription","ContractDate","FirstPaymentDate","VehiclePayoffDate","VehicleSalePrice","TotalSaleCredits","TotalCashDownAmount","TotalTax","TotalFinanceAmount","TotalofPayments","MonthlyPayment","ContractTerm","APR","PaymentFrequency","VehicleStock");
        return $financial_data_feild_name;
    }
    /*function to get the fieldname of database*/
    public function customer_data_database_fieldname_related_upload_file($file_field_name){
        if($file_field_name=='Buyer Last Name'){
            $return='buyer_last_name';
        }else if($file_field_name=='BuyerLastName'){
            $return='buyer_last_name';
        }else if($file_field_name=='Buyer First Name'){
            $return='buyer_first_name';
        }else if($file_field_name=='BuyerFirstName'){
            $return='buyer_first_name';
        }else if($file_field_name=='Buyer Address'){
            $return='buyer_address';
        }else if($file_field_name=='BuyerAddress'){
            $return='buyer_address';
        }else if($file_field_name=='Buyer Appartment #'){
            $return='buyer_appartment';
        }else if($file_field_name=='BuyerApartment#'){
            $return='buyer_appartment';
        }else if($file_field_name=='Buyer Appartment'){
            $return='buyer_appartment';
        }else if($file_field_name=='Buyer City'){
            $return='buyer_city';
        }else if($file_field_name=='BuyerCity'){
            $return='buyer_city';
        }else if($file_field_name=='Buyer Province/State'){
            $return='buyer_province';
        }else if($file_field_name=='BuyerState'){
            $return='buyer_province';
        }else if($file_field_name=='Buyer Postal Code/Zip'){
            $return='buyer_postalcode';
        }else if($file_field_name=='BuyerZip'){
            $return='buyer_postalcode';
        }else if($file_field_name=='Buyer Email'){
            $return='buyer_email';
        }else if($file_field_name=='BuyerEmail'){
            $return='buyer_email';
        }else if($file_field_name=='Buyer Home Phone'){
            $return='buyer_homephone';
        }else if($file_field_name=='BuyerHomePhone'){
            $return='buyer_homephone';
        }else if($file_field_name=='Buyer Business Phone'){
            $return='buyer_businessphone';
        }else if($file_field_name=='BuyerBusinessPhone'){
            $return='buyer_businessphone';
        }else if($file_field_name=='Buyer Cell Phone'){
            $return='buyer_cellphone';
        }else if($file_field_name=='BuyerCellPhone'){
            $return='buyer_cellphone';
        }else if($file_field_name=='Sold Vehicle Stock'){
            $return='sold_vehicle_stock';
        }else if($file_field_name=='SoldVehicleStock'){
            $return='sold_vehicle_stock';
        }else if($file_field_name=='SoldVehicleVIN'){
            $return='sold_vehicle_VIN';
        }else if($file_field_name=='Sold Vehicle VIN'){
            $return='sold_vehicle_VIN';
        }else if($file_field_name=='Shortened VIN'){
            $return='shortened_VIN';
        }else if($file_field_name=='ShortenedVIN'){
            $return='shortened_VIN';
        }else if($file_field_name=='New or Used'){
            $return='new_used';
        }else if($file_field_name=='NeworUsed'){
            $return='new_used';
        }else if($file_field_name=='Sold Vehicle Year'){
            $return='sold_vehicle_year';
        }else if($file_field_name=='SoldVehicleYear'){
            $return='sold_vehicle_year';
        }else if($file_field_name=='Sold Vehicle Make'){
            $return='sold_vehicle_make';
        }else if($file_field_name=='SoldVehicleMake'){
            $return='sold_vehicle_make';
        }else if($file_field_name=='Sold Vehicle Model'){
            $return='sold_vehicle_model';
        }else if($file_field_name=='SoldVehicleModel'){
            $return='sold_vehicle_model';
        }else{
            $return='';
        }
        return $return;
    }
        /*function to get the data of database*/
    public function pbs_customer_data_database_fieldname_related_upload_file($file_field_name){
        if($file_field_name=='Customer Last Name'){
            $return='buyer_last_name';
        }else if($file_field_name=='Customer First Name'){
            $return='buyer_first_name';
        }else if($file_field_name=='Customer Address'){
            $return='buyer_address';
        }else if($file_field_name=='Customer City'){
            $return='buyer_city';
        }else if($file_field_name=='Customer Province/State'){
            $return='buyer_province';
        }else if($file_field_name=='Customer Postal Code/Zip'){
            $return='buyer_postalcode';
        }else if($file_field_name=='BuyerZip'){
            $return='buyer_postalcode';
        }else if($file_field_name=='Customer Email'){
            $return='buyer_email';
        }else if($file_field_name=='BuyerEmail'){
            $return='buyer_email';
        }else if($file_field_name=='Customer Home Phone'){
            $return='buyer_homephone';
        }else if($file_field_name=='BuyerHomePhone'){
            $return='buyer_homephone';
        }else if($file_field_name=='Customer Business Phone'){
            $return='buyer_businessphone';
        }else if($file_field_name=='BuyerBusinessPhone'){
            $return='buyer_businessphone';
        }else if($file_field_name=='Customer Cell Phone'){
            $return='buyer_cellphone';
        }else if($file_field_name=='BuyerCellPhone'){
            $return='buyer_cellphone';
        }else if($file_field_name=='Vehicle Stock #'){
            $return='sold_vehicle_stock';
        }else if($file_field_name=='SoldVehicleStock'){
            $return='sold_vehicle_stock';
        }else if($file_field_name=='Vehicle VIN'){
            $return='sold_vehicle_VIN';
        }else if($file_field_name=='Sold Vehicle VIN'){
            $return='sold_vehicle_VIN';
        }else if($file_field_name=='Shortened VIN'){
            $return='shortened_VIN';
        }else if($file_field_name=='ShortenedVIN'){
            $return='shortened_VIN';
        }else if($file_field_name=='New or Used'){
            $return='new_used';
        }else if($file_field_name=='NeworUsed'){
            $return='new_used';
        }else if($file_field_name=='Vehicle Year'){
            $return='sold_vehicle_year';
        }else if($file_field_name=='Vehicle Sales Rep'){
            $return='salesman';
        }else if($file_field_name=='Vehicle Make'){
            $return='sold_vehicle_make';
        }else if($file_field_name=='SoldVehicleMake'){
            $return='sold_vehicle_make';
        }else if($file_field_name=='Vehicle Model'){
            $return='sold_vehicle_model';
        }else if($file_field_name=='SoldVehicleModel'){
            $return='sold_vehicle_model';
        }else{
            $return='';
        }
        return $return;
    }
    
    /*function to get dtabase field name releated to upload files*/
    public function financial_data_database_fieldname_related_upload_file($file_field_name){
        if($file_field_name=='BodyDescription'){
            $return='bodydescription';
        }else if($file_field_name=='ContractDate'){
            $return='contract_date';
        }else if($file_field_name=='DeliveryDate'){
            $return='delivery_date';
        }else if($file_field_name=='FirstPaymentDate'){
            $return='first_payment_date';
        }else if($file_field_name=='VehiclePayoffDate'){
            $return='vehicle_payoff_date';
        }else if($file_field_name=='VehicleSalePrice'){
            $return='vehiclesale_price';
        }else if($file_field_name=='TotalSaleCredits'){
            $return='totalsale_credits';
        }else if($file_field_name=='TotalCashDownAmount'){
            $return='total_cash_down_amount';
        }else if($file_field_name=='TotalTax'){
            $return='total_tax';
        }else if($file_field_name=='TotalFinanceAmount'){
            $return='total_finance_amount';
        }else if($file_field_name=='TotalOfPayments'){
            $return='total_of_payments';
        }else if($file_field_name=='MonthlyPayment'){
            $return='monthly_payment';
        }else if($file_field_name=='APRRate'){
            $return='apr';
        }else if($file_field_name=='APR'){
            $return='apr';
        }else if($file_field_name=='PaymentFrequency'){
            $return='payment_frequency';
        }else if($file_field_name=='VehicleStock'){
            $return='vehicle_stock';
        }else if($file_field_name=='ContractTerm'){
            $return='contract_term';
        }else {
            $return='';
        }
        return $return;
    }
  
    //------------------------------------Cronjob fuction start--------------------------------//
    
     /*function to read authenticom file from dealers folder*/
    function read_authenticom_file_from_dealer_folder(){
        $returnvalue=$this -> ftpread_model -> read_ftp_file_details('authenticom');
//        if(isset($returnvalue) && $returnvalue!=''){
//        foreach ($returnvalue as $values){
//                $start_limit=$values['offset'];
//                $filename=$values['filename'];
//                $end_limit=$start_limit+1000;
//                $source=$values['source'];
//                $dealership_id=$values['dealership_id'];
//                $staus_get=$this->ftp_authenticom_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename);               
//            }    
//        }
        
        $start_limit=0;
        $filename='';
        $end_limit=$start_limit+1000;
        $source='';
        $dealership_id=254;
        $staus_get=$this->ftp_authenticom_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename);    
    }
    /*function to read pbs file from dealers folder*/
    function read_pbs_file_from_dealer_folder(){
        $returnvalue=$this -> ftpread_model -> read_ftp_file_details('pbs');
//        if(isset($returnvalue) && $returnvalue!=''){
//        foreach ($returnvalue as $values){
//                $start_limit=$values['offset'];
//                $filename=$values['filename'];
//                $end_limit=$start_limit+1000;
//                $source=$values['source'];
//                $dealership_id=$values['dealership_id'];
//                $this->ftp_pbs_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename); 
//                }    
//        }
        $start_limit=0;
        $filename='';
        $end_limit=$start_limit+1000;
        $source='';
        $dealership_id=256;
        $this->ftp_pbs_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename); 
    }
        
    function ftp_pbs_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename){
    //$dealer_id=198;    
    //$filename='PBSDemoFandI0000.csv';
    $user_details=$this -> main_model-> dealerfulldetails($dealership_id);
    foreach($user_details as $details){
        $folder_name=$details['folder_name'];
    }
    $file_read=$this -> ftpread_model -> pbs_csv_file_read_qurey($start_limit,$end_limit,$dealership_id,$filename,$folder_name);
    if($file_read!=1){
            $admin_emailid= $this -> config -> item('admin_address'); 
            $subject='Ftp file move failed';
            $message.= 'Dear Admin,<br/><br/>
            The file '.$filename.' is failed to move in to the folder<br/><br/>';
            $message.='Regards,<br/>Exclusive Private Sale.Inc';  
            $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message);    
    }
    }
    //function to read customer authenticom file
    function ftp_authenticom_customer_csv_file_read($start_limit,$end_limit,$dealership_id,$filename){   
        //$dealership_id=170;
        $user_details=$this -> main_model-> dealerfulldetails($dealership_id);
        foreach($user_details as $details){
            $folder_name=$details['folder_name'];
        }
        $filename=$filename;
        $base_path = $this -> config -> item('rootpath');
//        $file_path=$base_path.'clients/'.$folder_name.'/'.$filename;
//        $file_path=$base_path.'clients/RichmondChrysler-247-2014-08-11/HIST_richmond_chrysler_SL.CSV';HIST_auto_clearing_SL.CSV
        $file_path=$base_path.'clients/HIST_auto_clearing_SL.CSV';
        //read the library file
        require_once $base_path.'uploadfile/parsecsv.lib.php';
        $csv_file_display = new parseCSV();
        $csv_file_display->auto($file_path);
        $comacheck=0;
        $comacheck_finacial=0;
        $comacheck_updates=0;
        //read the csv file title and save in to an array
        foreach ($csv_file_display->titles as $values_titles){ 
            if($values_titles!=''){
                $field_insert[]=$values_titles;         
            }
        }
        echo '<pre>';
        print_r($field_insert);
        echo '</pre>';
        $p=1; 
        //get count titles 
        $rowcountget=count($csv_file_display->titles); 
        $checklimit=$start_limit;
        $end_limit;
        $pbs_sales_data=$csv_file_display->data; 
        //get cont of row excluding title
        $total_row_count=(count($csv_file_display->data)-1);
        if($total_row_count!=''){
            //loop rows
            for($checklimit=$start_limit;$checklimit<$end_limit;$checklimit++){
                if($checklimit<=$total_row_count){
                    $i=0;
                    $count=0;
                    $insertfieldvalues='';
                    $updatefieldvalues='';
                    $insertfieldvalues_financial='';
                    $insertfieldvalues1='';
                    if($pbs_sales_data[$checklimit]!=''){
                        //read coloumn
                        foreach ($pbs_sales_data[$checklimit] as $line_of_text){  
//                            print_r($pbs_sales_data[$checklimit]);
//                            echo '<br/><br/>';
//                            continue;
                            if($i<17){
                                if($comacheck>0){
                                    $insertfieldvalues.=', ' ;
                                }
                                //checking if the values already in batabase
                                $values_get=$field_insert[$i];
                                //get name of title and corresponding database file name
                                $customer_data_related_database_field_name=$this -> customer_data_database_fieldname_related_upload_file($values_get);
                                $database_values=$customer_data_related_database_field_name;
                                //excluding six digits from year field
                                if($field_insert[$i]=='SoldVehicleYear'){
                                    if($line_of_text!=''){
                                        $soldvehicleyear_gettting=explode('.',trim(addslashes($line_of_text)));
                                        if(isset($soldvehicleyear_gettting)) {
                                            $soldvehicleyear=$soldvehicleyear_gettting[0]; 
                                        } 
                                        else{
                                            $soldvehicleyear=trim(addslashes($line_of_text)); 
                                        }
                                        $insertfieldvalues.=$database_values.'='."'".$soldvehicleyear."'";
                                    }
                                }elseif($field_insert[$i] == 'BuyerHomePhone'){
                                    $home_phone = trim(addslashes($line_of_text));
                                    if($home_phone != ''){
                                        $first_three = substr($home_phone, 0, 3);
                                        $second_three = substr($home_phone, 3, 3);
                                        $third_three = substr($home_phone, 6, 4);
                                        $home_phone = "(".$first_three.") ".$second_three."-".$third_three;
                                    }
                                    $insertfieldvalues.=$database_values.'='."'".$home_phone."'";
                                }elseif($field_insert[$i] == 'BuyerBusinessPhone'){
                                    $home_phone = trim(addslashes($line_of_text));
                                    if($home_phone != ''){
                                        $first_three = substr($home_phone, 0, 3);
                                        $second_three = substr($home_phone, 3, 3);
                                        $third_three = substr($home_phone, 6, 4);
                                        $home_phone = "(".$first_three.") ".$second_three."-".$third_three;
                                    }
                                    $insertfieldvalues.=$database_values.'='."'".$home_phone."'";
                                }elseif($field_insert[$i] == 'BuyerCellPhone'){
                                    $home_phone = trim(addslashes($line_of_text));
                                    if($home_phone != ''){
                                        $first_three = substr($home_phone, 0, 3);
                                        $second_three = substr($home_phone, 3, 3);
                                        $third_three = substr($home_phone, 6, 4);
                                        $home_phone = "(".$first_three.") ".$second_three."-".$third_three;
                                    }
                                    $insertfieldvalues.=$database_values.'='."'".$home_phone."'";
                                }elseif($field_insert[$i]=='BuyerFirstName'){
                                    $first_name = ucfirst(strtolower(trim(addslashes($line_of_text))));
                                    $insertfieldvalues.=$database_values.'='."'".$first_name."'";
                                }elseif($field_insert[$i]=='BuyerLastName'){
                                    $last_name = ucfirst(strtolower(trim(addslashes($line_of_text))));
                                    $insertfieldvalues.=$database_values.'='."'".$last_name."'";
                                }elseif($field_insert[$i]=='BuyerAddress'){
                                    $addresss = '';
                                    $address = ucfirst(strtolower(trim(addslashes($line_of_text))));
                                    $addresses = explode(' ',$address);
                                    foreach($addresses as $a){
                                        if(strlen($a) < 4){
                                            $addresss .= strtoupper($a)." ";
                                        }else{
                                            $addresss .= ucfirst($a)." ";
                                        }
                                    }
                                    $insertfieldvalues.=$database_values.'='."'".$addresss."'";
                                }elseif($field_insert[$i]=='BuyerEmail'){
                                    $insertfieldvalues.=$database_values.'='."'".strtolower(trim(addslashes($line_of_text)))."'";
                                }elseif($field_insert[$i]=='NeworUsed'){
                                    $new_used = strtolower(trim(addslashes($line_of_text)));
                                    echo $new_used."<br/><br/>";
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
                                    echo $new_used."<br/><br/>";
                                    $insertfieldvalues.=$database_values.'='."'".trim(addslashes($new_used))."'";
                                }else{
                                    if($field_insert[$i]=='SoldVehicleVIN'){
                                        $vin = trim(addslashes($line_of_text));
                                        $first_vin = substr($vin,0, 8);
                                        $second_vin = substr($vin,9, 1);
                                        $vin = $first_vin."".$second_vin;
                                        $insertfieldvalues.='shortened_VIN='."'".trim(addslashes($vin))."',";
                                    }
                                    $insertfieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."'";
                                }

                                //field for updates conditions
                                if($field_insert[$i]=='BuyerFirstName'){
                                    $updatefieldvalues.= 'LOWER('.$database_values.')='."LOWER('".trim(addslashes($line_of_text))."') AND ";
                                }elseif($field_insert[$i]=='BuyerLastName'){
                                    $updatefieldvalues.= 'LOWER('.$database_values.')='."LOWER('".trim(addslashes($line_of_text))."') AND ";
//                                    $updatefieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."' AND ";  
                                }elseif($field_insert[$i]=='BuyerAddress'){
                                    $updatefieldvalues.= 'LOWER('.$database_values.')='."LOWER('".trim(addslashes($line_of_text))."') AND ";
//                                    $updatefieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."' AND ";  
                                }elseif($field_insert[$i]=='SoldVehicleStock'){
                                  $updatefieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."' AND ";  
                                }elseif($field_insert[$i]=='SoldVehicleYear'){
                                    if($line_of_text!=''){
                                        $soldvehicleyear_gettting=explode('.',trim(addslashes($line_of_text)));
                                        if(isset($soldvehicleyear_gettting)) {
                                            $soldvehicleyear=$soldvehicleyear_gettting[0]; 
                                        } 
                                        else{
                                            $soldvehicleyear=trim(addslashes($line_of_text)); 
                                        }
                                        $updatefieldvalues.=$database_values.'='."'".$soldvehicleyear."' AND ";
                                        $soldvehicleyear=$soldvehicleyear;
                                    }
                                }elseif($field_insert[$i]=='SoldVehicleMake'){
                                    $updatefieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."' AND ";
                                    $SoldVehicleMake = trim(addslashes($line_of_text));
                                }elseif($field_insert[$i]=='SoldVehicleModel'){
                                    $updatefieldvalues.=$database_values.'='."'".trim(addslashes($line_of_text))."'";
                                    $SoldVehicleModel= trim(addslashes($line_of_text)); 
                                }
                                elseif($field_insert[$i]=='SoldVehicleVIN'){
                                    $SoldVehicleVIN=trim(addslashes($line_of_text));
                                }
                                elseif($field_insert[$i]=='BodyDescription'){
                                    $BodyDescription=trim(addslashes($line_of_text));
                                }
                                //insert vehicle_stock in to financial table
                            }else{
                                $values_get=$field_insert[$i];
                                $financial_related_database_feild_name=$this -> financial_data_database_fieldname_related_upload_file($values_get);
                                if($comacheck_finacial>16){
                                    $insertfieldvalues_financial.=', ' ;
                                }

                                if($field_insert[$i]=='ContractDate'){
                                    $insertfieldvalues_financial.=$financial_related_database_feild_name.'='."'".strtotime(trim(addslashes($line_of_text)))."'";  
                                }
                                elseif($field_insert[$i]=='FirstPaymentDate'){
                                    $insertfieldvalues_financial.=$financial_related_database_feild_name.'='."'".strtotime(trim(addslashes($line_of_text)))."'";  
                                }
                                elseif($field_insert[$i]=='DeliveryDate'){
                                    $insertfieldvalues_financial.=$financial_related_database_feild_name.'='."'".strtotime(trim(addslashes($line_of_text)))."'";  
                                }
                                else{
                                    $insertfieldvalues_financial.=$financial_related_database_feild_name.'='."'".trim(addslashes($line_of_text))."'";    
                                }
                            }
                            $comacheck++;
                            $comacheck_finacial++;
                            $count++;
                            if($rowcountget==$count){
                                $insert_csv_field_database=$insertfieldvalues.$insertfieldvalues_financial;
                                //$last_insertid=$this->upload_model ->insert_customer_csv_files_authenticom($insertfieldvalues,$dealership_id,$updatefieldvalues);
                                //insert customer data in to final eps table
                                $last_insertid=$this->ftpread_model ->insert_customer_csv_files_authenticom_into_final_eps($insert_csv_field_database,$dealership_id,$updatefieldvalues);
                                //insert function for financial data 
                                //$last_pbsdatainsertid=$this->upload_model ->insert_pbs_finacial_csv_files($financialdata,$vehicle_stock);
                                //call the function for update master table function 
                                $update_offset=$this->ftpread_model->updatemastertable($SoldVehicleVIN,$soldvehicleyear,$SoldVehicleMake,$SoldVehicleModel,$BodyDescription); 
                                $insertfieldvalues='';
                                $insertfieldvalues_financial='';
                                $comacheck=0; 
                                $comacheck_finacial=0;
                                break;
                            }
                            $p++;    
                            $i++; 
                        }
                        if($total_row_count!=$checklimit){
                            if($checklimit==$end_limit-1){
                                $start_limit=$start_limit+1000;
                                //updates ftp feed offset updates
                                $update_offset=$this->ftpread_model ->ftp_details_offset_updates($start_limit,$filename,$dealership_id); 
                               // $this->authenticom_customer_csv_file_read1($start_limit,$endlimit,$dealership_id,$filename);
                            }
                        }else{
                            //updates ftp feed status complete 
                            $start_limit=$total_row_count;
                            $update_status=$this->ftpread_model ->ftp_details_status_updates($start_limit,$filename,$dealership_id);     
                        }
                    }
                }
            }
        }else{
            $admin_emailid= $this -> config -> item('admin_address'); 
            $subject='Ftp file move failed';
            $message.= 'Dear Admin,<br/><br/>
            The file '.$file.' is failed to move in to the folder<br/><br/>';
            $message.='Regards,<br/>Exclusive Private Sale.Inc';  
            $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message); 
            
        }
    }
    /*--------------------------------------------------------------------------*/

    //update backbook data 
    function blackbookdataupdates(){
        //getting master vehicle details

                $master_vehicle=$this->ftpread_model ->getting_master_vehicle_details_updates(); 

    }
    function test(){
        $message='';
        $admin_emailid='ecommercedvlpr@gmail.com';
        $subject='Cronjob worked';
        $message.= 'Dear Admin,<br/><br/>';
        $message.= 'Cronjob worked<br/><br/>';
        $message.='Regards,<br/>Exclusive Private Sale.Inc';
        $this->main_model->HTMLemail($admin_emailid,$admin_emailid,'',$subject,$message);   
    }
    function updatemastertable($dealer_id){
        //get eps data 
        $dealer_id='246';
        $sql=("SELECT *
        FROM  eps_data
        WHERE dealership_id='$dealer_id' 
        ");
        $query=$this->db->query($sql);  
        $retrieved=$query->result_array();
        if(isset($retrieved)){
            foreach ($retrieved as $row){
              $vin=substr($row['sold_vehicle_VIN'],0,8); 
              $sold_vehicle_year=$row['sold_vehicle_year']; 
              $sold_vehicle_make=addslashes($row['sold_vehicle_make']); 
              $sold_vehicle_model=addslashes($row['sold_vehicle_model']); 
              $bodydescription=addslashes($row['bodydescription']); 
              $current_year=date('Y');
              $low_km=(($current_year-$sold_vehicle_year)*12 +12)* 1000;
              $high_km=(($current_year-$sold_vehicle_year)*12 +12)* 1500;
              $vehicle_trim=$this->ftpread_model ->get_trim_value($sold_vehicle_year,$sold_vehicle_make,$sold_vehicle_model); 
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
        }
    }
    
    function payment_frequency(){
        /*
         *  Update Payment Frequency based on Monthly, Bi-Weekly,Bi-Monthly
         */
        $this->main_model->update_payment_freq1();
        /*
         *  Update with formula
         */
        $this->main_model->update_payment_freq2();
    }
    
    /*
     *  Update the contract terms
     */
    function contract_terms(){
        $this->main_model->update_contract_term();
    }
    
    /*
     *  Update Total of Payment
     */
    
    function total_of_payment(){
        $this->main_model->update_total_of_payment();
    }
    
    /*
     *  Calculate Remaining Financial Amount
     */
    function finance_amount_remaining(){
        $this->main_model->financial_remaining();
    }
    
    function trade_in(){
        $this->main_model->calculate_trad_in();
    }
}
?>