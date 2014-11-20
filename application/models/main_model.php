<?php
class Main_model extends CI_Model {
    public function __construct(){
        $this->load->database();
    }
    /*Function to send mails*/
    public function email_send1($from_emailid, $subject, $email, $emaildata){
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['protocol'] = 'sendmail';
        $this->email->initialize($config);
        $this->email->from($from_emailid,'Exclusive Private Sale.Inc');
        $this->email->to($email);
        $this->email->subject($subject);
        $html_email = $this->load->view('email-views.php', $emaildata, true);
        $this->email->message($html_email);
        $this->email->send();
        return true;
    }
    //mail sending function
    public function email_send($from_emailid, $subject, $email, $emaildata){
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['protocol'] = 'sendmail';
        $this->email->initialize($config);
        $this->email->from($from_emailid, 'Exclusive Private Sale.Inc');
        $this->email->to($email);
        $this->email->subject($subject);
        $html_email= $this->load->view('email-views.php', $emaildata, true);
        $this->email->message($html_email);
        $this->email->send();
    }
    //function to resize images
    public function resize_image($pic,$loc,$new_name,$new_w,$new_h,$image_type){
        if ($image_type == 'image/jpeg' || $image_type == 'image/jpg' || $image_type == 'image/pjpeg'){
            $im = imagecreatefromjpeg($pic);
        }
        elseif ($image_type == 'image/gif'){
            $im = imagecreatefromgif($pic);
        }
        elseif ($image_type == 'image/png' || $image_type == 'image/x-png') {
            $im = imagecreatefrompng($pic);
        }
        //$im = imagecreatefromjpeg($pic);
        $orwidth=imagesx($im); // get original width
        $orheight=imagesy($im); //get original height
        if($orwidth>$orheight){
            if($orwidth>$new_w){
                $ratio = $orwidth/$orheight; // calc image ratio
                $new_h = round($new_w/$ratio,0); // calc new height keeping ratio of original
            }else{
                $new_w=$orwidth;
                $new_h=$orheight;
            }
            $new_image=ImageCreateTrueColor($new_w,$new_h);
            imagecopyresampled($new_image,$im,0,0,0,0,$new_w,$new_h,$orwidth,$orheight);
            imagejpeg($new_image,$loc.$new_name,100);
            imagedestroy($new_image);
        }else{
            if($orheight>$new_h){
                $ratio = $orheight/$orwidth; // calc image ratio
                $new_w = round($new_h/$ratio,0); // calc new height keeping ratio of original
            }
            else{
                $new_w=$orwidth;
                $new_h=$orheight;
            }
            $new_image=ImageCreateTrueColor($new_w,$new_h);
            imagecopyresampled($new_image,$im,0,0,0,0,$new_w,$new_h,$orwidth,$orheight);
            imagejpeg($new_image,$loc.$new_name,100);
            imagedestroy($new_image);
        }
    }
    //function to get user details
    public function user_data($user_id){
        $this->load->helper('url');
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('registration_id = ' . "'" . $user_id . "'");
        $result=$this->db->get();
        if ($result->num_rows()>0){
            $retrieved = $result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    /*Function to fetch user details*/
    public function alluserdetails(){
        $all_users_id='';

        $sql=("SELECT registration.*,
               autobrand.`company_name` AS autobrand_company_name,  dealership.`company_name` as dealership_company_name,
               autobrand.`company_phonenumber` AS autobrand_company_phonenumber,  dealership.`company_phonenumber` as dealer_company_phonenumber
              FROM registration
              LEFT JOIN autobrand ON autobrand.registration_id = registration.registration_id
              LEFT JOIN dealership ON dealership.registration_id = registration.registration_id
            WHERE registration.status = 'VERIFIED' and registration.usertype<> 'admin'
            ORDER BY registration.`usertype` = 'sub_admin',
            registration.`usertype` = 'auto_brand',
            registration.`usertype` = 'account_managers',
            registration.`usertype` = 'dealership' ,
            registration.registration_id desc ");
        $query=$this->db->query($sql);


        if($query -> num_rows()>0){
            $returnvalue= $query->result_array();
            return $returnvalue;
        }else{
            return FALSE;
        }
    }
    /*Function to fetch dealer details*/
    public function dealeruserdetails(){
        $all_users_id='';
        $sql=("SELECT *
            FROM registration
            WHERE STATUS = 'VERIFIED' and 
            usertype='dealership'
            ORDER BY registration_id desc ");
        $query=$this->db->query($sql);
        if($query->num_rows()>0){
            $returnvalue= $query->result_array();
            return $returnvalue;
        }else{
            return FALSE;
        }
    }
    /*function to sort*/
    public function sortuserdetails(){
        $member_user_type=$this->input->post('member_type');
        $condition='';
        if($member_user_type=='All'){
            $all_users_id='';
            $sql=("SELECT *
                FROM registration
                WHERE STATUS = 'VERIFIED' and 
                usertype<> 'admin'
                ORDER BY `usertype` = 'auto_brand', 
                `usertype` = 'account_managers', 
                `usertype` = 'dealership' ,
                registration_id desc ");
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0){
                $returnvalue= $query->result_array();
                return $returnvalue;
            }else{
                return FALSE;
            }
        }else{
            if($member_user_type=='dealership'){
                $condition="and usertype='dealership'";
            }else if($member_user_type=='account_managers'){
                $condition="and usertype='account_managers'";
            }else if($member_user_type=='auto_brand'){
                $condition="and usertype='auto_brand'";
            }else if($member_user_type=='sub_admin'){
                $condition="and usertype='sub_admin'";
            }
            $sql=("SELECT *
                    FROM registration
                    WHERE STATUS = 'VERIFIED' and usertype<> 'admin'  $condition
                    ORDER BY registration_id desc ");
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0){
                $returnvalue= $query->result_array();
                return $returnvalue;
            }else{
                return FALSE;
            }
        }
    }
    //function to delete an existing user
    public function property_delete($property_id){
        $query = $this->db->where('registration_id',$property_id);
        $query = $this->db->delete('registration');
    }
    //Function for country selectoin
    public function CountrySelection (){
        $CountryArray = array("Afghanistan"=>"Afghanistan","Albania"=>"Albania","Algeria"=>"Algeria","AmericanSamoa"=>"American Samoa","Andorra"=>"Andorra","Angola"=>"Angola","Anguilla"=>"Anguilla","Antigua"=>"Antigua","Barbuda"=>"Barbuda","Argentina"=>"Argentina","Armenia"=>"Armenia","Aruba"=>"Aruba","Australia"=>"Australia","Austria"=>"Austria","Azerbaijan"=>"Azerbaijan","Bahamas"=>"Bahamas","Bahrain"=>"Bahrain","Bangladesh"=>"Bangladesh","Barbados"=>"Barbados","Belarus"=>"Belarus","Belgium"=>"Belgium","Belize"=>"Belize","Benin"=>"Benin","Bermuda"=>"Bermuda","Bhutan"=>"Bhutan","Bolivia"=>"Bolivia","BosniaAndHerzegovina"=>"Bosnia & Herzegovina","Botswana"=>"Botswana","Brazil"=>"Brazil","BruneiDarussalam"=>"Brunei Darussalam","Bulgaria"=>"Bulgaria","BurkinaFaso"=>"Burkina Faso","Burundi"=>"Burundi","Cambodia"=>"Cambodia","Cameroon"=>"Cameroon","Canada"=>"Canada","CapeVerde"=>"Cape Verde","CaymanIslands"=>"Cayman Islands","CentralAfricanRepublic"=>"Central African Republic","Chad"=>"Chad","Chile"=>"Chile","China"=>"China","Colombia"=>"Colombia","Comoros"=>"Comoros","Congo"=>"Congo","CongoDRC"=>"Congo (DRC)","Cook"=>"Cook","Islands"=>"Islands","CostaRica"=>"Costa Rica","CotedIvoire"=>"C&ocirc;te d'Ivoire","Croatia"=>"Croatia","Cuba"=>"Cuba","Cyprus"=>"Cyprus","CzechRepublic"=>"Czech Republic","Denmark"=>"Denmark","Djibouti"=>"Djibouti","Dominica"=>"Dominica","DominicanRepublic"=>"Dominican Republic","EastTimor"=>"East Timor","Ecuador"=>"Ecuador","Egypt"=>"Egypt","ElSalvador"=>"El Salvador","EquatorialGuinea"=>"Equatorial Guinea","Eritrea"=>"Eritrea","Estonia"=>"Estonia","Ethiopia"=>"Ethiopia","FaeroeIslands"=>"Faeroe Islands","FalklandIslands"=>"Falkland Islands","Fiji"=>"Fiji","Finland"=>"Finland","France"=>"France","FrenchGuiana"=>"French Guiana","French"=>"French","Polynesia"=>"Polynesia","Gabon"=>"Gabon","Gambia"=>"Gambia","Georgia"=>"Georgia","Germany"=>"Germany","Ghana"=>"Ghana","Gibraltar"=>"Gibraltar","Greece"=>"Greece","Greenland"=>"Greenland","Grenada"=>"Grenada","Guadeloupe"=>"Guadeloupe","Guam"=>"Guam","Guatemala"=>"Guatemala","Guinea"=>"Guinea","Guinea-Bissau"=>"Guinea-Bissau","Guyana"=>"Guyana","Haiti"=>"Haiti","HolySee"=>"Holy See","Honduras"=>"Honduras","HongKong"=>"Hong Kong","Hungary"=>"Hungary","Iceland"=>"Iceland","India"=>"India","Indonesia"=>"Indonesia","Iran"=>"Iran","Iraq"=>"Iraq","Ireland"=>"Ireland","Israel"=>"Israel","Italy"=>"Italy","Jamaica"=>"Jamaica","Japan"=>"Japan","Jordan"=>"Jordan","Kazakhstan"=>"Kazakhstan","Kenya"=>"Kenya","Kiribati"=>"Kiribati","KoreaDPR"=>"Korea DPR","KoreaRepublic"=>"Korea Republic","Kuwait"=>"Kuwait","Kyrgyzstan"=>"Kyrgyzstan","Laos"=>"Laos","Latvia"=>"Latvia","Lebanon"=>"Lebanon","Lesotho"=>"Lesotho","Liberia"=>"Liberia","Libya"=>"Libya","Liechtenstein"=>"Liechtenstein","Lithuania"=>"Lithuania","Luxembourg"=>"Luxembourg","Macau"=>"Macau","Macedonia"=>"Macedonia","Madagascar"=>"Madagascar","Malawi"=>"Malawi","Malaysia"=>"Malaysia","Maldives"=>"Maldives","Mali"=>"Mali","Malta"=>"Malta","MarshallIslands"=>"Marshall Islands","Martinique"=>"Martinique","Mauritania"=>"Mauritania","Mauritius"=>"Mauritius","Mexico"=>"Mexico","Micronesia"=>"Micronesia","Moldova"=>"Moldova","Monaco"=>"Monaco","Mongolia"=>"Mongolia","Montserrat"=>"Montserrat","Morocco"=>"Morocco","Mozambique"=>"Mozambique","Myanmar"=>"Myanmar","Namibia"=>"Namibia","Nauru"=>"Nauru","Nepal"=>"Nepal","Netherlands"=>"Netherlands","NetherlandsAntilles"=>"Netherlands Antilles","NewCaledonia"=>"New Caledonia","NewZealand"=>"New Zealand","Nicaragua"=>"Nicaragua","Niger"=>"Niger","Nigeria"=>"Nigeria","Niue"=>"Niue","NorfolkIsland"=>"Norfolk Island","Northern"=>"Northern","MarianaIsland"=>"Mariana Island","Norway"=>"Norway","Oman"=>"Oman","Pakistan"=>"Pakistan","Palau"=>"Palau","PalestinianTerritory"=>"Palestinian Territory","Panama"=>"Panama","PapuaNewGuinea"=>"Papua NewGuinea","Paraguay"=>"Paraguay","Peru"=>"Peru","Philippines"=>"Philippines","Pitcairn"=>"Pitcairn","Poland"=>"Poland","Portugal"=>"Portugal","PuertoRico"=>"Puerto Rico","Qatar"=>"Qatar","R&eacute;union"=>"R&eacute;union","Romania"=>"Romania","RussianFederation"=>"Russian Federation","Rwanda"=>"Rwanda","StHelena"=>"St Helena","StKittsAndNevis"=>"St Kitts and Nevis","StLucia"=>"St Lucia","StPierreMiquelon"=>"St Pierre Miquelon","StVincentGrenadines"=>"St Vincent Grenadines","Samoa"=>"Samoa","SanMarino"=>"San Marino","SaoTomePrincipe"=>"Sao Tome Principe","SaudiArabia"=>"Saudi Arabia","Senegal"=>"Senegal","Seychelles"=>"Seychelles","SierraLeone"=>"Sierra Leone","Singapore"=>"Singapore","Slovakia"=>"Slovakia","Slovenia"=>"Slovenia","SolomonIslands"=>"Solomon Islands","Somalia"=>"Somalia","SouthAfrica"=>"South Africa","Spain"=>"Spain","SriLanka"=>"Sri Lanka","Sudan"=>"Sudan","Suriname"=>"Suriname","Swaziland"=>"Swaziland","Sweden"=>"Sweden","Switzerland"=>"Switzerland","Syria"=>"Syria","TaiwanProvinceOfChina"=>"Taiwan Province of China","Tajikistan"=>"Tajikistan","Tanzania"=>"Tanzania","Thailand"=>"Thailand","Togo"=>"Togo","Tokelau"=>"Tokelau","Tonga"=>"Tonga","TrinidadTobagoTunisia"=>"Trinidad Tobago Tunisia","Turkey"=>"Turkey","Turkmenistan"=>"Turkmenistan","TurksCaicosIslands"=>"Turks Caicos Islands","Tuvalu"=>"Tuvalu","Uganda"=>"Uganda","Ukraine"=>"Ukraine","UnitedArabEmirates"=>"United Arab Emirates","UnitedKingdom"=>"United Kingdom","USA"=>"USA","Uruguay"=>"Uruguay","Uzbekistan"=>"Uzbekistan","Vanuatu"=>"Vanuatu","Venezuela"=>"Venezuela","VietNam"=>"Viet Nam","Virgin"=>"Virgin","IslandsBritish"=>"Islands British","VirginIslands"=>"Virgin Islands","WallisFutunaIslands"=>"Wallis Futuna Islands","WesternSahara"=>"Western Sahara","Yemen"=>"Yemen","Yugoslavia"=>"Yugoslavia","Zambia"=>"Zambia","Zimbabwe"=>"Zimbabwe");
        return $CountryArray;
    }
    //Function create random generate
    public function random_generator($digits){
        srand ((double) microtime() * 10000000);
        //Array of alphabets
        $input = array ("A", "B", "C", "D", "E","F","G","H","I","J","K","L","M","N","O","P","Q",
            "R","S","T","U","V","W","X","Y","Z");
        $random_generator="";// Initialize the string to store random numbers
        for($i=1;$i<$digits+1;$i++){ // Loop the number of times of required digits
            if(rand(1,2) == 1){// to decide the digit should be numeric or alphabet
                // Add one random alphabet
                $rand_index = array_rand($input);
                $random_generator .=$input[$rand_index]; // One char is added
            }else{
                // Add one numeric digit between 1 and 10
                $random_generator .=rand(1,10); // one number is added
            } // end of if else
        } // end of for loop
        return $random_generator;
    }
    //function to get dealer details
    public function dealerdetails($user_type,$user_id){
        $this->load->helper('url');
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('registration_id = ' . "'" . $user_id . "'");
        $this->db->where('usertype = ' . "'" . $user_type . "'");
        $result=$this->db->get();
        if($result->num_rows()>0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    //get details with user id
    public function dealerfulldetails($user_id){
        $this->load->helper('url');
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('registration_id = ' . "'" . $user_id . "'");
        $result=$this->db->get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    public function updated_date_file($dealership_id){
        $this->db->select('creation_date');
        $this->db->from('ftp_feed_details');
        $this->db->where('dealership_id = ' . "'" . $dealership_id . "'");
        $result=$this->db->get();
        if($result -> num_rows() >0){
            $retrieved=$result->row();
            return $retrieved->creation_date;
        }else{
            return FALSE;
        }
    }
    /*Get all dealers under the account manager*/
    public function manager_dealerlist($user_id){
        $this->db->select('*');
        $this->db->from('user_setting');
        $this -> db -> where('user_id',$user_id);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    //function to get all dealer details    
    public function getdealerslisting($user_id){
        $details=$this ->manager_dealerlist($user_id);
        $ij=0;
        if(isset($details)!='' && is_array($details)&& !empty($details)){
            $query="SELECT registration.*,dealership.company_name,dealership.company_phonenumber
                    FROM registration
                    INNER JOIN dealership ON dealership.registration_id = registration.registration_id
                    WHERE usertype='dealership' and (";
            foreach($details as $row){
                if($row!=''){
                    if($ij>0){
                        $query.="or ";
                    }
                    $query.="registration.registration_id= $row[dealers_id] ";
                    $ij++;
                }
            }
            $query.=")";
            $result=$this->db->query($query);
            if($result -> num_rows() >0){
                $retrieved=$result->result_array();
                return $retrieved;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    /*Get all dealers under the account manager*/
    public function account_manager_information($user_id){
        $this->db->select('*');
        $this->db->from('user_setting');
        $this->db->where('dealers_id',$user_id);
        $result=$this->db->get();
        if($result->num_rows()>0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    public function getaccountmanagerdetaild($user_id){
        $details=$this ->account_manager_information($user_id);
        $ij=0;
        if(isset($details)!='' && is_array($details)&& !empty($details)){
            $query="SELECT * FROM registration WHERE usertype='account_managers' and (";
            foreach($details as $row){
                if($row!=''){
                    if($ij>0){
                        $query.=" or ";
                    }
                    $query.="registration_id= $row[user_id]";
                    $ij++;
                }
            }
            $query.=")";
            $result=$this->db->query($query);
            if($result -> num_rows() >0){
                $retrieved=$result->result_array();
                return $retrieved;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    //getting all dealers under a autobrand delaers
    public function getauto_brand_dealers($user_id){
        //get master brand of particular auo_brand user
        $sql=("SELECT registration.*,autobrand.masterbrand
                FROM registration
                INNER JOIN autobrand ON autobrand.registration_id = registration.registration_id
                WHERE registration.status = 'VERIFIED' and
                registration.`usertype` = 'auto_brand' and
                 registration.registration_id='$user_id'
              ");
        $query=$this->db->query($sql);
        $masterbrand_auto_brand_delaers='';
        if($query->num_rows() > 0){
            $returnvalue= $query->result_array();
            foreach($returnvalue as $assigned_dealer_id){
                $masterbrand_auto_brand_delaers=$assigned_dealer_id['masterbrand'];
            }
            if($masterbrand_auto_brand_delaers!=''){
                //get all the dealers under that particular auto brand dealers
                $sql_getquery=("SELECT registration.*,dealership.masterbrand
                                    FROM registration
                                    INNER JOIN dealership ON dealership.registration_id = registration.registration_id
                                WHERE registration.status = 'VERIFIED'
                                and registration.`usertype` = 'dealership'
                                and dealership.masterbrand='$masterbrand_auto_brand_delaers'
                               ");
                $query_result=$this->db->query($sql_getquery);
                if($query_result->num_rows() > 0) {
                    $result= $query_result->result_array();
                }else{
                    $result='FALSE';
                }
            }else{
                $result='FALSE';
            }
        }else{
            $result='FALSE';
        }
        return $result;
    }
    //function to get the usertype
    public function get_usertype($user_id){
        $this->db->select('usertype');
        $this->db->from('registration');
        $this -> db -> where('registration_id',$user_id);
        $result=$this->db->get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            foreach ($result->result() as $row){
                $retrieved=$row->usertype;
            }
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    //function to encrpt and decrypt
    function ProtectData ($DataString,$Method){
        $FinalDataToReturn = '';
        if($Method=='ENCODE'){
            //encrypt data
            $EncryptedData = base64_encode($DataString);
            //split encrypted data
            $EncryptedDataSplit = str_split($EncryptedData);
            //reversed array
            $EncryptedDataReversedArray = array_reverse($EncryptedDataSplit, true);
            foreach ($EncryptedDataReversedArray as $Key=>$Value){
                $FinalDataToReturn .= $Value;
            }
            // encrypt the fina take
            $FinalDataToReturn = base64_encode($FinalDataToReturn);
        }elseif ($Method=='DECODE'){
            // decrypt the final encode
            $DataString = base64_decode($DataString);
            //split encrypted data
            $EncryptedDataSplit = str_split($DataString);
            //reversed array
            $EncryptedDataReversedArray = array_reverse($EncryptedDataSplit, true);
            foreach ($EncryptedDataReversedArray as $Key=>$Value){
                $FinalDataToReturn .= $Value;
            }
            //encrypt data
            $FinalDataToReturn = base64_decode($FinalDataToReturn);
        }
        return $FinalDataToReturn;
    }
    //function to get states in ascending order
    public function getusstates(){
        $this->load->helper('url');
        $this -> db -> select('*');
        $this -> db -> from('states');
        $this->db->order_by("state", "asc");
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    public function getuscities($states){
        $sql_qurey=("SELECT distinct city
                    FROM  cities
                    where  	state='$states'");
        $result=$this->db->query($sql_qurey);
        if($result->num_rows()>0){
            $retrieved=$result->result_array();
            foreach($retrieved as $city_selected){
                echo '<option value="'.$city_selected['city'].'">'.$city_selected['city'].'</option>';
            }
        }else{
            echo '<option value="">No data available</option>';
        }
    }
    public function getuserselectedcity($states,$city){
        $sql_qurey=("SELECT distinct city
        FROM  cities
        where  	state='$states'");
        $result=$this->db->query($sql_qurey);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            echo '<label for="small-label-1" class="label">City</label>';
            echo '<select id="city_select" name="city" class="select" style="text-align: left;" onchange="postcode_display()">';
            foreach($retrieved as $city_selected){
                if($city!=''){
                    if($city_selected['city']==$city){
                        echo '<option value="'.$city_selected['city'].'" selected>'.$city_selected['city'].'</option>';
                    }
                }
                echo '<option value="'.$city_selected['city'].'">'.$city_selected['city'].'</option>';
            }
        }else{
            echo '<option value="">No data available</option>';
        }
        echo '</select>';
    }
    public function Canadian_provinces (){
        $CountryArray = array("alberta"=>"Alberta"," british_columbia"=>"British Columbia","manitoba"=>"Manitoba","new_brunswick"=>"New Brunswick","newfoundland_and_Labrador"=>"Newfoundland and Labrador","nova_scotia"=>"Nova Scotia","northwest_territories"=>"Northwest Territories","nunavut"=>"Nunavut","ontario"=>"Ontario","prince_edward_island"=>"Prince Edward Island","quebec"=>"Quebec","saskatchewan"=>"Saskatchewan","yukon"=>"Yukon");
        return $CountryArray;
    }
    public function makes_models(){
        $sql_make=("SELECT * from manufacturer
        order by make asc");
        $result=$this->db->query($sql_make);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return false;
        }
    }
    //Email function
    function HTMLemail($to, $from, $cc='', $subject='Trial Email', $message='Trial Message'){
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $from . "\r\n";
        $headers .= "CC: ".$cc."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $maildelivery = mail($to, $subject, $message, $headers);
        if ($maildelivery){
            $status = TRUE;
        }else{
            $status = FALSE;
        }
        return $status;
    }
    function get_createrid($loggedinid){
        $this->db->select('created_id');
        $this->db->from('registration');
        $this -> db -> where('registration_id',$loggedinid);
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            foreach ($result->result() as $row){
                $retrieved=$row->created_id;
            }
            return $retrieved;
        }
        else{
            return FALSE;
        }
    }
    function displaycustomerdata(){
        $this->db->select('*');
        $this->db->from(' vehicle_data');
        $result=$this -> db -> get();
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return false;
        }
    }
    //get all the assigned dealers and remaining un assign ed dealers
    public function subadmindisplay($loggedin_id){
        $sql_qurey=("SELECT registration_id
        FROM registration
        WHERE STATUS = 'VERIFIED' and usertype<> 'admin' and `usertype` <>'sub_admin'
        ORDER BY `usertype` = 'auto_brand', `usertype` = 'account_managers', `usertype` = 'dealership' , registration_id desc");
        $query_delaers=$this->db->query($sql_qurey);
        if($query_delaers-> num_rows() > 0){
            $dealers_id_get= $query_delaers->result_array();
            if(isset($dealers_id_get) && $dealers_id_get!=''){
                foreach($dealers_id_get as $assigned_dealer_id){
                    $detaler_detaild[]=$assigned_dealer_id['registration_id'];
                }
            }
        }else{
            $detaler_detaild='';
        }

        $sql=("SELECT registration_id
        FROM registration
        WHERE STATUS = 'VERIFIED' and
        `usertype` = 'sub_admin' and created_id=$loggedin_id");
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
        }
        if(isset($detaler_detaild) && $detaler_detaild!=''){
            $ij=0;

            $sql = "SELECT registration.*,autobrand.`company_name` AS autobrand_company_name,  dealership.`company_name` as dealership_company_name,
               autobrand.`company_phonenumber` AS autobrand_company_phonenumber,  dealership.`company_phonenumber` as dealer_company_phonenumber
              FROM registration
              LEFT JOIN autobrand ON autobrand.registration_id = registration.registration_id
              LEFT JOIN dealership ON dealership.registration_id = registration.registration_id ";

            $sql_query_details= "{$sql}
            WHERE registration.status='VERIFIED'  and (";

            /*$sql_query_details="SELECT *
            FROM  registration where
            status='VERIFIED'  and (";*/
            foreach($detaler_detaild as $alldealersget){
                if($alldealersget!=''){
                    if($ij>0){
                        $sql_query_details.="or ";
                    }
                    $sql_query_details.="registration.registration_id= $alldealersget ";
                    $ij++;
                }
            }
            $sql_query_details.=" )";
            $sql_query_details.="ORDER BY registration.`usertype` = 'sub_admin',registration.`usertype` = 'auto_brand', registration.`usertype` = 'account_managers', registration.`usertype` = 'dealership' , registration.registration_id desc";
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
    //get mining presets
    public function get_lead_mining_presets($event_id){
        $event_id=$this->session->userdata('event_id_get');
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
    public function get_dealer_logo($loggedin_id=''){
        $sql_getquery=("SELECT masterbrand
        FROM  dealership
        INNER JOIN registration on registration.registration_id = dealership.registration_id
        WHERE registration.status = 'VERIFIED'  and dealership.registration_id='$loggedin_id' and (registration.usertype='dealership' or registration.usertype='auto_brand')
        ");
        $query_result=$this->db->query($sql_getquery);
        if($query_result -> num_rows() > 0){
            $result= $query_result->result_array();
            foreach($result as $dealer_id){
                $sql_getquery_logo=("SELECT make_image
                FROM   vehiclemodelyear
                WHERE make = '$dealer_id[masterbrand]' order by id limit 1
                ");
                $query_result_logo=$this->db->query($sql_getquery_logo);
                if($query_result_logo -> num_rows() > 0){
                    $result_logo= $query_result_logo->result_array();
                    return $result_logo;
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
    }
    public function user_info_by_id($user_id){
        $this->db->select('*');
        $this->db->from('registration');
        $this -> db -> where('registration_id',$user_id);
        $query = $this->db->get();
        $result=$query->row();
        return $result;
    }
    /*function to get customer data*/
    public function customerDataJson($user_id,$iTotal){
        $columns = $this->session->userdata('customer_columns');
        $operators = $this->session->userdata('customer_operators');
        $values = $this->session->userdata('customer_values');

        $iDisplayStart = $this->input->get_post('iDisplayStart', true);

        $iDisplayLength = $this->input->get_post('iDisplayLength', true);

        if($iDisplayStart == 0){
            $pager = 0;
        }else{
            $pager = ceil($iDisplayStart/$iDisplayLength);
        }
        if($iDisplayLength == '25'){
            $iDisplayLength = '10';
            $_POST['iDisplayLength'] = '10';
        }else if($iDisplayLength == '55'){
            $iDisplayLength = '25';
            $_POST['iDisplayLength'] = '25';
        }else if($iDisplayLength == '125'){
            $iDisplayLength = '50';
            $_POST['iDisplayLength'] = '50';
        }else if($iDisplayLength == '625'){
            $iDisplayLength = '100';
            $_POST['iDisplayLength'] = '100';
        }else if($iDisplayLength == '3125'){
            $iDisplayLength = '500';
            $_POST['iDisplayLength'] = '500';
        }else if($iDisplayLength == '15625'){
            $iDisplayLength = '1000';
            $_POST['iDisplayLength'] = '1000';
        }
        $iDisplayStart = $iDisplayLength*$pager;
        $_POST['iDisplayStart'] = $iDisplayStart;

        $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('sSearch', true);
        $sEcho = $this->input->get_post('sEcho', true);
        $aColumns = array('buyer_first_name', 'buyer_address', 'buyer_appartment', 'buyer_city', 'buyer_province', 'buyer_postalcode', 'buyer_homephone', 'buyer_cellphone', 'first_payment_date', 'sold_vehicle_year', 'sold_vehicle_make', 'sold_vehicle_model', 'bodydescription', 'sold_vehicle_VIN', 'vehiclecategory', 'enginefueltype', 'littercombined', 'drivenwheels', 'transmissiontype', 'monthly_payment', 'contract_term', 'total_finance_amount','apr', 'tradeinvalue');

//        $this->load->helper('url');
        $aaColumns = $aColumns;
        $aaColumns[] = 'buyer_last_name';
        // Paging

//        $this -> db -> from('eps_data');
//        
        $this -> db -> where('dealership_id', $user_id);
        if(isset($iDisplayStart) && $iDisplayLength != '-1')
        {
            $this->db->limit($this->db->escape_str($iDisplayLength), $this->db->escape_str($iDisplayStart));
        }

        // Ordering
        if(isset($iSortCol_0))
        {
            for($i=0; $i<intval($iSortingCols); $i++)
            {
                $iSortCol = $this->input->get_post('iSortCol_'.$i, true);
                $bSortable = $this->input->get_post('bSortable_'.intval($iSortCol), true);
                $sSortDir = $this->input->get_post('sSortDir_'.$i, true);

                if($bSortable == 'true')
                {
                    $this->db->order_by($aColumns[intval($this->db->escape_str($iSortCol))], $this->db->escape_str($sSortDir));
                }
            }
        }
        /* 
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        if(isset($sSearch) && !empty($sSearch))
        {
            $or_string = '( ';
            for($i=0; $i<count($aColumns); $i++)
            {
                $bSearchable = $this->input->get_post('bSearchable_'.$i, true);

                // Individual column filtering
                if(isset($bSearchable) && $bSearchable == 'true')
                {
                    if($i == 0){
                        $or_string .= $aColumns[$i]. " LIKE '%".$this->db->escape_like_str($sSearch)."%' ";
                    }else{
                        $or_string .= " OR ".$aColumns[$i]. " LIKE '%".$this->db->escape_like_str($sSearch)."%' ";
                    }
                    // $this->db->or_like($aColumns[$i], $this->db->escape_like_str($sSearch));
                }
            }
            $or_string .= ')';
            $this->db->where($or_string);
        }

        if( isset($columns ) ) {
            //unset old items
            $this->session->unset_userdata('searchItems');
            //phpinfo();
            $counter = 1;
            $searchItems = array();
            for( $i=0; $i<count($columns); $i++) {
                if($operators[$i] == ''){

                }else{
                    if($operators[$i] == 'like'){
                        $this->db->or_like($columns[$i],$values[$i],'both');
                    }else if($operators[$i] == 'nlike'){
                        $this->db->not_like($columns[$i],$values[$i]);
                    }else{
                        $this->db->where($columns[$i]." ".$operators[$i], $values[$i]);
                    }
                }
            }
        }
        $this->db->group_by('id');

        // Select Data
        $this->db->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aaColumns)), false);
        $rResult=$this->db->get('eps_data');
        // Data set length after filtering
        $this->db->select('FOUND_ROWS() AS found_rows');
        $iFilteredTotal = $this->db->get()->row()->found_rows;

        // Total data set length
        $iTotals = $this->db->count_all('eps_data');

        if($rResult->num_rows() >0){

            $this->session->set_userdata('iTotal',$iTotal);
            $this->session->set_userdata('iFilteredTotal',$iFilteredTotal);
            $this->session->set_userdata('iDisplayStart',$iDisplayStart+1);
            $this->session->set_userdata('iDisplayLength',$iDisplayStart+$iDisplayLength);

            $output = array(
                "sEcho" => intval($sEcho),
                "iTotalRecords" => $iTotal,
                'iDisplayStart' => $iDisplayStart,
                'iDisplayLength' => $iDisplayLength,
                'iTotalDisplayRecords' => $iFilteredTotal,
                'aaData' => array()
            );
            $retrieved=$rResult->result_array();
            $user_details_arr = array();
            if(isset($retrieved) && is_array($retrieved)){
                $i=0;
                $account_manger_count=1;
                $sub_admin_det=1;
                foreach($retrieved as $value){
                    if($value['buyer_first_name']!='')
                    {
                        $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']))." ".ucfirst(strtolower($value['buyer_last_name']));
                    }
                    else
                    {
                        $buyer_first_name='N/A';
                    }
                    if($value['buyer_city']!='')
                    {
                        $buyer_city=ucfirst(strtolower($value['buyer_city']));
                    }
                    else
                    {
                        $buyer_city='N/A';
                    }
                    if($value['buyer_postalcode']!='')
                    {
                        $buyer_postalcode 	=$value['buyer_postalcode'];
                    }
                    else
                    {
                        $buyer_postalcode='N/A';
                    }
                    if($value['first_payment_date'] == 0){
                        $first_payment_date = 'N/A';
                    }else{
                        $first_payment_date = date('Y-m-d',$value['first_payment_date']);
                    }
                    $user_details_arr = array();
                    $user_details_arr[] = $buyer_first_name;
                    $user_details_arr[] = $value['buyer_address'];
                    $user_details_arr[] = $value['buyer_appartment'];
                    $user_details_arr[] = $buyer_city;
                    $user_details_arr[] = $value['buyer_province'];
                    $user_details_arr[] = $buyer_postalcode;
                    $user_details_arr[] = $value['buyer_homephone'];
                    $user_details_arr[] = $value['buyer_cellphone'];
                    $user_details_arr[] = $first_payment_date;
                    $user_details_arr[] = $value['sold_vehicle_year'];
                    $user_details_arr[] = $value['sold_vehicle_make'];
                    $user_details_arr[] = $value['sold_vehicle_model'];
                    $user_details_arr[] = $value['bodydescription'];
                    $user_details_arr[] = $value['sold_vehicle_VIN'];
                    $user_details_arr[] = $value['vehiclecategory'];
                    $user_details_arr[] = $value['enginefueltype'];
                    $user_details_arr[] = $value['littercombined'];
                    $user_details_arr[] = $value['drivenwheels'];
                    $user_details_arr[] = $value['transmissiontype'];
                    $user_details_arr[] = $value['monthly_payment'];
                    $user_details_arr[] = $value['contract_term'];
                    $user_details_arr[] = $value['total_finance_amount'];
                    $user_details_arr[] = $value['apr'];
                    $user_details_arr[] = $value['tradeinvalue'];
                    $output['aaData'][] = $user_details_arr;
                    $i++;
                }
            }
            return json_encode($output);
        }
        else{
            return FALSE;
        }
    }
    public function customerdata($user_id){
        $this->load->helper('url');
        $this -> db -> select('*');
        $this -> db -> from('eps_data');

        if( isset( $_POST['columns'] ) ) {
        }else{
            $this -> db -> limit('2000');
        }

        $this -> db -> limit('10');
        $this -> db -> where('dealership_id', $user_id);
        if( isset( $_POST['columns'] ) ) {
            //unset old items
            $this->session->unset_userdata('searchItems');
            //phpinfo();
            $counter = 1;
            $searchItems = array();
            for( $i=0; $i<count($_POST['columns']); $i++) {
                if($_POST['operators'][$i] == ''){

                }else{
                    if($_POST['operators'][$i] == 'like'){
                        $this->db->or_like($_POST['columns'][$i],$_POST['values'][$i],'both');
                    }else if($_POST['operators'][$i] == 'nlike'){
                        $this->db->not_like($_POST['columns'][$i],$_POST['values'][$i]);
                    }else{
                        $this->db->where($_POST['columns'][$i]." ".$_POST['operators'][$i], $_POST['values'][$i]);
                    }
                }
            }
        }
        $result=$this->db->get();
        if($result->num_rows() >0){
            $retrieved=$result->result_array();
            $user_details_arr = array();
            if(isset($retrieved) && is_array($retrieved)){
                $i=0;
                $account_manger_count=1;
                $sub_admin_det=1;
                foreach($retrieved as $value){
                    if($value['buyer_first_name']!='')
                    {
                        $buyer_first_name=ucfirst(strtolower($value['buyer_first_name']))." ".ucfirst(strtolower($value['buyer_last_name']));
                    }
                    else
                    {
                        $buyer_first_name='N/A';
                    }
                    if($value['buyer_email']!='')
                    {
                        $buyer_email=$value['buyer_email'];
                    }
                    else
                    {
                        $buyer_email='N/A';
                    }
                    if($value['buyer_city']!='')
                    {
                        $buyer_city=ucfirst(strtolower($value['buyer_city']));
                    }
                    else
                    {
                        $buyer_city='N/A';
                    }
                    if($value['buyer_postalcode']!='')
                    {
                        $buyer_postalcode 	=$value['buyer_postalcode'];
                    }
                    else
                    {
                        $buyer_postalcode='N/A';
                    }
                    if($value['new_used']=='U')
                    {
                        $new_used='Used';
                    }
                    else
                    {
                        $new_used='New';

                    }
                    if($value['first_payment_date'] == 0){
                        $first_payment_date = 'N/A';
                    }else{
                        $first_payment_date = date('Y-m-d',$value['first_payment_date']);
                    }
                    $user_details_arr[$i]['name'] = $buyer_first_name;
                    $user_details_arr[$i]['buyer_address'] = $value['buyer_address'];
                    $user_details_arr[$i]['buyer_appartment'] = $value['buyer_appartment'];
                    $user_details_arr[$i]['buyer_city'] = $buyer_city;
                    $user_details_arr[$i]['buyer_province'] = $value['buyer_province'];
                    $user_details_arr[$i]['buyer_postalcode'] = $buyer_postalcode;
                    $user_details_arr[$i]['buyer_homephone'] = $value['buyer_homephone'];
                    $user_details_arr[$i]['buyer_cellphone'] = $value['buyer_cellphone'];
                    $user_details_arr[$i]['first_payment_date'] = $first_payment_date;
                    $user_details_arr[$i]['sold_vehicle_year'] = $value['sold_vehicle_year'];
                    $user_details_arr[$i]['sold_vehicle_make'] = $value['sold_vehicle_make'];
                    $user_details_arr[$i]['sold_vehicle_model'] = $value['sold_vehicle_model'];
                    $user_details_arr[$i]['bodydescription'] = $value['bodydescription'];
                    $user_details_arr[$i]['littercombined'] = $value['littercombined'];
                    $user_details_arr[$i]['sold_vehicle_VIN'] = $value['sold_vehicle_VIN'];
                    $user_details_arr[$i]['vehiclecategory'] = $value['vehiclecategory'];
                    $user_details_arr[$i]['enginefueltype'] = $value['enginefueltype'];
                    $user_details_arr[$i]['drivenwheels'] = $value['drivenwheels'];
                    $user_details_arr[$i]['transmissiontype'] = $value['transmissiontype'];
                    $user_details_arr[$i]['monthly_payment'] = $value['monthly_payment'];
                    $user_details_arr[$i]['contract_term'] = $value['contract_term'];
                    $user_details_arr[$i]['total_finance_amount'] = $value['total_finance_amount'];
                    $user_details_arr[$i]['apr'] = $value['apr'];
                    $user_details_arr[$i]['tradeinvalue'] = $value['tradeinvalue'];
                    $i++;
                }
            }
            return $user_details_arr;
        }
        else{
            return FALSE;
        }
    }
    public function countCustomerData($dealership_id){
        $this->load->helper('url');
        $this -> db -> select('count(*) AS totalCustomer');
        $this -> db -> from('eps_data');
        $this -> db -> where('dealership_id', $dealership_id);

        $result=$this->db->get();
        if($result->num_rows() >0){
            $row = $result->row();
            return $row->totalCustomer;
        }
    }
    /*function to get customer full details*/
    public function customerdatafulldetails($dataid){
        $sql_getquery_logo=("SELECT *
        FROM    eps_data
        WHERE 	id 	= '$dataid' order by id limit 1
        ");
        $result=$this->db->query($sql_getquery_logo);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    /* to get dealer company name*/
    public function dealercompanynameget($dealer_id){
        $sql_getquery_logo=("SELECT company_name
        FROM     registration
        WHERE 	registration_id 	= '$dealer_id' order by registration_id limit 1
        ");
        $result=$this->db->query($sql_getquery_logo);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
    }
    public function password_update($user_id){
        $password_get=$this->input->post('password');
        $password=$this ->ProtectData($password_get,'ENCODE');
        $this -> db -> set('password', $password);
        $this->db->where('registration_id',$user_id);
        $this->db->update('registration');
    }
    public function customerdatalist($user_id,$startlimit,$endlimit,$leadlist_id) {
        $sql_get_query=("SELECT *
        FROM    pbs_customer_data
        WHERE 	dealership_id 	= '$user_id' order by id asc limit $startlimit,$endlimit
        ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
        return FALSE;
    }
    public function customerdatalist_equityscrap($user_id,$startlimit,$endlimit,$leadlist_id,$event_id) {
        $sql_date_range=("Select past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from  epsadvantage_campaign where event_id=$event_id");
        $query_date_range=$this->db->query($sql_date_range);
        if($query_date_range -> num_rows() > 0){
            $returnvalue_get_date_range=$query_date_range->result_array();
            foreach($returnvalue_get_date_range as $purchase_date_range){
                $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];
                $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];
            }
        }
        $date=strtotime(date('m/d/y'));
        $new_purchase_to_range = ($purchase_date_range_to)*12;
        $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date) ;
        $new_purchase_from_range =$purchase_date_range_from;
        $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date  ) ;
        $sql_get_query=("SELECT *
        FROM    eps_data
        WHERE 	dealership_id 	= '$user_id' AND 
        first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND $newdate_purchase_range_from_date_compare
        order by id asc limit $startlimit,$endlimit
        ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $retrieved=$result->result_array();
            return $retrieved;
        }else{
            return FALSE;
        }
        return FALSE;
    }
    public function delete_eventcampign($event_id){
        $query = $this->db->where('event_id',$event_id);
        $query = $this->db->delete('events');
        $query = $this->db->where('event_id',$event_id);
        $query = $this->db->delete('epsadvantage_campaign');
        $query = $this->db->where('event_id',$event_id);
        $query = $this->db->delete('select_customer_leadlist');
        $query = $this->db->where('event_id',$event_id);
        $query = $this->db->delete('select_mailer_options');
    }
    /*
       public function customerdatalist_model_breakdown($user_id,$startlimit,$endlimit,$vehicletype,$pastdate_to,$pastdate_from) {
   	if($vehicletype!='') {
    $sql_get_query=("SELECT * FROM pbs_vehicledata_data as vd,pbs_customer_data as cd ,pbs_financial_data as fd WHERE
   	(vd.customer_id=cd.id) and
    cd.dealership_id=$user_id and 
    (fd.contract_date BETWEEN '$pastdate_to' AND '$pastdate_from') and 
	vd.vehicletype = '$vehicletype' GROUP BY cd.id limit $startlimit,$endlimit");
	}else{
 	$sql_get_query=("SELECT * FROM pbs_vehicledata_data as vd,pbs_customer_data as cd ,pbs_financial_data as fd WHERE
	(vd.customer_id=cd.id) and
	dealership_id=$user_id and
	(vd.vehicletype != 'Car' or
	vd.vehicletype != 'SUV' or
	vd.vehicletype != 'Truck' or
	vd.vehicletype != 'Van') and
    (fd.contract_date BETWEEN '$pastdate_to' AND '$pastdate_from') GROUP BY cd.id limit $startlimit,$endlimit");
	}
    $result=$this->db->query($sql_get_query);
    if($result -> num_rows() >0){
    /*$retrieved=$result->result_array();
    $ij=0;
    $sql=("select * from  pbs_customer_data where(");
    foreach($retrieved as $values){
    if($values!=''){
     if($ij>0){
                $sql.="or ";
             }
                $sql.="(id=$values[customer_id])";
                $ij++;
    }
    }
    $sql.=")";
        $quer = $this->db->query($sql);
        $returnvalue_get= $quer->result_array();
		$returnvalue_get=$result->result_array();
    }
    else{
    $returnvalue_get='';
        }
        return $returnvalue_get;
    }
*/
    public function customerdatalist_model_breakdown($user_id,$startlimit,$endlimit,$vehicletype,$group_id,$event_id) {
        $returnvalue_get='';
        $condition='';
        //getting purchase to and from range
        $sql_date_range=("Select max_invites,past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from  epsadvantage_campaign where event_id=$event_id");
        $query_date_range=$this->db->query($sql_date_range);
        if($query_date_range -> num_rows() > 0){
            $returnvalue_get_date_range=$query_date_range->result_array();
            foreach($returnvalue_get_date_range as $purchase_date_range){
                $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];
                $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];
                $max_invites=$purchase_date_range['max_invites'];
            }
        }
//        $date=strtotime(date('m/d/y'));
//        $new_purchase_to_range = ($purchase_date_range_to)*12;
//        $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date ) ;   
//        $new_purchase_from_range =$purchase_date_range_from;
//        $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date  ) ; 

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
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }

        if($group_id!=''){
            $condition.="id  NOT IN ($group_id) AND ";
        }

        if($vehicletype!='') {
            $condition.='(';
            $condition.='(';
            if($vehicletype=='Car'){
                $condition.="(vehicletype='Car' AND market NOT LIKE 'crossover%') ";
            }else if($vehicletype=='SUVS'){
                $condition.="((vehicletype='SUV' AND market NOT LIKE 'crossover%')OR (market LIKE 'crossover%'))";
            }else if($vehicletype=='Trucks'){
                $condition.="vehicletype='Truck'";
            }else if($vehicletype=='Vans'){
                $condition.="(vehicletype='Van' OR vehicletype='Minivan')";
            }else{
                $condition.="";
            }
            $condition.=')';
            $condition.=" AND dealership_id='$user_id' AND 
            (first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare)" ;
            $condition.=')';
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition  
            order by id ASC ".$limit);
        }else{
            $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition (
            (vehicletype!='Car' and 
            vehicletype!='Green Cars' and
            vehicletype != 'SUV' and
            market NOT LIKE 'crossover%' and
            vehicletype != 'Truck' and
            vehicletype != 'Van' and 
            vehicletype != 'Minivan'
            ) AND  (dealership_id='$user_id') AND (first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare))
            order by id ASC ".$limit);
        }
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            /*$retrieved=$result->result_array();
            $ij=0;
            $sql=("select * from  pbs_customer_data where(");
            foreach($retrieved as $values){
            if($values!=''){
             if($ij>0){
                        $sql.="or ";
                     }
                        $sql.="(id=$values[customer_id])";
                        $ij++;
            }
            }
            $sql.=")";
            $quer = $this->db->query($sql);
            $returnvalue_get= $quer->result_array();
    		*/
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    //getting drive type
    public function customerdatalist_drive_type($user_id,$startlimit,$endlimit,$vehicletype,$group_id,$event_id) {
        $returnvalue_get='';
        $condition='';
        //getting purchase to and from range
        $sql_date_range=("Select max_invites,past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from  epsadvantage_campaign where event_id=$event_id");
        $query_date_range=$this->db->query($sql_date_range);
        if($query_date_range -> num_rows() > 0){
            $returnvalue_get_date_range=$query_date_range->result_array();
            foreach($returnvalue_get_date_range as $purchase_date_range){
                $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];
                $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];
                $max_invites=$purchase_date_range['max_invites'];
            }
        }
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
        if($group_id!=''){
            $condition.="id  NOT IN ($group_id) AND ";
        }
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
        if($vehicletype!='') {
            $condition.='(';
            if($vehicletype=='fwd'){
                //the drive type is  Front Wheel Drive
                $condition.="drivenwheels='FWD' AND " ;
            }else if($vehicletype=='rwd'){
                //the drive type is  Rear Wheel Drive
                $condition.="drivenwheels='RWD' AND " ;
            }else if($vehicletype=='awd'){
                //the drive type is  All Wheel Drive
                $condition.="drivenwheels='AWD' AND " ;
            }elseif($vehicletype=='4x4'){
                //the drive type is  Four Wheel Drive
                $condition.="drivenwheels='4x4' AND " ;
            }else{
                //the drive type is  Unavailable
                $condition.="drivenwheels='Unavailable' AND " ;
            }
            //generating query for drive type

            $condition.=" dealership_id=$user_id  AND 
            (first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare)" ;
            $condition.=')';
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition  
            order by id ASC ".$limit);
        }else{
            $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition (
            (drivenwheels!='FWD' and 
            drivenwheels!='RWD' and
            drivenwheels != 'AWD' and
            drivenwheels !='4x4'
            
            ) AND  (dealership_id='$user_id') AND (first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare))
            order by id ASC ".$limit);
        }
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            /*$retrieved=$result->result_array();
            $ij=0;
            $sql=("select * from  pbs_customer_data where(");
            foreach($retrieved as $values){
            if($values!=''){
             if($ij>0){
                        $sql.="or ";
                     }
                        $sql.="(id=$values[customer_id])";
                        $ij++;
            }
            }
            $sql.=")";
            $quer = $this->db->query($sql);
            $returnvalue_get= $quer->result_array();
    		*/
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    public function customerdatalist_model_breakdown_mine_data($user_id,$startlimit,$endlimit,$vehicletype,$group_id) {
        $returnvalue_get='';
        $condition='';
        if($group_id!=''){
            $condition.="id  NOT IN ($group_id) AND ";
            //if vehicle type not null
        }if($vehicletype!=''){
            $condition.='(';
            $condition.='(';
            if($vehicletype=='Car'){
                $condition.="(vehicletype='Car')";
            }else if($vehicletype=='SUVS'){
                $condition.="(vehicletype='SUV' OR market LIKE 'crossover%')";
            }else if($vehicletype=='Trucks'){
                $condition.="vehicletype='Truck'";
            }else if($vehicletype=='Vans'){
                $condition.="(vehicletype='Van'  OR vehicletype='Minivan')";
            }
            $condition.=')';
            $condition.=" AND dealership_id='$user_id'" ;
            $condition.=')';
            $sql_get_query=("SELECT  * FROM eps_data  WHERE
            $condition  
            order by id ASC ");
        }else{
            $sql_get_query=("SELECT  * FROM eps_data  WHERE $condition (
            (vehicletype!='Car' and 
            vehicletype!='Car' and 
            vehicletype!='Car' and 
            vehicletype!='Green Cars' and
            vehicletype != 'SUV' and
            market NOT LIKE 'crossover%' and
            vehicletype != 'Truck' and
            vehicletype != 'Van' and 
            vehicletype != 'Minivan') AND (dealership_id='$user_id'))
            order by id ASC ");
        }
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            /*$retrieved=$result->result_array();
            $ij=0;
            $sql=("select * from  pbs_customer_data where(");
            foreach($retrieved as $values){
            if($values!=''){
            if($ij>0){
            $sql.="or ";
            }
            $sql.="(id=$values[customer_id])";
            $ij++;
            }
            }
            $sql.=")";
            $quer = $this->db->query($sql);
            $returnvalue_get= $quer->result_array();
            */
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    /*get campign purchased dates*/
    function get_campaine_purchased_dates($event_id){
        $event_id=$this->session->userdata('event_id_get');
        $sql=("Select  max_invites,past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from epsadvantage_campaign where event_id=$event_id");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            $return=$returnvalue;
        }else{
            $return='';
        }
        return $return;
    }
    //fuel type
    public function customerdatalist_fuel_type($user_id,$startlimit,$endlimit,$vehicletype,$group,$leadlist_id,$event_id) {
        //getting purchase to and from range
        $sql_date_range=("Select max_invites,past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from  epsadvantage_campaign where event_id=$event_id");
        $query_date_range=$this->db->query($sql_date_range);
        if($query_date_range -> num_rows() > 0){
            $returnvalue_get_date_range=$query_date_range->result_array();
            foreach($returnvalue_get_date_range as $purchase_date_range){
                $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];
                $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];
                $max_invites=$purchase_date_range['max_invites'];
            }
        }
//        $date=strtotime(date('m/d/y'));;
//        $new_purchase_to_range = ($purchase_date_range_to)*12;
//        $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date ) ;   
//        $new_purchase_from_range =$purchase_date_range_from;
//        $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date  ) ;
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
//        if($group_id!=''){
//            $condition.="id  NOT IN ($group_id) AND ";  
//        } 
        if($max_invites > 0){
            $limit = 'Limit '.$max_invites;
        }
        $condition='';
        if($leadlist_id!=''){
            $condition.="id  NOT IN ($leadlist_id) AND ";
        }
        $condition.='(';
        $condition.='(';
        if($group=='1'){
            //Group 1 - High Efficiency Cars (vehicleType = 'Car' AND l/100kmCombined =1 to 8)
            $condition.="lper100kmcombined BETWEEN 1 AND 8 AND 
            vehicletype='Car' AND market NOT LIKE 'crossover%'";
        }else if($group=='2'){
            //Group 2 - Low efficiency Cars (vehicleType = 'Car' AND l/100kmCombined =8.001 to 100)
            $condition.="lper100kmcombined BETWEEN 8.001 AND 100 
            AND vehicletype='Car' AND 
            market NOT LIKE 'crossover%'";
        }else if($group=='3'){
            //Group 3 - High Efficincy SUV, Vans & Crossovers ((vehicleType = 'SUV' OR 'Van') AND l/100kmCombined =1 to 11.5)
            $condition.="lper100kmcombined BETWEEN 1 AND 11.5 AND 
            ((vehicletype='SUV' AND market NOT LIKE 'crossover%') 
            OR vehicletype='Crossovers' OR 
            vehicletype='Minivan' OR vehicletype='Van')";
        }else if($group=='4'){
            //Group 4 - Low Efficiency SUV, Vans, Crossovers ((vehicleType = 'SUV' OR 'Van') AND l/100kmCombined =11.51 to 100)
            $condition.="lper100kmcombined BETWEEN 11.51 AND 100 AND 
            ((vehicletype='SUV' AND market NOT LIKE 'crossover%') 
            OR vehicletype='Crossovers' OR 
            vehicletype='Minivan' OR vehicletype='Van')";
        }else if($group=='5'){
            //Group 5 - High Efficiency Trucks (vehicleType = 'truck' AND l/100kmCombined = 1 to 13.5)
            $condition.="lper100kmcombined BETWEEN 1 AND 13.5 AND vehicletype='Truck'";
        }else if($group=='6'){
            //Group 6 - Low Efficiency Trucks (vehicleType = 'truck' AND l/100kmCombined = 13.51 to 100)
            $condition.="lper100kmcombined BETWEEN 13.51 AND 100 AND vehicletype='Truck'";
        }
        $condition.=')';
        $condition.=" AND dealership_id='$user_id' AND 
        (first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare 
            OR 
            contract_date BETWEEN $newdate_purchase_range_to_date_compare AND 
            $newdate_purchase_range_from_date_compare)" ;
        $condition.=')';
        $sql_get_query=("SELECT  * FROM eps_data  WHERE
        $condition
        order by id ASC ".$limit);
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    //fuel type for mine data
    public function customerdatalist_fuel_type_mine_data($user_id,$startlimit,$endlimit,$vehicletype,$group,$leadlist_id) {
        $condition='';
        if($leadlist_id!=''){
            $condition.="id  NOT IN ($leadlist_id) AND ";
        }
        $condition.='(';
        $condition.='(';
        if($group=='1'){
            //Group 1 - High Efficiency Cars (vehicleType = 'Car' AND l/100kmCombined =1 to 8)
            $condition.="lper100kmcombined BETWEEN 1 AND 8 AND 
            vehicletype='Car' AND market NOT LIKE 'crossover%'";
        }else if($group=='2'){
            //Group 2 - Low efficiency Cars (vehicleType = 'Car' AND l/100kmCombined =8.001 to 100)
            $condition.="lper100kmcombined BETWEEN 8.001 AND 100 
            AND vehicletype='Car' AND 
            market NOT LIKE 'crossover%'";
        }else if($group=='3'){
            //Group 3 - High Efficincy SUV, Vans & Crossovers ((vehicleType = 'SUV' OR 'Van') AND l/100kmCombined =1 to 11.5)
            $condition.="lper100kmcombined BETWEEN 1 AND 11.5 AND 
            ((vehicletype='SUV' AND market NOT LIKE 'crossover%') 
            OR vehicletype='Crossovers' OR 
            vehicletype='Minivan' OR vehicletype='Van')";
        }else if($group=='4'){
            //Group 4 - Low Efficiency SUV, Vans, Crossovers ((vehicleType = 'SUV' OR 'Van') AND l/100kmCombined =11.51 to 100)
            $condition.="lper100kmcombined BETWEEN 11.51 AND 100 AND 
            ((vehicletype='SUV' AND market NOT LIKE 'crossover%') 
            OR vehicletype='Crossovers' OR 
            vehicletype='Minivan' OR vehicletype='Van')";
        }else if($group=='5'){
            //Group 5 - High Efficiency Trucks (vehicleType = 'truck' AND l/100kmCombined = 1 to 13.5)
            $condition.="lper100kmcombined BETWEEN 1 AND 13.5 AND vehicletype='Truck'";
        } else if($group=='6'){
            //Group 6 - Low Efficiency Trucks (vehicleType = 'truck' AND l/100kmCombined = 13.51 to 100)
            $condition.="lper100kmcombined BETWEEN 13.51 AND 100 AND vehicletype='Truck'";
        }
        $condition.=')';
        $condition.=" AND dealership_id='$user_id'" ;
        $condition.=')';
        $sql_get_query=("SELECT  * FROM eps_data  WHERE
        $condition
        order by id ASC");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    /*function to get warrant scrap details*/
    public function warrant_scarp($event_id,$user_id,$startlimit,$endlimit,$group,$group_id){
        $result_get_array=array();
        $return_result='';
        if($user_id!='198'){
            $condition='';
            $id_get='';
            $purchase_date_range_from='';
            $purchase_date_range_to='';
            //getting purchase to and from range
            $sql_date_range=("Select max_invites,past_vehicle_purchase_date_from_range,past_vehicle_purchase_date_to_range from  epsadvantage_campaign where event_id=$event_id");
            $query_date_range=$this->db->query($sql_date_range);
            if($query_date_range -> num_rows() > 0){
                $returnvalue_get_date_range=$query_date_range->result_array();
                foreach($returnvalue_get_date_range as $purchase_date_range){
                    $purchase_date_range_from=$purchase_date_range['past_vehicle_purchase_date_from_range'];
                    $purchase_date_range_to=$purchase_date_range['past_vehicle_purchase_date_to_range'];
                    $max_invites=$purchase_date_range['max_invites'];
                }
            }
//            $date=strtotime(date('m/d/y'));
//            $new_purchase_to_range = ($purchase_date_range_to)*12;
//            $newdate_purchase_range_to_date_compare = strtotime ( '-'.$new_purchase_to_range.' month' , $date ) ;   
//            $new_purchase_from_range =$purchase_date_range_from;
//            $newdate_purchase_range_from_date_compare = strtotime ( '-'.$new_purchase_from_range.' month' , $date  ) ; 
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
            if($max_invites > 0){
                $limit = 'Limit '.$max_invites;
            }
            $sql=("Select  event_start_date from events where event_id=$event_id");
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0){
                $returnvalue_get=$query->result_array();
                foreach($returnvalue_get as $event_date){
                    $event_date_select=$event_date['event_start_date'];
                }
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";
                }
                $query_financial=("SELECT id,first_payment_date,sold_vehicle_make from  eps_data where $condition (dealership_id='$user_id'
                AND (
                first_payment_date BETWEEN $newdate_purchase_range_to_date_compare AND $newdate_purchase_range_from_date_compare 
                OR 
                contract_date BETWEEN $newdate_purchase_range_to_date_compare AND $newdate_purchase_range_from_date_compare
                )) 
               	");
                $sql_get_query=$this->db->query($query_financial);
                if($sql_get_query -> num_rows() > 0){
                    $returnvalue_customer_data=$sql_get_query->result_array();
                    foreach($returnvalue_customer_data as $values_customer_data) {
                        $sql_warranty_query=("SELECT  * FROM warranty_manufacture  WHERE
                        manufacturer='$values_customer_data[sold_vehicle_make]'
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
                        $purcahse_date=strtotime($values_customer_data['first_payment_date']);
                        $difference = $event_date_select - $purcahse_date;
                        $months = floor($difference / 86400 / 30 );
                        $customer_id_get=$values_customer_data['id'];
                        if($months>0){
                            if($group==1){
                                if($powertrain_months!=''){
                                    if($months>$powertrain_months){
                                        $id_get[]= $customer_id_get;
                                        //echo $months.'-'.$values_customer_data['sold_vehicle_make'].'-'.$powertrain_months."<br />";
                                    }
                                }
                            }
                            if($group==2){
                                if($powertrain_months!=''){
                                    if($months>($powertrain_months-6)){
                                        $id_get[]= $customer_id_get;
                                    }
                                }
                            }
                            if($group==3){
                                if($basic_months!=''){
                                    if($months>($basic_months)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                            if($group==4){
                                if($basic_months!=''){
                                    if($months<($basic_months-6)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                            if($group==5){
                                if($basic_months!=''){
                                    if($months>($basic_months-6)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                        }
                    }
                    $ij=0;
                    $sql_warranty='';
                    if(!empty($id_get)){
                        $sql_warranty=("select * from  eps_data where dealership_id='$user_id' ");
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
                        $sql_warranty.=")".$limit;
                        $query_warranty = $this->db->query($sql_warranty);
                        $return_result= $query_warranty->result_array();
                    }
                    else{
                        $return_result='';
                    }
                }
            }
        }
        return $return_result;
    }
    public function warrant_scarp_mine_data($event_id,$user_id,$startlimit,$endlimit,$group,$group_id){
        $result_get_array=array();
        $return_result='';
        if($user_id!='198'){
            $condition='';
            $id_get='';
            $sql=("Select  event_start_date from events where event_id=$event_id");
            $query=$this->db->query($sql);
            if($query -> num_rows() > 0){
                $returnvalue_get=$query->result_array();
                foreach($returnvalue_get as $event_date){
                    $event_date_select=$event_date['event_start_date'];
                }
                if($group_id!=''){
                    $condition.="id  NOT IN ($group_id) AND ";
                }
                $query_financial=("SELECT id,first_payment_date,sold_vehicle_make from  eps_data where $condition (dealership_id='$user_id') 
                ");
                $sql_get_query=$this->db->query($query_financial);
                if($sql_get_query -> num_rows() > 0){
                    $returnvalue_customer_data=$sql_get_query->result_array();
                    foreach($returnvalue_customer_data as $values_customer_data) {
                        $sql_warranty_query=("SELECT  * FROM warranty_manufacture  WHERE
                        manufacturer='$values_customer_data[sold_vehicle_make]'
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
                        $purcahse_date=strtotime($values_customer_data['first_payment_date']);
                        $difference = $event_date_select - $purcahse_date;
                        $months = floor($difference / 86400 / 30 );
                        $customer_id_get=$values_customer_data['id'];
                        if($months>0){
                            if($group==1){
                                if($powertrain_months!=''){
                                    if($months>$powertrain_months){
                                        $id_get[]= $customer_id_get;
                                        //echo $months.'-'.$values_customer_data['sold_vehicle_make'].'-'.$powertrain_months."<br />";
                                    }
                                }
                            }
                            if($group==2){
                                if($powertrain_months!=''){
                                    if($months>($powertrain_months-6)){
                                        $id_get[]= $customer_id_get;
                                    }
                                }
                            }
                            if($group==3){
                                if($basic_months!=''){
                                    if($months>($basic_months)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                            if($group==4){
                                if($basic_months!=''){
                                    if($months<($basic_months-6)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                            if($group==5){
                                if($basic_months!=''){
                                    if($months>($basic_months-6)){
                                        $id_get[]=$customer_id_get;
                                    }
                                }
                            }
                        }
                    }
                    $ij=0;
                    $sql_warranty='';
                    if(!empty($id_get)){
                        $sql_warranty=("select * from  eps_data where dealership_id='$user_id' ");
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
        return $return_result;
    }
    function get_vehicle_warrant($make){
        $sql_get_query=("SELECT  * FROM warranty_manufacture  WHERE
        manufacturer='$make'
        ");
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $returnvalue_get=$result->result_array();
        }else{
            $returnvalue_get='';
        }
        return $returnvalue_get;
    }
    public function customerdatalist_model_breakdown_count($user_id,$startlimit,$endlimit,$vehicletype){
        if($vehicletype!='') {
            $sql_get_query=("SELECT count(*) as count FROM pbs_vehicledata_data as vd,pbs_customer_data as cd  WHERE
            (vd.customer_id=cd.id) and
            cd.dealership_id=$user_id and 
            vd.vehicletype = '$vehicletype' 
            GROUP BY cd.id limit $startlimit,$endlimit");
        }else{
            $sql_get_query=("SELECT count(*) as count FROM pbs_vehicledata_data as vd,pbs_customer_data as cd WHERE
            (vd.customer_id=cd.id) and
            dealership_id=$user_id and
            (vd.vehicletype != 'Car' or
            vd.vehicletype != 'SUV' or
            vd.vehicletype != 'Truck' or
            vd.vehicletype != 'Van') 
            GROUP BY cd.id limit $startlimit,$endlimit");
        }
        $result=$this->db->query($sql_get_query);
        if($result -> num_rows() >0){
            $returnvalue_get=$query->result_array();
            foreach($returnvalue_get as $count){
                $return =$count['count'];
            }
        }else{
            $return ='';
        }
    }
    function total_leadcount_display($lead_mining_presets,$dealer_id_upload_data,$event_insert_id){
        $return='';
        $group_id='';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> customerdatalist_equityscrap($dealer_id_upload_data,0,200,$group_id,$event_insert_id);
            $return=count($customer_data)*5;
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data_group_1=$this ->customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Car',$group_id,$event_insert_id);
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this  -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'SUVS',$group_id,$event_insert_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this-> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Trucks',$group_id,$event_insert_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this-> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'Vans',$group_id,$event_insert_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> customerdatalist_model_breakdown($dealer_id_upload_data,0,500,'',$group_id,$event_insert_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        }
        else if($lead_mining_presets=='efficiency'){
            $customer_data_group_1=$this -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Car',1,$group_id,$event_insert_id);
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this  -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Car',2,$group_id,$event_insert_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'SUV',3,$group_id,$event_insert_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this  -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'SUV',4,$group_id,$event_insert_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Truck',5,$group_id,$event_insert_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_6=$this -> customerdatalist_fuel_type($dealer_id_upload_data,0,50,'Truck',6,$group_id,$event_insert_id);
            if(isset($customer_data_group_6) && $customer_data_group_6!=''){
                foreach($customer_data_group_6 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            if(!empty($customer_data_group_6)){
                $count_group6=count($customer_data_group_6);
            }else{
                $count_group6=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5+$count_group6;
        }
        else if($lead_mining_presets=='warranty_scrape'){
            $group_id='';
            $customer_data_group_1=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,1,$group_id='');
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,2,$group_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,3,$group_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,4,$group_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> main_model -> warrant_scarp($event_insert_id,$dealer_id_upload_data,0,5000,5,$group_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        }
        return $return;
    }
    /*function to get the total lead count in mine data*/
    function total_leadcount_display_mine_data($lead_mining_presets,$dealer_id_upload_data,$event_insert_id){
        $return='';
        $group_id='';
        if($lead_mining_presets=='equity_scrape'){
            $customer_data=$this -> customerdatalist($dealer_id_upload_data,0,200,$group_id);
            $return=count($customer_data)*5;
        }else if($lead_mining_presets=='model_breakdown'){
            $customer_data_group_1=$this ->customerdatalist_model_breakdown_mine_data($dealer_id_upload_data,0,500,'Car',$group_id);
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this  -> customerdatalist_model_breakdown_mine_data($dealer_id_upload_data,0,500,'SUVS',$group_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this-> customerdatalist_model_breakdown_mine_data($dealer_id_upload_data,0,500,'Trucks',$group_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this-> customerdatalist_model_breakdown_mine_data($dealer_id_upload_data,0,500,'Vans',$group_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> customerdatalist_model_breakdown_mine_data($dealer_id_upload_data,0,500,'',$group_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        }else if($lead_mining_presets=='efficiency'){
            $customer_data_group_1=$this -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'Car',1,$group_id);
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this  -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'Car',2,$group_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'SUV',3,$group_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this  -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'SUV',4,$group_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'Truck',5,$group_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_6=$this -> customerdatalist_fuel_type_mine_data($dealer_id_upload_data,0,50,'Truck',6,$group_id);
            if(isset($customer_data_group_6) && $customer_data_group_6!=''){
                foreach($customer_data_group_6 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            if(!empty($customer_data_group_6)){
                $count_group6=count($customer_data_group_6);
            }else{
                $count_group6=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5+$count_group6;
        }else if($lead_mining_presets=='warranty_scrape'){
            $group_id='';
            $customer_data_group_1=$this -> main_model -> warrant_scarp_mine_data($event_insert_id,$dealer_id_upload_data,0,5000,1,$group_id='');
            if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                foreach($customer_data_group_1 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_2=$this -> main_model -> warrant_scarp_mine_data($event_insert_id,$dealer_id_upload_data,0,5000,2,$group_id);
            if(isset($customer_data_group_2) && $customer_data_group_2!=''){
                foreach($customer_data_group_2 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_3=$this -> main_model -> warrant_scarp_mine_data($event_insert_id,$dealer_id_upload_data,0,5000,3,$group_id);
            if(isset($customer_data_group_3) && $customer_data_group_3!=''){
                foreach($customer_data_group_3 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_4=$this -> main_model -> warrant_scarp_mine_data($event_insert_id,$dealer_id_upload_data,0,5000,4,$group_id);
            if(isset($customer_data_group_4) && $customer_data_group_4!=''){
                foreach($customer_data_group_4 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            $customer_data_group_5=$this -> main_model -> warrant_scarp_mine_data($event_insert_id,$dealer_id_upload_data,0,5000,5,$group_id);
            if(isset($customer_data_group_5) && $customer_data_group_5!=''){
                foreach($customer_data_group_5 as $value){
                    if($group_id!=null){
                        $group_id.=',';
                    }
                    $group_id.= $value['id'];
                }
            }
            if(!empty($customer_data_group_1)){
                $count_group1=count($customer_data_group_1);
            }else{
                $count_group1=0;
            }
            if(!empty($customer_data_group_2)){
                $count_group2=count($customer_data_group_2);
            }else{
                $count_group2=0;
            }
            if(!empty($customer_data_group_3)){
                $count_group3=count($customer_data_group_3);
            }else{
                $count_group3=0;
            }
            if(!empty($customer_data_group_4)){
                $count_group4=count($customer_data_group_4);
            }else{
                $count_group4=0;
            }
            if(!empty($customer_data_group_5)){
                $count_group5=count($customer_data_group_5);
            }else{
                $count_group5=0;
            }
            $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        }
        return $return;
    }
    function get_total_count_advance_options($event_insert_id,$dealer_id_upload_data,$group_id='',$query_date_range,$returnvalue_group){

        $return='';
        $group_id='';
        $return_group = array();
        if(is_array($returnvalue_group)){
            if(isset($returnvalue_group[1])){
                $customer_data_group_1=$this -> settings_model -> get_advanced_option_group_details($event_insert_id,1,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue_group[1]);
                $return_group[1] = $customer_data_group_1;
                if(isset($customer_data_group_1) && $customer_data_group_1!=''){
                    foreach($customer_data_group_1 as $value){
                        if($group_id!=null){
                            $group_id.=',';
                        }
                        $group_id.= $value['id'];
                    }
                }
            }

        }
        if(is_array($returnvalue_group)){
            if(isset($returnvalue_group[2])){
                $customer_data_group_2=$this -> settings_model -> get_advanced_option_group_details($event_insert_id,2,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue_group[2]);
                $return_group[2] = $customer_data_group_2;
                if(isset($customer_data_group_2) && $customer_data_group_2!='' && is_array($customer_data_group_2)){
                    foreach($customer_data_group_2 as $value){
                        if($group_id!=null){
                            $group_id.=',';
                        }
                        $group_id.= $value['id'];
                    }
                }
            }

        }
        if(is_array($returnvalue_group)){

            if(isset($returnvalue_group[3])){
                $customer_data_group_3=$this -> settings_model -> get_advanced_option_group_details($event_insert_id,3,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue_group[3]);
                $return_group[3] = $customer_data_group_3;
                if(isset($customer_data_group_3) && $customer_data_group_3!='' ){
                    foreach($customer_data_group_3 as $value){
                        if($group_id!=null){
                            $group_id.=',';
                        }
                        $group_id.= $value['id'];
                    }
                }
            }
        }
        if(is_array($returnvalue_group)){
            if(isset($returnvalue_group[4])){
                $customer_data_group_4=$this -> settings_model -> get_advanced_option_group_details($event_insert_id,4,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue_group[4]);
                $return_group[4] = $customer_data_group_4;
                if(isset($customer_data_group_4) && $customer_data_group_4!='' && is_array($customer_data_group_4)){
                    foreach($customer_data_group_4 as $value){
                        if($group_id!=null){
                            $group_id.=',';
                        }
                        $group_id.= $value['id'];
                    }
                }
            }
        }
        if(is_array($returnvalue_group)){
            if(isset($returnvalue_group[5])){
                $customer_data_group_5=$this -> settings_model -> get_advanced_option_group_details($event_insert_id,5,$dealer_id_upload_data,$group_id,$query_date_range,$returnvalue_group[5]);
                $return_group[5] = $customer_data_group_5;

            }
        }
        if(!empty($customer_data_group_1)){
            $count_group1=count($customer_data_group_1);
        }else{
            $count_group1=0;
        }
        if(!empty($customer_data_group_2)){
            $count_group2=count($customer_data_group_2);
        }else{
            $count_group2=0;
        }
        if(!empty($customer_data_group_3)){
            $count_group3=count($customer_data_group_3);
        }else{
            $count_group3=0;
        }
        if(!empty($customer_data_group_4)){
            $count_group4=count($customer_data_group_4);
        }else{
            $count_group4=0;
        }
        if(!empty($customer_data_group_5)){
            $count_group5=count($customer_data_group_5);
        }else{
            $count_group5=0;
        }
        $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        $return_group[0] = $return;
        return $return_group;
    }
    //get total records of minedata
    function get_total_count_advance_options_mine_data($event_insert_id,$dealer_id_upload_data,$group_id=''){
        $return='';
        $group_id='';
        $customer_data_group_1=$this -> settings_model -> get_advanced_option_group_details_mine_data($event_insert_id,1,$dealer_id_upload_data,$group_id);
        if(isset($customer_data_group_1) && $customer_data_group_1!=''){
            foreach($customer_data_group_1 as $value){
                if($group_id!=null){
                    $group_id.=',';
                }
                $group_id.= $value['id'];
            }
        }
        $customer_data_group_2=$this -> settings_model -> get_advanced_option_group_details_mine_data($event_insert_id,2,$dealer_id_upload_data,$group_id);
        if(isset($customer_data_group_2) && $customer_data_group_2!='' && is_array($customer_data_group_2)){
            foreach($customer_data_group_2 as $value){
                if($group_id!=null){
                    $group_id.=',';
                }
                $group_id.= $value['id'];
            }
        }
        $customer_data_group_3=$this -> settings_model -> get_advanced_option_group_details_mine_data($event_insert_id,3,$dealer_id_upload_data,$group_id);
        if(isset($customer_data_group_3) && $customer_data_group_3!='' ){
            foreach($customer_data_group_3 as $value){
                if($group_id!=null){
                    $group_id.=',';
                }
                $group_id.= $value['id'];
            }
        }
        $customer_data_group_4=$this -> settings_model -> get_advanced_option_group_details_mine_data($event_insert_id,4,$dealer_id_upload_data,$group_id);
        if(isset($customer_data_group_4) && $customer_data_group_4!='' && is_array($customer_data_group_4)){
            foreach($customer_data_group_4 as $value){
                if($group_id!=null){
                    $group_id.=',';
                }
                $group_id.= $value['id'];
            }
        }
        $customer_data_group_5=$this -> settings_model -> get_advanced_option_group_details_mine_data($event_insert_id,5,$dealer_id_upload_data,$group_id);
        if(!empty($customer_data_group_1)){
            $count_group1=count($customer_data_group_1);
        }else{
            $count_group1=0;
        }
        if(!empty($customer_data_group_2)){
            $count_group2=count($customer_data_group_2);
        }else{
            $count_group2=0;
        }
        if(!empty($customer_data_group_3)){
            $count_group3=count($customer_data_group_3);
        }else{
            $count_group3=0;
        }
        if(!empty($customer_data_group_4)){
            $count_group4=count($customer_data_group_4);
        }else{
            $count_group4=0;
        }
        if(!empty($customer_data_group_5)){
            $count_group5=count($customer_data_group_5);
        }else{
            $count_group5=0;
        }
        $return=$count_group1+$count_group2+$count_group3+$count_group4+$count_group5;
        return $return;
    }
    //function to get the purchase date
    function getpurchaesdate($vehicle_stock){
        $sql=("Select  first_payment_date,contract_date  from eps_data where sold_vehicle_stock='$vehicle_stock'");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue_get=$query->result_array();
            foreach($returnvalue_get as $contract_date){
                if($contract_date['first_payment_date']!=''){
                    $purchase_date=date('m/d/Y',$contract_date['first_payment_date']);
                }else {
                    $purchase_date=date('m/d/Y',$contract_date['contract_date']);
                }
            }
            $return =$purchase_date;
        }else{
            $return ='';
        }
        return $return ;
    }
    function getpurchaesdates_eps_table($vehicle_stock,$dealer_id){
        $sql=("Select  first_payment_date,contract_date  from eps_data where sold_vehicle_stock='$vehicle_stock' and dealership_id=$dealer_id");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue_get=$query->result_array();
            foreach($returnvalue_get as $contract_date){
                if($contract_date['first_payment_date']!=''){
                    $purchase_date=date('m/d/Y',$contract_date['first_payment_date']);
                }else {
                    $purchase_date=date('m/d/Y',$contract_date['contract_date']);
                }
            }
            $return =$purchase_date;
        }else{
            $return ='';
        }
        return $return ;
    }
    /*function to get lead mining details*/
    public function get_lead_mining_details($event_id){
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
    /*Function to fetch user details*/
    public function getdealerfoldername($dealername){
        $all_users_id='';
        $sql=("SELECT folder_name
        FROM registration
        WHERE `company_name` like '$dealername%'
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            foreach($returnvalue as $folder_name){
                $folder_name_send= $folder_name['folder_name'];
            }
            return $folder_name_send;
        }else{
            return FALSE;
        }
    }
    //function to get the userdetails with their folder name 
    public function userdetails_with_foldername($dealername){
        $all_users_id='';
        $sql=("SELECT *
        FROM registration
        WHERE `company_name` like '$dealername%'
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            return $returnvalue;
        }else{
            return FALSE;
        }
    }
    /*Function to fetch user details of pbs dealers*/
    public function getdealerfoldernamepbs($dealername){
        $dealername = mysql_real_escape_string($dealername);
        $all_users_id='';
        $sql=("SELECT folder_name
        FROM registration
        WHERE Replace( company_name, ' ', '' ) like '$dealername%'
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            foreach($returnvalue as $folder_name){
                $folder_name_send= $folder_name['folder_name'];
            }
            return $folder_name_send;
        }else{
            return FALSE;
        }
    }
    //function to get the userdetails with their folder name of pbs dealers
    public function userdetails_with_foldername_pbs($dealername){
        $all_users_id='';
        $sql=("SELECT *
        FROM registration
        WHERE Replace( company_name, ' ', '' ) like '$dealername%'
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            return $returnvalue;
        }else{
            return FALSE;
        }
    }
    //function to get get feed details
    public function ftp_file_feed_details($filename){
        $all_users_id='';
        $sql=("SELECT *
        FROM  ftp_feed_details
        WHERE `filename` ='$filename'
        ");
        $query=$this->db->query($sql);
        if($query -> num_rows() > 0){
            $returnvalue= $query->result_array();
            return $returnvalue;
        }else{
            return FALSE;
        }
    }
    //function to get the group name
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

    public function update_contract_term(){
        $sql = 'UPDATE eps_data
                SET `contract_term`= `total_of_payments`
                WHERE `total_of_payments` < `total_finance_amount`;';
        $this->db->query($sql);
    }
    public function update_total_of_payment(){
        $sql = 'UPDATE eps_data
                SET `total_of_payments`= `monthly_payment`*`contract_term`;';
        $this->db->query($sql);
    }

    public function financial_remaining(){
        $this->db->select('*');
        $this->db->from('eps_data');
        $this->db->where('first_payment_date != ','0');
        $this->db->where('payment_frequency != ','0');
        $this->db->where('dealership_id = ','247');
        $this->db->order_by('dealership_id','DESC');
//        $this->db->limit(6000);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $vehical_infos = $query->result_array();
            foreach ($vehical_infos as $vehical_info){
                if(is_numeric($vehical_info['payment_frequency'])){
                    $first_paayment = date("Y", $vehical_info['first_payment_date']);
                    $now = date('Y');
                    $year = $now-$first_paayment;
                    if($year == 0){
                        $year = 1;
                    }
                    $payments_made = $year*$vehical_info['payment_frequency'];
                    $total_amount_paid = ceil($payments_made*$vehical_info['monthly_payment']);
                    $total_of_payment = ceil($vehical_info['total_of_payments']);
                    $finance_amount_remaining =  $total_of_payment-$total_amount_paid;
                    echo "Total Amount Paid: ".$total_amount_paid." <br/> "
                        . "Monthly Amoun: ".$vehical_info['monthly_payment']." <br/> "
                        . "Total Amount: ".$total_of_payment." <br/> "
                        . "Financial Remaining Amount: ".$finance_amount_remaining."<br/><br/>";
                    if($finance_amount_remaining < 0){
                        $finance_amount_remaining = 0;
                    }
                    $vin = $vehical_info['sold_vehicle_VIN'];
                    $vin = substr($vin, 0,8);
                    $this->db->select('*');
                    $this->db->from('eps_master_vehicle');
                    $this->db->where('vin',$vin);
                    $this->db->where('sold_vehicle_year',$vehical_info['sold_vehicle_year']);
                    $this->db->where('sold_vehicle_make',$vehical_info['sold_vehicle_make']);
                    $this->db->where('sold_vehicle_model',$vehical_info['sold_vehicle_model']);
                    $query = $this->db->get();
                    if($query->num_rows()>0){
                        $vehicals = $query->result_array();
                        $low_km = $vehicals[0]['low_km'];
                        $lkm_high_value = $vehicals[0]['lkm_high_value'];
                        $lkm_low_value = $vehicals[0]['lkm_low_value'];

                        $high_km = $vehicals[0]['high_km'];
                        $hkm_high_value = $vehicals[0]['hkm_high_value'];
                        $hkm_low_value = $vehicals[0]['hkm_low_value'];

                        $lKMh_equity = $lkm_high_value-$finance_amount_remaining;
                        $bb_lowKM_avg = ($lkm_high_value+$lkm_low_value)/2;
                        $lKMa_equity =  $bb_lowKM_avg-$finance_amount_remaining;
                        $lKMl_equity = $lkm_low_value-$finance_amount_remaining;

                        $aKMh_equity = $hkm_high_value-$finance_amount_remaining;
                        $bb_avgKM_avg = ($hkm_high_value+$hkm_low_value)/2;
                        $aKMa_equity = $bb_avgKM_avg-$finance_amount_remaining;
                        $aKMl_equity = $hkm_low_value-$finance_amount_remaining;

                        $equity_data = array('lKMh_equity' => $lKMh_equity, 'bb_lowKM_avg' => $bb_lowKM_avg,'lKMa_equity' => $lKMa_equity,'lKMl_equity' => $lKMl_equity,'aKMh_equity' => $aKMh_equity,'bb_avgKM_avg' =>  $bb_avgKM_avg,'aKMa_equity' => $aKMa_equity,'aKMl_equity' => $aKMl_equity);
                        $this->db->trans_start();
                        $this->db->where('id', $vehical_info['id']);
                        $this->db->where('dealership_id', '247');
                        $this->db->update('eps_data',$equity_data);
                        $this->db->trans_complete();
                    }
                    $sql = 'UPDATE eps_data
                        SET `finance_amount_remaining`= "'.$finance_amount_remaining.'" '.
                        'WHERE id = '.$vehical_info['id'];
                    $this->db->query($sql);

                }
            }
        }
    }

    public function calculate_trad_in(){

    }

    public function update_payment_freq1(){
        /*
         * Monthly Update
         */
        $sql = 'UPDATE eps_data
                SET `payment_frequency` = "12"
                WHERE `payment_frequency` = "Monthly"';
        $this->db->query($sql);
        /*
         * Bi_Weekly Update
         */
        $sql = 'UPDATE eps_data
            SET `payment_frequency` = "26"
            WHERE `payment_frequency` = "Bi-Weekly"';
        $this->db->query($sql);
        /*
         * Semi-Monthly 
         */
        $sql = 'UPDATE eps_data
            SET `payment_frequency` = "24"
            WHERE `payment_frequency` = "Semi-Monthly"';
        $this->db->query($sql);

        $sql = 'UPDATE eps_data
            SET `payment_frequency` = "0"
            WHERE `payment_frequency` = ""';
        $this->db->query($sql);
    }

    public function update_payment_freq2(){
        /*
         *  Update payment_frequency for other condition
         */
        $not_in = array('12','24','26');
        $this->db->select('*');
        $this->db->from('eps_data');
        $this->db->where('dealership_id = ','247');
        $this->db->where_not_in('payment_frequency', $not_in);
//        $this->db->limit(3000);
        $query = $this->db->get();
        if($query->num_rows()>0){
            $vehical_infos = $query->result_array();
            foreach ($vehical_infos as $vehical_info){
//                if($vehical_info['payment_frequency'] == '0' || is_numeric($vehical_info['payment_frequency'])){
                if($vehical_info['total_finance_amount'] == 0){
                    $payment_frequency = 0;
                }else{
                    echo 'test';
                    $total_of_payment = $vehical_info['total_of_payments'];
                    $total_finance_amount = $vehical_info['total_finance_amount'];
                    $contract_term = $vehical_info['contract_term'];
                    if($total_of_payment<$total_finance_amount){
                        $payment_frequency = ceil($total_of_payment/ceil($contract_term/12));
                        print_r($payment_frequency."<br/>");
                        if(isset($payment_frequency)){
                            $sql = 'UPDATE eps_data
                                        SET `payment_frequency`= "'.$payment_frequency.'" '.
                                'WHERE id = '.$vehical_info['id'];
                            $this->db->query($sql);
                        }
//                            echo "Total of Payment: ".$total_of_payment."<br/>";
//                            echo "Total Finance Amount: ".$total_finance_amount."<br/>";
//                            echo "Contract Term: ".$contract_term."<br/>";
//                            echo "Formula: ".$total_of_payment."/(".$contract_term."/12)"."<br/>";
//                            echo "Payment Term: ".$payment_frequency."<br/><br/>New Item <br/><br/>";
                    }
                }
//                }

                if(isset($payment_frequency)){
                    $sql = 'UPDATE eps_data
                            SET `payment_frequency`= "'.$payment_frequency.'" '.
                        'WHERE id = '.$vehical_info['id'];
                    $this->db->query($sql);
                }
            }
        }
    }
}
?>