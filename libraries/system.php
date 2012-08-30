<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Системный объект
 */
class TSystem
{

    public function __construct()
    {
        self::getConfig();

        self::setError_reporting();

        self::database_setup();
    }

    /**
     * Метод подключения файлов конфигурации.
     *
     * @return  true если конфигурация загружена, false если нет.
     */
    public static function getConfig()
    {
        // Поключаю конфигурацию системы
        if (TLoader::load('TConfig')) {
            return true;
        } else {
            die('Не найден файл конфигурации');
            return false;
        }
    }

    /**
     * Метод установки уровня отчетов об ошибках из файла конфигурации системы.
     */
    public static function setError_reporting()
    {

        // Устанавливаю уровень отчета об ошибках.
        switch (TConfig::$error_reporting) {
            // Не показывать ошибки
            case 'none':
                error_reporting(0);
                ini_set('display_errors', 0);
                break;

            // Показывать важные
            case 'simple':
                error_reporting(E_ERROR | E_WARNING | E_PARSE);
                ini_set('display_errors', 1);
                break;

            // Показывать все
            case 'maximum':
                // Note: E_STRICT включен в E_ALL начиная с версии PHP >= 5.4
                error_reporting(E_ALL | E_STRICT);
                ini_set('display_errors', 1);
                break;
        }
    }

}

?>