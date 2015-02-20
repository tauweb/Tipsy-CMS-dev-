<?php
namespace Tipsy\Libraires\Exception

/**
 * Класс обработки ошибок во время выполнения
 * @package Tipsy\Libraires\Exception
 */
abstract class FatalRuntimeErrors
{
    /**
     * Description
     * @param string $message 
     * @return void
     */
    public function printFatalError($message = '')
    {
        echo '<meta charset="utf-8">';
        echo $message;
    }
}
