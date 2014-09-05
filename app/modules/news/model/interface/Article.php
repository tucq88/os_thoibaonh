<?php
/**
 * TomatoCMS
 * 
 * LICENSE
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE Version 2 
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-2.0.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@tomatocms.com so we can send you a copy immediately.
 * 
 * @copyright	Copyright (c) 2009-2010 TIG Corporation (http://www.tig.vn)
 * @license		http://www.gnu.org/licenses/gpl-2.0.txt GNU GENERAL PUBLIC LICENSE Version 2
 * @version 	$Id: Article.php 2177 2010-04-08 10:15:42Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_News_Model_Interface_Article
{
	public function getArticleById($id);

	/**
	 * Add new article
	 * 
	 * @param Tomato_Modules_News_Model_Article $article
	 * @return int
	 */
	public function add($article);
	
	/**
	 * Update article
	 * 
	 * @param Tomato_Modules_News_Model_Article $article
	 * @return int
	 */
	public function update($article);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param array $exp Search expression. An array contain various conditions, keys including:
	 * 'keyword', 'article_id', 'category_id', 'created_user_id', 'status'
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function find($start, $count, $exp = null);
	
	/**
	 * @param array $exp Search expression (@see find)
	 * @return int
	 */
	public function count($exp = null);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * @param int $id
	 * @param string $id
	 * @return int
	 */
	public function updateStatus($id, $status);
	
	/**
	 * Get list of articles tagged by given tag
	 * 
	 * @param int $tagId
	 * @param int $start
	 * @param int $count
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getArticlesByTag($tagId, $start, $count);
	
	/**
	 * Get number of articles tagged by given tag
	 * 
	 * @param int $tagId
	 * @return int
	 */
	public function countArticlesByTag($tagId);
	
	/**
	 * Increase article views
	 * 
	 * @param int $articleId
	 */
	public function increaseViews($articleId);
	
	/**
	 * Get latest articles in category
	 * 
	 * @param int $categoryId
	 * @param int $start
	 * @param int $count
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getArticlesByCategory($categoryId, $start, $count, $mainCategoryId = false);
	
	/**
	 * Get array of article category Ids
	 * 
	 * @param int $articleId
	 * @return array
	 */
	public function getArticleCategoryIds($articleId);
	
	/**
	 * Add the article to category
	 * 
	 * @param int $articleId
	 * @param int $categoryId
	 * @param bool $reset If $reset is true, remove article from all categories before adding
	 */
	public function addArticleToCategory($articleId, $categoryId, $reset = false);
	
	/**
	 * Add article to collection of hot articles
	 * 
	 * @param int $articleId
	 * @param bool $reset If $reset is true, remove article from hot collection before adding
	 */
	public function addHotArticle($articleId, $reset = false);
	
	/**
	 * Check whether article is hot or not
	 * 
	 * @param int $articleId
	 * @return bool
	 */
	public function isHotArticle($articleId);
	
	/**
	 * Get hot articles
	 * 
	 * @param int $limit
	 * @param string $status
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getHotArticles($limit, $status = null);
	
	/**
	 * Update order of hot article
	 * 
	 * @param int $order
	 * @param int $articleId
	 * @return int
	 */
	public function updateHotOrder($order, $articleId = null);
}
