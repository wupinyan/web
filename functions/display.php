<?php
function display_frame($content_path){
  $allow_in=0;
  $error_message='';
  $file=pathinfo($content_path,PATHINFO_BASENAME);
  $form_path='../login_form.php';
  if ($file=='registered.php') {
    $form_path='../registered_form.php';
  }
  setcookie('have_cookie',1);
  try {
    require 'identity.php';
    identity_check();
    $allow_in=1;
  } catch(\Exception $e){
    $error_message=$e->getMessage();
  }
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title></title>
      <style>
        h1{display: inline-block;margin-right: 20px}
        #logout,#registered{display:none;}
      </style>
      <script src="jquery/jquery-3.4.1.min.js"></script>
    </head>
    <body>
      <header>
        <h1>頁頂</h1>
        <a href='home.php'><button id="logout">登出</button></a>
        <a href='registered.php'><button id="registered">註冊</button></a>
      </header>
  <?php
  if ($allow_in==1) {
    require "../".$file;
  }else {
    require $form_path;
    if (!empty($error_message)) {
      echo "<div>$error_message</div>";
    }
  }
  ?>
    <footer>
      <h1>頁底</h1>
    </footer>
  </body>
  </html>
  <script>
  var allow_in=<?php echo $allow_in ?>;
  $('document').ready(function(){
    if (allow_in==1) {
      $('#logout').css('display','inline-block');
      $('#logout').click(function(){
        
      })
      $('#registered').css('display','inline-block');
    }
  })
  </script>
  <?php
}
?>
