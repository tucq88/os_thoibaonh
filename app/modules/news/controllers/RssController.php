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
 * @version 	$Id: RssController.php 2315 2010-04-17 12:30:12Z huuphuoc $
 */

class News_RssController extends Zend_Controller_Action 
{
	/* ========== Frontend actions ========================================== */
	
	/**
	 * View RSS output
	 * 
	 * @return void
	 */
	public function indexAction() 
	{
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		$categoryId = $this->getRequest()->getParam('category_id');
		$output 	= Tomato_Modules_News_Services_Rss::feed($categoryId);
		
		header('Content-Type: application/rss+xml; charset=utf-8');
		$this->getResponse()->setBody($output);
	}
}
