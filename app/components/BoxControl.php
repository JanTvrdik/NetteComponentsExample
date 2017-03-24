<?php

namespace App;

use Nette\Application\UI;


/**
 * Komponenta pro demonstraci hierarchické struktury.
 */
class BoxControl extends UI\Control
{
	/**
	 * Metody render() je automaticky volaná při vykreslování pomocí Latte makra {control}
	 */
	public function render()
	{
		// Stejně jako v presenteru je i v komponentě k dispozici šablona pomocí $this->template.
		// Navíc je ale potřeba ručně nastavit cestku k šabloně a zavolat metodu render()
		$this->template->setFile(__DIR__ . '/BoxControl.latte');
		$this->template->render();
	}


	/**
	 * Továrnička na "foo". Bude automaticky zavolaná při pokusu o získání komponenty "foo".
	 *
	 * @return   BoxControl
	 */
	protected function createComponentFoo()
	{
		return new BoxControl();
	}
}
