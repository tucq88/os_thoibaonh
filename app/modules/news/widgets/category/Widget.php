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

class Tomato_Modules_News_Widgets_Category_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$categoryId = $this->_request->getParam('category_id');
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$categoryDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		
		$categories = $categoryDao->getCategoryTree();
		
		$this->_view->assign('categories', $categories);
		$this->_view->assign('articleDao', $articleDao);
		$this->_view->assign('categoryId', $categoryId);
	}

	protected function _prepareConfig() 
	{
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		
		$this->_view->assign('categories', $categories); 
	}
}
