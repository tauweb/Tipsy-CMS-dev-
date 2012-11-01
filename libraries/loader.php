<?php
// Проверяет легален ли доступ к файлу.
defined('_TEXEC') or die;

/**
 * Класс для управления загрузкой библиотек.
 *
 * @package		Tipsy.Platform
 */
abstract class TLoader
{

	/**
	 * Контейнер для регистрации библиотек классов.
	 *
	 * @var	array		[Имя класса] => путь к файлу.
	 */
	protected static $classes = array();

	/**
	 * Метод обнаружения классов по заданному типу в заданном пути.
	 *
	 * @param	string		$classPrefix		Префикс имени класса для для регистрации ('T' - для родных классов системы(поумолчанию)).
	 * @param	string		$parentPath		Полный путь к папке, где ищем класс.
	 * @param	boolean	$recurse			Рекурсивный поиск библиотек (для автоматической регистрации всех существующих классов).
	 *
	 */
	public static function discover($classPrefix = 'T', $parentPath = _TPATH_LIBRARIES , $recurse = false)
	{
		if ($recurse) {
			$iterator = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($parentPath),
				RecursiveIteratorIterator::SELF_FIRST
			);
		} else {
			$iterator = new DirectoryIterator($parentPath);
		}

		foreach ($iterator as $file) {
			$fileName = $file->getFilename();

			// Только для загрузки php файлов.
			// Note: DirectoryIterator::getExtension доступно только в PHP >= 5.3.6
			if ($file->isFile() && $file->getExtension() == 'php') {

				// Note: Проверка на наличие префикса  "_" имени файла нужна только для разрабатываемых компонентов
				// Если имя библиотеки клааса начинается с префикса "_" (находящийся в разработке).
				if($fileName[0] == '_'){
					$class = strtolower($file->getBasename('.php'));
				}else{
					// Получаю имя класса с префиксом Класса.
					$class = strtolower($classPrefix . $file->getBasename('.php'));
				}

				// Проверяет зарегистрирван ли класс в $classes.
				if (!in_array($class, self::$classes, true)) {
					self::register($class, $file->getPath() . '/' . $fileName);
				}
			}
		}
	}

	/**
	 * Регистрация класса в список $classes
	 *
	 * @param	string		$class		Имя класса для регистрации.
	 * @param	string		$path		Полный путь к файлу который нужно зарегистрировать.
	 */
	public static function register($class, $path)
	{
		// Sanitize class name.
		$class = strtolower($class);

		// Регистрирует только классы у которых есть имя и полный путь к библиотеке класса
		if (!empty($class) && is_file($path)) {
			// Регистрирует только не зарегистрированные классы
			if (empty($classes[$class])) {
				self::$classes[$class] = $path;
				return true;
			}
		}
	}

	/**
	 * Метод проверки существавания класса в списке зарегистрированных
	 *
	 * @param	string		Имя класса
	 *
	 * @return	boolean
	 */
	public static function isRegister($class)
	{
		if (self::$classes[$class]) {
			return true;
		} else {
			return false;
		}

	}

	/**
	 * Метод подключения библиотеки класса по его пути из списка $classes.
	 *
	 * @param	string		$class  имя класса для загрузки.
	 * @param	string		$path  Путь к файлу подключаемого класса.
	 * @return	boolean	true если успешно или библиотека уже подключена.
	 */
	public static function load($class)
	{
		$class = strtolower($class);

		if (class_exists($class)) {
			return true;
		}

		// Проверяет зарегистрирован ли класс в списке классов и если да - подключает библиотеку класса.
		if (isset(self::$classes[$class])) {
			require_once self::$classes[$class];

			return true;
		}

		return false;
	}

	/**
	 * Метод загрузки всех классов из списка $classes.
	 */
	public static function loadAll()
	{
		foreach (self::$classes as $class)
			self::load($class);
	}
}

?>
