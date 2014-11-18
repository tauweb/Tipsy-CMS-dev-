<?php
namespace Tipsy\Components\User;

use Tipsy\Libraries\Loader;
use Tipsy\Components\User\UserLogin;
use Tipsy\Libraries\Database\Query;
use Tipsy\Libraries\Session;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * User: whiskeyman
 * Date: 08.11.12
 * Time: 17:32
 */
abstract class User
{
	static $template = '';

	/**
	 * Метод инициализации. Проверяет состояние пользователей.
	 *
	 */
	public static function init($method='')
	{
		if(!empty($method)){
			return self::$method();
		}

		// Проверяет нет ли авторизованных пользователей
		if(!isset($_SESSION['user'])){

			// Если нет - возвращает форму выбора действий.
			return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR .'tmpl'. DIRECTORY_SEPARATOR . 'tmpl_choise.php');
		}else{
			Loader::loadClass('\Components\User\UserLogout');
			return "Привет  ". $_SESSION['user'] . "<a href=\"?component=\\Components\\User\\UserLogout\">Выйти</a>";
		}
	}

	protected static function getTemplate($tmpl = 'tmpl_default.php')
	{
		ob_start();
		require_once __DIR__ . DIRECTORY_SEPARATOR .'tmpl'. DIRECTORY_SEPARATOR . $tmpl;
		$tmpl = ob_get_contents();
		ob_end_clean();
		self:$template = $tmpl;

	}

	/**
	 * Метод выполняющий авторизацию пользователя (перенаправляет на класс авторизации)
	 */
	protected static function login()
	{
		if(!self::$template){
			// Подключает шаблон формы авторизации пользоватея.
			$tmpl = self::getTemplate();
			if(!isset($_POST['name']))
				return 'Введите имя пользователя';
		}

		//Создает которткие имена переменных формы.
		$user =  $_POST['name'];
		$password = $_POST['password'];

		// Строка запроса к БД, выбирающая данные о пользователе.
		$query = "SELECT `username`, `password` FROM `users` WHERE username = \"" . $user . "\";";

		$table = Query::select($query);
		Session::start($table['username']);

		header("Location: ./");
		#return 'Вы вошли как: ' . $_SESSION['user'];
	}
}