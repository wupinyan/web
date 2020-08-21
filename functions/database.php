<?php
function database_connect(){
  require "../userPassword.php";
  try {
    $db=new PDO($mysql,$user,$password);
  } catch (\Exception $e) {
    return 0;
  }
  return $db;
}
?>
