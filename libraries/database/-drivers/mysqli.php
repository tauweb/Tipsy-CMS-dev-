<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Клас драйвера БД MySQLi унаследованный от стандартного mysqli
 */
class TMysqli extends mysqli
{
	/**
	 * Конструктор. устанавливает соединения с БД
	 *
	 * @param	array	$DBDBOptions	Массив содержащий host, username, password, dbame, port, socket базы данных к которой подключается
	 *
	 */
	public function __construct($DBDBOptions)
	{
		try {
			if (empty($DBDBOptions["dbname"])) {
				throw new TRuntimeException("<b>Ошибка соединения с базой данных:</b> Не указано имя базы данных");
			}
			
			#foreach($DBDBOptions as $key => $value)
			#{
			#	if (empty($value))
			#		unset($DBDBOptions[$key]);
			#}
			
			
			// Вызывает конструктор родителя (класс mysqli)
			$this->connection = parent::__construct($DBDBOptions);

			// Бросает исключение если возникла ошибка при подключении к БД.
			if ($this->connect_errno) {
				throw new TRuntimeException("<b>Ошибка соединения с базой данных:</b> $this->connect_error");
			}
		} catch (TRuntimeException $e) {
		}
	}
}
?>