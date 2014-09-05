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
 * @version 	$Id: Widget.php 2395 2010-04-18 06:43:22Z huuphuoc $
 */

class Tomato_Modules_News_Widgets_LatestSubCategory_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$categoryId = $this->_request->getParam('category_id');
		$limit 		= $this->_request->getParam('limit', 12);
		
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getSubCategories($categoryId, 1);

		if (count($categories) > 0 && ($categories[0]->right_id - $categories[0]->left_id == 1)) {
			$parentId = $categoryDao->getParentId($categoryId);
			$categories = ($categoryId == $parentId) ? $categories
							 : $categoryDao->getSubCategories($parentId, 1);
		}
		
		$this->_view->assign('categories', $categories);
		$this->_view->assign('categoryId', $categoryId);
		$this->_view->assign('limit', $limit);
	}
	
	protected function _prepareConfig()
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		
		$this->_view->assign('categories', $categories); 
	}	
}
