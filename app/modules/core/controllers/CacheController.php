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
 * @version 	$Id: CacheController.php 2324 2010-04-17 13:30:07Z huuphuoc $
 */

class Core_CacheController extends Zend_Controller_Action 
{
	/* ========== Frontend actions ========================================== */
	
	/**
	 * Response output taken from cache
	 * 
	 * @return void
	 */
	public function htmlAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		if (Zend_Layout::getMvcInstance() != null) {
			$this->_helper->getHelper('layout')->disableLayout();	
		}
		
		$request 	= $this->getRequest();
		$type 		= $request->getParam('__cacheType');
		$key 		= $request->getParam('__cacheKey');

		$content = Tomato_Core_Cache_File::fromCache($type, $key);
		$this->getResponse()->setBody($content);
	}
	
	/* ========== Backend actions =========================================== */
	
	/**
	 * Clear cache
	 * 
	 * @return void
	 */
	public function clearAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		Zend_Layout::getMvcInstance()->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$cache = Tomato_Core_Cache::getInstance();
			if ($cache) {
				$cache->clean();
			}
			$this->getResponse()->setBody('RESULT_OK');
		}
	}
	
	/**
	 * Delete cache
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		Zend_Layout::getMvcInstance()->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$type 	= $request->getPost('type');
			$id 	= $request->getPost('id');
			$cache 	= Tomato_Core_Cache::getInstance();
			if ($cache) {
				switch ($type) {
					case 'id':
						$cache->remove($id);
						break;
					case 'tag':
						$cache->clean(Zend_Cache::CLEANING_MODE_MATCHING_TAG, array($id));
						break;
				}
			}
			$this->getResponse()->setBody('RESULT_OK');
		}
	}
	
	/**
	 * List cached items
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$cache = Tomato_Core_Cache::getInstance();
		if (!$cache) {
			return;
		}
		
		$backend 		= $cache->getBackend();
		$supportListIds = false;
		$supportTags 	= false;
		if ($backend instanceof Zend_Cache_Backend_ExtendedInterface) {
			$capabilities 	= $backend->getCapabilities();
			$supportListIds = $capabilities['get_list'];
			$supportTags	= $capabilities['tags'];
		}
		
		$fillingPercentage = !($cache instanceof Zend_Cache_Backend_ExtendedInterface)
							? null
							: $cache->getFillingPercentage();
		if ($supportListIds && $supportTags) {
			$tags = $cache ? $cache->getTags() : null;
			$cacheIds = array();
			if ($tags) {
				foreach ($tags as $tag) {
					$cacheIds[$tag] = $cache->getIdsMatchingTags(array($tag));
				}
			}
			
			$this->view->assign('tags', $tags);
			$this->view->assign('cacheIds', $cacheIds);
		}
		
		$this->view->assign('cache', $cache);
		$this->view->assign('supportListIds', $supportListIds);
		$this->view->assign('supportTags', $supportTags);
		$this->view->assign('fillingPercentage', $fillingPercentage);
		$this->view->assign('backend', get_class($backend));
	}
}
