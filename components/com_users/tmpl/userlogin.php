<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 29.11.12
 * Time: 15:03
 */
abstract class TUserLogin
{
	public static function login()
	{
		self::getTemplate();
	}

	protected static function getTemplate()
	{
		$tmpl = require_once __DIR__ . DIRECTORY_SEPARATOR . 'tmpl_default.php';

	}

	protected static function checkUser()
	{
		if(empty($_POST['name'])) return false;

		$query = "SELECT `username` FROM `users` WHERE username = \"" . $_POST['name']. "\";";
		$table = TQuery::query($query);

		echo 'Вы вошли как: ' . $_POST['name'];
		return true;
	}
}
?>