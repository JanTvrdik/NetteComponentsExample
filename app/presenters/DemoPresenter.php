<?php

namespace App;

use Nette;
use Nette\Application\UI;


final class DemoPresenter extends UI\Presenter
{
	public function renderDefault()
	{
		$this->dump($this->getComponent('root'), 'Získání komponenty s názvem root');
		$this->dump($this['root']); // ekvivalentní zápis

		$this->dump($root = $this['root'], 'Root');

		$this->dump($this['root']['a'], 'Získání komponenty "a" uvnitř "root"');
		$this->dump($this['root-a']);
		$this->dump($root['a']);

		$this->dump($this['root']['c']['y'], 'Y');
		$this->dump($root['c']['y']);
		$this->dump($root['c-y']);

		$this->dump($root->components, 'Komponenty obsažené v komponentě root');

		$this->dump($this['root-c-x']->parent, 'Rodič X');

		$this->dump($this['root-c-x']->parent->parent, 'Rodič rodiče X');

		$this->dump($this['root-c-x']->parent->parent->parent, 'Rodič rodiče rodiče X');

		// $this['bar']; // Component with name 'bar' does not exist.

		$this->dump($this['root-a-foo-foo'], 'Hraní s createComponentFoo()');
	}


	protected function createComponentRoot()
	{
		$control = new BoxControl();
		$control->addComponent(new BoxControl, 'a');
		// $root->addComponent(new BoxControl, 'a'); // Component with name 'a' already exists.
		$control->addComponent(new BoxControl, 'b');
		$control->addComponent(new BoxControl, 'c');
		$control['c']->addComponent(new BoxControl, 'x');
		$control['c']->addComponent(new BoxControl, 'y');

		// $control->removeComponent($control['b']); // odstraní komponentu b

		return $control;
	}


	private function dump($var, $title = NULL)
	{
		if ($var instanceof Nette\ComponentModel\IComponent) {
			bdump([$var->getName() => $var], $title);

		} else {
			bdump($var, $title);
		}
	}
}
