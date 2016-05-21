<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/mycustom.css" />


<h3 class="text-info">Comments</h3 >


<div class="row">
	<div class="span8" id="comment_box">
		<input type="text" id="commenter" class="span7 form-search" name="from" placeholder="Name" required> </input></br>
			<textarea class="span7" id="comment" name="comment" cols="" rows="5" placeholder="Comment" required></textarea></br>
			<button class="btn btn-info" id="add_comment">Submit</button> <br />
	</div>
</div>
<br />
<div class="row">
	<div class="span9" id="comments"> </div>
</div>

<script>

	function showComment() {
		var commentTo = document.getElementById("comment_to").textContent.trim();
		var data = {
			"roll" : commentTo
		}
		$.post("fetch_comment.php", data, function(returnedData) {
			var comments = document.getElementById("comments");
			comments.style.marginLeft = "0px";
			comments.id = "comments";
			comments.innerHTML = returnedData;
		});
	}

	function needToAddComment(event) {
		var commenter = document.getElementById("commenter");
		var comment = document.getElementById("comment");
		var commentTo = document.getElementById("comment_to");
		if(comment.value !== "" && commenter.value !== "") {
			var data = {
				"roll" : commentTo.textContent.trim(),
				"comment" : comment.value,
				"commenter" : commenter.value
			}
			$.post("add_commnet.php", data, function(returnedData) {
				console.log(returnedData);
				showComment();
			});
		}
		showComment();
	}
</script>
