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
 * @version 	$Id: RuleController.php 2338 2010-04-17 15:05:56Z huuphuoc $
 */

class Core_RuleController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */
	
	/**
	 * Manage rules of role
	 * 
	 * @return void
	 */
	public function roleAction() 
	{
		$request 	= $this->getRequest();
		$roleId 	= $request->getParam('role_id');
		
		$modules 	= Tomato_Core_Utility_File::getSubDir(TOMATO_APP_DIR.DS.'modules');
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$roleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getRoleDao();
		$ruleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getRuleDao();
		$roleDao->setDbConnection($conn);
		$ruleDao->setDbConnection($conn);
		$role = $roleDao->getRoleById($roleId);
		if ($role->locked) {
			return;
		} 
		
		$this->view->assign('modules', $modules);
		$this->view->assign('role', $role);
		
		if ($request->isPost()) {
			// Reset all the rules
			$ruleDao->removeFromRole($roleId);

			// Update new rule
			$privileges = $request->getPost('privileges');
			if ($privileges) {
				foreach ($privileges as $priv) {
					list($privId, $resourceName) = explode('_', $priv);
					
					$ruleDao->add(new Tomato_Modules_Core_Model_Rule(array(
						'obj_id' 		=> $roleId,
						'obj_type' 		=> 'role',
						'privilege_id' 	=> $privId,
						'allow' 		=> 1,
						'resource_name' => $resourceName,
					)));
				}
			}
			$this->_redirect($this->view->serverUrl().$this->view->url(array('role_id' => $roleId), 'core_rule_set_role'));
		}
	}
	
	/**
	 * Manage rules of user
	 * 
	 * @return void
	 */
	public function userAction() 
	{
		$request 	= $this->getRequest();
		$userId 	= $request->getParam('user_id');
		
		$modules 	= Tomato_Core_Utility_File::getSubDir(TOMATO_APP_DIR.DS.'modules');
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$userDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getUserDao();
		$ruleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('core')->getRuleDao();
		$userDao->setDbConnection($conn);
		$ruleDao->setDbConnection($conn);
		$user = $userDao->getUserById($userId);
		if (!$user->is_active) {
			return;
		}
		
		$this->view->assign('modules', $modules);
		$this->view->assign('user', $user);
		
		if ($request->isPost()) {
			// Reset all the rules
			$ruleDao->removeFromUser($userId);
			
			// Update new rule
			$privileges = $request->getPost('privileges');
			if ($privileges) {
				foreach ($privileges as $priv) {
					list($privId, $resourceName) = explode('_', $priv);
					
					$ruleDao->add(new Tomato_Modules_Core_Model_Rule(array(
						'obj_id' 		=> $userId,
						'obj_type' 		=> 'user',
						'privilege_id' 	=> $privId,
						'allow' 		=> 1,
						'resource_name' => $resourceName,
					)));
				}
			}
			$this->_redirect($this->view->serverUrl().$this->view->url(array('user_id' => $userId), 'core_rule_set_user'));
		}
	}
}
