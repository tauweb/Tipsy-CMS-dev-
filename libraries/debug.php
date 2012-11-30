<?php
/**
 * Класс отладки системы и вывода отладочной информации.
 *
 */
abstract class TDebug
{
	/**
	 * @var	array	Контейнер содержащий отладочные сообщения.
	 */
	public static $messages = array();
	
	/**
	 * Метод добавляющий сообщения отладки в контейнер сообщений.
	 * @var	$message	Сообщение отладочной информации для добавления.
	 * @var	$from		Имя метода, из которого пришло сообщение
	 *
	 */
	public static function AddMessage($message, $from = '')
	{
		self::$messages[] = '<font color ="red">' . $from . '    </font>' . $message . '<p>';
	}
	
	/**
	 * Метод получающий и выводящий сообщения отладки из модуля на страницу.
	 *
	 */
	 public static function getDebugMsg()
	{   // Проверяет наличие сообщений в массиве и настройки вывода сообщений в конфиге.
		if(!empty(self::$messages) and TConfig::$debug)
		{
			// Формирует Заголовок раздела отладки.
			echo '<b>DEBUG MESSAGE: </b>';
			// Перебирает сообщения и построчно выводит их на страницу.
			foreach (self::$messages as $DebugMessages) {
				echo $DebugMessages;
			}
			// Выводит разделительную черту после сообщений.
			echo '<HR>';
		}
	}
}
?>