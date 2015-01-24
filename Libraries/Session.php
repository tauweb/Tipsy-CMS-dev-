<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Debug;
use Tipsy\Config\Config;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Класс управления сессиями
 */
abstract class Session
{   /*
    * Метод проверяющий существует ли сессия, если сессия не активна - начинает новую.
    * @returns	true если сессия существует или запущена.
    */
	public static function check(){
		if(!session_id()){
			session_start();
			return true;
		}
	}

	/**
	 * [[Description]]
	 * @param  [[Type]] $sessionName [[Description]]
	 * @return boolean  [[Description]]
	 */
	public static function start($sessionName)
	{
		// Если было получено имея сессии и если еще не используется, то запускает новую сессию
		if (!empty($sessionName) && !isset($_SESSION['user']))
		{
			if($sessionName == isset($_SESSION['user']))
			return true;

			// Имя пользователя сесии
			$_SESSION['user'] = $sessionName;
			
			// Количество посещений пользователя, общее или после чистки куки
			empty($_SESSION['count'])
					? $_SESSION['count'] = 1
					: $_SESSION['count']++;
							
		// Добавляет сообщение в сообщения отладки системы
		Debug::AddMessage("Страница показана <b>" . $_SESSION['count'] .
			"</b> раз за время сессии" . ' (' . Config::$sessionLifetime . ' мин)');
		}
	}
}
?>