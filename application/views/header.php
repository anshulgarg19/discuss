<html>
	<head>
		<title>Discuss</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	</head>
<body>
	<div id="my-profile"><a href="/index.php/userprofile/showprofile" target="_blank">My Profile  </a></div>
	<div id="my-home"><a href="/index.php/userhome" target="_blank">Home  </a></div>
	<div id="div-ask-question">
		<!--<a href="/index.php/question/showquestionform" id="a-ask-question">ASK QUESTION</a>-->
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#question-modal">Ask Question</button>
<!--<span class="jsAction" id="ask-question">ASK QUESTION</span>-->
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript" src="/static/js/askquestion.js"></script>


	<!-- Modal -->
	<div id="question-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">New Question</h4>
	      </div>
	      <form>
		      <div class="modal-body">
		        <!--<input class="noEnterSubmit" type="text" id="answer_content" onsubmit="return false;" placeholder="Enter your answer here :") />-->
		        <label for="question_title">Title: </label><input type="text" name="question-title" id="question-title"/><br/>
		        <div id="error-question-title"></div>
		        <label for="question_content">Question: </label><textarea name="text1" placeholder="Enter your question here" id="question_content"></textarea><br/>
		        <label for="question_tags">Tags: </label><input type="text" name="question-tags" id="question-tags"/><br/>
		        <div id="error-question-tags"></div><br/>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal" id="post-question-button">Post</button>
		      </div>
		  </form>    
	    </div>

	  </div>
	</div>
	<div id="result-question"></div>