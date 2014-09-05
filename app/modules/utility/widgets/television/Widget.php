<?php
class Tomato_Modules_Utility_Widgets_Television_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		$channels = array(
						$this->_view->translator()->widget('channel_1'),
						$this->_view->translator()->widget('channel_2'),
						$this->_view->translator()->widget('channel_3'),
						$this->_view->translator()->widget('channel_4'),
						$this->_view->translator()->widget('channel_5'),
						$this->_view->translator()->widget('channel_6'),
						$this->_view->translator()->widget('channel_7'),
						$this->_view->translator()->widget('channel_8'),
						$this->_view->translator()->widget('channel_9'),
						$this->_view->translator()->widget('channel_10'),
						$this->_view->translator()->widget('channel_11'),
						$this->_view->translator()->widget('channel_12'),
						$this->_view->translator()->widget('channel_13'),
						$this->_view->translator()->widget('channel_14'),
						$this->_view->translator()->widget('channel_15'),
						$this->_view->translator()->widget('channel_16'),
						$this->_view->translator()->widget('channel_17'),
						$this->_view->translator()->widget('channel_18'),
						$this->_view->translator()->widget('channel_19'),
						$this->_view->translator()->widget('channel_20'),
					);
		$this->_view->assign('channels', $channels);
	}
	
	protected function _prepareLoad() 
	{
		try {
			$url = $this->_request->getParam('url');
			$xml = simplexml_load_file($url, 'SimpleXMLElement', LIBXML_NOCDATA);
			$date = $xml->Date;
			$items = $xml->Items;
			$this->_view->assign('channel', $items);

			$data = array();
			foreach ($items->Item as $item) {
				$data[] = $item;
			} 
			$this->_view->assign('date', $date);
			$this->_view->assign('data', $data);
		} catch (Exception $ex) {
			$this->_view->assign('content', $ex->getMessage());
		}
	}
}
