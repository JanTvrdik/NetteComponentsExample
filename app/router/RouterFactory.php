<?php

namespace App;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\SmartObject;


class RouterFactory
{
	use SmartObject;


	/**
	 * @return IRouter
	 */
	public function create()
	{
		return new Route('<presenter>/<action>', 'Demo:default');
	}
}
