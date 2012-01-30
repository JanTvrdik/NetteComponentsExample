<?php

use Nette\Application\UI;


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

}
