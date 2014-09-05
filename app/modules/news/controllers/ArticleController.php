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
 * @version 	$Id: ArticleController.php 2403 2010-04-18 06:59:53Z huuphuoc $
 */

class News_ArticleController extends Zend_Controller_Action 
{
	/**
	 * Init controller
	 * 
	 * @return void
	 */
	public function init() 
	{
		/**
		 * Register hooks
		 * @since 2.0.2
		 */
		Tomato_Core_Hook_Registry::getInstance()->register('News_Article_Add_ShowSidebar', array(
			new Tomato_Modules_Tag_Hooks_Tagger_Hook(), 
			'show', 
			array(null, 'article_id', 'news_article_details', 'news_tag_article')
		));
		Tomato_Core_Hook_Registry::getInstance()->register(
			'News_Article_Add_Success',
			'Tomato_Modules_Tag_Hooks_Tagger_Hook::add'
		);
		Tomato_Core_Hook_Registry::getInstance()->register(
			'News_Article_Edit_Success',
			'Tomato_Modules_Tag_Hooks_Tagger_Hook::add'
		);
	}
	
	/* ========== Frontend actions ========================================== */
	
	/**
	 * List articles in given category
	 * 
	 * @return void
	 */
	public function categoryAction() 
	{
		$request	= $this->getRequest();
		$categoryId = $request->getParam('category_id');
		$pageIndex 	= $request->getParam('page_index', 1);
		$perPage 	= 25;
		$limit 		= 15;
		$start 		= ($pageIndex - 1) * $perPage;
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$category = $categoryDao->getCategoryById($categoryId);
		
		if (null == $category) {
			throw new Tomato_Core_Exception_NotFound();
		}
		
		// Add RSS link
		$this->view->headLink(array(
			'rel' 	=> 'alternate', 
			'type' 	=> 'application/rss+xml', 
			'title' => 'RSS',
			'href' 	=> $this->view->url($category->getProperties(), 'news_rss_category'),
		));
		
		// Add meta keyword tag
		if ($category->meta) {
			$keyword = strip_tags($category->meta);
			$this->view->headMeta()->setName('keyword', $keyword);
		}
		
		// Add meta description tag
		$description = strip_tags($category->name);
		$this->view->headMeta()->setName('description', $description);
		
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		$articles = $articleDao->getArticlesByCategory($categoryId, $start, $perPage);
		$numArticles = $articleDao->count(array('category_id' => $categoryId));

		$this->view->assign('articles', $articles);
		$this->view->assign('category', $category);
		$this->view->assign('pageIndex', $pageIndex);
		$this->view->assign('limit', $limit);
		$this->view->assign('perPage', $perPage);
		$this->view->assign('numArticles', $numArticles);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($articles, $numArticles));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path'		=> $this->view->url($category->getProperties(), 'news_article_category'),
			'itemLink' 	=> 'page-%d',
		));
	}	
	
	/**
	 * View article details
	 * 
	 * @return void
	 */
	public function detailsAction()
	{
		$request	= $this->getRequest();
		$articleId 	= $request->getParam('article_id');
		$categoryId = $request->getParam('category_id');
		$preview 	= $request->getParam('preview');
		$preview 	= ($preview == 'true') ? true : false;
		
		/**
		 * If user are going to preview article
		 * @since 2.0.4
		 */
		if ($preview) {
			$revisionId = $request->getParam('revision');
			if ($revisionId) {
				$this->_forward('preview', 'article', 'news', array('revision_id' => $revisionId));
				return;
			}
		}
		
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		$article = $articleDao->getArticleById($articleId);
		if (null == $article || ($article->status != 'active' && !$preview)) {
			throw new Tomato_Core_Exception_NotFound();
		}
		
		// Add meta description tag
		$description = strip_tags($article->description);
		$this->view->headMeta()->setName('description', $description);
		
		// Format content
		$article->content = Tomato_Core_Hook_Registry::getInstance()->executeFilter('News_Article_Details_FormatContent', $article->content);
		
		/**
		 * Add activate date
		 * @since 2.0.4
		 */
		if (null == $article->activate_date) {
			$article->activate_date = $article->created_date;
		}
		
		$categoryDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$categoryDao->setDbConnection($conn);
		$category = $categoryDao->getCategoryById($categoryId);
		
		/**
		 * Increase article views
		 */ 
		if (!$preview && $article->status != 'draft') {
			$cookieName = '__tomato_news_details_numviews';
			$viewed = false;
			if (!isset($_COOKIE[$cookieName])) {
				setcookie($cookieName, $articleId, time() + 3600);
			} else {
				if (strpos($_COOKIE[$cookieName], $articleId) === false) {
					$cookie = $_COOKIE[$cookieName].','.$articleId;
					setcookie($cookieName, $cookie);
				} else {
					$viewed = true;
				}
			}
			if (!$viewed) {
				$conn = Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
				$articleDao->setDbConnection($conn);
				$articleDao->increaseViews($articleId);
			}
		}
		
		$this->view->assign('article', $article);
		$this->view->assign('category', $category);
	}
	
	/**
	 * Search articles by keyword
	 * 
	 * @since 2.0.2
	 * @return void
	 */
	public function searchAction()
	{
		$request 	= $this->getRequest();
		$keyword 	= $request->getParam('q');
		$keyword 	= strip_tags($keyword);
		$perPage 	= 10;
		$pageIndex 	= $this->_request->getParam('page_index', 1);
		
		if (null == $keyword) {
			return;
		}
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		
		$start = ($pageIndex - 1) * $perPage;
		$exp = array(
			'keyword' 	=> $keyword,
			'status' 	=> 'active',
		);
		$articles = $articleDao->find($start, $perPage, $exp);
		$numArticles = $articleDao->count($exp);

		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($articles, $numArticles));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		// TODO: Use properties from PaginationControl view helper 
		$from = ($numArticles > 0) ? $start + 1 :0;
		$to = 0;
		if ($numArticles > 0) {
			$to = ($numArticles > $pageIndex * $perPage) 
					? $numArticles - ($pageIndex * $perPage) + 1 
					: $numArticles;	
		}

		$this->view->assign('keyword', $keyword);
		$this->view->assign('pageIndex', $pageIndex);
		$this->view->assign('articles', $articles);
		$this->view->assign('numArticles', $numArticles);
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' 		=> $this->view->url(array(), 'news_article_search'),
			'itemLink' 	=> '?q='.$keyword.'&page_index=%d',
		));
		$this->view->assign('from', $from);
		$this->view->assign('to', $to);
	}	
	
	/**
	 * Suggest list of articles containing keyword
	 * 
	 * @since 2.0.3
	 * @return void 
	 */
	public function suggestAction()
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request	= $this->getRequest();
		$limit 		= $request->getParam('limit');
		$keyword 	= $request->getParam('q');
		$keyword 	= strip_tags($keyword);
		
		$exp = array(
			'keyword' 	=> $keyword,
			'status' 	=> 'active',
		);
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		$articles = $articleDao->find(0, $limit, $exp);
		
		$response = null;
		foreach ($articles as $article) {
			$response .= $article->title.'|'.$article->article_id.'|'.$article->image_square."\n";
		}
		$this->_response->setBody($response);
	}
	
	/* ========== Backend actions =========================================== */
	
	/**
	 * Activate or deactivate article
	 * 
	 * @return void
	 */
	public function activateAction() 
	{
		$request = $this->getRequest();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		if ($request->isPost()) {
			$id 	= $request->getPost('id');
			$status = ($request->getPost('status') == 'active') ? 'inactive' : 'active';
			
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
			$articleDao->setDbConnection($conn);
			$articleDao->updateStatus($id, $status);
			
			$this->getResponse()->setBody($status);
		}
	}
	
	/**
	 * Add new article
	 * 
	 * @return void
	 */
	public function addAction() 
	{
		$request = $this->getRequest();
		$this->view->addHelperPath(TOMATO_APP_DIR.DS.'modules'.DS.'upload'.DS.'views'.DS.'helpers', 'Upload_View_Helper_');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$revisionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getRevisionDao();
		$categoryDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		$revisionDao->setDbConnection($conn);
		$categories = $categoryDao->getCategoryTree();
		
		$descriptionPrefix = Tomato_Core_Module_Config::getConfig('news')->general->description_prefix;
		if (null == $descriptionPrefix) {
			$descriptionPrefix = '';	
		}
		
		$this->view->assign('categories', $categories); 
		$this->view->assign('descriptionPrefix', stripslashes($descriptionPrefix)); 
		
		if ($request->isPost()) {
			$user = Zend_Auth::getInstance()->getIdentity();
			
			$categoryId 	= $request->getPost('category');
			$title 			= $request->getPost('title');
			$subTitle 		= $request->getPost('subTitle');
			$slug 			= $request->getPost('slug');			
			$description 	= $request->getPost('description');
			$content 		= $request->getPost('content');
			$allowComment 	= $request->getPost('allowComment');
			$sticky 		= $request->getPost('stickyCategory');
			$articleCats 	= $request->getPost('categories');
			$icons 			= $request->getPost('icons'); 
			$articleImage 	= $request->getPost('articleImage');
			$author 		= $request->getPost('author');
			$preview 		= $request->getPost('preview');
			$preview 		= ($preview == 'true') ? true : false;
			
			$imageUrls 		= Zend_Json::decode($articleImage);
			$articleIcons 	= "";
			if (count($icons) == 1 ) {
				$articleIcons = '{"'.$icons[0].'"}';
			}
			if (count($icons) == 2 ) {
				$articleIcons = '{"'.$icons[0].'","'.$icons[1].'"}';
			}
			$article = new Tomato_Modules_News_Model_Article(array(
				'category_id' 		=> $categoryId,
				'title' 			=> $title,	
				'sub_title' 		=> $subTitle,
				'slug' 				=> $slug,
				'description' 		=> $description,
				'content' 			=> utf8_encode($content),
				'allow_comment' 	=> $allowComment,
				'created_date' 		=> date('Y-m-d H:i:s'),
				'created_user_id' 	=> $user->user_id,
				'created_user_name' => $user->user_name,
				'author' 			=> $author,
				'icons' 			=> $articleIcons,
				'sticky' 			=> false,
			));
			if ($preview) {
				$article->status = 'draft';
			}
			if ($sticky == 1) {
				$article->sticky = true;
			}
			if (null != $imageUrls) {
				$article->image_square 	= $imageUrls['square'];
				$article->image_large 	= $imageUrls['large'];
				$article->image_general = $imageUrls['general'];
				$article->image_small 	= $imageUrls['small'];
				$article->image_crop 	= $imageUrls['crop'];
				$article->image_medium 	= $imageUrls['medium'];
			}
			$id = $articleDao->add($article);
			if ($id > 0) {				
				/**
				 * Save draft and preview article
				 * @since 2.0.4
				 */
				if ($preview) {
					$this->_helper->getHelper('viewRenderer')->setNoRender();
					$this->_helper->getHelper('layout')->disableLayout();
					$article->article_id = $id;
					$response = array(
						'article_id' 		=> $id,
						'article_url' 		=> $this->view->serverUrl().$this->view->url($article->getProperties(), 'news_article_details').'?preview=true',
						'article_edit_url' 	=> $this->view->serverUrl().$this->view->url($article->getProperties(), 'news_article_edit'),
					);
					$this->_response->setBody(Zend_Json::encode($response));
				} else {
					$articleDao->addArticleToCategory($id, $categoryId);
					if ($articleCats) {
						for ($i = 0; $i < count($articleCats); $i++) {
							if ($articleCats[$i] != $categoryId) {
								$articleDao->addArticleToCategory($id, $articleCats[$i]);
							}
						}
					}
					
					if ($request->getPost('hotArticle') == 1) {
						$articleDao->addHotArticle($id);
					}
					
					/**
					 * Add new revistion
					 * @since 2.0.4
					 */
					$revisionDao->add(new Tomato_Modules_News_Model_Revision(array(
						'article_id' 		=> $id,
						'category_id' 		=> $categoryId,
						'title' 			=> $title,	
						'sub_title' 		=> $subTitle,
						'slug' 				=> $slug,
						'description' 		=> $description,
						'content' 			=> $content,
						'created_date' 		=> date('Y-m-d H:i:s'),
						'created_user_id' 	=> $user->user_id,
						'created_user_name' => $user->user_name,
						'author' 			=> $author,
						'icons' 			=> $articleIcons,
					)));
					
					/**
					 * Execute hooks
					 * @since 2.0.2
					 */
					Tomato_Core_Hook_Registry::getInstance()->executeAction('News_Article_Add_Success', $id);
					
					$this->_helper->getHelper('FlashMessenger')->addMessage($this->view->translator('article_add_success'));
					$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'news_article_add'));
				}
			}
		}
	}
	
	/**
	 * Delete article
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();

		$request 	= $this->getRequest();
		$result 	= 'RESULT_ERROR';
		if ($request->isPost()) {
			$articleId = $request->getPost('id');
			
			$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
			$articleDao->setDbConnection($conn);
			$articleDao->delete($articleId);
			
			$result = 'RESULT_OK';
		}
		$this->getResponse()->setBody($result);
	}	
	
	/**
	 * Edit article
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$this->view->addHelperPath(TOMATO_APP_DIR.'/modules/upload/views/helpers', 'Upload_View_Helper_');
		
		$request 	= $this->getRequest();
		$articleId 	= $request->getParam('article_id');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$revisionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getRevisionDao();
		$categoryDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		$revisionDao->setDbConnection($conn);
		
		$categories 		= $categoryDao->getCategoryTree();
		$article 			= $articleDao->getArticleById($articleId);
		$articleCategories 	= $articleDao->getArticleCategoryIds($articleId);
		$isHotArticle 		= $articleDao->isHotArticle($articleId);
		
		/**
		 * Registry hook
		 * @since 2.0.2
		 */
		Tomato_Core_Hook_Registry::getInstance()->register('News_Article_Edit_ShowSidebar', array(
				new Tomato_Modules_Tag_Hooks_Tagger_Hook(), 
				'show', 
				array($articleId, 'article_id', 'news_article_details', 'news_tag_article')
		));
		
		$this->view->assign('categories', $categories);
		$this->view->assign('article', $article);
		$this->view->assign('articleImages', Zend_Json::encode(array(
			'square' 	=> $article->image_square,
			'large' 	=> $article->image_large,
			'general' 	=> $article->image_general,
			'small' 	=> $article->image_small,
			'crop' 		=> $article->image_crop,
			'medium' 	=> $article->image_medium,
		)));
		$this->view->assign('articleCategories', $articleCategories);
		$this->view->assign('hotArticle', $isHotArticle);
		
		if ($request->isPost()) {
			$user 			= Zend_Auth::getInstance()->getIdentity();
			
			$categoryId 	= $request->getPost('category');
			$title 			= $request->getPost('title');
			$subTitle 		= $request->getPost('subTitle');
			$slug 			= $request->getPost('slug');		
			$description 	= $request->getPost('description');
			$content 		= $request->getPost('content');
			$allowComment 	= $request->getPost('allowComment');
			$sticky	 		= $request->getPost('stickyCategory');
			$articleCats 	= $request->getPost('categories');
			$icons 			= $request->getPost('icons'); 
			$articleImage 	= $request->getPost('articleImage');
			$author 		= $request->getPost('author');			
			$imageUrls 		= Zend_Json::decode($articleImage);
			$preview	 	= $request->getPost('preview');
			$preview 		= ($preview == 'true') ? true : false;
			$articleIcons = "";
			if (count($icons) == 1 ) {
				$articleIcons = '{"'.$icons[0].'"}';
			}
			if (count($icons) == 2 ) {
				$articleIcons = '{"'.$icons[0].'","'.$icons[1].'"}';
			}
			$article = new Tomato_Modules_News_Model_Article(array(
				'article_id' 		=> $articleId,
				'category_id' 		=> $categoryId,
				'title' 			=> $title,	
				'sub_title' 		=> $subTitle,
				'slug' 				=> $slug,
				'description' 		=> $description,
				'content' 			=> utf8_encode($content),
				'allow_comment' 	=> $allowComment,
				'created_date' 		=> date('Y-m-d H:i:s'),
				'created_user_id' 	=> $user->user_id,
				'created_user_name' => $user->user_name,
				'author' 			=> $author,
				'icons' 			=> $articleIcons,
				'sticky' 			=> false,
			));
			if ($sticky == 1) {
				$article->sticky = true;
			}
			if (null != $imageUrls) {
				$article->image_square 	= $imageUrls['square'];
				$article->image_large 	= $imageUrls['large'];
				$article->image_general = $imageUrls['general'];
				$article->image_small 	= $imageUrls['small'];
				$article->image_crop 	= $imageUrls['crop'];
				$article->image_medium 	= $imageUrls['medium'];
			}
			$result = $articleDao->update($article);
			
			if ($preview) {
				$this->_helper->getHelper('viewRenderer')->setNoRender();
				$this->_helper->getHelper('layout')->disableLayout();
				$response = array(
					'article_id' 	=> $article->article_id,
					'article_url' 	=> $this->view->serverUrl().$this->view->url($article->getProperties(), 'news_article_details').'?preview=true',
				);
				$this->_response->setBody(Zend_Json::encode($response));
			} else {
				$articleDao->addArticleToCategory($articleId, $categoryId, true);
				if ($articleCats) {
					for ($i = 0; $i < count($articleCats); $i++) {
						if ($articleCats[$i] != $categoryId) {
							$articleDao->addArticleToCategory($articleId, $articleCats[$i]);
						}
					}
				}
				if ($request->getPost('hotArticle') == 1) {
					$articleDao->addHotArticle($articleId, true);
				}
			
				/**
				 * Add new revistion
				 * @since 2.0.4
				 */
				$revisionDao->add(new Tomato_Modules_News_Model_Revision(array(
					'article_id' 		=> $articleId,
					'category_id' 		=> $categoryId,
					'title' 			=> $title,	
					'sub_title' 		=> $subTitle,
					'slug' 				=> $slug,
					'description' 		=> $description,
					'content' 			=> $content,
					'created_date' 		=> date('Y-m-d H:i:s'),
					'created_user_id' 	=> $user->user_id,
					'created_user_name' => $user->user_name,
					'author'			=> $author,
					'icons' 			=> $articleIcons,
				)));
				
				/**
				 * Execute hooks
				 * @since 2.0.2
				 */
				Tomato_Core_Hook_Registry::getInstance()->executeAction('News_Article_Edit_Success', $articleId);
				
				$this->_helper->getHelper('FlashMessenger')
					->addMessage($this->view->translator('article_edit_success'));
				$this->_redirect($this->view->serverUrl().$this->view->url(array('article_id' => $articleId), 'news_article_edit'));
			}
		}
	}
	
	/**
	 * Manage hot articles
	 * 
	 * @return void
	 */
	public function hotAction() 
	{
		$request 	= $this->getRequest();
		$limit 		= 20;
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		
		if ($request->isPost()) {
			$this->_helper->getHelper('layout')->disableLayout();
			$this->_helper->getHelper('viewRenderer')->setNoRender();
			$articleIds = $request->getPost('tArticleRow');
			$response 	= 'RESULT_NOT_OK';
			
			// Update ordering for all hot articles
			$articleDao->updateHotOrder(1000);
			
			if (is_array($articleIds)) {
				for ($i = 0; $i < count($articleIds); $i++) {
					$articleDao->updateHotOrder($i + 1, $articleIds[$i]);
				}
				$response = 'RESULT_OK';
			}
			$this->getResponse()->setBody($response);
			return;
		}
		
		$articles = $articleDao->getHotArticles($limit);
		$this->view->assign('articles', $articles);
		$this->view->assign('numArticles', $articles->count());
	}
	
	/**
	 * List articles
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$categoryDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		
		$categories = $categoryDao->getCategoryTree();
		
		$request 	= $this->getRequest();
		$pageIndex 	= $this->_request->getParam('pageIndex', 1);
		$perPage 	= 20;
		$start 		= ($pageIndex - 1) * $perPage;
		
		// Build article search expression
		$user 	= Zend_Auth::getInstance()->getIdentity();
		$params = null;
		$exp 	= array(
			'created_user_id' => $user->user_id,
		);
		
		$this->view->assign('categories', $categories);
		$this->view->assign('pageIndex', $pageIndex);
		
		if ($request->isPost()) {
			$id 			= $request->getPost('articleId');
			$keyword 		= $request->getPost('keyword');
			$categoryId 	= $request->getPost('category');
			$status 		= $request->getPost('status');
			$findMineOnly 	= $request->getPost('findMyArticles');
			if ($keyword) {
				$exp['keyword'] = $keyword;
			}
			if ($id) {
				$exp['article_id'] = $id;
			}
			if ($categoryId) {
				$exp['category_id'] = $categoryId;
			}
			if (null == $findMineOnly) {
				$exp['created_user_id'] = null;
			}
			if ($status) {
				$exp['status'] = $status;
			}
			$params = rawurlencode(base64_encode(Zend_Json::encode($exp)));
		} else {
			$params = $request->getParam('q');
			if (null != $params) {
				$exp = rawurldecode(base64_decode($params));
				$exp = Zend_Json::decode($exp); 
			} else {
				$params = rawurlencode(base64_encode(Zend_Json::encode($exp)));
			}
		}
		
		$articles 	 	= $articleDao->find($start, $perPage, $exp);
		$numArticles 	= $articleDao->count($exp);
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($articles, $numArticles));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('exp', $exp);
		$this->view->assign('articles', $articles);
		$this->view->assign('numArticles', $numArticles);
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path'		=> $this->view->url(array(), 'news_article_list'),
			'itemLink' 	=> (null == $params) ? 'page-%d' : 'page-%d?q='.$params,
		));
	}
	
	/**
	 * Preview article
	 * 
	 * @since 2.0.4
	 * @return void
	 */
	public function previewAction() 
	{
		$request 	= $this->getRequest();
		$revisionId = $request->getUserParam('revision_id');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$revisionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getRevisionDao();
		$revisionDao->setDbConnection($conn);
		$revision = $revisionDao->getRevisionById($revisionId);
		if (null == $revision) {
			throw new Tomato_Core_Exception_NotFound();
		}
		$this->view->assign('revision', $revision);
	}
}
