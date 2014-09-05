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
 * @version 	$Id: TagController.php 2316 2010-04-17 12:33:20Z huuphuoc $
 * @since		2.0.2
 */

class News_TagController extends Zend_Controller_Action
{
	/**
	 * Show list of articles by given tag
	 * 
	 * @return void
	 */
	public function articleAction() 
	{
		$request 		= $this->getRequest();
		$tagId 			= $request->getParam('tag_id');
		$detailsRoute 	= $request->getParam('details_route_name');
		$pageIndex 		= $request->getParam('page_index', 1);
		$perPage 		= 20;
		$start 			= ($pageIndex - 1) * $perPage;
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$tagDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagDao();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$tagDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		
		$tag = $tagGateway->getTagById($tagId);		
		if (null == $tag) {
			throw new Tomato_Core_Exception_NotFound();
		}
		$tag->details_route_name = $detailsRoute;
		
		// Get the list of articles tagged by the tag
		$articles = $articleDao->getArticlesByTag($tagId, $start, $perPage);
		
		// Count number of articles tagged by the tag
		$numArticles = $articleDao->countArticlesByTag($tagId);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($articles, $numArticles));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('tag', $tag);
		$this->view->assign('articles', $articles);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> $this->view->url($tag->getProperties(), 'tag_tag_details'),
			'itemLink' 	=> 'page-%d',
		));
	}
}
