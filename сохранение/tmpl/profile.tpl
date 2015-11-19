<div class="main">
	<?php if (isset($hornav)) { ?><?=$hornav?><?php } ?>	
	<div id="profile_avatar">
		<h2>Изменить аватар</h2>
		<div class="avatar_foto">
			<img src="<?=$avatar?>" alt="Аватар" />
		</div>
		<div class="avatar_info">
			<p>Допустимые форматы - <b>GIF</b>, <b>JPG</b>, <b>PNG</b></p>
			<p>Размер изображения должен быть <b>не более <?=$max_size?> КБ</b>!</p>
		</div>
		<?=$form_avatar?>
	</div>
	<div id="profile_name">
		<?=$form_name?>
	</div>
	<div id="profile_password">
		<?=$form_password?>
	</div>	
</div>