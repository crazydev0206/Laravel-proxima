<?php
function test_input($data) {
  $data=@trim($data);
  $data=@stripslashes($data);
  $data=@htmlspecialchars($data);
  $data=@addslashes($data);
  $data=@nl2br($data);
  return $data;
}


   function test_input2($data) {
  $data=@trim($data);
  $data=@stripslashes($data);
  $data=@htmlspecialchars($data);
  $data=@addslashes($data);
  return $data;
}

/*define('host','166.62.10.139');
define('user','nuqaliati_u');
define('pass','dDEQ~+*tF[UD');
define('db_name','nerc_www');*/

define('host','localhost');
define('user','root');
define('pass','');
define('db_name','munganga_www');

$dbc=@mysqli_connect(host,user,pass,db_name);
 ?>
