<?php
namespace Tipsy\Libraries;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс путями в адресной строке.
 */
abstract class Router
{
	/**
	 * Метод определяющий и перенаправляющий управление компоненту системы. todo: Переделать!
	 *
	 * @return bool
	 */
	public static function getURL()
	{
		// Проверяет наличие переменных в 
		if(empty($_GET['component'])){
			return false;
		}else{
			$com = $_GET['component'];
			
			Loader::autoload($com);
			if( method_exists($com,'init')){
				$com::init();
			}else{
				Debug::AddMessage("Страница $com не найдена", __CLASS__);
			}

		}
	}
}