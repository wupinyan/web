<?php
function identity_check(){
  if (!empty($_COOKIE['have_cookie'])) {
    session_start();
    if (!empty($_SESSION['login'])) {
      return true;
    }
  }elseif (!empty($_POST['user']) &&
           !empty($_POST['password'])) {
    require "database.php";
    if (!$db=database_connect()) {
      throw new \RuntimeException("Error Processing Request", 1);
    }
    $command="select *
              from table1
              where name=:name
              and val1=:val1";
    $stmt=$db->prepare($command);
    $stmt->bindParam(':name',$_POST['user']);
    $stmt->bindParam(':val1',$_POST['password']);
    $stmt->execute();
    $result=$stmt->fetchall(PDO::FETCH_ASSOC);
    if (count($result)!=1) {
      throw new \Exception("Error Processing Request", 1);
    }
    return true;
  }
  return false;
}
?>
