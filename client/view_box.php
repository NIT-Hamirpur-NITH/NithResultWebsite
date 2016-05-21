<br />
<h4 class="text-info" id="add_like">Your Result Views -<span id="views"></span></h4>

<script>
  function showViews() {
    var views = document.getElementById("views");
    var commentTo = document.getElementById("comment_to").textContent.trim();
    var data = {
      "roll" : commentTo
    }
    $.post("fetch_views.php", data, function(returnedData) {
      console.log(returnedData);
      views.innerHTML = returnedData;
    });
  }

  function addViews() {
    var commentTo = document.getElementById("comment_to").textContent.trim();
    var data = {
      "roll" : commentTo
    }
    if(commentTo !== "") {
      $.post("add_views.php", data, function(returnedData) {
        console.log(returnedData);
        showViews();
      });
    }
    showViews();
  }
</script>
