<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 31.08.12
 * Time: 21:40
 */
class TLogger
{

	public static function WriteLogs($message)
	{
		if (empty($message)) {
			return false;
		}

		try {
			if (@!$logfile = fopen(_TPATH_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'log.txt', 'a')) {
				throw new TErrorException('<b>Ошибка логирования: </b>Не могу открыть или создать файл для записи логов');
			}

			$message = date('l jS \of F Y h:i:s A') . "\t" . strip_tags($message) . "\n";

			fwrite($logfile, $message);

			fclose($logfile);


		} catch (TErrorException $e) {

		}

		return true;
	}
}
