<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Класс обработчика исключений во время работы
 *
 */
class TRuntimeException extends ErrorException
{
	public static $errors = array();
	
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

		self::$errors[] = $this->getMessage();

		TLogger::WriteLogs($this->getMessage());
	}

}


/**
 * Класс обработчика ошибок
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
