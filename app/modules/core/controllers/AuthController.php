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
 * @version 	$Id: AuthController.php 2323 2010-04-17 13:25:22Z huuphuoc $
 */

class Core_AuthController extends Zend_Controller_Action 
{
	/**
	 * Init controller
	 * 
	 * @return void
	 */
	public function init() 
	{
		Zend_Layout::getMvcInstance()->setLayoutPath(TOMATO_APP_DIR.DS.'templates'.DS.'admin'.DS.'layouts');
		Zend_Layout::getMvcInstance()->setLayout('auth');
	}
	
	/* ========== Frontend actions ========================================== */
	
	/**
	 * Deny access
	 * 
	 * @return void
	 */
	public function denyAction() 
	{
	}
	
	/**
	 * Login
	 * 
	 * @return void
	 */
	public function loginAction() 
	{
		$request 	= $this->getRequest();
		$auth 		= Zend_Auth::getInstance();
		
		// Redirect to dashboard if user has logged in already 
		if ($auth->hasIdentity()) {
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_index_dashboard'));
		}
		if ($request->isPost()) {
			$username 	= $request->getPost('username');
			$password 	= $request->getPost('password');
			$adapter 	= new Tomato_Modules_Core_Services_Auth($username, $password);
			$result 	= $auth->authenticate($adapter);
			switch ($result->getCode()) {
				/** 
				 * Not found
				 */
				default:
				case Tomato_Modules_Core_Services_Auth::FAILURE:
					$message = $this->view->translator('auth_login_failure');
					$this->_helper->getHelper('FlashMessenger')->addMessage($message);
					$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_auth_login'));
					break;
					
				/**
				 * Found user, but the account has not been activated
				 */
				case Tomato_Modules_Core_Services_Auth::NOT_ACTIVE:
					$this->_helper->getHelper('FlashMessenger')
						->addMessage($this->view->translator('auth_login_user_not_activated'));
					$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_auth_login'));
					break;
					
				/**
				 * Logged in successfully
				 */
				case Tomato_Modules_Core_Services_Auth::SUCCESS:
					$user = $auth->getIdentity();
					
					Tomato_Core_Hook_Registry::getInstance()->executeAction('Core_Auth_Login_LoginSuccess', $user);
					$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'core_index_dashboard'));
					break;
			}
		}
	}
	
	/**
	 * Logout
	 * 
	 * @return void
	 */
	public function logoutAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()) {
			$user = $auth->getIdentity();
			
			Tomato_Core_Hook_Registry::getInstance()->executeAction('Core_Auth_Login_LogoutSuccess', $user);
			// Clear Session
			Zend_Session::destroy(false, false);
			
			$auth->clearIdentity();
		}
		$this->_redirect($this->view->baseUrl());
	}
}
