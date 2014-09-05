<?php
class Tomato_Modules_Utility_Widgets_Zingtopsong_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$url 	= $this->_request->getParam('url');
		
		try {
			//$entries = Zend_Feed::import($url);
			$url = TOMATO_TEMP_DIR.DS.'mp3.zing.vn.xml';
			$xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);
			$entries = $xml->item;
	    	$limit = $this->_request->getParam('limit', count($entries));
	    	$limit = min(count($entries), $limit);
	    	$items = array();
	    	for ($i = 0; $i < $limit; $i++) {
	    		if ($i > $limit - 1) {
	    			break;
	    		} else {
	    			$items[] = $entries[$i];
	    		}
	    	}
			$this->_view->assign('entries', $items);
			$this->_view->assign('limit', $limit);
		} catch (Exception $ex) {
			echo $ex->getMessage();
		}
	}
}
