<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Database\Database;


// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Системный класс. Инициализирует состояние и настройки системы, а так же выполняет все настройки и проверки.
 */
abstract class Factory
{
    protected static $cfg = null;
    protected static $db = null;
    protected static $doc = null;

    public static function getConfig()
    {
        if(!self::$cfg){
            Loader::loadClass('\Libraries\Configurator');
            self::$cfg = new \Tipsy\Libraries\Configurator();
            return self::$cfg;
        }
        return self::$cfg;
    }

    public static function getDocument()
    {
        if(!self::$doc){
            Loader::loadClass('\Libraries\Document\Model');
            Loader::loadClass('\Libraries\Document\Document');
            self::$doc = new \Tipsy\Libraries\Document\Document();
            return self::$doc;
        }
        return self::$doc;
    }

    public static function getDb()
    {
        if(!self::$db){
            Loader::loadClass('\Libraries\Database\Database');
            self::$db = new \Tipsy\Libraries\Database\Database(self::$cfg->getDbOptions());
            return self::$db;
        }
    }
}