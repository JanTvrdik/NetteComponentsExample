<?php

use Nette\Application\UI;
use Nette\Diagnostics\Debugger;


/**
 * @author   Jan Tvrdík
 */
final class DemoPresenter extends UI\Presenter
{

	protected function createComponentRoot()
	{
		$control = new BoxControl();
		$control->addComponent(new BoxControl, 'a');
		$control->addComponent(new BoxControl, 'b');
		$control->addComponent(new BoxControl, 'c');
		$control['c']->addComponent(new BoxControl, 'x');
		$control['c']->addComponent(new BoxControl, 'y');

		return $control;
	}

	private function dump($var, $title = NULL)
	{
		if ($var instanceof Nette\ComponentModel\IComponent) {
			Debugger::barDump(array($var->getName() => $var), $title);

		} else {
			Debugger::barDump($var, $title);
		}
	}

}
