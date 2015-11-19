<?php function printComment($comment, &$comments, $childrens, $auth_user) { ?>
	<div class="comment" id="comment_<?=$comment->id?>">
		<img src="<?=$comment->user->avatar?>" alt="<?=$comment->user->name?>" />
		<span class="date"><?=$comment->date?></span>
		<span class="name"><?=$comment->user->name?></span>
		<p class="text"><?=$comment->text?></p>
		<div class="clear"></div>
		<p class="functions"><span <?php if (!$auth_user) { ?>onclick="alert('Для добавления комментариев необходимо авторизоваться на сайте!')"
		<?php } else { ?>
		class="reply_comment"<?php } ?>> Ответить </span><?php if ($auth_user) { ?><?php if ($comment->accessEdit($auth_user, "text"))
		{ ?><span class="edit_comment"> Редактировать  </span> <?php } if ($comment->accessDelete($auth_user))
		{ ?><span class="delete_comment">  Удалить   </span><?php } ?><?php } ?>	
		</p>
		<?php
			while (true) {
				$key = array_search($comment->id, $childrens);
				if (!$key) break;
				unset($childrens[$key]);
		?>
			<?php if (isset($comments[$key])) { ?>
				<?=printComment($comments[$key], $comments, $childrens, $auth_user)?>
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>
<div class="main" >
	<?php if (isset($hornav)) { ?><?=$hornav?><?php } ?>
	<article oncopy="return false" unselectable="on">
		<h3><?=$article->title?></h3>
		<?php $full=$article->full?>
		<?php function get_page($full, $page_index, $line_length, $page_length){
			$lines = explode("\n", wordwrap($full, $line_length, "\n"));
			$page_lines = array_slice($lines, $page_index*$page_length, $page_length);
			return implode("\n", $page_lines);
		}
		$page_length =2000;
		$line_length = 1;
		$lines = explode("\n", wordwrap($full, $line_length, "\n"));
		$count_line = count($lines);
		$page_count = ceil( $count_line/$page_length);
		if(isset($_GET['page'])){
			$page = (int) $_GET['page'];
		}
		else{
			$page = 1;
		}
		echo $page_text = get_page($full, $page-1, $line_length, $page_length);
		echo '</br>';?>
		<div id="pagination">
			<?php if (($page_count-1) > 0) { ?>
				<?php if ($page > 1){
					$page = $page - 1;
					echo "<a href=$article->link&page=" . $page . " > Предыдущая </a> ";?>
				<?php } else { ?>
					<span>Предыдущая</span>
				<?php }?>
			<?php
			for ($page=1;$page<=$page_count;$page++){
				echo "<a href=$article->link&page=" . $page . " > ".$page." </a> "; 
			}
			if(isset($_GET['page'])){
				if($_GET['page'] <= ($page_count-1)) {
					echo "<a href=$article->link&page=" . ($_GET['page']+1) . " > Следующая </a> ";?>
				<?php } else { ?>
					<span>Следующая</span>
			<?php }}?>	
		<?php } ?>
		</div>
	</article>
	<div id="article_pn">
		<?php if ($prev_article) { ?><a id="prev_article" href="<?=$prev_article->link?>">Предыдущая статья</a><?php } ?>
		<?php if ($next_article) { ?><a id="next_article" href="<?=$next_article->link?>">Следующая статья</a><?php } ?>
		<div class="clear"></div>
	</div>
	<div id="comments">
		<h3>Комментарии</h3>
		<input type="button" value="Добавить комментарий" id="add_comment" <?php if (!$auth_user) { ?>onclick="alert
		('Для добавления комментариев необходимо авторизоваться на сайте!')"<?php } ?> />
		<?php foreach ($comments as $comment) { ?>
			<?php if ($comment->parent_id == 0) { ?><?=printComment($comment, $comments, $childrens, $auth_user)?><?php } ?>
		<?php } ?>
		<div class="clear"></div>
		<?php if ($auth_user) { ?>
			<div id="form_add_comment">
				<form name="form_add_comment" method="post" action="#">
					<div id="comment_cancel">
						<span>X</span>
					</div>
					<table>
						<tr>
							<td>
								<label for="text_comment">Комментарий:</label>
							</td>
							<td>
								<textarea cols="40" rows="5" name="text_comment" id="text_comment"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="hidden" value="0" name="comment_id" id="comment_id" />
								<input type="hidden" value="<?=$article->id?>" name="article_id" id="article_id" />
								<input type="hidden" value="0" name="parent_id" id="parent_id" />
								<input type="button" value="Сохранить" class="button" />
							</td>
						</tr>
					</table>
				</form>
			</div>
		<?php } else { ?>
			<p class="center2">Для добавления комментариев надо войти в систему.<br />Если Вы ещё не зарегистрированы на сайте, то сначала <a href="<?=$link_register?>">зарегистрируйтесь</a>.</p>
		<?php } ?>
	</div>
	<div id="share">
		<p>Порекомендуйте эту статью друзьям:</p>
		<script type="text/javascript">getSocialNetwork("<?=Config::DIR_IMG?>", "");</script><a name="bottom"></a>
	</div>
</div>
<script type="text/javascript">
		var api;

		jQuery(document).ready(function(){
			api = jQuery("#gallery").unitegallery();
		
		
			//those are the eventws you can use:
			
			api.on("item_change",function(num, data){		//on item change, get item number and item data
				
				if(console)
					console.log(data);
				//do something
			});
	
			api.on("resize",function(){				//on gallery resize
				//do something
			});
	
			api.on("enter_fullscreen",function(){	//on enter fullscreen
				//do something
			});
	
			api.on("exit_fullscreen",function(){	//on exit fulscreen
				//do something
			});
			
			api.on("play",function(){				//on start playing
				//do something
			});
	
			api.on("stop",function(){				//on stop playing
				//do something
			});
	
			api.on("pause",function(){				//on pause playing
				//do something
			});
	
			api.on("continue",function(){			//on continue playing
				//do something
			});
			
			
		});
			
			
	</script>


