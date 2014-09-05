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
 * @version 	$Id: PollController.php 2350 2010-04-17 16:45:52Z huuphuoc $
 */

class Poll_PollController extends Zend_Controller_Action 
{
	/* ========== Backend actions =========================================== */

	/**
	 * Activate poll
	 * 
	 * @return void
	 */
	public function activateAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$id	= $request->getPost('id');
						
			$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$questionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getQuestionDao();
			$questionDao->setDbConnection($conn);
			$question = $questionDao->getQuestionById($id);
			if (null == $question) {
				$this->getResponse()->setBody('RESULT_NOT_FOUND');
				return;
			}
			$questionDao->toggleActive($id);
			$isActive = 1 - $question->is_active;
			$data = array(
				'title' 	=> $question->title,
				'is_active'	=> $isActive,
			);
			$this->getResponse()->setBody(Zend_Json::encode($data));			
		}
	}
	
	/**
	 * Add new poll
	 * 
	 * @return void
	 */	
	public function addAction() 
	{
		$request = $this->getRequest();
		if ($request->isPost()) {
			$user 			= Zend_Auth::getInstance()->getIdentity();
			$title 			= $request->getPost('title');
			$content 		= $request->getPost('content');
			$multipleOpts 	= (int)$request->getPost('multiOption');
			$status 		= $request->getPost('status');
			$startDate 		= $request->getPost('start_date');
			$endDate 		= $request->getPost('end_date');
			$answers 		= $request->getPost('answers');
			
			$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$questionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getQuestionDao();
			$questionDao->setDbConnection($conn);
			
			$question = new Tomato_Modules_Poll_Model_Question(array(
				'title'				=> $title,
				'content'			=> $content,
				'created_date'		=> date('Y-m-d H:i:s'),
				'start_date'		=> $startDate,
				'end_date'			=> $endDate,
				'is_active'			=> $status,
				'multiple_options'	=> $multipleOpts,
				'user_id'			=> $user->user_id,
			));
			$questionId = $questionDao->add($question);
			
			if ($answers != null && $questionId != null) {
				$answerDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getAnswerDao();
				$answerDao->setDbConnection($conn);
				
				for ($i = 0; $i < count($answers); $i++) {
					$answerDao->add(new Tomato_Modules_Poll_Model_Answer(array(
						'question_id' 	=> $questionId,
						'title'			=> $answers[$i],
						'position'		=> $i + 1,
						'user_id'		=> $user->user_id,
						'num_views'		=> 0,
					)));
				}
			}
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'poll_add'));
		}
	}
	
	/**
	 * Delete poll
	 * 
	 * @return void
	 */
	public function deleteAction() 
	{
		$this->_helper->getHelper('layout')->disableLayout();
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		
		$request = $this->getRequest();
		if ($request->isPost()) {
			$id = $request->getPost('id');
			
			$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$questionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getQuestionDao();
			$answerDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getAnswerDao();
			$questionDao->setDbConnection($conn);
			$answerDao->setDbConnection($conn);
			
			$question = $questionDao->getQuestionById($id);
			if (null == $question) {
				$this->getResponse()->setBody('RESULT_NOT_FOUND');
				return;
			} 
			
			$answerDao->deleteByQuestion($id);
			$questionDao->delete($id);
			$data = array(
				'title' => $question->title
			);
			$this->getResponse()->setBody(Zend_Json::encode($data));
			return;
		}
		$this->getResponse()->setBody('RESULT_NOT_OK');
	}	
	
	/**
	 * Edit poll
	 * 
	 * @return void
	 */
	public function editAction() 
	{
		$request 	= $this->getRequest();
		$id 		= $request->getParam('poll_id');
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$answerDao 		= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getAnswerDao();
		$questionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getQuestionDao();
		$questionDao->setDbConnection($conn);
		$answerDao->setDbConnection($conn);
		
		$question 	= $questionDao->getQuestionById($id);
		$answers 	= $answerDao->getAnswers($id);
		
		$this->view->assign('question', $question);
		$this->view->assign('answers', $answers);
		
		if ($request->isPost()) {
			$user 			= Zend_Auth::getInstance()->getIdentity();
			$title 			= $request->getPost('title');
			$content 		= $request->getPost('content');
			$multipleOpts 	= (int)$request->getPost('multiOption');
			$status 		= $request->getPost('status');
			$startDate 		= $request->getPost('start_date');
			$endDate 		= $request->getPost('end_date');
			$answers 		= $request->getPost('answers');
			
			$question->title 			= $title;
			$question->content 			= $content;
			$question->multiple_options = $multipleOpts;
			$question->is_active 		= $status;
			$question->start_date 		= $startDate;
			$question->end_date 		= $endDate;
			
			$questionDao->update($question);
			
			$questionId = $question->question_id;
			if ($answers != null && $questionId != null) {
				$answerDao->deleteByQuestion($questionId);
				
				for ($i = 0; $i < count($answers); $i++) {
					$answerDao->add(new Tomato_Modules_Poll_Model_Answer(array(
						'question_id' 	=> $questionId,
						'title'			=> $answers[$i],
						'position'		=> $i + 1,
						'user_id'		=> $user->user_id,
						'num_views'		=> 0,
					)));
				}
			}
			$this->_helper->getHelper('FlashMessenger')->addMessage(
				$this->view->translator('poll_edit_success')
			);
			$this->_redirect($this->view->serverUrl().$this->view->url(array(), 'poll_list'));
		}
	}
	
	/**
	 * List polls
	 * 
	 * @return void
	 */
	public function listAction() 
	{
		$request 	= $this->getRequest();
		$pageIndex 	= $request->getParam('pageIndex', 1);
		$perPage 	= 20;
		$start 		= ($pageIndex - 1) * $perPage;
		
		$conn 			= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
		$questionDao 	= Tomato_Core_Model_Dao_Factory::getInstance()->setModule('poll')->getQuestionDao();
		$questionDao->setDbConnection($conn);
		
		$questions 		= $questionDao->find($start, $perPage);
		$numQuestions 	= $questionDao->count();
		
		// Paginator
		$paginator = new Zend_Paginator(new Tomato_Core_Utility_PaginatorAdapter($questions, $numQuestions));
		$paginator->setCurrentPageNumber($pageIndex);
		$paginator->setItemCountPerPage($perPage);
		
		$this->view->assign('pageIndex', $pageIndex);
		$this->view->assign('questions', $questions);
		$this->view->assign('numQuestions', $numQuestions);
		
		$this->view->assign('paginator', $paginator);
		$this->view->assign('paginatorOptions', array(
			'path' => $this->view->url(array(), 'poll_list'),
			'itemLink' => 'page-%d',
		));
	}	
}
