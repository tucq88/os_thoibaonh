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
 * @version 	$Id: Article.php 2219 2010-04-12 04:51:11Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_News_Model_Dao_Pdo_Mysql_Article
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_News_Model_Interface_Article
{
	public function convert($entity) 
	{
		return new Tomato_Modules_News_Model_Article($entity); 
	}
	
	public function getArticleById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('a' => $this->_prefix.'news_article'))
						->where('a.article_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$articles = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($articles) == 0) ? null : $articles[0];	
	}
	
	public function add($article) 
	{
		$this->_conn->insert($this->_prefix.'news_article', array(
			'category_id' 		=> $article->category_id,
			'title' 			=> $article->title,
			'sub_title' 		=> $article->sub_title,
			'slug' 				=> $article->slug,
			'description' 		=> $article->description,
			'content' 			=> $article->content,
			'created_date' 		=> $article->created_date,
			'created_user_id' 	=> $article->created_user_id,
			'created_user_name' => $article->created_user_name,
			'activate_date' 		=> $article->created_date,
			'activate_user_id' 	=> $article->created_user_id,
			'activate_user_name' => $article->created_user_name,
			'author' 			=> $article->author,
			'allow_comment' 	=> (int)$article->allow_comment,
			'image_medium' 		=> $article->image_medium,
			'image_square' 		=> $article->image_square,
			'image_large' 		=> $article->image_large,
			'image_general' 	=> $article->image_general,
			'image_small' 		=> $article->image_small,
			'image_crop' 		=> $article->image_crop,
			'image_thumbnail' 	=> $article->image_thumbnail,
			'sticky' 			=> (int)$article->sticky,
			'status' 			=> $article->status,
			'icons' 			=> $article->icons,
			'link_source'		=> $article->link_source,
		));
		return $this->_conn->lastInsertId($this->_prefix.'news_article');
	}
	
	public function update($article) 
	{
		$where[] = 'article_id = '.$this->_conn->quote($article->article_id);
		return $this->_conn->update($this->_prefix.'news_article', array(
				'category_id' 		=> $article->category_id,
				'title' 			=> $article->title,
				'sub_title' 		=> $article->sub_title,
				'slug' 				=> $article->slug,
				'description' 		=> $article->description,
				'content' 			=> $article->content,
				'updated_date' 		=> $article->updated_date,
				'updated_user_id' 	=> $article->updated_user_id,
				'updated_user_name' => $article->updated_user_name,
				'author' 			=> $article->author,
				'allow_comment' 	=> (int)$article->allow_comment,
				'image_medium' 		=> $article->image_medium,
				'image_square' 		=> $article->image_square,
				'image_large' 		=> $article->image_large,
				'image_general' 	=> $article->image_general,
				'image_small' 		=> $article->image_small,
				'image_crop' 		=> $article->image_crop,
				'image_thumbnail' 	=> $article->image_thumbnail,
				'sticky' 			=> (int)$article->sticky,
				'icons' 			=> $article->icons,
			), $where);			
	}
	
	public function find($start, $count, $exp = null) 
	{
		$select = $this->_conn
					->select()
					->from(array('a' => $this->_prefix.'news_article'));
		if ($exp) {
			if (isset($exp['article_id'])) {
				$select->where('a.article_id = ?', $exp['article_id']);
			}
			if (isset($exp['category_id'])) {
				$select->where('a.category_id = ?', $exp['category_id']);
			}
			if (isset($exp['created_user_id'])) {
				$select->where('a.created_user_id = ?', $exp['created_user_id']);
			}
			if (isset($exp['status'])) {
				$select->where('a.status = ?', $exp['status']);
			}
			if (isset($exp['keyword'])) {
				$select->where('a.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
		}
		$select->order('a.activate_date DESC')
				->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function count($exp = null) 
	{
		$select = $this->_conn
				->select()
				->from(array('a' => $this->_prefix.'news_article'), array('num_articles' => 'COUNT(*)'));
		if ($exp) {
			if (isset($exp['article_id'])) {
				$select->where('a.article_id = ?', $exp['article_id']);
			}
			if (isset($exp['category_id'])) {
				$select->joinInner(array('ac' => $this->_prefix.'news_article_category_assoc'), 'a.article_id = ac.article_id', array('category_id'));
				$select->where('ac.category_id = ?', $exp['category_id']);
			}
			if (isset($exp['created_user_id'])) {
				$select->where('a.created_user_id = ?', $exp['created_user_id']);
			}
			if (isset($exp['status'])) {
				$select->where('a.status = ?', $exp['status']);
			}
			if (isset($exp['keyword'])) {
				$select->where('a.title LIKE \'%'.addslashes($exp['keyword']).'%\'');
			}
		}
		$row = $select->query()->fetch();
		return $row->num_articles;
	}
	
	public function delete($id) 
	{
                $user = Zend_Auth::getInstance()->getIdentity();
		$where[] = 'article_id = '.$this->_conn->quote($id);
		return $this->_conn->update($this->_prefix.'news_article', array('status' => 'deleted', 'delete_user_name' => $user->user_name, 'deleted_date' => date('Y-m-d H:i:s')), $where);
	}
	
	public function updateStatus($id, $status) 
	{
		$user = Zend_Auth::getInstance()->getIdentity();
		$where[] = 'article_id = '.$this->_conn->quote($id);
		return $this->_conn->update($this->_prefix.'news_article', array(
										'status' => $status,
										'activate_user_id' => $user->user_id,
										'activate_user_name' => $user->user_name,
										'activate_date' => date('Y-m-d H:i:s'),
									), $where);
	}
	
	public function getArticlesByTag($tagId, $start, $count)
	{
		$select = $this->_conn->select()
					->from(array('a' => $this->_prefix.'news_article'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 'a.article_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'article_id')
					->where('a.status = ?', 'active')
					->group('a.article_id')
					->order('a.article_id DESC')
					->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
	
	public function countArticlesByTag($tagId)
	{
		$select = $this->_conn->select()
					->from(array('a' => $this->_prefix.'news_article'), array('num_articles' => 'COUNT(article_id)'))
					->joinInner(array('ti' => $this->_prefix.'tag_item_assoc'), 'a.article_id = ti.item_id', array())
					->where('ti.tag_id = ?', $tagId)
					->where('ti.item_name = ?', 'article_id')
					->where('a.status = ?', 'active');
		return $select->query()->fetch()->num_articles;		
	}
	
	public function increaseViews($articleId)
	{
		$query = 'UPDATE '.$this->_prefix.'news_article
				SET num_views = num_views + 1
				WHERE article_id = '.$this->_conn->quote($articleId);
		return $this->_conn->query($query);
	}
	
	public function getArticlesByCategory($categoryId, $start, $count, $mainCategoryId = false)
	{
            $cachedFile = strtr(dirname(__FILE__) . '/cached/cache_{cate}_{start}_{count}_{main}.serialize', array(
                '{cate}' => $categoryId,
                '{start}' => $start,
                '{count}' => $count,
                '{main}' => (int)$mainCategoryId,
            ));
            $time = @filemtime($cachedFile);

            if (!$time || (time() - $time > 2 * 60) || (($rs = unserialize(@file_get_contents($cachedFile))) == false)) {
		$select = $this->_conn->select()
						->from(array('a' => $this->_prefix.'news_article'))
						->joinInner(array('ac' => $this->_prefix.'news_article_category_assoc'), 'a.article_id = ac.article_id', array('category_id'))
						->joinInner(array('c' => $this->_prefix.'category'), 'a.category_id = c.category_id', array('category_name' => 'name'));
		if ($mainCategoryId) {
			$select->where('a.category_id = ?', $categoryId);
		} else {
			$select->where('ac.category_id = ?', $categoryId);
		}
		$select->where('a.status = ?', 'active')
			//->order('a.activate_date DESC')
			//->order('a.article_id ASC')
			->order('a.article_id DESC')
			->limit($count, $start);
		//$rs = $select->query()->fetchAll();
                $stmt = $select->query();
                $rs = null;
                
                while ($row = $stmt->fetch()) {
                    $ordDate[] = $row->activate_date;
                    $ordID [] = $row->article_id;
                    $rs[] = $row;
                }
                
                array_multisort($ordDate, SORT_DESC, SORT_STRING, $ordID, SORT_ASC, SORT_NUMERIC, $rs);
                @file_put_contents($cachedFile, serialize($rs));
            }
		
            return new Tomato_Core_Model_RecordSet($rs, $this);		
	}
	
	public function getArticleCategoryIds($articleId)
	{
		$select = $this->_conn->select()
						->from(array('a' => $this->_prefix.'news_article_category_assoc'), array('category_id'))
						->where('a.article_id = ?', $articleId);
		$rs = $select->query()->fetchAll();
		$categoryIds = array();
		if ($rs) {
			foreach ($rs as $row) {
				$categoryIds[] = $row->category_id;
			}
		}
		return $categoryIds;		
	}
	
	public function addArticleToCategory($articleId, $categoryId, $reset = false)
	{
		if ($reset) {
			$this->_conn->delete($this->_prefix.'news_article_category_assoc', array('article_id = '.$this->_conn->quote($articleId)));
		}
		$this->_conn->insert($this->_prefix.'news_article_category_assoc', array(
								'category_id' => $categoryId,
								'article_id' => $articleId,
							));
	}
	
	public function addHotArticle($articleId, $reset = false)
	{
		if ($reset) {
			$this->_conn->delete($this->_prefix.'news_article_hot', array('article_id = '.$this->_conn->quote($articleId)));			
		}
		$this->_conn->insert($this->_prefix.'news_article_hot', array(
								'article_id' 	=> $articleId,
								'created_date' 	=> date('Y-m-d H:i:s'),
								'ordering'		=> 1,
							));
	}
	
	public function isHotArticle($articleId)
	{
		$select = $this->_conn->select()
					->from(array('h' => $this->_prefix.'news_article_hot'), array('num_articles' => 'COUNT(*)'))
					->where('h.article_id = ?', $articleId)
					->limit(1);
		return ($select->query()->fetch()->num_articles > 0);
	}
	
	public function getHotArticles($limit, $status = null)
	{
		$select = $this->_conn->select()
						->from(array('a' => $this->_prefix.'news_article'))
						->joinInner(array('h' => $this->_prefix.'news_article_hot'), 'a.article_id = h.article_id',
							array('ordering'));
		if ($status) {
			$select->where('a.status = ?', $status);
		}
		$select->order('h.ordering')
			->limit($limit);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);	
	}
	
	public function updateHotOrder($order, $articleId = null)
	{
		if (null == $articleId) {
			return $this->_conn->update($this->_prefix.'news_article_hot', array('ordering' => $order));
		} else {
			return $this->_conn->update($this->_prefix.'news_article_hot', array(
								'ordering' => $order
							), array('article_id = '.$this->_conn->quote($articleId)));
		}
	}
}
