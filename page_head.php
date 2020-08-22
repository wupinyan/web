<?php
function display_head(){
  $allow_in=0;
  $error_message='aaa';
  setcookie('have_cookie',1);
  try {
    require 'functions/identity.php';
    identity_check();
    $allow_in=1;
  } catch(\UnexpectedValueException $e){
    $error_message=$e->getMessage();
  } catch (\Exception $e) {}
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title></title>
      <style>
        h1{display: inline-block;margin-right: 20px}
      </style>
    </head>
    <body>
      <header>
        <h1>頁頂</h1><span>456</span>
      </header>
  <?php
  return $error_message;
}
?>
