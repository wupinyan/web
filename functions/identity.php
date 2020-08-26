<?php
function identity_check(){
  if (!empty($_POST['user']) &&
      !empty($_POST['password'])) {
    if (!empty($_COOKIE['have_cookie'])) {
      require 'database.php';
      if (!$db=database_connect()) {
        throw new \Exception("資庫連線錯誤");
      }
      $command="select *
                from identity
                where user=:user
                and password=:password";
      $stmt=$db->prepare($command);
      $paramiters=[':user'=>$_POST['user'],
                   ':password'=>$_POST['password']];
      $stmt->execute($paramiters);
      $result=$stmt->fetchall(PDO::FETCH_ASSOC);
      if (count($result)!=1) {
        throw new \Exception("密碼錯誤");
      }
      session_start();
      $_SESSION['allow_in']=1;
      return;
    }
    throw new \Exception("請開啟您瀏覽器的cookie");
  }elseif (!empty($_POST['new_user']) &&
           !empty($_POST['new_password'])) {
        if (empty($_COOKIE['have_cookie'])) {
          throw new \Exception("請開啟您瀏覽器的cookie");
        }
        require 'database.php';
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
        session_start();
        $_SESSION['allow_in']=1;
        var_export($_SESSION);
        return;
  } elseif (!empty($_COOKIE['have_cookie'])) {
      session_start();
      if (empty($_SESSION['allow_in'])) {
        throw new \Exception();
      }
      return;
  }
  throw new \Exception();
}
?>
