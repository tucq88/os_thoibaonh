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
 * @version 	$Id: CategoryController.php 2321 2010-04-17 13:10:49Z huuphuoc $
 */

class Category_CategoryController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */

	/**
	 * Add new category
	 * 
	 * @return void
	 */
	public function addAction() 
	{
		$this->view->addHelperPath(TOMATO_APP_DIR.DS.'modules'.DS.'upload'.DS.'views'.DS.'helpers', 'Upload_View_Helper_');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		$this->view->assign('categories', $categories);
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$user 		= Zend_Auth::getInstance()->getIdentity();
			$name 		= $request->getPost('name');
			$slug 		= $request->getPost('slug');
			$parentId 	= $request->getPost('parentId');
			$meta 		= $request->getPost('meta');
			$imageUrl 	= $request->getPost('imageUrl');
			
			$category = new Tomato_Modules_Category_Model_Category(array(
				'name'			=> $name,
				'slug'			=> $slug,
				'meta'			=> $meta,
				'created_date'	=> date('Y-m-d H:i:s'),
				'user_id'		=> $user->user_id,
				'image_url'		=> $imageUrl,
			));
			$id = $categoryDao->add($category, $parentId);
			if ($id > 0) {
				$this->_helper->getHelper('FlashMessenger')->addMessage(
					$this->view->translator('category_add_success')
				);
				$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'category_category_add'));
			}
		}
	}
	
	/**
	 * Delete category
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$response 	= 'RESULT_ERROR';
		$request 	= $this->getRequest();
		if ($request->isPost()) {
			$id 			= $request->getPost('id');
			$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$categoryDao	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
			$categoryDao->setDbConnection($conn);
			$category = $categoryDao->getCategoryById($id);
			
			if ($category != null) {
				$categoryDao->delete($category);
				$response = 'RESULT_OK';
			}
		}
		$this->getResponse()->setBody($response);
	}
	
	/**
	 * Edit category
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$this->view->addHelperPath(TOMATO_APP_DIR.DS.'modules'.DS.'upload'.DS.'views'.DS.'helpers', 'Upload_View_Helper_');
		
		$request 		= $this->getRequest();
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		
		$categories = $categoryDao->getCategoryTree();
		$id 		= $request->getParam('category_id');
		$category 	= $categoryDao->getCategoryById($id);
		
		$this->view->assign('categories', $categories);
		$this->view->assign('category', $category);
		
		if ($request->isPost()) {
			$deleteCategory 		= true;
			$name 					= $request->getPost('name');
			$slug 					= $request->getPost('slug');
			$parentId 				= $request->getPost('parentId');
			$meta 					= $request->getPost('meta');
			$includeChildCategory 	= $request->getPost('include_child_category');
			$includeChildCategory 	= ($includeChildCategory == 1) ? true : false;
			$imageUrl 				= $request->getPost('imageUrl');
			
			$category->name = $name;
			$category->slug = $slug;
			$category->meta = $meta;
			$category->modified_date = date('Y-m-d H:i:s');
			$category->image_url = $imageUrl;

			$parent = $categoryDao->getParentCategory($category);
			if ((null == $parent && $parentId == 0) || ($parent != null && $parent->category_id == $parentId)) {
				$deleteCategory = false;
			}
			$categoryDao->update($category, $parentId, $deleteCategory, $includeChildCategory);
			$this->_helper->getHelper('FlashMessenger')->addMessage(
				$this->view->translator('category_edit_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array('category_id' => $id), 'category_category_edit'));
		}
	}
	
	/**
	 * List categories
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		$this->view->assign('categories', $categories);
	}
}
	