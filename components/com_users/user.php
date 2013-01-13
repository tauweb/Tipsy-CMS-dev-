<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();
/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class TUser
{
	/**
	 * Метод выполняющий авторизацию пользователя (перенаправляет на класс авторизации)
	 */
	public static function login()
	{
		TLoader::load('TUserLogin');
		TUserLogin::login();
	}

	/**
	 * Метод инициализации. Проверяет состояние пользователей.
	 *
	 */
	public static function init()
	{
		// Проверяет нет ли авторизованных пользователей
		if(!isset($_SESSION['user'])){
			self::login();
		}else{
			echo 'Вы уже авторизованы как' . $_SESSION['user'];
			return true;
		}
	}
}
?>