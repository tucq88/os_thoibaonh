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
 * @version 	$Id: LayoutPage.php 2077 2010-04-07 09:02:55Z huuphuoc $
 * @since		2.0.5
 */

interface Tomato_Modules_Core_Model_Interface_LayoutPage
{
	public function getOrderedPages();
	
	/**
	 * Re-update the order
	 * 
	 * @return int Maximum ordering
	 */
	public function reupdateOrder();
	
	/**
	 * Update the page order
	 * 
	 * @return int
	 */
	public function updateOrder($pageId = null, $order);
	
	/**
	 * @param string $name
	 * @return Tomato_Modules_Core_Model_LayoutPage
	 */
	public function getPageByName($name);
	
	/**
	 * Add new page
	 * 
	 * @param Tomato_Modules_Core_Model_LayoutPage $page
	 * @return int
	 */
	public function add($page);
	
	/**
	 * @param int $id
	 * @return int
	 */
	public function delete($id);
	
	/**
	 * Update page
	 * 
	 * @param Tomato_Modules_Core_Model_LayoutPage $page
	 * @return int
	 */
	public function update($page);
	
	/**
	 * Export all layout pages to INI file
	 * 
	 * @return boolean
	 */
	public function export($file);
	
	/**
	 * @param string $checkFor Field to check. Can be name or url
	 * @param string $value
	 * @return bool
	 */
	public function exist($checkFor, $value);
}
