<?php
class Utility_Widgets_Zingtopsong_Helper extends Zend_View_Helper_Abstract
{
	public function helper() 
	{
		return $this;
	}
	
	public function link($content) 
	{
		$content = str_replace(" ", "+", trim($content));		
		$url = 'http://mp3.zing.vn/mp3/search/do.html';
		$link = sprintf($this->view->translator()->widget('song_link'), $url, $this->view->escape($content));
		return $link;
	}
}
