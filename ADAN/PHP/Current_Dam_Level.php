<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbAdan/Current_Dam_Level.xml");
echo json_encode($xml);

?>