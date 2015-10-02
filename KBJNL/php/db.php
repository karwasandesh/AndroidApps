
<?php

   $host        = "host=192.168.1.17";
   $port        = "port=5432";
   $dbname      = "dbname=kbjnl_New130215";
   $credentials = "user=postgres password=postgres123";

   $db = pg_connect( "$host $port $dbname $credentials"  );
  /*if(!$db)
  {

  		echo"db not connected ";
  }
  else
  {

  		echo "connected";
  }*/
?>