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
 * @version 	$Id: WidgetController.php 2342 2010-04-17 15:30:23Z huuphuoc $
 */

class Core_WidgetController extends Zend_Controller_Action 
{
	/* ========== Frontend actions ========================================== */
	
	/**
	 * Load widget by Ajax
	 * 
	 * @return void
	 */
	public function ajaxAction() 
	{
//		Zend_Registry::set(Tomato_Core_GlobalKey::LOG_REQUEST, false);
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request 	= $this->getRequest();
		$module 	= $request->getParam('mod');
		$name 		= $request->getParam('name');
		$params 	= $request->getParam('params');
		$act 		= $request->getParam('act', 'show');
		
		if ($params != null) {
			$params = Zend_Json::decode($params);
		}
		$return = array('css' => array(), 'javascript' => array(), 'content' => '');
		if ($module == 'null' && $name == 'null') {
			// Default output
			$this->getResponse()->setBody(Zend_Json::encode($return));
			return;
		}
		
		$res 		= Tomato_Core_Widget_Resource::getResources($module, $name);
		$search 	= array('{APP_URL}', '{APP_STATIC_SERVER}');
		$replace 	= array($this->view->baseUrl(), $this->view->APP_STATIC_SERVER);
		foreach ($res['css'] as $style) {
			$return['css'][] = str_replace($search, $replace, $style);	
		}
		foreach ($res['javascript'] as $script) {
			$return['javascript'][] = str_replace($search, $replace, $script);
		}
		
		$widgetClass = 'Tomato_Modules_'.$module.'_Widgets_'.$name.'_Widget';
		if (!class_exists($widgetClass)) {
			$this->getResponse()->setBody(Zend_Json::encode($return));
			return;
		}
		
		$timeout 	= isset($params[Tomato_Core_Layout::CACHE_LIFETIME_PARAM]) ? $params[Tomato_Core_Layout::CACHE_LIFETIME_PARAM] : null;
		$cache 		= Tomato_Core_Cache::getInstance();
		$cacheKey 	= $widgetClass.'_'.md5($module.'_'.$name.'_'.serialize($params));
		if ($cache && $timeout != null) {
			$cache->setLifetime($timeout);
		}
		
		$widget = new $widgetClass($module, $name);
		if (!($widget instanceof Tomato_Core_Widget)) {
			// TODO: Throw exception
		} else {
			if ($act == 'show' && $cache && $timeout) {
				if (!($fromCache = $cache->load($cacheKey))) {
					$content = $widget->show($params);
					$cache->save($content, $cacheKey, array('Tomato_Modules_'.$module.'_Widgets'));
					$return['content'] = $content;
				} else {
					$return['content'] = $fromCache;
				}
			} else {
				$return['content'] = $widget->$act($params);
			}
		}
		$this->getResponse()->setBody(Zend_Json::encode($return));		
	}
	
	/* ========== Backend actions =========================================== */
	
	/**
	 * Install widget
	 * 
	 * @return void
	 */
	public function installAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$module = $request->getPost('mod');
			$name 	= $request->getPost('name');
			
			$info = Tomato_Core_Widget_Config::getWidgetInfo($module, $name);
			if ($info) {
				$widget 	= new Tomato_Modules_Core_Model_Widget($info);
				$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
				$widgetDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getWidgetDao();
				$widgetDao->setDbConnection($conn);
				$id = $widgetDao->add($widget);

				$this->getResponse()->setBody($module.':'.$name.':'.$id);
			} else {
				$this->getResponse()->setBody('RESULT_ERROR');
			}
		}
	}
	
	/**
	 * List widgets
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$dir 		= TOMATO_APP_DIR.DS.'modules';
		$modules 	= Tomato_Core_Utility_File::getSubDir($dir);
		$widgets 	= array();
		foreach ($modules as $module) {
			// Load all widgets from module
			$widgetDirs = Tomato_Core_Utility_File::getSubDir(TOMATO_APP_DIR.DS.'modules'.DS.$module.DS.'widgets');
			if (count($widgetDirs) > 0) {
				$widgets[$module] = array();
				foreach ($widgetDirs as $widgetName) {
					$info = Tomato_Core_Widget_Config::getWidgetInfo($module, $widgetName);
					if ($info != null) { 				
						$widgets[$module][] = new Tomato_Modules_Core_Model_Widget($info);
					}
				}
			}
		}
		
		// Get the list of widgets from database
		$dbWidgets 	= array();
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$widgetDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getWidgetDao();
		$widgetDao->setDbConnection($conn);
		$rs = $widgetDao->getWidgets();
		if ($rs) {
			foreach ($rs as $row) {
				$key = strtolower($row->module.':'.$row->name); 
				$dbWidgets[$key] = $key.':'.$row->widget_id;
			}
		}
		
		$modules = array_keys($widgets);
		
		$this->view->assign('dbWidgets', $dbWidgets);
		$this->view->assign('widgets', $widgets);
		$this->view->assign('modules', $modules);
	}
	
	/**
	 * Uninstall widget
	 * 
	 * @return void
	 */
	public function uninstallAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$module = $request->getPost('mod');
			$name 	= $request->getPost('name');
			$id 	= $request->getPost('id');
			
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$widgetDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getWidgetDao();
			$widgetDao->setDbConnection($conn);
			$widgetDao->delete($id);
			
			$this->getResponse()->setBody($module.':'.$name);
		}
	}
	
	/**
	 * Upload new widget
	 * 
	 * @return void
	 */
	public function uploadAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$file 		= $_FILES['file'];
			$prefix 	= 'widget_'.time();
			$zipFile 	= TOMATO_TEMP_DIR.DS.$prefix.$file['name'];
			move_uploaded_file($file['tmp_name'], $zipFile);
			
			// Process uploaded file
			$zip = Tomato_Core_Zip::factory($zipFile);
			$res = $zip->open();
			if ($res === true) {
				$tempDir = TOMATO_TEMP_DIR.DS.$prefix;
				if (!file_exists($tempDir)) {
					mkdir($tempDir);
				}
				$zip->extract($tempDir);
				
				// Get the first (and only) sub-forder
				$subDirs = Tomato_Core_Utility_File::getSubDir($tempDir);
				$xml = $tempDir.DS.$subDirs[0].DS.'about.xml';
				
				$info = Tomato_Core_Widget_Config::getWidgetInfoFromXml($xml);
				if ($info) {
					// TODO: Check whether the widget was already installed
					$widget 	= new Tomato_Modules_Core_Model_Widget($info);
					$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
					$widgetDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getWidgetDao();
					$widgetDao->setDbConnection($conn);
					$id = $widgetDao->add($widget);
					
					// Copy to the module directory
					$widgetDir = TOMATO_APP_DIR.DS.'modules'.DS.$widget->module.DS.'widgets'.DS.$widget->name;
					Tomato_Core_Utility_File::copyRescursiveDir($tempDir.DS.$subDirs[0], $widgetDir);
				} else {
					// TODO: Still add the widget information to database without its about file
				}
				
				// Remove all the temp files
				$zip->close();
				
				Tomato_Core_Utility_File::deleteRescursiveDir($tempDir);
				unlink($zipFile);
			}
			
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_widget_list'));
		}
	}
}
