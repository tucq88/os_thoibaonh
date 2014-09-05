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
 * @version 	$Id$
 */

class Core_CrawlerController extends Zend_Controller_Action 
{
	public function indexAction()
	{
		ini_set('display_errors', 1);
		ini_set('max_execution_time', 5000);
		
		$this->_helper->getHelper('viewRenderer')->setNoRender();
		$this->_helper->getHelper('layout')->disableLayout();
		
		// Get config
		$config = Tomato_Core_Module_Config::getConfig('core', 'crawler');
		$array = $config->crawler->toArray();
		
		while (list($key , $value) = each($array)) {
			$data1 = explode(';', $value);
			for ($i = 0; $i < count($data1); $i++) {
				$data2 = explode('|', $data1[$i]);
				$params = array(
					'website' => $data2[0],
					'url' => $data2[1],
					'category_ids' => $data2[2],
					'author'	=> $data2[3],
					'name'		=> $data2[4],
				);
				$crawler = new Tomato_Modules_Core_Services_Crawler($params);
			}
		}
	}
}