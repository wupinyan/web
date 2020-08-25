<?php
$registered_success=0;
$error_message='';
setcookie('have_cookie',1);
if (!empty($_POST['new_user']) &&
    !empty($_POST['new_password'])) {
  try {
      if (empty($_COOKIE['have_cookie'])) {
        throw new \Exception("請開啟您瀏覽器的cookie");
      }
      require 'functions/database.php';
      if (!$db=database_connect()) {
        throw new \Exception('資料庫異常');
      }
      if (database_userExist($db,$_POST['new_user'])) {
        throw new \Exception('此帳號已有人使用了');
      }
      $command="insert into identity
                values(0,:new_user,:new_password)";
      $stmt=$db->prepare($command);
      $stmt->execute([':new_user'=>$_POST['new_user'],
                      ':new_password'=>$_POST['new_password']]);
      if (!database_userExist($db,$_POST['new_user'])) {
        throw new \Exception('註冊失敗');
      }
      $registered_success=1;
      session_start();
      $_SESSION['have_cookie']=1;
  } catch (\Exception $e) {
    $error_message=$e->getMessage();
  }
}
if ($registered_success=0) {
  ?>
  <form action="registered.php" method="post">
    <input type="text" name="new_user"><br>
    <input type="text" name="new_password"><br>
    <input type="submit">
  </form>
  <?php
  echo $error_message;
}else {
  ?>
  <h1>註冊成功</h1>
  <a href="home.php">前往首頁</a>
  <?php
}
?>
