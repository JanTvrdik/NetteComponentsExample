<?php

namespace App;

use Nette;
use Nette\Application\UI;


final class ArticlePresenter extends UI\Presenter
{
	/** @var     Nette\Database\IRow */
	private $article;

	/** @var     ArticlesService */
	private $articlesService;

	/** @var     CommentsService */
	private $commentsService;


	/**
	 * Konstruktor sloužící pro předání závislostí.
	 *
	 * @param    ArticlesService $articlesService
	 * @param    CommentsService $commentsService
	 */
	public function __construct(ArticlesService $articlesService, CommentsService $commentsService)
	{
		parent::__construct();
		$this->articlesService = $articlesService;
		$this->commentsService = $commentsService;
	}


	/**
	 * Zobrazí článek s daným ID.
	 *
	 * @param    int $id
	 */
	public function actionDefault($id)
	{
		$this->article = $this->articlesService->getArticle($id);
		if (!$this->article) $this->error('Article not found');

		$this->template->article = $this->article;
	}


	/**
	 * Zobrazí přehled všech článků s komentářovými komponentami. Ideální pro komentářové spammery.
	 */
	public function actionOverview()
	{
		$this->template->articles = $this->articlesService->getAll();
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
		$control->setService($this->commentsService);

		return $control;
	}


	/**
	 * Vytvoří kouzelný kontejner. Kdokoliv ho požádá o subkomponentu, tak dostane instanci CommentsControl navázanou
	 * na článek s ID stejným jako název komponenty.
	 *
	 * Tedy např. $this['magicContainer'][815] vrátí komponentu s názvem '815', která bude instancí CommentsControl
	 * navázanou na článek s ID 815.
	 *
	 * @return   UI\Multiplier
	 */
	protected function createComponentMagicContainer()
	{
		$service = $this->commentsService;
		return new UI\Multiplier(function ($id) use ($service) {
			$control = new CommentsControl();
			$control->setArticleId($id);
			$control->setService($service);

			return $control;
		});
	}
}
