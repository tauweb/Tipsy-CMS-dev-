<?php
// Проверяю легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Клас драйвера БД MySQLi унаследованный от стандартного mysqli
 */
class TMysqli extends mysqli
{

    /**
     * Конструктор. устанавливает соединения с БД
     *
     * @param  string  $db_type      Этот параметр задает тип базы данных (mysql, mysqli или др.)
     * @param  string  $db_server    Адрес сервера базы данных (localhost или другой)
     * @param  string  $db_user      Имя пользователя БД
     * @param  string  $db_password    Пароль пользователя БД
     * @param  string  $db_dbname    Имя БД для подклюёения
     * @param  integer  $db_port      Порт подключения к Дб
     * @param  string  $db_socket
     *
     * @return  string  $db_connect    Соединение с БД
     *
     */
    public function __construct($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket)
    {
        try {
            if (empty($db_dbname)) {
                throw new TRuntimeException("<b>Ошибка соединения с базой данных:</b> Не указано имя базы данных");
            }

            // Вызываю конструктор родителя (класс mysqli)
            @$this->connection = parent::__construct($db_host, $db_user, $db_password, $db_dbname, $db_port, $db_socket);

            if ($this->connect_errno) {
                throw new TRuntimeException("<b>Ошибка соединения с базой данных:</b> $this->connect_error");
            }

            echo 'Соединение с БД удалось'; // Todo: Отладка, потом удалить строку

        } catch (TRuntimeException $e) {
        }
    }

}
?>