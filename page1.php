<?php
require_once 'functions/display.php';
$nav_pages=display_navPages(__FILE__);
$nav_pages=json_encode($nav_pages);
echo "<h1>".pathinfo(__FILE__,PATHINFO_FILENAME)."</h1>";
?>
<p>頁面表</p>
<ul>
</ul>
<script src="jquery/jquery-3.4.1.min.js"></script>
<script>
  var new_pages='<?php echo $nav_pages ?>';
  $('document').ready(function(){
    new_pages=JSON.parse(new_pages);
    for (let i in new_pages) {
      let page=new_pages[i];
      $('ul').append('<a href="'+page+'.php"><li>'+page+'</li></a>')
    }
  })
</script>
