<!DOCTYPE html>
<html>
<?=$header?>
<body >
<div id="conteiner2">
	<div id="kruk">
		<div class="forkit-curtain" style="top: 100%;">
			<div class="close-button"></div>			
			<div id="foto_otca"></div>
			<div id="content_otca">
				<p id="zv">* * *</p>
				<p>Боюсь я утром в зеркало смотреть,</p><p>Так надоела своя рожа.</p><p>Орет противно на дворе</p>
				<p>То ли сорока, то ли ронжа,</p><p>Встает рассвет уныло-сер</p><p>И лампа светит в полнакала.</p>	
				<p> Я сам себе так надоел,</p><p>Вчера пол-литра было мало.</p><p id="zvz">1997г.</p>
			</div>
		</div>
		<a class="forkit" ></a>
	<script src="js/forkit.js"></script>
	</div>
	<div id="header"></div>
	<div id="header1" class="maxw">
		<div id="header2">
			<div id="menu">
				<ul>
					<?=$top?>
				</ul>	
			</div>
		</div>
		<div id="header4">
			<?=$auth?>
				<ul>
					<a href="#top"><li id="menu_top_Li">
						<img alt="Вверх" id="menu_top2" src="/images/decor/top2.png">
						<img alt="Вверх" id="menu_top1" src="/images/decor/top.png">
					</li></a>
					<a href="/"><li id="menu_home_Li">
						<img alt="Домой" id="menu_home2" src="/images/decor/home2.png">
						<img alt="Домой" id="menu_home1" src="/images/decor/home.png">
					</li></a>
					<a href="#bottom"><li id="menu_buttum_Li">
						<img alt="Вниз" id="menu_buttum2" src="/images/decor/buttum2.png">
						<img alt="Вниз" id="menu_buttum1" src="/images/decor/buttum.png">
					</li></a>
				</ul>
		</div> 
		<div id="article"></div>	
	</div>	
	<div id="conteiner" >
		<span id="left">
			<div id="search">
				<form name="search" action="<?=$link_search?>" method="get">
				<input type="submit" value="" id="search_btn"/>
					<input type="text" id="search_fld"  name="query" placeholder="Поиск" />
					
				</form>
			</div>
			<div id="poisk"></div>
			<div id="left"><?=$left?></div>
		</span>
		<span id="center">
			<div id="center"><?=$center?></div>
			<div class="clear"></div>
		</span>
		<span id="right"></span>
	</div><a name="bottom"></a>
</div>
	<div id="footer"></div>
</body>
</html>