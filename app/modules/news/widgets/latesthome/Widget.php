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

class Tomato_Modules_News_Widgets_Latesthome_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$limit 			= $this->_request->getParam('limit', 5);
		$categoryIds 	= $this->_request->getParam('category_ids', null);
		
		if ($categoryIds != null && $categoryIds != '') {
			$categoryIds = explode(',', $categoryIds);
			$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
			$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
			$categoryDao->setDbConnection($conn);
			
			$categories = array();
			foreach ($categoryIds as $id) {
				$category = $categoryDao->getCategoryById($id);
				if ($category) {
					$categories[] = $category;
				}
			}
			$this->_view->assign('categories', $categories);
		}
		
		$this->_view->assign('limit', $limit);	
	}
	
	protected function _prepareConfig() 
	{
		$params 		= $this->_request->getParam('params');
		$categoryIds 	= array();
		$categoryIdsStr = '';
		if ($params) {
			$params 		= Zend_Json::decode($params);
			$categoryIdsStr = $params['category_ids']['value'];
			$categoryIds 	= explode(',', $categoryIdsStr);
		}
		
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		
		$this->_view->assign('categories', $categories);
		$this->_view->assign('categoryIds', $categoryIds);
		$this->_view->assign('categoryIdsString', $categoryIdsStr);
		$this->_view->assign('uniqueId', uniqid());
	}		
}
