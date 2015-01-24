<?php
namespace Tipsy\Libraries;
    use Tipsy\Libraries\Exception\RuntimeException;
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Класс загрузчик. Выполняет загрузку компонентов системы 
 * 
 * @package Tipsy\Libraries
 * @subpackage Loader
 * 
 */
abstract class Loader
{
    /**
     * Метод для загрузки библиотеки класса
     * @param string $className Имя класса
     * @return boolean. True - если загрузка класса удалась
     *                  false - если не смог загрузить класс,
     *                  в случае неудачи выводи выводит сообщение об ошибке.
     */
    public static function loadClass($className, $_calledFrom = '', $_line = '')
    {
        if (class_exists($className)) {
            return true;
        }

        if ($_calledFrom) {
            self::$_calledFrom = $_calledFrom;
        }
        if ($_line) {
            self::$_line = $_line;
        }

        $className = ltrim($className, '\\');
        $fileName = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

        // if (file_exists($fileName)) {
        //     require_once $fileName;
        //     return true;
        // } else {
        //     echo "Загрузчик: не могу найти файл: <b>$fileName</b>";
        //     return false;
        // }
        if (file_exists($fileName)) {
            require_once $fileName;
            return true;
        } else {
            throw new RuntimeException("Загрузчик: не могу найти файл: <b>$fileName</b>", 1);
            //return false;
        }
    }
}