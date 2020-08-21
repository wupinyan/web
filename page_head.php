<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <header>
      <h1>頁頂</h1>
    </header>
<?php
$allow_in=0;
$passwordError=0;
$connentError=0;
setcookie('have_cookie',1);
try {
  require 'functions/identity.php';
  
} catch(\RuntimeException $e){
  $connentError=1;
} catch (\Exception $e) {
  $passwordError=1;
}
?>
