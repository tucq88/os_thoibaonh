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
 * @version 	$Id: File.php 2121 2010-04-08 01:42:53Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Multimedia_Model_Interface_File
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Multimedia_Model_File
	 */
	public function getFileById($id);

	/**
	 * Add new file
	 * 
	 * @param Tomato_Modules_Multimedia_Model_File $file
	 * @return int
	 */
	public function add($file);
	
	/**
	 * @param int $start
	 * @param int $count
	 * @param array $exp Search expression. An array contain various conditions, keys including:
	 * 'keyword', 'file_id', 'created_user', 'is_active'
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
	 * Update file title/description
	 * 
	 * @param int $fileId
	 * @param string $title
	 * @param string $description
	 * @return int
	 */
	public function updateDescription($fileId, $title, $description = null);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function toggleStatus($id);
	
	/**
	 * Update file
	 * 
	 * @param Tomato_Modules_Multimedia_Model_File $file
	 * @return int
	 */
	public function update($file);

	/**
	 * Get files from given set
	 * 
	 * @param int $setId
	 * @param int $start
	 * @param int $count
	 * @param bool $isActive
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getFilesInSet($setId, $start = null, $count = null, $isActive = null);
	
	/**
	 * Count the number of files belonging to given set
	 * 
	 * @param int $setId
	 * @param bool $isActive
	 * @return int
	 */
	public function countFilesInSet($setId, $isActive = null);
	
	/**
	 * Remove file or all file from given set
	 * 
	 * @param int $setId
	 * @param int $fileId
	 */
	public function removeFilesFromSet($setId, $fileId = null);
	
	/**
	 * Add file to set
	 * 
	 * @param int $setId
	 * @param int $fileId
	 */
	public function addFileToSet($setId, $fileId);
	
	/**
	 * Get list of files tagged by given tag
	 * 
	 * @param int $tagId
	 * @param int $start
	 * @param int $count
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getFilesByTag($tagId, $start, $count);
	
	/**
	 * Get number of files tagged by given tag
	 * 
	 * @param int $tagId
	 * @return int
	 */
	public function countFilesByTag($tagId);
}
