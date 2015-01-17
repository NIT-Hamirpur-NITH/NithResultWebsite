<button class="btn btn-info " id="add_like"> Like me-->  <span id="likes"></span></button>

<script>
  function showLikes() {
    var likes = document.getElementById("likes");
    var commentTo = document.getElementById("comment_to").textContent.trim();
    var data = {
      "roll" : commentTo
    }
    $.post("fetch_likes.php", data, function(returnedData) {
      likes.innerHTML = returnedData;
    });
  }

  function needToAddLike() {
    var commentTo = document.getElementById("comment_to").textContent.trim();
    var data = {
      "roll" : commentTo
    }
    if(commentTo !== "") {
      $.post("add_likes.php", data, function(returnedData) {
        console.log(returnedData);
        showLikes();
      });
    }
    showLikes();
  }
</script>
