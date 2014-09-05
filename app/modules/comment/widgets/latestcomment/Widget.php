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
 * @version 	$Id: Widget.php 2392 2010-04-18 06:03:46Z huuphuoc $
 * @since		2.0.2
 */

class Tomato_Modules_Comment_Widgets_Latestcomment_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow()
	{
		$limit 		= $this->_request->getParam('limit', 5);
		
		$conn 		= Tomato_Core_Db_ConnectionFactory::factory()->getSlaveConnection();
		$commentDao = Tomato_Core_Model_Dao_Factory::getInstance()->setModule('comment')->getCommentDao();
		$commentDao->setDbConnection($conn);
		$comments = $commentDao->getLatestComments(0, $limit, true);
		
		$this->_view->assign('comments', $comments);
	}
}
