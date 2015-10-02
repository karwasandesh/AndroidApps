<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbAIp/Current_Spillway_Gate_Data.xml");
echo json_encode($xml);

?>