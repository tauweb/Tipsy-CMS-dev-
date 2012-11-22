<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Базовый класс платформы Tipsy CMS
 * По возможности здесь будет реализовываться API
 *
 */
class TApplication
{
	/**
	 * Метод запускающий формирование страцы
	 *
	 */
	public function run()
	{
		// Загружает класс работы с БД
		TLoader::load('TDatabase');
		// Устанавливает соединение с БД
		TDatabase::connect(TSystem::getDBOptions());
		
		TLoader::load('TDebug');
		
		 // Сессия (тест)
		TLoader::load('_Session');
		TSession::start('test_session');

		TLoader::discover('T',_TPATH_COMPONENTS);

		try {
			// Подключает библиотеку формирующую страницы html
			TLoader::load('TDocument');
			// Создает объект формирующий страницу html
			$TDocument = new TDocument();
		} catch (TRuntimeException $e) {
		}
		
		// Получает список сообщений отладки системы
		$this->debugMsg = TDebug::$messages;
		
	}
	
	/**
	 * Метод вывода системных ошибок на страницу html
	 *
	 */
	public function getErrors()
	{	
		// Проверяет наличие сообщений об ошибках.
		if (!empty($this->errors)) {
			// Построчно выводит все ошибки из массива на страницу html.
			foreach ((array)$this->errors as $msg) {
				echo $msg . "<p>";
			}
		}
	}
	
	public function getDebugMsg()
	{
		if(!empty($this->debugMsg))
		{
			echo '<b>DEBUG MESSAGE: <HR></b>';
			
			foreach ($this->debugMsg as $DebugMessages) {
				echo $DebugMessages;
			}
		}
	}
}

?>