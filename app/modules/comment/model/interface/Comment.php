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
 * @version 	$Id: Comment.php 2109 2010-04-07 16:40:13Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Comment_Model_Interface_Comment
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Comment_Model_Comment
	 */
	public function getCommentById($id);
	
	/**
	 * @param Tomato_Modules_Comment_Model_Comment $comment
	 * @return int
	 */
	public function add($comment);
	
	/**
	 * @param Tomato_Modules_Comment_Model_Comment $comment
	 * @return int
	 */
	public function update($comment);
	
	/**
	 * Update order, depth and path for comment and all comments in same thread
	 * 
	 * @param Tomato_Modules_Comment_Model_Comment $comment
	 * @return int
	 */
	public function reupdateOrderInThread($comment);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * @param Tomato_Modules_Comment_Model_Comment $comment
	 * @return int
	 */
	public function toggleActive($comment);
	
	/**
	 * Get latest comments
	 * 
	 * @param int $start
	 * @param int $count
	 * @param bool $isActive
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getLatestComments($start, $count, $isActive = null);
	
	/**
	 * Get latest comments groupped by thread
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getLatestCommentsByThread();
	
	/**
	 * Count the number of threaded comments
	 * 
	 * @return int
	 */
	public function countThreads();
	
	/**
	 * Get latest comments in same thread
	 *
	 * @param int $start
	 * @param int $count
	 * @param string $url Thread URL
	 * @param bool $isActive
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getThreadComments($start, $count, $url, $isActive = null);
	
	/**
	 * Count number of comments in thread
	 * 
	 * @param string $url Thread URL
	 * @param bool $isActive
	 * @return int
	 */
	public function countThreadComments($url, $isActive = null);
}
