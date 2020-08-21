<?php
function identity_check(){
  if (!empty($_POST['user']) &&
      !empty($_POST['password'])) {
    if (!empty($_COOKIE['have_cookie'])) {
      require 'database.php';
      if (!$db=database_connect()) {
        throw new \UnexpectedValueException("資庫連線錯誤");
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
        throw new \UnexpectedValueException("密碼錯誤");
      }
      session_start();
      $_SESSION['allow_in']=1;
      return;
    }
    throw new \UnexpectedValueException("請開啟您瀏覽器的cookie");
  }elseif (!empty($_COOKIE['have_cookie'])) {
    session_start();
    if (empty($_SESSION['allow_in'])) {
      throw new \Exception();
    }
    return;
  }
  throw new \Exception();
}
?>
