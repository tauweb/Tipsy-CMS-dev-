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

/**
 *Контейнер содержащий ошибки системы.
 * @var	attay
 */
public static $Errors = array();

/**
 * Контейнер содержащий отладочные сообщения системы.
 * @var	array
 */
public static $DebugMessages = array();

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