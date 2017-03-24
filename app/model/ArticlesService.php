<?php

namespace App;

use Nette;


/**
 * Část modelu starající se o práci s články
 */
class ArticlesService
{
	use Nette\SmartObject;

	/** @var     Nette\Database\Connection */
	private $db;


	/**
	 * Class constructor
	 *
	 * @param    Nette\Database\Connection $db
	 */
	public function __construct(Nette\Database\Connection $db)
	{
		$this->db = $db;
	}


	/**
	 * Returns article or FALSE if article does not exist.
	 *
	 * @param    int $id
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
