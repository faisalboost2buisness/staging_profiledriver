<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Settings extends CI_Controller {
    	public function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> library('session');
		$this -> load -> helper('form');
		$this->load->model('login_model'); 
        $this->load->library("pagination");
        $this->load->model("settings_model");
         $this->load->model("main_model");
	}
    /*Function to view page*/
    public function index($user_id){
        $data['menu']=$this->login_model->loginauth();        
        if (isset($data['menu']['logged_in']) != '')
        {
           $data['title'] = 'Exclusive Private Sale Inc-Register';
           $data['user_id']=$user_id;            
           $this->load->view('themes/header',$data);
           $this->load->view('themes/side-bar',$data);
    	   $this -> load -> view('settings-view',$data);
           $this->load->view('themes/footer',$data);
        }
       else
       {
           redirect(base_url().'login');
       }
    }
    /*Function to insert dealer details*/    
    public function setting_uploadprocess(){
        $data['menu']=$this->login_model->loginauth();        
        if (isset($data['menu']['logged_in']) != '')
        {
            $data['title'] = 'Exclusive Private Sale Inc-Register';    
             $dealer_name= $this->input->post('dealers');
            $user_id= $this->input->post('user_id'); 
             $delete_id=$this -> settings_model -> delete_dealers($user_id);
            $insert_lastid=$this -> settings_model -> update_dealerdetails($user_id,$dealer_name);
            if($insert_lastid>0){
            $data['user_details']=$this -> main_model-> alluserdetails(); 
            $data['user_id']=$user_id;
            $data['success']='Dealers added successfuly';            
            $this->load->view('themes/header',$data);
            $this->load->view('themes/side-bar',$data);
            $this -> load -> view('dashboard-view',$data);
            $this->load->view('themes/footer',$data);
            }else{
              redirect(base_url().'dashboard');      
            }
        }
        else{
            redirect(base_url().'login');    
        }
    }
 public function states() 
        {
      //$user_id = $data['menu']['logged_in']['user_id'];
      $data['details'] = $this -> main_model -> getusstates();
        }
 public function getcity() 
 {
    $states=$_POST['states'];
     $data['details'] = $this -> main_model -> getuscities($states);
 }
  public function getcitywithselected() 
 {
    $states=$_POST['states'];
    if(isset($_POST['city']) && $_POST['city']!='')
    {
        $city=$_POST['city'];
    }
    else
    {
        $city='';
    }
     $data['details'] = $this -> main_model -> getuserselectedcity($states,$city);
 }
public function adddealers(){
    $dealers_name=$_POST['dealers_name'];
    $member_id=$_POST['member_id'];
    $insert_lastid=$this -> settings_model -> update_dealerdetails($member_id,$dealers_name);
   
    $dealer_details=$this -> settings_model -> new_removeddealers($member_id);
    
        if(isset($dealer_details) && is_array($dealer_details))
        {
        foreach($dealer_details as $value)
        {
            $dealer_details=$this -> settings_model ->managers_assigned_dealers($member_id);
                if(isset($dealer_details) && $dealer_details!='')
                {
                    if(in_array($value['registration_id'],$dealer_details))
                    {
                        $selected='selected';
                    }
                    else
                    {
                        $selected='';
                    }
                }
            echo '<option value="'.$value['registration_id'].'">'.$value['first_name'].'</option>';                        
        }
        }
    
} 
public function removedealers(){
$dealers_name1=$_POST['dealers_name'];

$member_id1=$_POST['member_id'];
$dealer_assigned=$this -> settings_model -> delete_dealers_seperate($member_id1,$dealers_name1);   
  
    $dealer_details=$this -> settings_model -> new_removeddealers($member_id1);
    
        if(isset($dealer_details) && is_array($dealer_details))
        {
        foreach($dealer_details as $value)
        {
            $dealer_details=$this -> settings_model ->managers_assigned_dealers($member_id1);
               
            echo '<option value="'.$value['registration_id'].'" >'.$value['first_name'].'</option>';                        
        }
        }
   
}
public function newdealerlist(){
    $userid=$_POST['member_id'];
    $member_id1=$_POST['member_id'];
    $dealer_details=$this -> settings_model -> assigned_alldealers($userid);
                                if(isset($dealer_details))
                                {
                                    foreach($dealer_details as $value)
                                    { 
                                    ?>
                                    <?php
                                    $dealer_details=$this -> settings_model ->managers_assigned_dealers($userid);
                                      
                                                                   
                                    echo '<option value="'.$member_id1.'" >'.$value['first_name'].'</option>';                                
                                   
                                    }
                                }else{
                                ?>                                
                                <option value="" >No dealers Found</option>                                
                                <?php
                                }
                                
}
public function selectcampaine()
{
    echo '<fieldset style="width:100%" id="steptwo">
            <div id="tab-1" class="with-padding">
                <div class="standard-tabs margin-bottom" id="add-tabs">
                    <ul class="tabs">
                        <li class="active"><a href="#tab-1">Selected tab</a></li>
                        <li><a href="#tab-2">Another tab</a></li>
                        <li><a href="#tab-3">Another tab</a></li>
                        <li ><a href="#tab-4">Disabled tab</a></li>
                    
                    </ul>
                <div class="tabs-content" style="float: left;margin-bottom: 14px;">
                    <div id="tab-1" class="with-padding" style="width: 33%;float: left;">
                        <label  class="reportlabel">Select your report type:</label>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 1</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 2</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 3</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 4</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 5</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 6</label>
                        </div>
                        <div class="reporttype">
                        <input type="radio" name="report" value="type1" style="width: 31px;"/>
                        <label for="validation-required" class="label">Report Type 7</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 8</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 9</label>
                        </div>
                        <div class="reporttype">
                            <input type="radio" name="report" value="type1" style="width: 31px;"/>
                            <label for="validation-required" class="label">Report Type 10</label>
                        </div>
                    </div>
                    
                    <div style="float: left; width: 58%;margin-top: 10px;">
                        <h4 style="color:#666666;">Report Type 1</h4>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Variable 1</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Variable 2</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Variable 3</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Variable 4</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
                        </p>
                        <p class="inline-small-label button-height">
                            <label for="small-label-1" class="label">Variable 5</label>
                            <input type="text" name="last_name" id="last_name" class="input small-margin-right" value=""/>
                        </p>
                    </div>
                </div> 
            </div>
        </div>
        <div id="tab-2" class="with-padding" style="width: 33%;float: left;">
                    Second tab
                    </div>
        <div id="tab-3" class="with-padding">
        
        </div>
        <div id="tab-4" class="with-padding">
        Disabled tab
        </div>
        
        <button type="button" class="previous  button glossy mid-margin-right" value="Previous">
        <span class="button-icon green-gradient"><span class="icon-backward "></span></span>
        previous
        </button>
        <button type="button" class="next  button glossy mid-margin-right" value="Next">
        <span class="button-icon green-gradient"><span class="icon-forward "></span></span>
        Next
        </button>
        
        </fieldset>';
}
    
}