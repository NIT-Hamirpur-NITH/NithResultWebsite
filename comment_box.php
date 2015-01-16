<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/mycustom.css" />

<div class="row">
	<div class="span8 offset1">
		<h3 class="text-info">Comment here...	</h3 >
	</div>
</div>

<div class="row">
	<div class="span8 offset1" id="comment_box">
		<div id="comments"></div>
		<input type="text" id="commenter" class="input-medium" name="from" value="Your name here...."> </input></br>
		<textarea id="comment" name="comment" cols="25000" rows="3">Write your message here....</textarea></br>
		<button class="btn btn-info" id="add_comment">Submit</button>
	</div>
</div>

<script>
	function showComment() {
		var commentTo = document.getElementById("comment_to").textContent.trim();
		var data = {
			"roll" : commentTo
		}
		if(commentTo !== "") {
			$.post("fetch_comment.php", data, function(returnedData) {
				var comments = document.getElementById("comments")
				comments.id = "comments";
				comments.innerHTML = returnedData;
			});
		}
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
			});
		}
		showComment();
		showComment();
	}
</script>
