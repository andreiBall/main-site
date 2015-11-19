<nav>
	<ul >
		<?php foreach ($items as $item) { ?>
		<a <?php if ($item->link == $uri) {  ?>class="active"<?php } ?> 
		<?php if ($item->external) { ?>rel="external"<?php } ?> 
	
		<?php switch ($item->link ) {
		case ('/section?id=7'==$item->link) : ?>
					href="<?=$item->link?>"><li id="newLi">
						<img alt="Новости" id="new2" src="/images/decor/new2.png">
						<img alt="Новости" id="new1" src="/images/decor/new1.png">
					</li></a> <?php ;?>
		<?php 		break; 
		case ('/section?id=1'==$item->link) : ?>
					href="<?=$item->link?>"><li id="stixiLi">
						<img alt="Стихи" id="stixi2" src="/images/decor/stixi2.png">
						<img alt="Стихи" id="stixi1" src="/images/decor/stixi1.png">
					</li></a><?php ;?>
		<?php 		break; 
		case ('/section?id=2'==$item->link) : ?>
					href="<?=$item->link?>"><li id="prozaLi">
						<img alt="Проза" id="proza2" src="/images/decor/proza2.png">
						<img alt="Проза" id="proza1" src="/images/decor/proza1.png">
					</li></a><?php ;?>
		<?php 		break; 
		case ('/section?id=3'==$item->link) : ?>
					href="<?=$item->link?>"><li id="garciLi">
						<img alt="Жарки" id="garci2" src="/images/decor/garci2.png">
						<img alt="Жарки" id="garci1" src="/images/decor/garci1.png">
					</li></a><?php ;?>
		<?php 		break; 
		case ('/section?id=4'==$item->link) : ?>
					href="<?=$item->link?>"><li id="fotogalLi">
						<img alt="Фотогалерея" id="fotogal2" src="/images/decor/fotogal2.png">
						<img alt="Фотогалерея" id="fotogal1" src="/images/decor/fotogal1.png">
					</li></a><?php ;?>
		<?php 		break; 
		case ('/section?id=5'==$item->link) : ?>
					href="<?=$item->link?>"><li id="forumLi">
						<img alt="Форум" id="forum2" src="/images/decor/forum2.png">
						<img alt="Форум" id="forum1" src="/images/decor/forum1.png">
					</li></a><?php ;?>
		<?php 		break; 
		case ('/section?id=6'==$item->link) : ?>
					href="<?=$item->link?>"><li id="avtorLi">
						<img alt="Автор" id="avtor2" src="/images/decor/avtor2.png">
						<img alt="Автор" id="avtor1" src="/images/decor/avtor1.png">
					</li></a><?php ;?>
		<?php 		break; 
		} ?>
		<?php } ?>
	</ul>
</nav>


			
			
			
		