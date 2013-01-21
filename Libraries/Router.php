<?php
namespace Tipsy\Libraries;
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
		// Проверяет наличие переменных в 
		if(empty($_GET['component'])){
			return false;
		}else{
			$com = 'T' . $_GET['component'];
			
			TLoader::discover('T',_TPATH_COMPONENTS, true);
			TLoader::load($com);
			#$com == 'Tuser' ? TUser::init() : '';
			if( method_exists($com,'init')){
				$com::init();
			}else{
				TDebug::AddMessage("Страница $com не найдена", __CLASS__);
			}

		}
		
		// Построчно перебирает переменные в URL.
		#foreach($_GET as $component=>$type){
		#	TDebug::AddMessage("<B>В данный момент компонет находится в разработке. </B>Название компонента: $component, $type ? раздел: $type :  ", __METHOD__);
		#}
		// Добавляет префикс к имени компонента (получает имя класса)
		#$component .= 'T';
		#TLoader::discover('T',_TPATH_COMPONENTS,true);
	}
}

?>