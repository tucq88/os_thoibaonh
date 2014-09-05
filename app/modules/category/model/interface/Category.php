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
 * @version 	$Id: Category.php 2105 2010-04-07 15:10:24Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Category_Model_Interface_Category
{
	/**
	 * @param int $id
	 * @return Tomato_Modules_Category_Model_Category
	 */
	public function getCategoryById($id);
	
	/**
	 * Get sub-categories of given category
	 * 
	 * @param int $categoryId Category id
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getSubCategories($categoryId, $depth = 1);
	
	/**
	 * @param Tomato_Modules_Category_Model_Category $category
	 * @param int $parentId
	 * @return int
	 */
	public function add($category, $parentId = null);
	
	/**
	 * @param Tomato_Modules_Category_Model_Category $category
	 * @param int $parentId
	 * @param bool $deleteCategory
	 * @param bool $includeChild
	 * @return void
	 */
	public function update($category, $parentId = null, $deleteCategory = false, $includeChild = true);
	
	/**
	 * @param Tomato_Modules_Category_Model_Category $category
	 * @return void
	 */
	public function delete($category);
	
	/**
	 * Build category tree with depth for each item
	 * 
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getCategoryTree();
	
	/**
	 * @param Tomato_Modules_Category_Model_Category $category
	 * @return Tomato_Modules_Category_Model_Category
	 * @since 2.0.3
	 */
	public function getParentCategory($category);
	
	/**
	 * Get parent categories (From root to parent one)
	 * 
	 * @param int $categoryId
	 * @return Tomato_Core_Model_RecordSet
	 */
	public function getParentCategories($categoryId);
	
	public function getParentId($categoryId);
}
