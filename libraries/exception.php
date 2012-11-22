<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Класс работы с ошибками.
 */
abstract class TErrors
{
	/**
	 * @var	array	Массив содержащий ошибки системы.
	 */
	protected static $errors = array();
	
	public static function getErrors()
	{
		foreach(self::$errors as $error){
			echo $error;
		}
		
	}
}

/**
 * Класс обработчика исключений во время работы
 *
 */
class TRuntimeException extends ErrorException
{
	/**
	 * Конструктор
	 *
	 * Конструктор, используется для установки всех необходимых свойств и методов объекта исключений
	 *
	 * @param	string 	$message  Текст исключения
	 * @param	int			$code
	 *
	 */
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		
		// Добовляет ошибку в список ошибок.
		TErrors::$errors[] = $this->getMessage();
		
		// Логирует ошибку
		TLogger::WriteLogs($this->getMessage());
	}
}


/**
 * Класс обработчика ошибок которые нельзя логировать.
 *
 */
class TErrorException extends ErrorException
{
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);

		TRuntimeException::$errors[] = $this->getMessage();
	}
}

?>
