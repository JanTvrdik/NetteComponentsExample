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
	public function renderDefault($id)
	{
		$this->article = $this->context->articlesService->getArticle($id);
		if (!$this->article) $this->error('Article not found');

		$this->template->article = $this->article;
	}

}
