<?php
require '../functions/identity.php';
try {
  $res=identity_check();
  echo $res;
} catch(\RuntimeException $e){
  echo 'connentError';
} catch (\Exception $e) {
  echo 'passwordError';
}

?>
