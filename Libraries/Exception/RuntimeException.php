<?php
namespace Tipsy\Libraries\Exception;

/**
 * 
 * @package Tipsy\Libraries\Exception
 * @subpackage RuntimeException
 */
class RuntimeException extends \ErrorException
{
    /**
     * Конструктор, используется для установки всех необходимых свойств и методов объекта исключений
     * @param string $message Сообщение
     * @param integer $code Код ошибки
     * @param string Exception $previous Предыдущее исклчение
     * @return void
     */
    public function __construct($message = '', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        
        // Добовляет ошибку в список ошибок.
        //Errors::$errors[] = $this->getMessage();
echo $message.'Fuck';
        // Логирует ошибку
        //Logger::WriteLogs($this->getMessage());
    }
}
