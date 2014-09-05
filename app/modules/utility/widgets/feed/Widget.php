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
 * @version 	$Id: Widget.php 2384 2010-04-18 05:46:07Z huuphuoc $
 */

class Tomato_Modules_Utility_Widgets_Feed_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$url 	= $this->_request->getParam('url');
		$title 	= $this->_request->getParam('title');
		
		try {
			$entries = Zend_Feed::import($url);
	    	$limit = $this->_request->getParam('limit', count($entries));
	    	$i = 0;
	    	$items = array();
	    	foreach ($entries as $entry) {
	    		$i++;
	    		if ($i > $limit) {
	    			break;
	    		} else {
	    			$items[] = $entry;
	    		}
	    	}
	    	
			$title = ($title == null || $title == '') ? $entries->title() : $title;

			$this->_view->assign('entries', $items);
			$this->_view->assign('limit', $limit);
			$this->_view->assign('title', $title);
		} catch (Exception $ex) {
			// There is problems with network. User work in offline mode, for example
			$this->_view->assign('title', $title);
		}
	}
}
