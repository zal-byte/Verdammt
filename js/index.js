$("#profile").on("click", function(){
  $("#body-response").load("layout/profile_layout.php");
});
$("#home").on("click", function(){
  
  getPost();
});

$("#new-post").on("click", function(){
  $("#body-response").load("layout/new_post_layout.php");
});

function postLike(post_id, my_username){
  var param = '?request=postLike&post_id=' +post_id+ '&my_username=' + my_username;
  $.ajax({
    type:'GET',
    url:'http://localhost/verdammt/post.php' + param,
    success:function(res){
      var json = JSON.parse(res);
      
      if(json[0] == true){
        getPost();
      }else{
        alert(json[1]);
      }
    }
  });
  
}



function getPost(){

  var page = $("#page").val();
  var limit = $("#limit").val();

  var header = {"User-Agent":"blyat"};
  $.ajax({
    type:'GET',
    header:header,
    url:'http://localhost/verdammt/post.php?request=getPost&page=' + page + '&limit=' + limit,
    success: function( result )
    {
      $("#body-response").html(result);
    }
  });
}