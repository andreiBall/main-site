<div class="main">
	<?php foreach ($articles as $article) { ?>
		<a id="ramka" href="<?=$article->link?>"><p id="data">Опубликованно: 
		<?=$article->date?> | Автор:Баль Г.П.</p><h3><?=$article->title?></h3>
		<?=$article->intro?>
		<p id="data"><?=$article->count_comments?> <?=$article->count_comments_text?></p>
			</a>
			<br />
	<?php } ?>
	<?php if ($more_articles) { ?>
	<h4>Ещё статьи...</h4>
	<?php foreach ($more_articles as $article) { ?>
				<div class="category_item">
					<a href="<?=$article->link?>"><?=$article->title?></a>
					<div class="category_author"><img src="/images/icon_user.png" alt="" /> Георгий Баль</div>
					<div class="clear"></div>
				</div>
	<?php } ?>
	<?php } else { ?>
		<?=$pagination?>
	<?php } ?>
</div>