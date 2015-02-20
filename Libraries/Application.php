<?php
namespace Tipsy\Libraries;

use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Factory;

// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Class Application главный объект системы.
 * @package Tipsy\Libraries
 * @subpackage Application
 */
class Application
{

    public function __construct()
    {
        // Подключает Абстрактную фабрику.
       Loader::loadClass('\Libraries\Factory');
       
        // Получает настройки конфигурации системы.
        Factory::getConfig();

        // Подключает класс диспетчера компонентов системы
        Loader::loadClass('\Libraries\Dispatcher');

        $dispatcher = new Dispatcher();

        $html = Factory::getDocument();
    }

    public function __destruct()
    {

    }
}