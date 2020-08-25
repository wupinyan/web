<?php
function database_connect(){
  require "../userPassword.php";
  try {
    $db=new PDO($mysql,$user,$password);
  } catch (\Exception $e) {
    return 0;
  }
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  return $db;
}
function database_userExist($db,$user){
  $command="select *
            from identity
            where user=:user";
  $stmt=$db->prepare($command);
  $stmt->execute([':user'=>$user]);
  $result=$stmt->fetchall();
  if (count($result)>0) {
    return 1;
  }else {
    return 0;
  }
}
?>
