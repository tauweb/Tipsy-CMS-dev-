<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die;

/**
 * Базовый класс платформы tipsy
 * По возможности здесь будет реализовываться API
 *
 */
class TApplication
{
    public function run()
    {
        // Подключаю библиотеку формирующую страницы html
        TLoader::load('TDocument');

        try {
            $TDocument = new TDocument();
        } catch (TRuntimeException $e) {
        }
    }
}

?>