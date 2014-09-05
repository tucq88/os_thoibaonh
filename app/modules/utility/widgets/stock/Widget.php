<?php
class Tomato_Modules_Utility_Widgets_Stock_Widget extends Tomato_Core_Widget 
{
	protected function _prepareShow() 
	{
		
	}
	
	protected function _prepareLoad() 
	{
		try {
			$url = $this->_request->getParam('url');
			$content = file_get_contents($url);

			$this->_view->assign('content', $content);
		} catch (Exception $ex) {
			$this->_view->assign('content', $ex->getMessage());
		}
	}
}
