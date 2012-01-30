<?php

/**
 * Část modelu starající se o práci s články
 *
 * @author   Jan Tvrdík
 */
class ArticlesService extends Nette\Object
{

	/** @var     DibiConnection */
	private $db;

	/**
	 * Class constructor
	 *
	 * @param    DibiConnection
	 */
	public function __construct(DibiConnection $db)
	{
		$this->db = $db;
	}

	/**
	 * Returns article or FALSE if article does not exist.
	 *
	 * @param    int
	 * @return   DibiRow|FALSE
	 */
	public function getArticle($id)
	{
		return $this->db->fetch('
			SELECT *
			FROM [articles]
			WHERE [id] = %i', $id
		);
	}

	/**
	 * Returns all articles.
	 *
	 * @return   array (# => DibiRow)
	 */
	public function getAll()
	{
		return $this->db->fetchAll('
			SELECT *
			FROM [articles]
		');
	}

}
