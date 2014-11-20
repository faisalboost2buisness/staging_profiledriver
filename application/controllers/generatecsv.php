<?php

class Generatecsv extends CI_Controller{
    function Generatecsv(){
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('csv');
        $this->load->model('settings_model'); 
        $this->load->helper('file');
        $this -> load -> library('zip');
    }
    //checking zip file genertaion
    function create_zip() {
        $dealer_id=122;
        $event_id=5;
        $zipname=$dealer_id.'-'.$event_id;
        $folder_in_zip = "/"; //root directory of the new zip file
        $base_path = $this -> config -> item('rootpath');
        $this->zip->archive($base_path.'/downloadreportzip/'.$zipname.'/exclusivereport.zip'); 
        //$path = $base_path.'/downloadreportzip/my_backup.zip';
        $this->zip->get_files_from_folder($base_path.'/downloadreportzip/'.$zipname.'/', 'exclusivereport.zip/');
        $this->zip->download('exclusivereport.zip');
    }
}