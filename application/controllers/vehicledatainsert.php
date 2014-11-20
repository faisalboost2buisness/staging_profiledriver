<?php
class Vehicledatainsert extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this -> load -> library("Pdf");
        $this -> load -> helper('url');
        $this -> load -> library('session');
        $this -> load -> helper('form');
        $this -> load -> library('form_validation');
        $this -> load -> model('login_model'); 
        $this -> load -> model('main_model'); 
        $this -> load -> model('settings_model'); 
        $this -> load -> library("pagination");
        $this -> load -> library('session');
        $this -> load -> library('zip');
    }
    /*function to insert customer data*/
    function insert_customer_data(){
        $sql_leadlist=("SELECT pbs_customer_data.id as customer_id, Vehicle.* FROM  Vehicle, pbs_customer_data WHERE Vehicle.year=pbs_customer_data.sold_vehicle_year AND  Vehicle.make=pbs_customer_data.sold_vehicle_make AND  Vehicle.model=pbs_customer_data.sold_vehicle_model AND Vehicle.vehicleType = 'car' and pbs_customer_data.dealership_id=170");
        $query_leadlist=$this->db->query($sql_leadlist);
        if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist -> result_array();
            foreach($returnvalue as $name){
                $data=array('styleId' => $name['styleId'],
                'vehicletype' => $name['vehicleType'],
                'vehiclesize' => $name['vehicleSize'],
                'vehiclestyle' => $name['vehicleStyle'],
                'vehiclecategory' => $name['vehicleCategory'],
                'enginefueltype' => $name['engineFuelType'],
                'drivenwheels' => $name['drivenWheels'],
                'transmissiontype' => $name['transmissionType'],
                'numberofdoors' => $name['numberOfDoors'],
                'mpgcity' => $name['mpgCity'],
                'mpghighway' => $name['mpgHighway'],
                'mpgcombined' => $name['mpgCombined'],
                'curbweight' => $name['curbWeight'],
                'customer_id' => $name['customer_id']
                );
                $this->db->insert('pbs_vehicledata_data',$data);
            } 
        }
    }
    /*function to insert customer data*/
    function insert_customer_data1(){
        $sql_leadlist=("SELECT pbs_customer_data.id as customer_id, Vehicle.* FROM  Vehicle, pbs_customer_data WHERE Vehicle.year=pbs_customer_data.sold_vehicle_year AND  Vehicle.make=pbs_customer_data.sold_vehicle_make AND  Vehicle.model=pbs_customer_data.sold_vehicle_model AND Vehicle.vehicleType = 'SUV' and pbs_customer_data.dealership_id=170");
        $query_leadlist=$this->db->query($sql_leadlist);
        if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist->result_array();
            foreach($returnvalue as $name){
                $data=array('styleId'=>$name['styleId'],
                'vehicletype'=>$name['vehicleType'],
                'vehiclesize'=>$name['vehicleSize'],
                'vehiclestyle'=>$name['vehicleStyle'],
                'vehiclecategory'=>$name['vehicleCategory'],
                'enginefueltype'=>$name['engineFuelType'],
                'drivenwheels'=>$name['drivenWheels'],
                'transmissiontype'=>$name['transmissionType'],
                'numberofdoors'=>$name['numberOfDoors'],
                'mpgcity'=>$name['mpgCity'],
                'mpghighway'=>$name['mpgHighway'],
                'mpgcombined'=>$name['mpgCombined'],
                'curbweight'=>$name['curbWeight'],
                'customer_id'=>$name['customer_id']
                );
                $this->db->insert('pbs_vehicledata_data',$data);
            } 
        }
    }
    /*function to insert the data*/
    function insert_customer_data2(){
        $sql_leadlist=("SELECT  *  from pbs_customer_data where dealership_id=170 order by id limit 1000, 6000");
        $query_leadlist=$this -> db -> query($sql_leadlist);
        if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist -> result_array();
            foreach($returnvalue as $name_vehicledata){
                $sql_leadlist_vehicle=("SELECT  *  from  Vehicle where year='$name_vehicledata[sold_vehicle_year]' and make='$name_vehicledata[sold_vehicle_make]'  and model='$name_vehicledata[sold_vehicle_model]' ");
                $query_leadlist_vehicle=$this -> db-> query($sql_leadlist_vehicle);
                $query_leadlist_vehicle=$this -> db -> query($sql_leadlist_vehicle);
                if($query_leadlist_vehicle -> num_rows() > 0){
                    $returnvalue_vehicle= $query_leadlist_vehicle->result_array();    
                    foreach($returnvalue_vehicle as $name){
                        $data=array('styleId' => $name['styleId'],
                        'vehicletype' => $name['vehicleType'],
                        'vehiclesize' => $name['vehicleSize'],
                        'vehiclestyle' => $name['vehicleStyle'],
                        'vehiclecategory' => $name['vehicleCategory'],
                        'enginefueltype' => $name['engineFuelType'],
                        'drivenwheels' => $name['drivenWheels'],
                        'transmissiontype' => $name['transmissionType'],
                        'numberofdoors' => $name['numberOfDoors'],
                        'mpgcity' => $name['mpgCity'],
                        'mpghighway' => $name['mpgHighway'],
                        'mpgcombined' => $name['mpgCombined'],
                        'curbweight' => $name['curbWeight'],
                        'customer_id' => $name_vehicledata['id'],
                        'fuel_efficiency' => $name['fuelCapacity']
                        );
                        $insert=$this -> db -> insert('pbs_vehicledata_data',$data);
                        if($insert){
                            echo 'insert';
                        }
                    }
                }
            }
        } 
    }
    /*function to insert the customer data*/
    function insert_customer_data3(){
        $sql_leadlist=("SELECT pbs_customer_data.id as customer_id, Vehicle.* FROM  Vehicle, pbs_customer_data WHERE Vehicle.year=pbs_customer_data.sold_vehicle_year AND  Vehicle.make=pbs_customer_data.sold_vehicle_make AND  Vehicle.model=pbs_customer_data.sold_vehicle_model AND  Vehicle.vehicleType = 'Minivan' and pbs_customer_data.dealership_id=170");
        $query_leadlist=$this -> db -> query($sql_leadlist);
        if($query_leadlist -> num_rows() > 0){
            $returnvalue= $query_leadlist -> result_array();
            foreach($returnvalue as $name){
                $data=array('styleId' => $name['styleId'],
                'vehicletype' => $name['vehicleType'],
                'vehiclesize' => $name['vehicleSize'],
                'vehiclestyle' => $name['vehicleStyle'],
                'vehiclecategory' => $name['vehicleCategory'],
                'enginefueltype' => $name['engineFuelType'],
                'drivenwheels' => $name['drivenWheels'],
                'transmissiontype' => $name['transmissionType'],
                'numberofdoors' => $name['numberOfDoors'],
                'mpgcity' => $name['mpgCity'],
                'mpghighway' => $name['mpgHighway'],
                'mpgcombined' => $name['mpgCombined'],
                'curbweight' => $name['curbWeight'],
                'customer_id' => $name['customer_id']
                );
                $this -> db ->insert('pbs_vehicledata_data',$data);
            } 
        }
    }
}
?>