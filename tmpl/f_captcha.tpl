<div>
	<label for="<?=$input->name?>">Введите код с картинки:</label>
	<input id="form_reg" autocomplete="off" type="text" name="<?=$input->name?>" id="<?=$input->name?>" <?php include "jsv.tpl"; ?> />
</div>
<div class="captcha">
	<img src="/images/decor/update.png" alt="Обновить" />
	<img src="captcha.php" alt="Капча" />
</div>