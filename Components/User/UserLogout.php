<?php
namespace Tipsy\Components\User;
/**
 * Created by JetBrains PhpStorm.
 * User: whiskeyman
 * Date: 13.01.13
 * Time: 16:31
 * To change this template use File | Settings | File Templates.
 */
abstract class UserLogout
{
	public static function init(){
		unset($_SESSION['user']);
	}
}