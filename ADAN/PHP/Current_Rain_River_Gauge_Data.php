<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbAdan/Current_Rain_River_Gauge_Data.xml");
echo json_encode($xml);

?>