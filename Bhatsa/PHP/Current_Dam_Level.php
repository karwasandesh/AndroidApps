<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbBhatsa/Current_Dam_Level.xml");
echo json_encode($xml);

?>