<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbBhatsa/Current_Flow_Data.xml");
echo json_encode($xml);

?>