<?php
// В дальнейшем библиотека и все исключения будут переписаны.
// Сейчас создана лишь для общего представления автором что и как будет работать.
namespace Tipsy\Libraries;

use Tipsy\Libraries\Logger;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Класс работы с ошибками.
 */
abstract class Errors
{
	/**
	 * @var	array	Массив содержащий ошибки системы.
	 */
	public static $errors = array();

	/**
	 * Метод построчно выводящий сообщения об ошибках на страницу.
	 *
	 */
	public static function getErrors()
	{
		foreach(self::$errors as $error){
			echo $error . '<p>';
		}
	}
}

/**
 * Класс обработчика исключений во время работы
 *
 */
class RuntimeException extends \ErrorException
{
	/**
	 * Конструктор, используется для установки всех необходимых свойств и методов объекта исключений
	 *
	 * @param	string 	$message  Текст исключения
	 * @param	int		$code
	 *
	 */
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);
		
		// Добовляет ошибку в список ошибок.
		Errors::$errors[] = $this->getMessage();

		// Логирует ошибку
		Logger::WriteLogs($this->getMessage());
	}
}

class PdoException extends \PDOException
{
   /**
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
		Errors::$errors[] = $this->getMessage();

		// Логирует ошибку
		Logger::WriteLogs($this->getMessage());
	}
}

/**
 * Класс обработчика ошибок которые нельзя логировать.
 *
 */
class FatalErrorException extends \ErrorException
{
	public function __construct($message = '', $code = 0, Exception $previous = null)
	{
		parent::__construct($message, $code, $previous);

		Errors::$errors[] = $this->getMessage();
	}
}