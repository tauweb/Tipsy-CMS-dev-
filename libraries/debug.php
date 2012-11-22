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
	 * Метод получающий сообщения отладки из модуля.
	 *
	 */
	 public static function getDebugMsg()
	{
		if(!empty(self::$messages))
		{
			echo '<b>DEBUG MESSAGE: <HR></b>';
			
			foreach (self::$messages as $DebugMessages) {
				echo $DebugMessages;
			}
		}
	}
}
?>