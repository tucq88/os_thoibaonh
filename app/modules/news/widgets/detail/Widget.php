<?php
class Tomato_Modules_News_Widgets_Detail_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$articleId = $this->_request->getParam('article_id');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$categoryDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('category')->getCategoryDao();
		$articleDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$categoryDao->setDbConnection($conn);
		$articleDao->setDbConnection($conn);
		
		$article = $articleDao->getArticleById($articleId);
		$this->_view->assign('article', $article);
		
		if ($article != null) {
			$category = $categoryDao->getCategoryById($article->category_id);
			$this->_view->assign('category', $category);
		}
	}	
}
