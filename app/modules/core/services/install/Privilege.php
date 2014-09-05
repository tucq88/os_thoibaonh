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
 * @version 	$Id: Privilege.php 2361 2010-04-17 19:24:16Z huuphuoc $
 * @since		2.0.3
 */

/**
 * Import all resources and previleges when user install TomatoCMS
 */
class Tomato_Modules_Core_Services_Install_Privilege
{
	/**
	 * @var Tomato_Modules_Core_Model_Interface_Privilege
	 */
	private $_privilegeInterface;
	
	/**
	 * @var Tomato_Modules_Core_Model_Interface_Resource
	 */
	private $_resourceInterface;
	
	/**
	 * Set previlege gateway
	 * 
	 * @param Tomato_Modules_Core_Model_Interface_Privilege $dao
	 */
	public function setPrivilegeInterface($dao) 
	{
		$this->_privilegeInterface = $dao;
	}

	/**
	 * Set resource gateway
	 * 
	 * @param Tomato_Modules_Core_Model_Interface_Resource $dao
	 */
	public function setResourceInterface($dao) 
	{
		$this->_resourceInterface = $dao;
	}
	
	/**
	 * Install all previleges of given module
	 * 
	 * @param string $module Name of module
	 */
	public function install($module) 
	{
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$view = $viewRenderer->view;
		
		$file = TOMATO_APP_DIR.DS.'modules'.DS.$module.DS.'config'.DS.'permissions.xml';
		if (!file_exists($file)) {
			return null;
		}
		$xml = simplexml_load_file($file);
		foreach ($xml->resource as $res) {
			$attr = $res->attributes();
			
			$langKey = (string) $attr['langKey'];
			
			$description = $view->translator($langKey, $module);
			$description = ($description == $langKey) ? (string) $attr['description'] : $description;
			
			$resource = new Tomato_Modules_Core_Model_Resource(array(
				'description' 		=> $description,
				'parent_id' 		=> null,
				'module_name' 		=> $module,
				'controller_name' 	=> $attr['name'],
			));
			
			// Add resource
			$this->_resourceInterface->add($resource);
			
			if ($res->privilege) {
				foreach ($res->privilege as $pri) {
					$attr2 = $pri->attributes();
					$langKey = (string) $attr2['langKey'];
					
					$description = $view->translator($langKey, $module);
					$description = ($description == $langKey) ? (string) $attr2['description'] : $description;
					$privilege = new Tomato_Modules_Core_Model_Privilege(array(
						'name' 				=> $attr2['name'],
						'description' 		=> $description,
						'module_name' 		=> $module,
						'controller_name' 	=> $attr['name'],
					));
					
					$this->_privilegeInterface->add($privilege);
				}
			}
		}
	}
}
