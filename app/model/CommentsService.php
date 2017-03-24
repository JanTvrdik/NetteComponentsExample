<?php

namespace App;

use DateTimeImmutable;
use Nette;
use Nette\SmartObject;


/**
 * Část modelu starající se o práci s komentáři
 */
class CommentsService
{
	use SmartObject;

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
	 * Adds a new comment.
	 *
	 * @param    int    $articleId
	 * @param    string $author author's name
	 * @param    string $text   comment text
	 * @return   void
	 */
	public function addComment($articleId, $author, $text)
	{
		$this->db->query('INSERT INTO `comments`', [
			'articleId' => $articleId,
			'date' => new DateTimeImmutable('now'),
			'author' => $author,
			'text' => $text,
		]);
	}


	/**
	 * Removes a comment.
	 *
	 * @param    int $id
	 * @return   void
	 */
	public function removeComment($id)
	{
		$this->db->query('
			DELETE FROM `comments`
			WHERE `id` = ?', $id
		);
	}


	/**
	 * Returns an array of comments for given article.
	 *
	 * @param    int $articleId
	 * @return   Nette\Database\IRow[]
	 */
	public function getComments($articleId)
	{
		return $this->db->fetchAll('
			SELECT * FROM `comments`
			WHERE `articleId` = ?', $articleId
		);
	}
}
