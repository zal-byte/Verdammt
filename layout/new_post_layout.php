<?php session_start();?>
<div class="card shadow-sm border-0">
  <div class="card-body">
    <div class="form-group">
      <input type="text" id="username" value="<?php echo $_SESSION['username'];?>" hidden>
      <textarea id="post_content" class="form-control" rows="5" placeholder="Content"></textarea>
      
      <button style="width:100%;" class="btn btn-block bg-info text-white mt-2" id="submit">Submit</button>
      
    </div>
  </div>
</div>

<script>
  $("#submit").on("click", function(){
    var post_content = $("#post_content").val();
    var username = $("#username").val();
    
    param = "post_content=" + post_content +"&username=" + username +"&request=newPost";
    
    send( param );
  });
  function send( param ){
    $.ajax({
      type:'POST',
      data:param,
      url:'http://localhost/verdammt/post.php',
      success:function(res){
        var json = JSON.parse(res)[0];
        if( json.status == true ){
          //$("#body-response").html('<input id="page" value="0"><input id="limit" value="10">');
          getPost($("#page").val(), $("#limit").val());
        }else{
          alert(json.msg);
        }
      }
    });
  }
</script>