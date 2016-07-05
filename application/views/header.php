<!DOCTYPE html>
<html>
	<head>
		<title>Discuss</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

		<!-- Select 2-->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

		<link rel="stylesheet" href="/static/css/custom.css">
	</head>
<body>
	<div id="div-ask-question">
		<!--<a href="/index.php/question/showquestionform" id="a-ask-question">ASK QUESTION</a>-->
<!--<span class="jsAction" id="ask-question">ASK QUESTION</span>-->
	</div>

	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="/index.php/userhome" target="_blank">Discuss.io</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <!--<ul class="nav navbar-nav">
	        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
	        <li><a href="#">Link</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="#">Action</a></li>
	            <li><a href="#">Another action</a></li>
	            <li><a href="#">Something else here</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">Separated link</a></li>
	            <li role="separator" class="divider"></li>
	            <li><a href="#">One more separated link</a></li>
	          </ul>
	        </li>
	      </ul> -->
	      <form class="navbar-form navbar-left" id="navBarSearchForm" method="GET" action="/index.php/search/getresults" role="search">
	        <div class="form-group">
	          <input type="text" name="query" class="form-control" id="searchfield" placeholder="Search">
	          <input type="hidden" name="value" class="form-control" id="hiddensearchinput">
	        </div>
	        <button type="submit" class="btn btn-default">Submit</button>
	      </form>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="/index.php/userprofile/showprofile" target="_blank"><?php echo $_SESSION['firstname'];?></a></li>
			<li><a data-toggle="modal" data-target="#question-modal">Ask Question</a></li>
			<li><a href="/index.php/userhome/logout">Logout</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<!-- Modal -->
	<div id="question-modal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">New Question</h4>
	      </div>
	      <form method="POST" action="/index.php/question/postquestion" id="question_form">
		      <div class="modal-body">
		        <!--<input class="noEnterSubmit" type="text" id="answer_content" onsubmit="return false;" placeholder="Enter your answer here :") />-->
		        <label for="question_title">Title: </label><input type="text" name="question_title" id="question_title" class="form-field" /><br/>
		        <div id="error-question-title"></div>
		        <label for="question_content">Question: </label><textarea name="question_content" placeholder="Enter your question here" id="question_content" class="content"></textarea><br/>
		        <div id="error-question-content"></div>
		        <label for="question_tags">Tags: </label>
		        <select style="width:100%;" name="tag_select[]" class="form-control" id="tag_select" multiple>
		        	<option value=""></option>
		        </select>
		        <div id="error-question-tags"></div><br/>
		      </div>
		      <div class="modal-footer">
		        <!--<button type="submit" class="btn btn-default" data-dismiss="modal" id="post-question-button">Post</button>
		        <input type="submit" id="post-question-button"  class="btn btn-default" data-dismiss="modal" value="Post">-->
		        <button type="button" id="post-question-button"  class="btn btn-default" >Post</button>
		      </div>
		  </form>    
	    </div>

	  </div>
	</div>
	<div id="result-question"></div>
