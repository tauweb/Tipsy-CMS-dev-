<?php
// Проверяет легален ли доступ к файлу
defined('_TEXEC') or die();

/**
 * Класс путями в адресной строке.
 */
abstract class TRouter
{
	/**
	 * Метод определяющий и перенаправляющий управление компоненту системы. todo: Переделать!
	 *
	 * @return bool
	 */
	public static function getURL()
	{
		// Проверяет наличие переменных в строке.
		if(empty($_GET)){
			return false;
		}

		foreach($_GET as $component=>$type){
			TDebug::AddMessage("<B>В данный момент компонет находится в разработке. </B>Название компонента: $component, раздел: $type ", __METHOD__);
		}
		if($component == 'user'){
			TLoader::discover('T',_TPATH_COMPONENTS,true);
			TLoader::load('TUsers');
			TUsers::check();
		}
	}
}

?>