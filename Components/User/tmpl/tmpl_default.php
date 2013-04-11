<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 29.11.12
 * Time: 15:20
 */
?>
<div form_login>
	<form action="./" method="post"  class="login_form">
		Имя:	<input type="text" name="name" />
		Пароль:	<input type="text" name="password" />
		<button type="submit">Войти</button>
	</form>
</div>