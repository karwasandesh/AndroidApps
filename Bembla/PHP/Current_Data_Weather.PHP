<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbBembla/Current_Data_Weather.xml");
echo json_encode($xml);

?>