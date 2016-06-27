<?php
defined('BASEPATH') or exit('No direct access to script allowed');
?>

<div id='question-form'>
	<form>
		<label for='question-title'>Title </label><input type="text" name="question-title" id="question-title"><br/><br/>
		<div id="error-question-title"></div>
		<label for='question-content'>Question </label><input type="text"  name="question-content" id="question-content"><br/><br/>
		<div id="error-question-content"></div>
		<label for='question-tags'>Tags</label><input type="text" name="question-tags" id="question-tags"><br/><br/>
		<div id="error-question-tags"></div>
		<button type="button" id="post-question-button">POST QUESTION</button>
	</form>
	<div id="question-response"></div>
</div>
