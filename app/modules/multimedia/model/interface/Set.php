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
 * @version 	$Id: Set.php 2120 2010-04-07 19:40:03Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Multimedia_Model_Interface_Set
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Multimedia_Model_Set
	 */
	public function getSetById($id);

	/**
	 * Add new set
	 * 
	 * @param Tomato_Modules_Multimedia_Model_Set $set
	 * @return int
	 */
	public function add($set);
	
	/**
	 * Update set
	 * 
	 * @param Tomato_Modules_Multimedia_Model_Set $set
	 * @return int
	 */
	public function update($set);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param array $exp Search expression. An array contain various conditions, keys including:
	 * 'keyword', 'set_id', 'created_user_id'
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function find($start = null, $count = null, $exp = null);
	
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
	 * Update set title/description
	 * 
	 * @param int $setId
	 * @param string $title
	 * @param string $description
	 * @return int
	 */
	public function updateDescription($setId, $title, $description = null);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function toggleStatus($id);
	
	/**
	 * Get list of sets tagged by given tag
	 * 
	 * @param int $tagId
	 * @param int $start
	 * @param int $count
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getSetsByTag($tagId, $start, $count);
	
	/**
	 * Get number of sets tagged by given tag
	 * 
	 * @param int $tagId
	 * @return int
	 */
	public function countSetsByTag($tagId);
	
	/**
	 * Get list of sets which contain given file
	 * 
	 * @param int $fileId
	 * @param int $limit
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getSetsHavingFile($fileId, $limit);
}
