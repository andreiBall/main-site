<div id="auth">
	<form  name="auth" action="<?=$action?>" method="post">
		<input type="submit" name="auth" value="." />
		<div id="login2"><input type="text"  name="login" placeholder="Логин" id="form_inp1"/></div>
		<div id="password2"><input type="password" name="password" placeholder="Пароль" id="form_inp2"/></div>
	</form>
	<a href="<?=$link_register?>" ><div id="regDiv">
		<img alt="Регистрация" id="reg2" src="/images/decor/reg2.png">
		<img alt="Регистрация" id="reg1" src="/images/decor/reg1.png">
	
	</div></a>
	<?php if ($message) { ?>
		<span class="message"><?=$message?>
			<a class="link_reset" href="<?=$link_reset?>">Забыли пароль / </a>
			<a class="link_reset" href="<?=$link_remind?>">логин?</a>
		</span>
	<?php } ?>
</div>