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
 * @version 	$Id: TagController.php 2348 2010-04-17 16:33:22Z huuphuoc $
 * @since		2.0.2
 */

class Multimedia_TagController extends Zend_Controller_Action
{
	/* ========== Frontend actions ========================================== */
	
	/**
	 * Show list of files by given tag
	 * 
	 * @since 2.0.2
	 * @return void
	 */
	public function fileAction() 
	{
		$request 		= $this->getRequest();
		$tagId 			= $request->getParam('tag_id');
		$detailsRoute 	= $request->getParam('details_route_name');
		$pageIndex 		= $request->getParam('page_index', 1);
		$perPage 		= 18;
		$start 			= ($pageIndex - 1) * $perPage;
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$tagDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagDao();
		$fileDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('multimedia')->getFileDao();
		$tagDao->setDbConnection($conn);
		$fileDao->setDbConnection($conn);
		
		$tag = $tagDao->getTagById($tagId);
		if (null == $tag) {
			throw new Tomato_Core_Exception_NotFound();
		}
		$tag->details_route_name = $detailsRoute;
		
		// Get the list of files tagged by the tag
		$files = $fileDao->getFilesByTag($tagId, $start, $perPage);
		
		// Count number of files tagged by the tag
		$numFiles = $fileDao->countFilesByTag($tagId);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($files, $numFiles));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('tag', $tag);
		$this->view->assign('files', $files);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' => $this->view->url($tag->getProperties(), 'tag_tag_details'),
			'itemLink' => 'page-%d',
		));
	}
	
	/**
	 * Show list of sets by given tag
	 * 
	 * @since 2.0.2
	 * @return void
	 */
	public function setAction() 
	{
		$request 		= $this->getRequest();
		$tagId 			= $request->getParam('tag_id');
		$detailsRoute 	= $request->getParam('details_route_name');
		$pageIndex 		= $request->getParam('page_index', 1);
		$perPage 		= 18;
		$start 			= ($pageIndex - 1) * $perPage;
		
		$conn 	= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$tagDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagDao();
		$setDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('multimedia')->getSetDao();
		$tagDao->setDbConnection($conn);
		$setDao->setDbConnection($conn);
		
		$tag = $tagDao->getTagById($tagId);
		if (null == $tag) {
			throw new Tomato_Core_Exception_NotFound();
		}
		$tag->details_route_name = $detailsRoute;
		
		// Get the list of files tagged by the tag
		$sets = $setDao->getSetsByTag($tagId, $start, $count);
		
		// Count number of sets tagged by the tag
		$numSets = $setDao->countSetsByTag($tagId);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($sets, $numSets));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('tag', $tag);
		$this->view->assign('sets', $sets);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> $this->view->url($tag->getProperties(), 'tag_tag_details'),
			'itemLink' 	=> 'page-%d',
		));
	}
}
