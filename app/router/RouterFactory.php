<?php

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;


class RouterFactory extends Nette\Object
{
	/**
	 * @return IRouter
	 */
	public function create()
	{
		return new Route('<presenter>/<action>', 'Demo:default');
	}
}
