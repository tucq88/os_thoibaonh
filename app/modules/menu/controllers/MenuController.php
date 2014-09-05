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
 * @version 	$Id: MenuController.php 2343 2010-04-17 15:38:37Z huuphuoc $
 * @since		2.0.2
 */

class Menu_MenuController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */
	
	/**
	 * Build new menu
	 * 
	 * @return void
	 */	
	public function buildAction() 
	{
		$request = $this->getRequest();
		if ($request->isPost()) {
			$name 			= $request->getPost('menu_name');
			$description 	= $request->getPost('menu_description');
			$data 			= $request->getPost('menu_html_data');
			
			$user = Zend_Auth::getInstance()->getIdentity();
			$menu = new Tomato_Modules_Menu_Model_Menu(array(
				'name'			=> $name,
				'description'	=> $description,
				'json_data'		=> $data,
				'user_id'		=> $user->user_id,
				'user_name'		=> $user->user_name,
				'created_date'	=> date('Y-m-d H:i:s'), 		
			));
					
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$menuDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
			$menuDao->setDbConnection($conn);
			$menuDao->add($menu);
			
			$this->_helper->getHelper('FlashMessenger')->addMessage(
				$this->view->translator('menu_build_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'menu_build'));
		}
	}
	
	/**
	 * Delete menu
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$id 		= $request->getPost('id');
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$menuDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
			$menuDao->setDbConnection($conn);

			$menu = $menuDao->getMenuById($id);
			if (null == $menu) {
				$this->getResponse()->setBody('RESULT_NOT_FOUND');
				return;
			} 
			$menuDao->delete($id);
			$data = array(
				'name' => $menu->name
			);
			$this->getResponse()->setBody(Zend_Json::encode($data));
			return;
		}
		$this->getResponse()->setBody('RESULT_NOT_OK');
	}
	
	/**
	 * Edit menu
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$request 	= $this->getRequest();
		$id 		= $request->getParam('menu_id');
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$menuDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
		$menuDao->setDbConnection($conn);
		
		$menu = $menuDao->getMenuById($id);
		if (null == $menu) {
			return;
		}
		
		$this->view->assign('baseUrl', $request->getBaseUrl());
		$this->view->assign('menu', $menu);	
		$this->view->assign('menuData', Zend_Json::decode($menu->json_data));
		
		if ($request->isPost()) {
			$name 			= $request->getPost('menu_name');
			$description 	= $request->getPost('menu_description');
			$data 			= $request->getPost('menu_html_data');
			
			$menu->name = $name;
			$menu->description = $description;
			$menu->json_data = $data;
			$menuDao->update($menu);
			
			$this->_helper->getHelper('FlashMessenger')->addMessage(
					$this->view->translator('menu_edit_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'menu_list'));
		}
	} 
	
	/**
	 * List menus
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$request 	= $this->getRequest();
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$menuDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('menu')->getMenuDao();
		$menuDao->setDbConnection($conn);	
		
		$perPage 	= 20;
		$pageIndex 	= $request->getParam('pageIndex', 1);
		$start 		= ($pageIndex - 1) * $perPage;
		
		$menus 		= $menuDao->getMenus($start, $perPage);
		$numMenus 	= $menuDao->count();
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($menus, $numMenus));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('pageIndex', $pageIndex);
		$this->view->assign('menus', $menus);
		$this->view->assign('numMenus', $numMenus);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> $this->view->url(array(), 'menu_list'),
			'itemLink' 	=> 'page-%d',
		));		
	}
}
