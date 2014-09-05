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

class Tomato_Modules_Core_Services_Crawler
{
	/**
	 * @param array $params
	 * @example: $params['url'], $params['category_id'], $params['web_link']
	 */
	public function __construct($params = array())
	{
		require_once TOMATO_LIB_DIR.DS.'simplehtmldom/simple_html_dom.php';
		$functionName = '_'.$params['name'];
		$this->$functionName($params);
	}
	
	private function _vnexpress($params = array())
	{
		if (empty($params)) {
			return;
		}
		$vnexpress = new Tomato_Modules_Core_Services_Vnexpress();
		$html = file_get_html($params['url']);
		$container = $html->find('div.content-center', 0);

		$date = date('Y-m-d H:i:s');
		$params['date_time'] = $date;
		
		$topFolder = $container->find('.folder-top', 0);
		if ($topFolder != null) {
			$vnexpress->save($topFolder, $params);
		}
				
		foreach ($container->find('.folder-news') as $index => $folder) {
			if ($index < 14) {
				$vnexpress->save($folder, $params);
			}
		}
	}
} 