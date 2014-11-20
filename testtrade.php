<?php
/*
$url ='http://xml.canadianblackbook.com/XMLWebServices/service?command=priceVehicle&year=2014&vin=2C4RC1CG&selectedOptions=20&kilometers=12000&annualKilometers=12000&account=eps_advantage_xml&key=KLAD3njdf8fh3hgf8&schemaVersion=3.0';
$xml=simplexml_load_file("$url");
$eml1=$xml->response->children();
echo "<pre>";
//print_r($eml1);
echo "</pre>";
$eml2=$eml1->vehicles->children();
echo "<pre>";
//print_r($eml2);
echo "</pre>";
$eml3=$eml2->vehicle->children();
echo "<pre>";
//print_r($eml3);
echo "</pre>";
$eml4=$eml3->values->children();
echo "<pre>";
//print_r($eml4);
echo "</pre>";

foreach($eml4 as $values){
    //echo $values."<br />";
    $tradevalue[]=$values;
    
}
*/

$url ='http://xml.canadianblackbook.com/XMLWebServices/service?command=vehicles&year=2010&vin=4YMDU102&account=eps_advantage_xml&key=KLAD3njdf8fh3hgf8&schemaVersion=3.0';
$xml=simplexml_load_file("$url");
$eml1=$xml->response->children();
echo "<pre>";
print_r($eml1);
echo "</pre>";
$eml2=$eml1->vehicles->children();
echo "<pre>";
print_r($eml2);
echo "</pre>";
$eml3=$eml2->vehicle->children();
echo "<pre>";
//print_r($eml3);
echo "</pre>";
$eml4=$eml3->vid;
//echo $eml4;
$date=strtotime(date('m/d/y'));
//echo $from_year = date('Y',strtotime ( '-1 year' , $date)).'<br />';  
//echo $to_year = date('Y',strtotime ( '-10 year' , $date)); 
?>