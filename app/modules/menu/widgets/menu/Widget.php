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
 * @version 	$Id: Widget.php 2393 2010-04-18 06:04:41Z huuphuoc $
 * @since		2.0.2
 */

class Tomato_Modules_Menu_Widgets_Menu_Widget extends Tomato_Core_Widget
{
	protected function _prepareShow()
	{
		$categoryId 	= $this->_request->getParam('category_id');
		$menuId 	= $this->_request->getParam('menu_id');
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$menuDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
		$menuDao->setDbConnection($conn);
		
		$menu 		= $menuDao->getMenuById($menuId);
		$menuData 	= (null == $menu) ? null : Zend_Json::decode($menu->json_data);
		
		$this->_view->assign('menuData', $menuData);
		$this->_view->assign('uuid', uniqid());
		
		$day = strtolower(date('D'));
		$date = date('d/m/Y H:i P'); 
		
		$this->_view->assign('day', $day);
		$this->_view->assign('date', $date);
		$this->_view->assign('categoryId', $categoryId);
	}
	
	protected function _prepareConfig()
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$menuDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
		$menuDao->setDbConnection($conn);
		$menus = $menuDao->getMenus();
		$this->_view->assign('menus', $menus);
	}
}
