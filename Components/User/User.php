<?php
namespace Tipsy\Components\User;

use Tipsy\Libraries\Loader;
use Tipsy\Components\User\UserLogin;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();
/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class User
{
	/**
	 * Метод инициализации. Проверяет состояние пользователей.
	 *
	 */
	public static function init($param='')
	{echo $param;
		// Проверяет нет ли авторизованных пользователей
		if(!isset($_SESSION['user'])){
			return "<a href=\"?com=user&param=LOGIN\">Вход </a>" .
					"<a href=\"?com=user&param=test\"> Регистрация</a>".
					"<a href=\"?comt=user&param=test&test=tester\"> test</a>";
		}else{
			Loader::autoload('\Components\User\UserLogout');
			echo "Привет  ". $_SESSION['user'] . "<a href=\"?component=\\Components\\User\\UserLogout\">Выйти</a>";
			return true;
		}
	}

	/**
	 * Метод выполняющий авторизацию пользователя (перенаправляет на класс авторизации)
	 */
	public static function login()
	{

	}
}