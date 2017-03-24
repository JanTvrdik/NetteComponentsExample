<?php

namespace App;

use Nette\Application\UI;


/**
 * Komentářová komponenta.
 */
class CommentsControl extends UI\Control
{
	/** @var     int */
	private $articleId;

	/** @var     CommentsService */
	private $service;


	/**
	 * Nastaví ID článku, ke kterému se budou komentáře vázat.
	 *
	 * @param    int $id
	 * @return   void
	 */
	public function setArticleId($id)
	{
		$this->articleId = $id;
	}


	/**
	 * Vstříkne službu, kterou tato komponenta bude používat pro práci s komentáři.
	 *
	 * @param    CommentsService $service
	 * @return   void
	 */
	public function setService(CommentsService $service)
	{
		$this->service = $service;
	}


	/**
	 * Vykreslí komentářovou komponentu. Metoda render() je automaticky volaná při vykreslování komponenty pomocí makra {control ...}.
	 *
	 * @todo     Metoda neřeší, že v $this->articleId může být NULL.
	 * @return   void
	 */
	public function render()
	{
		$this->template->setFile(__DIR__ . '/CommentsControl.latte');
		$this->template->comments = $this->service->getComments($this->articleId);
		$this->template->render();
	}


	/**
	 * Továrnička na formulář pro přidávání komentářů.
	 *
	 * Bude automaticky zavolaná, v případě, že se někdo pokusí získat instanci komponenty addCommentForm pomocí
	 * $this->getComponent('addCommentForm') resp. pomocí $this['addCommentForm'] a komponenta ještě nebude vytvořená
	 * (tj. nebude v $this->components).
	 *
	 * @return   UI\Form
	 */
	protected function createComponentAddCommentForm()
	{
		$form = new UI\Form();
		$form->addText('name', 'Jméno:');
		$form->addTextArea('message', 'Text:')
			->setRequired();
		$form->addSubmit('send', 'Přidat komentář');
		$form->onSuccess[] = [$this, 'processAddCommentForm'];

		return $form;
	}


	/**
	 * Zpracování formuláře na přidávání komentářů.
	 *
	 * @todo     Metoda neřeší, že $this->articleId může být NULL nebo může odkazovat na neexistují článek.
	 * @param    UI\Form $form odeslaný formulář, jehož instanci by šlo také získat pomocí $this['addCommentForm']
	 * @return   void
	 */
	public function processAddCommentForm(UI\Form $form)
	{
		$values = $form->values;
		$this->service->addComment($this->articleId, $values['name'], $values['message']);
		$this->flashMessage('Komentář byl úspěšně přidán, děkujeme.');
		$this->redirect('this');
	}


	/**
	 * Odstraní komentář s daným ID.
	 *
	 * @param    int $id ID komentáře
	 * @return   void
	 */
	public function handleDelete($id)
	{
		$this->service->removeComment($id);
		$this->flashMessage('Díky za očistu!');
		$this->redirect('this');
	}
}
