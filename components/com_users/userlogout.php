<?php
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 13.01.13
 * Time: 16:31
 * To change this template use File | Settings | File Templates.
 */
abstract class TUserLogOut
{
	public static function init(){
		unset($_SESSION['user']);
	}
}
