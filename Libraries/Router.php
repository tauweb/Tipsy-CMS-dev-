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
	 * @var array Возможные параметры URL строки.
	 */
	protected static $urlParam = array(
								"com" => "",
								"param" =>"",
	);

	/**
	 * Метод определяющий и перенаправляющий управление компоненту системы.
	 *
	 * @return bool
	 */
	public static function getURL()
	{
		// Проверяет наличие переменных в URL.
		if(empty($_GET))
			return false;

		if(!isset($_GET['com']))
			return false;

		self::$urlParam = &$_GET;

		// Формирует название компонента, который привязан к позиции шаблона.
		$com = ucfirst(self::$urlParam['com']);
		// Формирует имя пространста имен компонента.
		$com = "\\Tipsy\\Components\\$com\\$com";

		$com::init(self::$urlParam['param']);

		Loader::autoload($com);
		if(method_exists($com, 'init')){
			$com::init();
		}else{
			Debug::AddMessage("Страница $com не найдена", __CLASS__);
		}
	}
}