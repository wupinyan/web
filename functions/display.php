<?php
function display_frame($content_path){
  $allow_in=0;
  $error_message='';
  $form_path='../form.php';
  setcookie('have_cookie',1);
  try {
    require 'identity.php';
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
        #logout{display:none;}
      </style>
      <script src="jquery/jquery-3.4.1.min.js"></script>
    </head>
    <body>
      <header>
        <h1>頁頂</h1>
        <a href='home.php'><button id="logout">登出</button></a>
      </header>
  <?php
  if ($allow_in==1) {
    $file=pathinfo($content_path,PATHINFO_BASENAME);
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
  $(document).ready(function(){
    if (allow_in==1) {
      $('#logout').css('display','inline-block');
      $('#logout').click(function(){
        <?php
        $_SESSION['allow_in']=0;
        ?>
      });
    }
  })
  </script>
  <?php
}
?>
