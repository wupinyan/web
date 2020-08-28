<script src="jquery/jquery-3.4.1.min.js"></script>
<script>
  $.get('test2.php',function(data){
    var object=JSON.parse(data);
    for (var variable in object) {
      console.log(object[variable]);
    }
  })
</script>
