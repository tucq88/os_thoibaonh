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

class Tomato_Modules_News_Widgets_LatestCategory_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$categoryId = $this->_request->getParam('category_id');
		$limit 		= $this->_request->getParam('limit', 3);
		
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$dao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$dao->setDbConnection($conn);
		$articles = $dao->getArticlesByCategory($categoryId, 0, $limit);

		$this->_view->assign('articles', $articles);
		$this->_view->assign('category', $categoryId);
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
