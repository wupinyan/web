<script src="jquery/jquery-3.4.1.min.js"></script>
<script>
  var paramiters={'x':5};
  $('document').ready(function(){
    $.get('test2.php',paramiters,function(data,status){
      if (status=='success') {
        console.log(data);
      }else {
        console.log('err...');
      }
    })
  })
</script>
