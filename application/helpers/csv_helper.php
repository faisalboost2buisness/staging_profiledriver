<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('array_to_csv')){
    function array_to_csv($array, $download = ""){
    //if ($download != "")
    //{    
    // header('Content-Type: application/csv');
    //header('Content-Disposition: attachement; filename="' . $download . '"');
    // }        
    ob_start();
    $f = fopen($download, 'w') or show_error("Can't open php://output");
    $n = 0;        
    foreach ($array as $line){
        $n++;
        if ( ! fputcsv($f, $line)){
            show_error("Can't write line $n: $line");
        }
    }
    fclose($f) or show_error("Can't close php://output");
    $str = ob_get_contents();
    ob_end_clean();
    }
}
if ( ! function_exists('query_to_csv')){
function query_to_csv($query, $headers = TRUE, $download = ""){
if ( ! is_object($query) OR ! method_exists($query, 'list_fields')){
    show_error('invalid query');
}
$array = array();
if ($headers){
$line = array();
$customer_data_feild_name=array("First Name","Last Name","Address","Appartment #","City","Province/State","Postal Code/Zip","Home Phone","Work Phone","Year","Make","Model","Purchase Date");
    foreach ($customer_data_feild_name as $name){
        $line[] = $name;
    }
    $array[] = $line;
    
}
foreach ($query->result_array() as $row){
    $line = array();
    foreach ($row as $item){
    $line[] = $item;
    }
    $array[] = $line;
}


echo array_to_csv($array, $download);
}
}

/* End of file csv_helper.php */
/* Location: ./system/helpers/csv_helper.php */