<?php
class Tomato_Modules_News_Widgets_Topic_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$tagId = $this->_request->getParam('tag_id');
		$limit 		= $this->_request->getParam('limit', 8);
		
		// Get the parent node
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$dao = Tomato_Core_Model_Dao_Factory::getInstance()->setWidget($this)->getTagDao();
		$dao->setDbConnection($conn);
		$tag = $dao->getTagById($tagId);
		
		if (null == $tag) {
			return;
		}
		
		$this->_view->assign('tag', $tag);
		$this->_view->assign('limit', $limit);
		
		$articleDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('news')->getArticleDao();
		$articleDao->setDbConnection($conn);
		$articles = $articleDao->getArticlesByTag($tag->tag_id, 0, $limit);
		$this->_view->assign('articles', $articles);
	}
	
	protected function _prepareConfig() 
	{
		$conn = Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$dao = Tomato_Core_Model_Dao_Factory::getInstance()->setWidget($this)->getTagDao();
		$dao->setDbConnection($conn);
		$tags = $dao->getAllKeywords();
		
		$this->_view->assign('tags', $tags);
	}
}
