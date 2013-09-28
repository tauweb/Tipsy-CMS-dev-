<?php

namespace Tipsy\Libraries\Document;

use Tipsy\Libraries\Html\Head;
use Tipsy\Libraries\Loader;
use Tipsy\Libraries\Html\Position;
use Tipsy\Libraries\Factory;

class Model
{

	protected static function head($method, $param)
	{
		Head::$method($param);
	}
	

}