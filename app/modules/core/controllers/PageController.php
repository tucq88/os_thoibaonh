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
 * @version 	$Id: PageController.php 2333 2010-04-17 14:46:32Z huuphuoc $
 */

class Core_PageController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */

	/**
	 * Add new page
	 * 
	 * @return void
	 */
	public function addAction() 
	{
		$request = $this->getRequest();
		if ($request->isPost()) {
			$name 			= $request->getPost('name');
			$title 			= $request->getPost('title');
			$description 	= $request->getPost('description');
			$url 			= $request->getPost('url');
			$urlType 		= $request->getPost('url_type');
			$paramsName 	= $request->getPost('params_name');
			$paramsValue 	= $request->getPost('params_value');
			$params 		= null;
			
			switch ($urlType) {
				case 'regex':
					if (!empty($paramsName) && !empty($paramsValue)) {
						for ($i = 0; $i < count($paramsName); $i++) {
							$params .= (null == $params) ? '' : ',';
							$params .= '"'.trim($paramsName[$i]).'":"'.trim($paramsValue[$i]).'"';
						}
						$params = (null == $params) ? null : '{'.$params.'}';
					}
					break;
				default:
					break;
			}
			
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
			$pageDao->setDbConnection($conn);			
			$ordering = $pageDao->reupdateOrder();
			
			$page = new Tomato_Modules_Core_Model_LayoutPage(array(
				'name' 			=> $name,
				'title' 		=> $title,
				'description' 	=> $description,
				'url' 			=> $url,
				'url_type' 		=> $urlType,
				'params' 		=> $params,
				'ordering' 		=> $ordering,
			));
			$id = $pageDao->add($page);
			if ($id > 0) {
				// Rewrite layout config file
				$file = TOMATO_APP_DIR.DS.'config'.DS.'layout.ini';
				$pageDao->export($file);
				
				$this->_helper->getHelper('FlashMessenger')->addMessage(
					$this->view->translator('page_add_success')
				);
				$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_page_add'));
			}
		}
	}
	
	/**
	 * Check if the page name has been existed or not
	 * 
	 * @return void
	 */
	public function checkAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request 	= $this->getRequest();
		$checkType 	= $request->getParam('check_type');
		$value 		= $request->getParam($checkType);
		$original 	= $request->getParam('original');
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$pageDao->setDbConnection($conn);
		$result = false;
		if ($original == null || ($original != null && $value != $original)) {
			$result = $pageDao->exist($checkType, $value);
		}
		($result == true) ? $this->getResponse()->setBody('false') 
						  : $this->getResponse()->setBody('true');		
	}
	
	/**
	 * Delete page
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
			$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
			$pageDao->setDbConnection($conn);
			$pageDao->delete($id);

			// Update the page orders
			$ordering = $pageDao->reupdateOrder();
			
			// Rewrite layout config file
			$file = TOMATO_APP_DIR.DS.'config'.DS.'layout.ini';
			$pageDao->export($file);
		}
		$this->getResponse()->setBody('RESULT_OK');
	}
	
	/**
	 * Edit page
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$pageDao->setDbConnection($conn);

		$request 	= $this->getRequest();
		$pageName 	= $request->getParam('page_name');
		$template 	= $request->getParam('template');
		$page 		= $pageDao->getPageByName($pageName);
		
		$params 	= str_replace('{', '', $page->params);
		$params 	= str_replace('}', '', $params);
		$paramsName = $paramsValue = array();
		$params 	= explode(',', $params);
		foreach ($params as $param) {
			$nameValue = explode(':', $param);
			if (count($nameValue) == 2) {
				$paramsName[] 	= str_replace('"', '', trim($nameValue[0]));
				$paramsValue[] 	= str_replace('"', '', trim($nameValue[1]));
			}
		}
		
		$this->view->assign('page', $page);
		$this->view->assign('template', $template);
		$this->view->assign('paramsName', $paramsName);
		$this->view->assign('paramsValue', $paramsValue);
		
		if ($request->isPost()) {
			$pageId 		= $request->getPost('page_id');
			$name 			= $request->getPost('name');
			$title 			= $request->getPost('title');
			$description 	= $request->getPost('description');
			$url 			= $request->getPost('url');
			$urlType 		= $request->getPost('url_type');
			$paramsName 	= $request->getPost('params_name');
			$paramsValue 	= $request->getPost('params_value');
			$params 		= null;
			switch ($urlType) {
				case 'regex':
					if (!empty($paramsName) && !empty($paramsValue)) {
						for ($i = 0; $i < count($paramsName); $i++) {
							$params .= (null == $params) ? '' : ',';
							$params .= '"'.trim($paramsName[$i]).'":"'.trim($paramsValue[$i]).'"';
						}
						$params = (null == $params) ? null : '{'.$params.'}';
					}
					break;
				default:
					break;
			}
			
			$page = new Tomato_Modules_Core_Model_LayoutPage(array(
				'page_id' 		=> $pageId,
				'title' 		=> $title,
				'description' 	=> $description,
				'url' 			=> $url,
				'url_type' 		=> $urlType,
				'params' 		=> $params,
			));
			$result = $pageDao->update($page);
			
			// Rewrite layout config file
			$file = TOMATO_APP_DIR.DS.'config'.DS.'layout.ini';
			$pageDao->export($file);
			
			$this->_helper->getHelper('FlashMessenger')->addMessage(
				$this->view->translator('page_edit_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array('template' => $template, 'page_name' => $pageName), 'core_page_edit')); 
		}
	}
	
	/**
	 * Edit layout of page
	 * 
	 * @return void
	 */
	public function layoutAction() 
	{
		$request 	= $this->getRequest();
		$template 	= $request->getParam('template');
		$pageName 	= $request->getParam('page_name');
		
		$moduleDirs = Tomato_Core_Utility_File::getSubDir(TOMATO_APP_DIR.DS.'modules');
		
		/**
		 * Get modules
		 * TODO: Only show module that has at least one widgets
		 */
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$moduleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getModuleDao();
		$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$moduleDao->setDbConnection($conn);
		$pageDao->setDbConnection($conn);

		$modules 	= $moduleDao->getModules();
		$page 		= $pageDao->getPageByName($pageName);
		
		// Load layout data from JSON file
		$jsonData 	= null;
		$jsonFile 	= TOMATO_APP_DIR.DS.'templates'.DS.$template.DS.'layouts'.DS.$pageName.'.json';
		$xmlFile 	= TOMATO_APP_DIR.DS.'templates'.DS.$template.DS.'layouts'.DS.$pageName.'.xml';
		if (file_exists($jsonFile)) {
			$jsonData = file_get_contents($jsonFile);
		} else if (file_exists($xmlFile)) {
			// Try to build JSON file if it does not exist
			$array = Tomato_Core_Layout::load($xmlFile);
			$array = Zend_Json::encode($array);
			file_put_contents($jsonFile, $array);
			$jsonData = file_get_contents($jsonFile);
		}
		
		$this->view->assign('template', $template);
		$this->view->assign('modules', $moduleDirs);
		$this->view->assign('widgetModules', $modules);
		$this->view->assign('page', $page);
		
		$this->view->assign('jsonData', $jsonData);
	}
	
	/**
	 * List pages
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$request 	= $this->getRequest();
		$template 	= $request->getParam('template');
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
		$pageDao->setDbConnection($conn);		
		$pages = $pageDao->getOrderedPages();
		
		$this->view->assign('template', $template);
		$this->view->assign('pages', $pages);
	}
	
	/**
	 * Update the order of pages
	 * 
	 * @return void
	 */
	public function orderingAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$ids 		= $request->getPost('pageId');
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$pageDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getLayoutPageDao();
			$pageDao->setDbConnection($conn);
			
			// Reset the order
			$pageDao->updateOrder(null, 0);
			
			// Update new order
			if ($ids != null) {
				for ($i = 0; $i < count($ids); $i++) {
					$pageDao->updateOrder($ids[$i], $i);
				}
			}
			
			// Rewrite layout config file
			$file = TOMATO_APP_DIR.DS.'config'.DS.'layout.ini';
			$pageDao->export($file);
		}
		
		$this->getResponse()->setBody('RESULT_OK');
	}
	
	/**
	 * Save page layout
	 * 
	 * @return void
	 */	
	public function savelayoutAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$template 	= $request->getPost('template');
			$page 		= $request->getPost('page');
			$jsonLayout = $request->getPost('layout');
			$layout 	= Zend_Json::decode($jsonLayout);
			
			// Save data in JSON format for reading process more easy later
			$jsonFile 	= TOMATO_APP_DIR.DS.'templates'.DS.$template.DS.'layouts'.DS.$page.'.json';
			$f 	= fopen($jsonFile, 'w');
			fwrite($f, $jsonLayout);
			fclose($f);
			
			$xmlFile = TOMATO_APP_DIR.DS.'templates'.DS.$template.DS.'layouts'.DS.$page.'.xml';
			Tomato_Core_Layout::save($xmlFile, $layout);
			
			$this->getResponse()->setBody('RESULT_OK');	
		}
	}
	
	/**
	 * Load widgets
	 * 
	 * @return void
	 */
	public function widgetsAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request 	= $this->getRequest();
		$module 	= $request->getParam('mod');
		$pageIndex 	= $request->getParam('page', 1);
		$perPage 	= 10;
		$start 		= ($pageIndex - 1) * $perPage;
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$widgetDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getWidgetDao();
		$widgetDao->setDbConnection($conn);
		
		// Get the number of widgets in the module
		$numWidgets = $widgetDao->count($module);
					
		// List widgets
		$widgets = $widgetDao->getWidgets($start, $perPage, $module);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($widgets, $numWidgets));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('widgets', $widgets);
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> '',
			'itemLink' 	=> "javascript: loadWidgets(%d, '$module');",
		));
	}
}
