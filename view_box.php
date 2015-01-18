<br />
<button class="btn btn-info " id="add_like"> Views <span id="views"></span></button>

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
