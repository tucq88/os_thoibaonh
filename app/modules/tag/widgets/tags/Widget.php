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
 * @version 	$Id: Widget.php 2385 2010-04-18 05:48:08Z huuphuoc $
 * @since		2.0.2
 */

class Tomato_Modules_Tag_Widgets_Tags_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$limit 		= $this->_request->getParam('limit');
		$router 	= Zend_Controller_Front::getInstance()->getRouter();
		$routeName 	= $router->getCurrentRouteName();
		$currRoute 	= $router->getCurrentRoute();
		$params 	= array();
		if (!($currRoute instanceof Zend_Controller_Router_Route_Regex)) {
			return;
		}
		$requestParams = Zend_Controller_Front::getInstance()->getRequest()->getParams();
		foreach ($currRoute->getVariables() as $variable) {
			$params[] = $variable.':'.$requestParams[$variable]; 
		}
		$params = '|'.implode('|', $params).'|';
		$conn 	= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$tagDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagDao();
		$tagDao->setDbConnection($conn);
		$tags = $tagDao->getTagsByRoute(new Tomato_Modules_Tag_Model_TagItem(array(
									'route_name' => $routeName,
									'params' => $params
								)), $limit);
		$this->_view->assign('tags', $tags);
		
		// TODO: Add tag to keyword meta
		// Following code does not work
		// $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		// $viewRenderer->view->headMeta()->setName('keyword', 'tag1, tag2, tag3');
	}
}
