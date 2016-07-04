"><?php foreach ($tags as $tag) { ?>
		<div class="row" style="margin-left:10px">
			<input type="checkbox" name="tag" value="<?php echo $tag['tag_id']; ?>"><?php echo $tag['tag_name'].'('.$tag['user_count'].')'; ?>
		</div>
		<div class="partition" style="width:98%"></div>
	<?php } ?>
</div>