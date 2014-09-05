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
 * @version 	$Id: Comment.php 2356 2010-04-17 19:04:47Z huuphuoc $
 * @since		2.0.5
 */

class Tomato_Modules_Comment_Model_Dao_Pdo_Mysql_Comment
	extends Tomato_Core_Model_Dao
	implements Tomato_Modules_Comment_Model_Interface_Comment
{
	public function convert($entity) 
	{
		return new Tomato_Modules_Comment_Model_Comment($entity); 
	}
	
	public function getCommentById($id) 
	{
		$select = $this->_conn
						->select()
						->from(array('c' => $this->_prefix.'comment'))
						->where('c.comment_id = ?', $id)
						->limit(1);
		$rs = $select->query()->fetchAll();
		$comments = new Tomato_Core_Model_RecordSet($rs, $this);
		return (count($comments) == 0) ? null : $comments[0];	
	}
	
	public function add($comment) 
	{
		$this->_conn->insert($this->_prefix.'comment', array(
			'title'			=> $comment->title,
			'content'		=> $comment->content,
			'is_active'		=> $comment->is_active,
			'email'			=> $comment->email,
			'ip'			=> $comment->ip,
			'full_name'		=> $comment->full_name,
			'web_site'		=> $comment->web_site,
			'created_date'	=> $comment->created_date,
			'reply_to'		=> $comment->reply_to,
			'depth'			=> $comment->depth,
			'path'			=> $comment->path,
			'ordering'		=> $comment->ordering,
			'page_url'		=> $comment->page_url,
			'activate_date'	=> $comment->activate_date,
		));
		return $this->_conn->lastInsertId($this->_prefix.'comment');
	}
	
	public function update($comment) 
	{
		$where[] = 'comment_id = '.$this->_conn->quote($comment->comment_id);
		return $this->_conn->update($this->_prefix.'comment', array(
			'title'			=> $comment->title,
			'content'		=> $comment->content,
			'is_active'		=> $comment->is_active,
			'email'			=> $comment->email,
			'ip'			=> $comment->ip,
			'full_name'		=> $comment->full_name,
			'web_site'		=> $comment->web_site,
			'activate_date'	=> $comment->activate_date,
		), $where);
	}
	
	public function reupdateOrderInThread($comment)
	{
		$ordering = $this->_conn->select()
						->from(array('c' => $this->_prefix.'comment'), array('max_ordering' => 'MAX(c.ordering)'))
						->where('c.page_url = ?', $comment->page_url)
						->query()->fetch()->max_ordering;
		$depth = 0;
		$path = $commentId.'-';
		if ($comment->reply_to) {
			$replyTo = $this->getCommentById($comment->reply_to); 
			if ($replyTo != null) {
				$row = $this->_conn->select()
							->from(array('c' => $this->_prefix.'comment'), array('max_ordering' => 'MAX(c.ordering)'))
							->where('c.path LIKE ?', $replyTo->path.'%')
							->query()
							->fetch();
				$ordering = (null == $row) ? $replyTo->ordering : $row->max_ordering;
				$path = $replyTo->path.$path;
				$depth = $replyTo->depth + 1;
				$sql = 'UPDATE '.$this->_prefix.'comment 
						SET ordering = ordering + 1
						WHERE page_url = '.$this->_conn->quote($comment->page_url).' AND ordering > '.$this->_conn->quote($ordering);
				$this->_conn->query($sql);
			}
		}		
		
		$where[] = 'comment_id = '.$this->_conn->quote($comment->comment_id);
		return $this->_conn->update($this->_prefix.'comment', array(
										'ordering'	=> $ordering + 1,
										'depth'		=> $depth,
										'path'		=> $path,
									), $where);
	}
	
	public function delete($id) 
	{
		$where[] = 'comment_id ='.$this->_conn->quote($id);
		return $this->_conn->delete($this->_prefix.'comment', $where);
	}
	
	public function toggleActive($comment)
	{
		$sql = 'UPDATE '.$this->_prefix.'comment'
				.' SET is_active = 1 - is_active, activate_date = '.$this->_conn->quote($comment->activate_date)
				.' WHERE comment_id = '.$this->_conn->quote($comment->comment_id);
		return $this->_conn->query($sql);
	}
	
	public function getLatestComments($start, $count, $isActive = null)
	{
		$select = $this->_conn->select()
					->from(array('c' => $this->_prefix.'comment'));
		if (is_bool($isActive)) {
			$select->where('c.is_active = ?', (int)$isActive);
		}
		$select->order('c.activate_date DESC')->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function getLatestCommentsByThread()
	{
		$sql = 'SELECT c.* FROM '.$this->_prefix.'comment AS c 
				WHERE c.comment_id IN (SELECT MAX(c2.comment_id) FROM '.$this->_prefix.'comment AS c2 GROUP BY c2.page_url)
				ORDER BY c.comment_id DESC';
		$rs = $this->_conn->query($sql)->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}

	public function countThreads()
	{
		$sql = 'SELECT COUNT(DISTINCT page_url) AS num_threads FROM '.$this->_prefix.'comment';
		return $this->_conn->query($sql)->fetch()->num_threads;
	}
	
	public function getThreadComments($start, $count, $url, $isActive = null)
	{
		$select = $this->_conn->select()
						->from(array('c' => $this->_prefix.'comment'))
						->where('c.page_url = ?', $url);
		if (is_bool($isActive)) {
			$select->where('c.is_active = ?', (int)$isActive);
		}
		$select->order('c.ordering')
				->limit($count, $start);
		$rs = $select->query()->fetchAll();
		return new Tomato_Core_Model_RecordSet($rs, $this);
	}
	
	public function countThreadComments($url, $isActive = null)
	{
		$select = $this->_conn->select()
					->from(array('c' => $this->_prefix.'comment'), array('num_comments' => 'COUNT(*)'))
					->where('c.page_url = ?', $url);
		if (is_bool($isActive)) {
			$select->where('c.is_active = ?', (int)$isActive);
		}
		$select->limit(1);
		return $select->query()->fetch()->num_comments;
	}
}
