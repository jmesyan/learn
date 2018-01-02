<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db('learn', $con);
$rs = mysql_query('select * from easyui_users');
$result = array();
while($row = mysql_fetch_object($rs)){
    array_push($result, $row);
}
mysql_close($con);

echo json_encode($result);
