<?php
/**
 * User: whiskeyman
 * Date: 31.08.12
 * Time: 21:40
 */
 
 // Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

 /**
  * Класс библиотеки логирования системных ошибок
  *
  */
class TLogger
{
	/**
	 * Метод записи логов в файл и формирования строки логирования
	 *
	 * @param	string		сообщение для записи в лог
	 * return		bool		true если запись удалась и false если нет сообщения для записи
	 */
	public static function WriteLogs($message)
	{
		// Проверяет на наличия текста сообщения для логирования
		if (empty($message)) {
			return false;
		}

		try {
			// Проверяет и пытаетс открыть файл для записи логов, если не получается - бросает исключение с сообщением об ошибке
			if (@!$logfile = fopen(_TPATH_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log.txt', 'a')) {
				throw new TErrorException('<b>Ошибка логирования: </b>Не могу открыть или создать файл для записи логов');
			}
			
			// Формирует сообщение в логоподобный вид
			$message = date('l jS \of F Y h:i:s A') . "\t" . strip_tags($message) . "\n";

			fwrite($logfile, $message);

			fclose($logfile);

		} catch (TErrorException $e) {
			return false;
		}
		return true;
	}
}
