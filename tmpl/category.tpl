<div class="main">
	<?php if (count($articles)) { ?>
		<?php $number = 0; foreach ($articles as $article) { $number++; ?>
			<a id="ramka" href="<?=$article->link?>"><p id="data">Опубликованно: 
				<?=$article->date?> | Автор:Баль Г.П.</p><h3><?=$article->title?></h3>		
				<?=$article->intro?>
				<p id="data">Комментарии <?=$article->count_comments = CommentDB::getCountOnArticleID($article->id);?> </p>
			</a>
			<br />
		<?php } ?>
	<?php } else { ?>
		<h2>Материалов пока нет.</h2>
	<?php } ?>
</div>