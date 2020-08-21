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
$error_message='';
setcookie('have_cookie',1);
try {
  require 'functions/identity.php';
  identity_check();
  $allow_in=1;
} catch(\UnexpectedValueException $e){
  $error_message=$e->getMessage();
} catch (\Exception $e) {}
?>
