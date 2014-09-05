<?php
class Tomato_Modules_Utility_Widgets_Weatherforex_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
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
	
	protected function _prepareLoad() 
	{
		$cityUrl = $this->_request->getParam('city_url');
		if (null == $cityUrl) {
			return null;
		}
		$xmls = simplexml_load_file($cityUrl, 'SimpleXMLElement',LIBXML_NOCDATA);
		$city = $xmls[0];

		$this->_view->assign('weather', $city->Weather);
		$this->_view->assign('adimg', $city->AdImg);
		$this->_view->assign('adimg1', $city->AdImg1);
		$this->_view->assign('adimg2', $city->AdImg2);
		$this->_view->assign('adimg3', $city->AdImg3);
	}
}
