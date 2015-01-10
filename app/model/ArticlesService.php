<?php

/**
 * Část modelu starající se o práci s články
 *
 * @author   Jan Tvrdík
 */
class ArticlesService extends Nette\Object
{

	/** @var     Nette\Database\Context */
	private $db;

	/**
	 * Class constructor
	 *
	 * @param    Nette\Database\Context
	 */
	public function __construct(Nette\Database\Context $db)
	{
		$this->db = $db;
	}

	/**
	 * Returns article or FALSE if article does not exist.
	 *
	 * @param    int
	 * @return   Nette\Database\IRow|FALSE
	 */
	public function getArticle($id)
	{
		return $this->db->fetch('
			SELECT *
			FROM `articles`
			WHERE `id` = ?', $id
		);
	}

	/**
	 * Returns all articles.
	 *
	 * @return   Nette\Database\IRow[]
	 */
	public function getAll()
	{
		return $this->db->fetchAll('
			SELECT *
			FROM `articles`
		');
	}

}
