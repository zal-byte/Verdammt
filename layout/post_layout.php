<?php ini_set('display_errors', 1);?><style>
  .date{
    font-size: 10px;
  }
  .time{
    font-size: 10px;
  }
  .right{
    float: right;
  }
  .left{
    float: left;
  }
  .user_name{
    font-size: 15px;
    color: black;
  }
  .usr_img{
    width: 32px;
    height:32px;
  }
  
  .circle{
    border-radius: 50px;
    border-width: 10px;
    border-color: black;
  }
  
  .btn_love{
    width: 30px;
    height: 30px;
    text-decoration: none;
    color:#f08f8f;
  }
  .btn_comment{
    width: 30px;
    height: 30px;
    text-decoration: none;
    color: #b8b6b6;
  }
  
  .btn_love:hover{
    color:red;
  }
  .btn_comment{
    color:gray;
  }
  .fix{
    position:fixed;
    
    width:100%;
    padding: 0;
  }
  .bottom{
    bottom:0;
  }
</style>
<input type="text" id="my_username" value="<?php echo $_SESSION['username'];?>" hidden>
<?php

for($i = 0; $i < count($status);$i++){
  ?>
  <input type="text" id="post_id_<?php echo $i;?>" value="<?php echo $status[$i]['post_id'];?>" hidden>

<div class="card shadow-sm mb-2">
  <div class="card-body">
    <b class="mb-2">
      <?php echo $status[$i]["name"];?>
    </b>
    <p>
      <?php
      $html = htmlspecialchars($status[$i]["post_content"]);
      echo $html;?>
    </p>
    <i class="date">
      <?php echo $status[$i]["post_date"];?>
    </i>
    <i class="time right">
      <?php echo $status[$i]["post_time"];?>
    </i>
    <hr>
    <a class="btn_love" id="btn_love" onclick="proc(<?php echo $i;?>)">
      <span class="fa-2x fa fa-heart">10</span>
      <b id='post_likes' style='color:black'>
        <?php echo $status[$i]['post_likes'];?>
      </b>
    </a>
    <a class="btn_comment">
      <span class="fa-2x fa fa-comment"></span>
    </a>

    <img class="circle right usr_img img-responsive" src="img/user/default.jpg">
  </div>
</div>
  <?php
}

?>
<div class="bottom">
  <button onclick="previous()" style="width:100px;" class="text-white btn btn-block btn-info left">
    Previous
  </button>
  <button onclick="next()" style="width:100px;" class="text-white btn btn-block btn-info right">
    Next
  </button>
</div>
<script type="text/javascript">
  function proc( identifier ){
    
    var username = $("#my_username").val();
    var post_id = $("#post_id_"+identifier).val();
    
    postLike(post_id, username);
  }
  
  function next(){
    var pages = parseInt($("#page").val()) + 1;
    $("#page").val(pages);
    getPost();
  }
  function previous(){
    var pages = parseInt($("#page").val()) - 1;
    $("#page").val( pages );
    
    getPost();
  }
</script>