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
 * @version 	$Id: Hook.php 2386 2010-04-18 05:50:01Z huuphuoc $
 * @since		2.0.2
 */

class Tomato_Modules_Tag_Hooks_Tagger_Hook 
{
	public static function show($itemId = null, $itemName, $routeName, $detailsRouteName)
	{
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
		$view = $viewRenderer->view;
		
		if ($itemId) {
			$conn 	= Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$tagDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagDao();
			$tagDao->setDbConnection($conn);
			$tags = $tagDao->getTagsByItem(new Tomato_Modules_Tag_Model_TagItem(array(
												'item_id' => $itemId,
												'item_name' => $itemName,
												'route_name' => $routeName,
												'details_route_name' => $detailsRouteName,
											)));
			$view->assign('tags', $tags);
		}
		
		$view->assign('tagItemName', $itemName);
		$view->assign('tagItemRouteName', $routeName);
		$view->assign('tagDetailsRouteName', $detailsRouteName);
		$view->addScriptPath(TOMATO_APP_DIR.DS.'modules'.DS.'tag'.DS.'views'.DS.'scripts');
		echo $view->render('partial/_tagger.phtml');
	}
	
	public static function add($itemId)
	{
		$request 		= Zend_Controller_Front::getInstance()->getRequest();
		$itemName 		= $request->getParam('tagItemName');
		$itemRouteName 	= $request->getParam('tagItemRouteName');
		$detailsRoute 	= $request->getParam('tagDetailsRouteName');
		$tagIds 		= $request->getParam('tagIds');
		
		if ($tagIds) {
			$conn = Tomato_Core_Db_ConnectionFactory::factory()->getMasterConnection();
			$tagItemDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('tag')->getTagItemDao();
			$tagItemDao->setDbConnection($conn);
			$tagItemDao->delete(new Tomato_Modules_Tag_Model_TagItem(array(
									'item_id' 				=> $itemId,
									'item_name' 			=> $itemName,
									'route_name' 			=> $itemRouteName,
									'details_route_name' 	=> $detailsRoute,
								)));
			
			foreach ($tagIds as $tagId) {
				$tagItemDao->add(new Tomato_Modules_Tag_Model_TagItem(array(
									'tag_id' 				=> $tagId,
									'item_id' 				=> $itemId,
									'item_name' 			=> $itemName,
									'route_name' 			=> $itemRouteName,
									'details_route_name' 	=> $detailsRoute,
									'params' 				=> $itemName.':'.$itemId,
								)));
			}
		}
	}
}
