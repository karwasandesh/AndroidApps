<?php
include_once('db.php');

error_reporting(0);
$uname =  $_POST['name'];

$password1= $_POST['password'];
$str1 = sha1($password1);
$str2 = "{SHA}" ;
$password =$str2.$str1; 
$query = "SELECT * FROM user_login WHERE user_login_id ='$uname' and current_password ='$password'";
//var_dump($query); {SHA}5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8
//var_dump ($query);

if ($result=pg_query($query))
  {
if ($row=pg_fetch_row($result))
    {
    $vart = $row[18];
	if($vart >=0)
	

//$result = pg_exec($query);   
//$check = pg_numrows($result);

//if($check <=0)
//{
echo $vart;

}
else
{
echo 0;
}
	}
?>