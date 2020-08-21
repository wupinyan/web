<?php
require '../functions/identity.php';
try {
  $res=identity_check();
  echo 'success<br>';
} catch(\UnexpectedValueException $e){
  echo 'passwordError';
} 
echo "11111";
?>
