<?php
namespace Tipsy\Libraries;

// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

abstract class Loader
{
    /*
    * @var sting Имя клааса откуда был вызван загрузчик используется для отладки
    */
    protected static $_calledFrom = '';
    protected static $_line = '';

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

        if (file_exists($fileName)) {
            require_once $fileName;
            // todo отображать имя загружаемого// файла (для отладки) echo $fileName."</br>";
            return true;
        } else {
            // if(self::$_calledFrom)

            echo "Загрузчик: не могу найти файл: <b>$fileName</b>, меня вызвал <b>"
                . self::$_calledFrom ."</b>, со строки <b>" . self::$_line. "</b><p>";
            return false;
        }
    }
}