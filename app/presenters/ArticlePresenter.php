<?php

use Nette\Application\UI;


/**
 * @author   Jan Tvrdík
 */
final class ArticlePresenter extends UI\Presenter
{

	/** @var     DibiRow */
	private $article;

	/**
	 * Zobrazí článek s daným ID.
	 *
	 * @param    int               ID článku
	 */
	public function actionDefault($id)
	{
		$this->article = $this->context->articlesService->getArticle($id);
		if (!$this->article) $this->error('Article not found');

		$this->template->article = $this->article;
	}


	/**
	 * Továrnička na komentářovou komponentu.
	 *
	 * Bude automaticky zavolaná, pokud se někdo pokusí získat komponentu "comments" pomocí
	 * $this->getComponent['comments'] nebo pomocí $this['comments'].
	 *
	 * @return   CommentsControl|NULL
	 */
	protected function createComponentComments()
	{
		if (!$this->article) return NULL;

		$control = new CommentsControl();
		$control->setArticleId($this->article->id);
		$control->setService($this->context->commentsService);

		return $control;
	}
}
