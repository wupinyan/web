<?php
function display_foot($error_message){
  $x=$error_message;
  ?>
  <footer>
    <h1>頁底</h1>
  </footer>
</body>
</html>
<script>
var x=<?php echo $x ?>;
console.log(x);
</script>
  <?php
}
?>
