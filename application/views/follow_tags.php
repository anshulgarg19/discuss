<div id="body" class="container">
	
		<div class="col-md-offset-1">
			<p>
				<h2><center>Choose at least 3 tags you want to follow</center></h2>
					<form>
						<div id="tag_details" style="overflow-y:auto;height:300px;overflow-x:hidden;">
							<div id="tags-0">
								<?php foreach ($tags as $tag) { ?>
									<!--<div class="badge" style="margin:10px">-->
									<div class="row" style="margin-left:10px">
										<input type="checkbox" name="tag" value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['tag_name'].'('.$tag['user_count'].')'; ?>
									</div>
									<div class="partition" style="width:98%"></div>
								<?php } ?>
							</div>
						</div>
						<center><button id="submit" type="button" value="Submit">Continue</button></center>
					</form>
					<!--<pre id="result"></pre>-->
			</p>
		</div>
	
</div>

<script type="text/javascript" src="/static/js/followtags.js"></script>