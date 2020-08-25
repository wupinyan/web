<?php
$user='g';
$password='7';
require '../functions/database.php';
try {
  $db=database_connect();
  $paramiters=[':user'=>$user,':password'=>$password];

  $command="select *
            from identity
            where user=:user";
  $stmt=$db->prepare($command);
  $stmt->execute($paramiters);
  $result=$stmt->fetchall(PDO::FETCH_ASSOC);
  if (count($result)==1) {
    throw new \Exception('重複');
  }
  echo "err1..<br>";
  $command="insert into identity
            values(0,:user,:password)";
  $stmt=$db->prepare($command);
  $stmt->execute($paramiters);

} catch (\Exception $e) {
  echo "err..<br>";
  // echo $e->getMessage();
}

?>
