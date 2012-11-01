<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы Tipsy CMS
 * По возможности здесь будет реализовываться API
 *
 */
class TApplication
{
//Тестовая часть библиотеки

public static $Errors = array();

public static $DebugMessages = array();

//=========
	
	
	/**
	 * Метод запускающий формирование страцы
	 *
	 */
	public function run()
	{
		// Подключает библиотеку формирующую страницы html
		TLoader::load('TDocument');

		try {
			// Создает объект формирующий страницу html
			$TDocument = new TDocument();
		} catch (TRuntimeException $e) {
		}
	}
}

?>