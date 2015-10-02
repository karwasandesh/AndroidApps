<?php 
 header('Access-Control-Allow-Origin: *');

$xml = simplexml_load_file("http://msplautomationprojects.com/Db/DbAIp/Current_Rain_Gauge_Data.xml");
$ab= json_encode($xml);
echo $ab;
?>