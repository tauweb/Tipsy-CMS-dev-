<?php
namespace Tipsy\Libraries\Html;

use Tipsy\Libraries\Html\Position;

class View extends Model{

	public function __construct()
	{
		self::getTemplate();
	}
	
	protected static function getHead()
	{
		echo '<head>';
		foreach(static::$head as $tag){
			if(is_array($tag) and !empty($tag) ){
				foreach($tag as $subTag){
					if(!empty($subTag)) echo $subTag . "\n";
				}
			}elseif(!empty($tag)){
				echo $tag ."\n";
			}
		}
		echo '</head>';
	}
	
	protected function getPositions()
	{
		Position::getComponent();
	}
	
	protected function position($name)
	{
		echo static::$positions[strtolower($name)];
	}
}